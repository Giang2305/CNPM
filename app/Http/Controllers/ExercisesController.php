<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lecture;
use App\Models\Exercises;
use DB;

class ExercisesController extends Controller
{
    //Admin View
    public function all_exercises(){
        $all_exercises = Exercises::with('lecture')->get(); // Lấy bài tập cùng thông tin bài giảng
        return view('admin.exercises.show_exercises', compact('all_exercises'));
    }

    //Create
    public function show_create_exercise()
    {
        $lectures = Lecture::all(); // Lấy danh sách bài giảng
        return view('admin.exercises.create_exercise', compact('lectures'));
    }

    public function create_exercise(Request $request)
    {
        $data = [
            'lecture_id' => $request->lecture_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'created_at' => now(),
        ];

        // Xử lý file nếu có
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('exercise_files'), $fileName);
            $data['file_path'] = $fileName;
        }

        DB::table('tbl_exercises')->insert($data);

        return redirect()->route('all_exercises')->with('success', 'Exercise created successfully.');
    }

    //Edit
    public function show_edit_exercise($id){
        $lectures = Lecture::all();
        $exercise = Exercises::findOrFail($id);
        
        return view('admin.exercises.edit_exercise', compact('exercise', 'lectures'));
    }

    public function edit_exercise(Request $request, $id){ 
        $exercise = Exercises::findOrFail($id);
        $data = [
            'lecture_id' => $request->lecture_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ];

        // Xử lý file nếu có
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('exercise_files'), $fileName);
            $data['file_path'] = $fileName;
        } else {
            $data['file_path'] = $exercise->file_path;
        }

        DB::table('tbl_exercises')->where('id', $id)->update($data);

        return redirect()->route('all_exercises')->with('success', 'Exercise updated successfully.');
    }

    //Delete
    public function delete_exercise($id){

        DB::table('tbl_exercises')->where('id', $id)->delete();
        return redirect()->route('all_exercises')->with('success', 'Exercise deleted successfully.');
    }
}
