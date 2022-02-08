<?php

namespace App\Http\Controllers;

use App\student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //The main dashboard part
    {
       $students = student::all(); //return all from DB

       return view('students.dashboard', compact('students'));
                                        //compact:create array containing variables and their values
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //The Save Part : 
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'required',
            'adress' => 'required',
        ]);

        $student = new student;

        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->gender = $request->gender;
        $student->country = $request->country;
        $student->city = $request->city;
        $student->adress = $request->adress;

        $student->save();
        
        // Mass assignemant
        // student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student Successfully Registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = Student::findOrfail($id);

        return view('students.show',compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::findOrfail($id);

        return view('students.edit',compact('students'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'city' => 'required',
            'adress' => 'required',
        ]);
            
        $student = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'country' => $request->country,
            'city' => $request->city,
            'adress' => $request->adress,
        );

        Student::whereId($id)->update($student);
        return redirect()->route('students.index')->with('success', 'Student successfully  updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $students = Student::findOrfail($id);
        $students->delete();

        return redirect()->route('students.index')->with('success', 'Student successfully  deleted');
    }
}
