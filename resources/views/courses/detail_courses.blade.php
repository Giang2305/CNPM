@extends('welcome')
@section('content')
<div class="container mt-5 top1">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-3 name">Ngôn ngữ {{$course->Name}} </h1>
            <p class="lead">
                {{$course->Description}}
            </p>
            <div class="d-flex gap-3">
                <span><i class="fas fa-clock"></i> 20 giờ</span>
                <span><i class="fas fa-list"></i> {{ $course->chapters->sum(fn($chapter) => $chapter->lectures->count()) }} bài giảng</span>
                <span><i class="fas fa-user"></i> Giảng viên: {{$course->Teacher}}</span>
                <span><i class="fas fa-certificate"></i> Chứng chỉ</span>
                <span><i class="fas fa-star"></i> 4.3 (184 đánh giá)</span>
            </div>
            <a href="#" class="btn btn-success mt-3 button"><i class="fa-solid fa-right-to-bracket"></i> Đăng ký chỉ với {{$course->Price}}</a>
        </div>
        <div>
            <img style="border-radius: 2rem;" src="{{asset('public/images/' . $course->Image) }}" alt="Thư viện chuẩn C++" class="img-fluid " >
        </div>
        <button id="toggle-theme" class="btn" style="padding: 0px 0px 0px -100px"><i class="fa-brands fa-medapps fa-2xl"></i></button>
    </div>
</div>

<div class="container">
    <h1 class="named">Nội dung khóa học</h1>
    <p>{{ count($course->chapters) }} Chương • {{ $course->chapters->sum(fn($chapter) => $chapter->lectures->count()) }} bài giảng</p>
    <div class="accordion" id="courseAccordion">
        @foreach ($course->chapters as $chapter)
            <div class="card">
                <div class="card-header" id="heading-{{ $chapter->id }}">
                    <h5 class="mb-0">
                        <button class="btn btn-link named" type="button" data-toggle="collapse" 
                            data-target="#collapse-{{ $chapter->id }}" 
                            aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                            aria-controls="collapse-{{ $chapter->id }}">
                            {{ $chapter->title }} ({{ $chapter->lectures->count() }} bài giảng)
                        </button>
                    </h5>
                </div>

                <div id="collapse-{{ $chapter->id }}" 
                    class="collapse {{ $loop->first ? 'show' : '' }}" 
                    aria-labelledby="heading-{{ $chapter->id }}" 
                    data-parent="#courseAccordion">
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($chapter->lectures as $lecture)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                	<a href="{{ route('lectures.show', $lecture->id) }}" class="named">
                                		 Bài {{ $lecture->lecture_number }}: {{ $lecture->title }}
	                                    <span class="badge badge-primary badge-pill">
	                                        {{ $lecture->duration }} phút
	                                    </span>
                                	</a>                                   
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection('content')