<?php
// +----------------------------------------------------------------------
// | ke/thinkphp-migration
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------


namespace ke\phinx;


use think\Exception;
use think\facade\App;
use think\facade\Config;

class Command extends \think\console\Command
{
    protected function initConfig()
    {
        $config = Config::get('migration.');
        if (empty($config)) {
            throw new Exception('migration config is Empty');
        }
        $base_dir = App::getRootPath() . 'db/';
        if (!is_dir($base_dir)) {
            throw new Exception('path notExist:db/migrates;db/seeds');
        }
        $config = array_merge([
            'paths'=>[
                'migrations'=>$base_dir . 'migrations',
                'seeds'=>$base_dir . 'seeds',
            ],
            'environments'=>[
                'default_migration_table'=>'phinxlog',
                'default_database'=>'default',
                'default'=>[
                    'adapter'=>'mysql',
                    'host'=>'127.0.0.1',
                    'name'=>'',
                    'user'=>'',
                    'pass'=>'',
                    'table_prefix'=>'',
                    'port'=>3306,
                    'charset'=>'utf8',
                    'collation'=>'utf8mb4_unicode_ci'
                ]
            ]
        ], $config);

        $config_path = App::getRuntimePath() . 'phinx.json';
        file_put_contents($config_path, json_encode($config));

        return $config_path;
    }

}