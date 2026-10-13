<?php

namespace DownGrade\Console\Commands;
use DownGrade\Http\Controllers\CommonController;

use Illuminate\Console\Command;


class DownGrade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'downgrade:command {Envato Addon Purchased Code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $key = $this->argument('Envato Addon Purchased Code');
		$controller = new CommonController();
        $controller->installAiWriterModule($key);
		//$this->info('Success! Installation Done');
		
		
    }
}
