<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $students = Student::orderBy("id", "desc")->paginate(5);
        return view('students.list', compact('students'));
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'father_name' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'digits:10', 'unique:students'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', Password::min(8)],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'image' => ['required','image','mimes:jpeg,png,jpg','max:2048']
        ]);

        // check email and mobile number already exist
            $student = new Student;
            $student->name = $request->name;
            $student->father_name = $request->father_name;
            $student->mobile = $request->mobile;
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->address = $request->address;
            $student->city = $request->city;
            $student->state = $request->state;

            // generate unique filename
            $timestamp = time();
            $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            
            //store image
            $student->image = $request->file('image')->storeAs('uploads', $imageFileName);
            $student->save();
            return redirect('student/list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);

        // if (Gate::denies('edit_profile', $student)) {
        //     abort(403);
        // }
        // if (! Gate::allows('edit_profile', $student)) {
        //     abort(403);
        // }

        if (! Gate::allows('edit_profile', $student)) {
            abort(403);
        }

        return view('students.edit', compact('student'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $student = Student::findOrFail($id);

        // if (Gate::denies('edit_profile', $student)) {
        //     abort(403);
        // }

        if (! Gate::allows('edit_profile', $student)) {
            abort(403);
        }
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'father_name' => ['required', 'string', 'max:100'],
            'mobile' => ['required', 'digits:10', Rule::unique('students')->ignore($student->id) ],
            'email' => ['required', 'email', 'max:255'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg','max:2048']
        ]);

        $student->name = $request->name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->email = $request->email;
        $student->address = $request->address;
        $student->city = $request->city;
        $student->state = $request->state;
        
        if($request->hasFile('image'))
        {
            $destination = 'storage/'.$student->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            // generate unique filename
            $timestamp = time();
            $imageFileName = $timestamp . '.' . $request->file('image')->getClientOriginalExtension();
            
            //store image
            $student->image = $request->file('image')->storeAs('uploads', $imageFileName);
        }

        $student->update();

        return redirect()->route('student/list', $student->id)
        ->with('success', 'Student details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($studentId)
    {
        // dd($studentId);
        // Find the student record
        $student = Student::find($studentId);
        // Check if there are any dependent records in the student_documents table
        $dependentDocuments = StudentDocument::where('student_id', $studentId)->get();

        if ($dependentDocuments->isEmpty()) {
            // If there are no dependent documents, you can safely delete the student
            $student->delete();
            // Optionally, you can add a success message
            return redirect()->route('student/list')->with('success', 'Student deleted successfully.');
        } else {
            // Handle the case where there are dependent documents
            foreach ($dependentDocuments as $document) {
                $document->delete();
            }
            $student->delete();
            return redirect()->route('student/list')->with('error', 'Cannot delete student with dependent documents.');
        }
    }
}
