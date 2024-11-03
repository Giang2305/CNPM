<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('tbl_user')->onDelete('cascade'); // Tham chieesu bảng tbl_user
            $table->foreignId('lectures_id')->constrained('tbl_lectures')->onDelete('cascade'); //bảng lectures
            $table->float('progress');
            $table->enum('status', ['Completed', 'Incomplete']); 
            $table->timestamp('completed_at')->nullable();    // Thời điểm hoàn thành
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user_progress');
    }
};
