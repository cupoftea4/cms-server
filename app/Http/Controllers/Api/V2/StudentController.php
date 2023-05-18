<?php

namespace App\Http\Controllers\Api\V2;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V2\StudentResource;
use App\Http\Resources\V2\StudentCollection;
use App\Http\Requests\V2\StoreStudentRequest;
use App\Http\Requests\V2\UpdateStudentRequest;
        
class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']); // Apply middleware to all methods except 'index' and 'show'
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new StudentCollection(Student::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        return new StudentResource(Student::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        if (empty($student)) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->all());
        return new StudentResource(Student::find($student->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        if (empty($student)) {
            return response()->json(['error' => 'Student not found'], 404);
        }
        $student->delete();
        return $id;
    }
}
