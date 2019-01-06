<?php
// +----------------------------------------------------------------------
// | ke/thinkphp-migration
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------

if (class_exists(\think\Console::class)) {
    \think\Console::addDefaultCommands([
        \ke\phinx\command\Run::class,
        \ke\phinx\command\Create::class,
        \ke\phinx\command\Status::class,
        \ke\phinx\command\Rollback::class,
        \ke\phinx\command\Breakpoint::class,
        \ke\phinx\command\seed\Create::class,
        \ke\phinx\command\seed\Run::class
    ]);
}
