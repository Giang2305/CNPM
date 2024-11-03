@extends('Admin.index')
@section('page-title', 'Edit Courses')
@section('content')
<style>
    .form-control {
        border: 2px solid #ced4da;
        padding: 10px;
        border-radius: 5px;
        font-size: 16px; 
    }

    .form-control:focus {
        border-color: #007bff; 
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none; 
    }

    textarea.form-control {
        resize: vertical; 
        min-height: 150px; 
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Chỉnh sửa thông tin khoá học</h2>

        <!-- Form chỉnh sửa thông tin khoá học -->
        <form action="{{ route('update_courses', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tên khoá học -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên khoá học</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $course->Name }}" placeholder="Nhập tên khoá học" required>
            </div>

            <!-- Mô tả khoá học -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả khoá học</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả khoá học" required>{{ $course->Description }}</textarea>
            </div>

            <!-- Tên giáo viên -->
            <div class="form-group mb-3">
                <label for="teacher" class="form-label">Giáo viên</label>
                <input type="text" class="form-control" id="teacher" name="teacher" value="{{ $course->Teacher }}" placeholder="Nhập tên giáo viên" required>
            </div>

            <!-- Hình ảnh khoá học -->
            <div class="form-group mb-3">
			    <label for="image" class="form-label">Hình ảnh</label>
			    <input type="file" class="form-control" id="image" name="image">

			    @if($course->Image)
			        <img src="{{ asset('public/images/' . $course->Image) }}" alt="Course Image" class="img-thumbnail mt-3 image-edit-zoom" style="max-width: 200px;">
			    @endif
			</div>

            <!-- Giá khoá học -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Giá khoá học</label>
                <input type="text" class="form-control" id="price" name="price" value="{{ $course->Price }}" placeholder="Nhập giá khoá học" required>
            </div>

            <!-- Trạng thái hoạt động -->
            <div class="form-group mb-3">
                <label for="is_active" class="form-label">Trạng thái hoạt động</label>
                <select class="form-control" id="is_active" name="is_active" required>
                    <option value="Open" {{ $course->is_active == 'Open' ? 'selected' : '' }}>Mở khoá học</option>
                    <option value="Close" {{ $course->is_active == 'Close' ? 'selected' : '' }}>Đóng khoá học</option>
                </select>
            </div>

             <div class="position-relative row form-group mb-1">
                <div class="col-md-9 col-xl-8 offset-md-2">
                    <a href="{{ route('all_courses') }}" class="border-0 btn btn-outline-danger mr-1">
                        <span class="btn-icon-wrapper pr-1 opacity-8">
                            <i class="fa fa-times fa-w-20"></i>
                        </span>
                        <span>Huỷ</span>
                    </a>

                    <button type="submit" class="btn-shadow btn-hover-shine btn bg-gradient-warning">
                        <span class="btn-icon-wrapper pr-2 opacity-8">
                            <i class="fa fa-edit fa-w-20"></i>
                        </span>
                        Sửa
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection