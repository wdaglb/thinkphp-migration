<?php
// +----------------------------------------------------------------------
// | ke/thinkphp-migration
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------


namespace ke\phinx\command;


use ke\phinx\Command;
use Phinx\Console\PhinxApplication;
use Phinx\Wrapper\TextWrapper;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;


/**
 * Class Phinx
 * @package app\command
 *
 * php think migrate:status
 */
class Status extends Command
{
    protected function configure()
    {
        return $this->setName('migrate:status')
            ->addOption('e', null, Option::VALUE_OPTIONAL, 'env')
            ->addOption('t', null, Option::VALUE_OPTIONAL, 'target');
    }


    protected function execute(Input $input, Output $output)
    {
        $configPath = $this->initConfig();


        $app = new PhinxApplication();
        $wrap = new TextWrapper($app, [
            'configuration'=>$configPath
        ]);

        $env = null;
        if ($input->hasOption('e')) {
            $env = $input->getOption('e');
        }
        $target = null;
        if ($input->hasOption('t')) {
            $target = $input->getOption('t');
        }

        echo call_user_func([$wrap, 'getStatus'], $env, $target);
    }

}
