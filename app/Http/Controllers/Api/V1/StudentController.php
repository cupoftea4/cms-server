<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
        
class StudentController extends Controller
{
    private $students = [ 
        [
            'id' => 1,
            'name' => 'John',
            'surname' => 'Doe',
            'group' => 'PZ-21',
            'gender' => 'M',
            'birthDate' => '1990-01-01'
        ],
        [
            'id' => 2,
            'name' => 'Amy',
            'surname' => 'Lio',
            'group' => 'PZ-23',
            'gender' => 'F',
            'birthDate' => '2005-01-01'
        ]
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['error' => 'No data provided'], 400);
        }

        if (
            is_numeric($request->input('name')) || 
            empty($request->input('surname')) || 
            empty($request->input('group')) ||
            strpos($request->input('name'), '*') !== false ||
            strpos($request->input('surname'), '*') !== false
        ) {
            return response()->json(['error' => 'Data is invalid'], 400);
        }

        $newStudent = $request->all();
        $newStudent['id'] = count($this->students) + 1;
        $newStudent['status'] = 'inactive';
        $this->students[] = $newStudent;

        return response()->json($this->students);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = array_filter($this->students, function ($student) use ($id) {
            return $student['id'] == $id;
        });
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->students = array_map(function ($student) use ($request, $id) {
            if ($student['id'] == $id) {
                return $request->all();
            }
            return $student;
        }, $this->students);
        return response()->json($this->students);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->students = array_filter($this->students, function ($student) use ($id) {
            return $student['id'] != $id;
        });
        return response()->json($this->students);
    }
}
