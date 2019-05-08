<?php

use Illuminate\Support\Facades\DB;
use CrCms\Permission\Repositories\Constants\CommonConstant;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $result = DB::table('roles')->where('super', CommonConstant::SUPER_YES)->first();
        if (! $result) {
            DB::table('roles')->insert([
                'name' => '超级管理员',
                'remark' => '超级管理员',
                'status' => CommonConstant::STATUS_NORMAL,
                'super' => CommonConstant::SUPER_YES,
                'created_at' => \Illuminate\Support\Carbon::now()->getTimestamp(),
                'updated_at' => \Illuminate\Support\Carbon::now()->getTimestamp(),
            ]);
        }
    }
}