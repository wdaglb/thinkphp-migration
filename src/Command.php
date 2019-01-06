<?php
// +----------------------------------------------------------------------
// | 商城v2
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------


namespace ke\phinx;


use think\facade\App;
use think\facade\Config;

class Command extends \think\console\Command
{
    protected function initConfig()
    {
        $base_dir = App::getRootPath() . 'db/';
        $config = [
            'paths'=>[
                'migrations'=>$base_dir . 'migrations',
                'seeds'=>$base_dir . 'seeds',
            ],
            'environments'=>[
                'default_migration_table'=>'phinxlog',
                'default_database'=>'shop',
                'shop'=>[
                    'adapter'=>Config::get('database.we7.type'),
                    'host'=>Config::get('database.we7.hostname'),
                    'name'=>Config::get('database.we7.database'),
                    'user'=>Config::get('database.we7.username'),
                    'pass'=>Config::get('database.we7.password'),
                    'table_prefix'=>Config::get('database.we7.prefix'),
                    'port'=>Config::get('database.we7.hostport'),
                    'charset'=>'utf8',
                    'collation'=>'utf8mb4_unicode_ci'
                ],
                'integral'=>[
                    'adapter'=>Config::get('database.type'),
                    'host'=>Config::get('database.hostname'),
                    'name'=>Config::get('database.database'),
                    'user'=>Config::get('database.username'),
                    'pass'=>Config::get('database.password'),
                    'table_prefix'=>Config::get('database.prefix'),
                    'port'=>Config::get('database.hostport'),
                    'charset'=>'utf8',
                    'collation'=>'utf8mb4_unicode_ci'
                ]
            ]
        ];

        $config_path = App::getRuntimePath() . 'phinx.json';
        file_put_contents($config_path, json_encode($config));

        return $config_path;
    }

}