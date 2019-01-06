<?php
// +----------------------------------------------------------------------
// | phinx.
// +----------------------------------------------------------------------
// | FileName: Create.php
// +----------------------------------------------------------------------
// | Author: King east <1207877378@qq.com>
// +----------------------------------------------------------------------


namespace ke\phinx\command\seed;


use ke\phinx\Command;
use Phinx\Console\PhinxApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\StreamOutput;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class Run extends Command
{
    protected function configure()
    {
        $this->setName('seed:run')
            ->addOption('s', null, Option::VALUE_OPTIONAL, 'seed_name')
            ->addOption('v', null, Option::VALUE_OPTIONAL, 'seed_info');
    }

    protected function execute(Input $input, Output $output)
    {

        $configPath = $this->initConfig();


        $app = new PhinxApplication();

        // Output will be written to a temporary stream, so that it can be
        // collected after running the command.
        $stream = fopen('php://temp', 'w+');

        // Execute the command, capturing the output in the temporary stream
        // and storing the exit code for debugging purposes.
        $commands = ['seed:run'];
        $commands += ['-c'=>$configPath];
        if ($input->hasOption('s')) {
            $commands += ['-s'=>$input->getOption('s')];
        }
        if ($input->hasOption('v')) {
            $commands += ['-v'=>$input->getOption('v')];
        }

        $exit_code = $app->doRun(new ArrayInput($commands), new StreamOutput($stream));

        // Get the output of the command and close the stream, which will
        // destroy the temporary file.
        $result = stream_get_contents($stream, -1, 0);
        fclose($stream);

        echo $result;
    }

}