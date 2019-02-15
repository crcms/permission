<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60)->nullable()->comment('角色名');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：1-正常 2-禁用');
            $table->unsignedTinyInteger('super')->default(0)->comment('是否是超级管理员： 0-否 1-是');
            $table->unsignedBigInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedBigInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedBigInteger('deleted_at')->nullable()->comment('删除时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
