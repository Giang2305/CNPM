@extends('Admin.index')
@section('page-title', 'Create Courses')
@section('content')
<style>
    /* Định dạng cho các trường input và textarea */
    .form-control {
        border: 2px solid #ced4da; /* Tăng độ dày của viền */
        padding: 10px; /* Tăng khoảng cách giữa chữ và viền */
        border-radius: 5px; /* Làm cho góc khung mềm mại hơn */
        font-size: 16px; /* Tăng cỡ chữ */
    }

    /* Định dạng khi người dùng tập trung vào trường input hoặc textarea */
    .form-control:focus {
        border-color: #007bff; /* Thay đổi màu viền khi tập trung vào */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Hiệu ứng bóng cho trường */
        outline: none; /* Bỏ đường viền mặc định */
    }

    /* Định dạng riêng cho textarea */
    textarea.form-control {
        resize: vertical; /* Cho phép kéo thả để thay đổi kích thước theo chiều dọc */
        min-height: 150px; /* Đặt chiều cao tối thiểu cho khung textarea */
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h2 class="mb-4 text-center">Tạo mới khoá học</h2>

        <!-- Form tạo mới khoá học -->
        <form action="{{ route('save_courses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Tên khoá học -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên khoá học</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên khoá học" required>
            </div>

            <!-- Mô tả khoá học -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả khoá học</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Nhập mô tả khoá học" required></textarea>
            </div>

            <!-- Tên giáo viên -->
            <div class="form-group mb-3">
                <label for="teacher" class="form-label">Giáo viên</label>
                <input type="text" class="form-control" id="teacher" name="teacher" placeholder="Nhập tên giáo viên" required>
            </div>

            <!-- Hình ảnh khoá học -->
            <div class="form-group mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <!-- Giá khoá học -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Giá khoá học</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá khoá học" required>
            </div>

            <!-- Trạng thái hoạt động -->
            <div class="form-group mb-3">
                <label for="is_active" class="form-label">Trạng thái hoạt động</label>
                <select class="form-control" id="is_active" name="is_active" required>
                    <option value="Open">Mở khoá học</option>
                    <option value="Close">Đóng khoá học</option>
                </select>
            </div>

            <div class="position-relative row form-group mb-1">
                <div class="position-relative row form-group mb-1">
                    <div class="col-md-9 col-xl-8 offset-md-2">
                        <a href="{{ route('all_courses') }}" class="border-0 btn btn-outline-danger mr-1">
                            <span class="btn-icon-wrapper pr-1 opacity-8">
                                <i class="fa fa-times fa-w-20"></i>
                            </span>
                            <span>Huỷ</span>
                        </a>

                        <button type="submit" class="btn-shadow btn-hover-shine btn bg-gradient-info">
                            <span class="btn-icon-wrapper pr-2 opacity-8">
                                <i class="fa fa-download fa-w-20"></i>
                            </span>
                            Tạo
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
