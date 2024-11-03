<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use App\Models\Course;
use DB;

class StudentsController extends Controller
{
    //User View
    public function profile($id){
        $course = Course::all();
        $linkedId = session('linked_id');
        $student = Students::findOrFail($linkedId);
        return view('user_profile.show', compact('student','course'));
    }

    public function update_profile(Request $request, $id){
        $student = Students::findOrFail($id);
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'profile_image' => $request->profile_image,
            'status' => $request->status,
            'created_at' => now(),
        ];

        if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName);
        $data['profile_image'] = $fileName;
        }else{
            $data['profile_image'] = $student->profile_image;
        }

        $student->update($data);

        session([
            'name' => $student->name,
            'profile_image' => $student->profile_image,
        ]);

        return redirect()->route('student.profile', ['id' => $id])->with('success', 'Profile updated successfully');
    }

    //Admin view
    public function all_students(){
        $all_students = DB::table('tbl_students')
                        ->orderByDesc('id')
                        ->get();
        return view('admin.students.show_students', compact('all_students'));
    }

    //Create
    public function show_create_student()
    {
        return view('admin.students.create_student');
    }
    public function create_student(Request $request)
    {
        
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'profile_image' => $request->profile_image,
            'status' => $request->status,
            'created_at' => now(),
        ];

        if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName); 
        $data['profile_image'] = $fileName;
        }else{
            $data['profile_image'] = $student->profile_image;
        }

        DB::table('tbl_students')->insert($data);

        return redirect()->route('all_students')->with('success', 'Student created successfully.');
    }

    //Edit
    public function show_edit_student($id){
        $student = DB::table('tbl_students')->where('id', $id)->first();
        if (!$student) {
            return redirect()->route('all_students')->with('error', 'Student not found.');
        }
        return view('admin.students.edit_student', compact('student'));
    }
    public function edit_student(Request $request, $id){ 
        $student = DB::table('tbl_students')->where('id', $id)->first();
        $data = [
            'name' => $request->name,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'start_date' => $request->start_date,
            'profile_image' => $request->profile_image,
            'status' => $request->status,
            'created_at' => now(),
        ];

        if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName);
        $data['profile_image'] = $fileName;
        }else{
            $data['profile_image'] = $student->profile_image;
        }

        DB::table('tbl_students')->where('id', $id)->update($data);

        return redirect()->route('all_students')->with('success', 'Student edited successfully.');
    }

    //Delete
    public function delete_student($id){

        DB::table('tbl_students')->where('id', $id)->delete();

        return redirect()->route('all_students')->with('success', 'Student deleted successfully.');
    }
}
