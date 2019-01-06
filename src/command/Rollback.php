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
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use think\console\Input;
use think\console\input\Option;
use think\console\Output;


/**
 * Class Phinx
 * @package app\command
 *
 * php think migrate:rollback
 */
class Rollback extends Command
{
    protected function configure()
    {
        return $this->setName('migrate:rollback')
            ->addOption('e', null, Option::VALUE_OPTIONAL, 'env')
            ->addOption('t', null, Option::VALUE_OPTIONAL, 'target')
            ->addOption('d', null, Option::VALUE_OPTIONAL, 'date');
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

        echo call_user_func([$wrap, 'getRollback'], $env, $target);


        ///////////////
        ///
        $configPath = $this->initConfig();
        $app = new PhinxApplication();

        $stream = fopen('php://temp', 'w+');

        $commands = ['rollback'];
        $commands += ['-c'=>$configPath];
        if ($input->hasOption('e')) {
            $commands += ['-e'=>$input->getOption('e')];
        }
        if ($input->hasOption('t')) {
            $commands += ['-t'=>$input->getOption('t')];
        }
        if ($input->hasOption('d')) {
            $commands += ['-d'=>$input->getOption('d')];
        }

        $exit_code = $app->doRun(new ArrayInput($commands), new StreamOutput($stream));

        $result = stream_get_contents($stream, -1, 0);
        fclose($stream);

        echo $result;
    }

}
