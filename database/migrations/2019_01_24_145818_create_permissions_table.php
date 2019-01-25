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
            $table->string('title', 255)->nullable()->comment('权限标题');
            $table->string('route', 255)->nullable(true)->comment('路由');
            $table->string('action', 255)->nullable()->comment('http请求方法');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->tinyInteger('status')->default(1)->comment('状态：1-正常 2-禁用');
            $table->bigInteger('created_at')->nullable()->comment('创建时间');
            $table->bigInteger('updated_at')->nullable()->comment('更新时间');
            $table->softDeletes()->comment('删除时间');
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
