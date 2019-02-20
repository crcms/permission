<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 60)->nullable()->comment('权限标题');
            $table->string('route', 60)->nullable(true)->comment('路由');
            $table->string('action', 10)->nullable()->comment('http请求方法');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->string('tags', 30)->nullable()->comment('标签');
            $table->unsignedTinyInteger('status')->default(1)->comment('状态：1-正常 2-禁用');
            $table->unsignedBigInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedBigInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedBigInteger('deleted_at')->nullable()->comment('删除时间');

            $table->unique('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
