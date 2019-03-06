<?php

namespace CrCms\Permission\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use CrCms\Foundation\Helpers\InstanceConcern;
use CrCms\Permission\Repositories\FieldRepository;

class GetTableFieldCommand extends Command
{
    use InstanceConcern;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:fields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all table fields';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /* @var FieldRepository $repository */
        $repository = $this->app->make(FieldRepository::class);

        //获取数据库中字段的数据信息
        $models = $repository->all();

        //获取所有表的字段信息
        $tables = $this->getAllTables();

        $this->dataStorage($repository, $models, $tables);
    }

    /**
     * 获取所有表的迁移信息.
     *
     * @return array
     */
    protected function getAllTables()
    {
        $schema = Schema::getConnection()->getDoctrineSchemaManager();

        $schema->getDatabasePlatform()
        ->registerDoctrineTypeMapping('geometry', 'string');

        $schema->getDatabasePlatform()
            ->registerDoctrineTypeMapping('point', 'string');

        //获取所有表名
        $tables = $schema->listTableNames();

        $data = [];
        $temp = [];

        //格式化返回数据
        foreach ($tables as $key => $val) {
            //判断是否含有迁移表
            $has_migrations = $this->config->get('database.migrations', 'migrations');

            if (strtolower(substr($val, -10)) === strtolower(substr($has_migrations, -10))) {
                continue;
            }

            $columns = $schema->listTableColumns($val);

            //获取列的详情信息
            foreach ($columns as $v) {
                $temp['table_name'] = $val;
                $temp['field_key'] = $v->getName();
                $temp['name'] = $v->getComment() ?? '';
                $data[] = $temp;
            }
        }

        return $data;
    }

    /**
     * 数据入库.
     *
     * @param FieldRepository $repository
     * @param Collection $collect
     * @param $tables
     */
    protected function dataStorage(FieldRepository $repository, Collection $collect, $tables)
    {
        $guard = ['table_name', 'field_key', 'name'];

        try {
            //判断数据库是否为空
            if ($collect->isEmpty()) {
                foreach ($tables as $key => $val) {
                    $repository->setGuard($guard)->create($val);
                }
            } else {
                //获取所有数据库的字段数据
                $tmp = [];
                $data = [];

                foreach ($collect as $k => $v) {
                    $tmp[$k] = $v->table_name.'.'.$v->field_key;
                }

                //新增的字段值入库
                foreach ($tables as $_k => $_v) {
                    //按照表名.字段名组成新常量
                    $new = $_v['table_name'].'.'.$_v['field_key'];

                    //判断table_name, field 是否存在数据库中,若存在跳过循环
                    if (in_array($new, $tmp)) {
                        continue;
                    }

                    $data['table_name'] = $_v['table_name'];
                    $data['field_key'] = $_v['field_key'];
                    $data['name'] = $_v['name'];
                    $repository->setGuard($guard)->create($data);
                }
            }
        } catch (\Exception $e) {
            Log::error('字段数据入库填充错误'.$e->getMessage());
        }
    }
}
