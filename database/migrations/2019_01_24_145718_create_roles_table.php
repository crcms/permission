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
            $table->string('name', 128)->nullable()->comment('角色名');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->tinyInteger('status')->default(1)->comment('状态：1-正常 2-禁用');
            $table->tinyInteger('super')->default(0)->comment('是否是超级管理员： 0-否 1-是');
            $table->bigInteger('created_at')->nullable()->comment('创建时间');
            $table->bigInteger('updated_at')->nullable()->comment('更新时间');
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
