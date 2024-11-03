<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use DB;

class CoursesController extends Controller
{

//User view
     public function index(){
       $all_courses = DB::table('tbl_courses')
                    ->orderByDesc('id')
                    ->get();
        return view('courses.all_courses', compact('all_courses'));
    }

    public function detail($id){
        $course = Course::with('chapters.lectures')->findOrFail($id);
        return view('courses.detail_courses', compact('course'));
    }
    
//Admin view
    public function all_courses(){
        $all_courses = DB::table('tbl_courses')
                        ->orderByDesc('id')
                        ->get();
        return view('admin.courses.show_courses', compact('all_courses'));
    }

    //Create
    public function show_create_courses()
    {
        $userId = session('user_id');
        return view('admin.courses.create_courses');
    }
    public function create_courses(Request $request)
    {
        $data = [
            'Name' => $request->name,
            'Description' => $request->description,
            'Teacher' => $request->teacher,
            'Price' => $request->price,
            'is_active' => $request->is_active,
            'created_at' => now(),
        ];

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName); 
        $data['Image'] = $fileName;
        }

        DB::table('tbl_courses')->insert($data);

        return redirect()->route('all_courses')->with('success', 'Category created successfully.');
    }

    //Edit
    public function show_edit_courses($id){
        $course = DB::table('tbl_courses')->where('id', $id)->first();
        if (!$course) {
            return redirect()->route('all_courses')->with('error', 'Courses not found.');
        }
        return view('admin.courses.edit_courses', compact('course'));
    }
    public function edit_courses(Request $request, $id){ 
        $data = [
            'Name' => $request->name,
            'Description' => $request->description,
            'Teacher' => $request->teacher,
            'Price' => $request->price,
            'is_active' => $request->is_active,
            'created_at' => now(),
        ];

        if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName(); 
        $file->move(public_path('images'), $fileName);
        $data['Image'] = $fileName;
        }

        DB::table('tbl_courses')->where('id', $id)->update($data);

        return redirect()->route('all_courses')->with('success', 'Category edited successfully.');
    }

    //Delete
    public function delete_courses($id){

        DB::table('tbl_courses')->where('id', $id)->delete();

        return redirect()->route('all_courses')->with('success', 'Category deleted successfully.');
    }
}
