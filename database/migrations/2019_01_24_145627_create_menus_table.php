<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 60)->nullable()->comment('菜单标题');
            $table->string('url', 150)->nullable()->comment('url');
            $table->string('route', 60)->nullable()->comment('route');
            $table->string('icon', 60)->nullable()->comment('菜单图标');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态：1-正常 2-禁用');
            $table->unsignedBigInteger('created_at')->default(0)->comment('创建时间');
            $table->unsignedBigInteger('updated_at')->default(0)->comment('更新时间');
            $table->unsignedBigInteger('deleted_at')->nullable()->comment('删除时间');
            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
