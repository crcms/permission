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
            $table->string('title', 128)->nullable()->comment('菜单标题');
            $table->string('url', 255)->nullable()->comment('url');
            $table->string('route', 128)->nullable()->comment('route');
            $table->string('icon', 255)->nullable()->comment('菜单图标');
            $table->string('remark', 255)->nullable()->comment('备注');
            $table->integer('sort')->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态：1-正常 2-禁用');
            $table->integer('pid')->default(0)->comment('父id');
            $table->bigInteger('created_at')->nullable()->comment('创建时间');
            $table->bigInteger('updated_at')->nullable()->comment('更新时间');
            $table->bigInteger('deleted_at')->nullable(true)->comment('删除时间');

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
