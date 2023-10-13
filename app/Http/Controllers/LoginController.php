<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
   
    public function showLoginForm()
    {
        return view('students.login');
    }

    public function login(Request $request)
    {
        // Validate the login data
        // Validate the user's login credentials
            $credentials = $request->only('email', 'password');
        
        //for plain text password    
        // $student = Student::where($credentials)->get()->First();
        // if($student) {
        //     Auth::loginUsingId($student->id);
        //     return redirect()->intended('student/list'); 
        // } else {
        //     return back()->withErrors(['email' => 'Invalid credentials']);
        // }
        
        // For encrypted password
        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('student/list'); // Use route name instead of URL

        } else {
            // Authentication failed
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('students.login');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
