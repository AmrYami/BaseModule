<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');
            $table->morphs('notifiable');
            $table->enum('seen', ['0', '1'])->comment('0 == not seen | 1 == seen');
            $table->text('data');
            $table->string('route')->nullable();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
