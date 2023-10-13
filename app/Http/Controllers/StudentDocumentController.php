<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class StudentDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($student_id)
    {   
        $studentData = DB::table('student_documents')
            ->leftJoin('students', 'students.id', '=', 'student_documents.student_id')
            ->select('students.id as student_id', 'students.name', 'student_documents.document',  'student_documents.file')
            ->get();

        $student = Student::find($student_id);
        
        $studentDocuments = $student->documents()->paginate(5);

        return view('documents.index', compact('studentDocuments','student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($student_id)
    {
        return view('documents.add', ['student_id' => $student_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($student_id, Request $request)
    {
        $student = Student::find($student_id);
        
        $validated = $request->validate([
            'document' => ['required', 'string', 'max:100'],
            'file' => ['nullable','file','mimes:jpeg,png,jpg','max:2048']
        ]);

        $studentDocument = new StudentDocument;
        $studentDocument->document = $request->document;
        // generate unique filename
        $timestamp = time();
        $imageFileName = $timestamp . '.' . $request->file('file')->getClientOriginalExtension();
        //store image
        $studentDocument->file = $request->file('file')->storeAs('fileUploads', $imageFileName);

        // Set the student_id using the associated student model
        $studentDocument->student_id = $student->id;

        $studentDocument->save();

        return redirect()->route('documents.index', ['student_id' => $student_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $student_id, $document_id)
    {
        $studentDocument = StudentDocument::findOrFail($document_id);
        return view('documents.edit', ['student_id' => $student_id, 'studentDocument' => $studentDocument]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $student_id, string $document_id, Request $request)
    {
        $studentDocument = StudentDocument::where('id', $document_id)
                                            ->where('student_id', $student_id)
                                            ->get()
                                            ->first();
        //Update data                                    
        $studentDocument->document = $request->document;
        if($request->hasFile('file'))
        {
            $destination = 'storage/' .$studentDocument->file;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
             // generate unique filename
            $timestamp = time();
            $imageFileName = $timestamp . '.' . $request->file('file')->getClientOriginalExtension();
            //store image
            $studentDocument->file = $request->file('file')->storeAs('fileUploads', $imageFileName);
        }

        $studentDocument->update();
        return redirect()->route('documents.index', ['student_id' => $student_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($student_id, $document_id, Request $request)
    {
        // Find the student and the document
        $student = Student::find($student_id);
        $document = StudentDocument::find($document_id);

        $document->delete(); // Soft delete by default
        return redirect()->route('documents.index', ['student_id' => $student_id])->with('success', 'Document deleted successfully.');
    }

    //Upload multiple form
    public function addMultipleImages($student_id, Request $request)
    {
        return view('documents.addMultiple', ['student_id' => $student_id]);
    }

    public function storeMultipleImages($student_id, Request $request)
    {   
        $student = Student::find($student_id);

        if ($request->hasFile('file')) {
                $documents = $request->input('document');
                $files = $request->file('file');
                
                foreach ($files as $key => $file) {
                    // $originalFileName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $uniqueFileName = time() . '_' . uniqid() . '.' . $extension;
                    $path = $file->storeAs('fileUploads', $uniqueFileName);
                    
                    $studentDocument = new StudentDocument;
                    $studentDocument->document = $documents[$key];
                    $studentDocument->file = $path;
                    $studentDocument->student_id = $student->id;
                    $studentDocument->save();
                }
        }
        return redirect()->route('documents.index', ['student_id' => $student_id]);
    }

}
