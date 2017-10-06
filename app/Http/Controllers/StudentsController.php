<?php

namespace Roscio\Http\Controllers;

use Illuminate\Http\Request;
use Roscio\Http\Requests\CreateStudentRequest;
use Roscio\Http\Requests\EditStudentRequest;
use Roscio\Student;
use Roscio\Register;
use Roscio\Http\Requests;
use Roscio\Http\Controllers\Controller;
use Session;
use Redirect;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $estudiantes = Student::Ci($request->get('ci'))
            ->Name($request->get('name'))
            ->paginate();
        return view('students.index', compact('estudiantes'));
    }

    public function buscar_ci($cedula, Request $request)
    {
        $student = Student::where('ci', $cedula)->first();
        if ($student)
        {
            return response()->json(['created' => true, 'student' => $student]);
        }else
        {
            return response()->json(['created' => false]);
        }
        
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
    public function store(CreateStudentRequest $request)
    {
        $student = new Student($request->all());
        $student->save();
        Session::flash('success-message', 'El estudiante fue creado exitosamente');
        return Redirect::route('students.show', $student->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = Student::find($id);
        $registers = Register::where('student_id', $id)->get();
        //dd($registers);
        return view('students.show', compact('estudiante', 'registers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditStudentRequest $request, $id)
    {
        $student = Student::find($id);
        $student->fill($request->all());
        $student->save();
        Session::flash('success-message', 'El estudiante fue editado exitosamente');
        return Redirect::route('students.show', $student->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
