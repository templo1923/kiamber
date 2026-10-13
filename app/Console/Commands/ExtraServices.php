<?php

namespace DownGrade\Console\Commands;
use DownGrade\Http\Controllers\Admin\AddonsController;
use Illuminate\Console\Command;

class ExtraServices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extraservices:install';

    /**
     * The console command description.
     *
     * @var string
     */
	 
    protected $description = 'ExtraServices installation using command prompt';

    /**
     * Execute the console command.
     */
	 
	public function __construct()
    {
        parent::__construct();
    } 
	 
    public function handle()
    {
	    $key = $this->ask('Enter your envato addon purchased code');
		$addon_real_name = "ExtraServices";
        $controller = new AddonsController();
        $controller->Install_Addon($key,$addon_real_name);
		
    }
}
