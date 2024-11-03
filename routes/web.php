<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LecturesController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExercisesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Login
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [LoginController::class, 'show_register']);
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/profile/{id}', [StudentsController::class, 'profile'])->name('student.profile');
Route::post('/profile/update/{id}', [StudentsController::class, 'update_profile'])->name('student.update');

//Courses:
Route::get('/courses', [CoursesController::class, 'index']);
Route::get('/courses/{id}', [CoursesController::class, 'detail']);

//Lecture Content:
Route::get('/lecture/{id}', [LecturesController::class, 'show'])->name('lectures.show');

//Admin Dashboard:
    Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login'); 

    Route::get('/admin/', [AdminController::class, 'index'])->name('admin.show'); // route for viewing admin
    // Route::get('/admin', [AdminController::class, 'index']);

    //Courses Router
        Route::get('/admin/show_courses', [CoursesController::class, 'all_courses'])->name('all_courses');
        Route::get('/admin/courses/create', [CoursesController::class, 'show_create_courses'])->name('create_courses');
        Route::post('/admin/courses/create/save', [CoursesController::class, 'create_courses'])->name('save_courses');
        Route::get('/admin/courses/edit/{id}', [CoursesController::class, 'show_edit_courses'])->name('edit_courses');
        Route::post('/admin/courses/edit/save/{id}', [CoursesController::class, 'edit_courses'])->name('update_courses');
        Route::delete('/admin/show_courses/delete/{id}', [CoursesController::class, 'delete_courses'])->name('delete_courses');
    //Teacher Router
        Route::get('/admin/show_teacher', [TeacherController::class, 'all_teacher'])-> name('all_teacher');
        Route::get('/admin/teacher/create', [TeacherController::class, 'show_create_teacher'])->name('create_teacher');
        Route::post('/admin/teacher/create/save', [TeacherController::class, 'create_teacher'])->name('save_teacher');
        Route::get('/admin/teacher/edit/{id}', [TeacherController::class, 'show_edit_teacher'])->name('edit_teacher');
        Route::post('/admin/teacher/edit/save/{id}', [TeacherController::class, 'edit_teacher'])->name('update_teacher');
        Route::delete('/admin/show_teacher/delete/{id}', [TeacherController::class, 'delete_teacher'])->name('delete_teacher');
    //Students Route
        Route::get('/admin/show_students', [StudentsController::class, 'all_students'])-> name('all_students');
        Route::get('/admin/students/create', [StudentsController::class, 'show_create_student'])->name('create_student');
        Route::post('/admin/students/create/save', [StudentsController::class, 'create_student'])->name('save_student');
        Route::get('/admin/students/edit/{id}', [StudentsController::class, 'show_edit_student'])->name('edit_student');
        Route::post('/admin/students/edit/save/{id}', [StudentsController::class, 'edit_student'])->name('update_student');
        Route::delete('/admin/show_students/delete/{id}', [StudentsController::class, 'delete_student'])->name('delete_student');
    //Lectures Route
        Route::get('/admin/show_lectures', [LecturesController::class, 'all_lectures'])-> name('all_lectures');
        Route::get('/admin/lecture/create', [LecturesController::class, 'show_create_lecture'])->name('create_lecture');
        Route::post('/admin/lecture/create/save', [LecturesController::class, 'create_lecture'])->name('save_lecture');
        Route::get('/admin/lecture/edit/{id}', [LecturesController::class, 'show_edit_lecture'])->name('edit_lecture');
        Route::post('/admin/lecture/edit/save/{id}', [LecturesController::class, 'edit_lecture'])->name('update_lecture');
        Route::delete('/admin/show_lectures/delete/{id}', [LecturesController::class, 'delete_lecture'])->name('delete_lecture');
        Route::post('/save-chapter', [LecturesController::class, 'save_chapter']);
    //Exercises Route
        Route::get('/admin/show_exercises', [ExercisesController::class, 'all_exercises'])-> name('all_exercises');
        Route::get('/admin/exercises/create', [ExercisesController::class, 'show_create_exercise'])->name('create_exercise');
        Route::post('/admin/exercises/create/save', [ExercisesController::class, 'create_exercise'])->name('save_exercises');
        Route::get('/admin/exercises/edit/{id}', [ExercisesController::class, 'show_edit_exercise'])->name('edit_exercise');
        Route::post('/admin/exercises/edit/save/{id}', [ExercisesController::class, 'edit_exercise'])->name('update_exercise');
        Route::delete('/admin/show_exercises/delete/{id}', [ExercisesController::class, 'delete_exercise'])->name('delete_exercise');

/*Route::prefix('Admin')->middleware(['auth', 'auth.Admin'])->group(function(){
    //Courses Router
    Route::get('/admin/show', [CoursesController::class, 'show']);
});
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

profile/show.blade.php
<h1>{{ $course->Name }}</h1>
<p>Tiến độ học tập: {{ $progress }}%</p>

@foreach ($course->chapters as $chapter)
    <h2>{{ $chapter->title }}</h2>
    <ul>
        @foreach ($chapter->lectures as $lecture)
            <li>
                {{ $lecture->title }} 
                ({{ $lecture->type }})
                @if ($lecture->type === 'video')
                    - Thời lượng: {{ $lecture->duration }} phút
                @endif
            </li>
        @endforeach
    </ul>
@endforeach

 <!-- edit_exercise.blade.php
 @if($lectures->title)
<p class="mt-2">Tên file: <strong>{{$lectures->title}}</strong></p>
@else
    <p class="mt-2 text-muted">Chưa chọn khoá học.</p>
@endif
-->
*/
?>