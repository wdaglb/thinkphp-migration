<?php
// +----------------------------------------------------------------------
// | 商城v2
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------


namespace ke\phinx\command;


use ke\phinx\Command;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;


/**
 * Class Phinx
 * @package app\command
 *
 * php think migrate:run --e integral
 */
class Run extends Command
{
    protected function configure()
    {
        return $this->setName('migrate:run')
            ->addArgument('name', Argument::OPTIONAL, 'migrate_name')
            ->addOption('e', null, Option::VALUE_REQUIRED, 'env');
    }


    protected function execute(Input $input, Output $output)
    {
        $configPath = $this->initConfig();


        $command = $input->getArgument('name');
        $app = new PhinxApplication();
        $wrap = new TextWrapper($app, [
            'configuration'=>$configPath
        ]);
        $routes = [
            'status' => 'getStatus',
            'migrate' => 'getMigrate',
            'rollback' => 'getRollback',
        ];

        if (!isset($routes[$command])) {
            $commands = implode(', ', array_keys($routes));
            $output->writeln("Command not found! Valid commands are: {$commands}.");
            die;
        }

        $env = null;
        if ($input->hasOption('e')) {
            $env = $input->getOption('e');
        }

        $output = call_user_func([$wrap, $routes[$command]], $env, null);

        echo $output;
    }

}
