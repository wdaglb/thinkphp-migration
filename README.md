# thinkphp-migration

> 本扩展与官方的区别是什么？

_支持最新的phinx扩展,直接composer更新而不是固定死版本_

_为什么不直接使用phinx包?因为使用命令需要vendor\bin\phinx,还有配置文件也要自定义,本扩展已支持加载tp的数据库配置_

_由于tp内置的命令行选项是2个-的，所以我们的命令都会成 php think migrate:run --e dev 这样子的选项_

```
composer require ke/thinkphp-migration
```

## Config 配置文件

```
<?php
// /config/migration.php
return [
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
];
```

## Breakpoint 命令

> Breakpoint 命令用来设置断点，可以使你对回滚进行限制。你可以调用 breakpoint 命令不带任何参数，也就是断点设在最新的迁移脚本上

```
php think migrate:breakpoint --e development
```

> 可以使用 --t 来指定断点打到哪个迁移版本上

```
php think migrate:breakpoint --e development --t 20120103083322
```

> 可以使用 --r 来移除所有断点

```
php think migrate:breakpoint --e development --r
```

> 当你运行 status 命令时可以看到断点信息

## Create 命令

> create 命令用来创建迁移脚本文件。需要一个参数：脚本名。迁移脚本命名应该保持 驼峰命名法

```
php think migrate:create MyNewMigration
```

## Run 命令

> Run 命令默认运行执行所有脚本，可选指定环境

```
php think migrate:run --e development
```

> 可以使用 --t 来指定执行某个迁移脚本

```
php think migrate:run --e development --t 20110103081132
```

## Rollback 命令

> Rollback 命令用来回滚之前的迁移脚本。与 Run 命令相反。
> 你可以使用 rollback 命令回滚上一个迁移脚本。不带任何参数

```
php think migrate:rollback --e development
```

> 使用 --t 回滚指定版本迁移脚本

```
php think migrate:rollback --e development --t 20120103083322
```

> 指定版本如果设置为0则回滚所有脚本

```
php think migrate:rollback --e development --t 0
```

> 可以使用 --d 参数回滚指定日期的脚本

```
php think migrate:rollback --e development --d 2012
php think migrate:rollback --e development --d 201201
php think migrate:rollback --e development --d 20120103
php think migrate:rollback --e development --d 2012010312
php think migrate:rollback --e development --d 201201031205
php think migrate:rollback ---e development --d 20120103120530
```

## 创建Seed类

> 不像数据库迁移，Phinx 并不记录 seed 是否执行过。这意味着 seeders 可以被重复执行。请在开发的时候记住

> Phinx 用下面命令创建一个新的 seed 类

```
php think seed:create UserSeeder
```

## 执行 Seed

> 这很简单，当注入数据库时，只需要运行 seed:run 命令

```
php think seed:run
```

> 默认Phinx会执行所有 seed。 如果你想要指定执行一个，只要增加 -s 参数并接 seed 的名字

```
php think seed:run -s UserSeeder
```