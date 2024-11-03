<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class UserProgressController extends Controller
{
    // Lấy tiến độ của một khóa học cho người dùng hiện tại
    public function getProgress($course_id)
    {
        $user_id = Auth::id();  // Lấy ID của người dùng hiện tại

        // Tổng số bài giảng trong khóa học
        $totalLectures = Course::findOrFail($course_id)
            ->chapters()
            ->withCount('lectures')
            ->get()
            ->sum('lectures_count');

        // Số bài đã hoàn thành của người dùng
        $completedLectures = UserProgress::where('user_id', $user_id)
            ->whereHas('lecture', function ($query) use ($course_id) {
                $query->whereHas('chapter', function ($q) use ($course_id) {
                    $q->where('course_id', $course_id);
                });
            })
            ->where('is_completed', true)
            ->count();

        // Tính phần trăm tiến độ
        $progress = ($completedLectures / $totalLectures) * 100;

        return response()->json([
            'progress' => round($progress, 2)  // Làm tròn đến 2 chữ số thập phân
        ]);
    }
    
    public function updateProgress($userId, $lectureId, $progress)
    {
        // Kiểm tra xem bản ghi tồn tại không
        $userProgress = UserProgress::where('users_id', $userId)
                                     ->where('lectures_id', $lectureId)
                                     ->first();

        // Nếu chưa có bản ghi, tạo mới
        if (!$userProgress) {
            $userProgress = new UserProgress();
            $userProgress->users_id = $userId;
            $userProgress->lectures_id = $lectureId;
        }

        // Cập nhật tiến độ
        $userProgress->progress = $progress;

        // Nếu hoàn thành 100%, cập nhật trạng thái và thời điểm hoàn thành
        if ($progress == 100) {
            $userProgress->status = 'Completed';
            $userProgress->completed_at = now();
        } else {
            $userProgress->status = 'Incomplete';
            $userProgress->completed_at = null;
        }

        $userProgress->save();
    }

}
