<?php

namespace App\Console\Commands;

use App\Http\Controllers\TestClass;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-attributes';

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
        $rc = new \ReflectionClass(TestClass::class);
        $attrs = $rc->getAttributes();
        //dd($attrs[0]->newInstance());
        dd($attrs[0]->newInstance()->myArgument);
    }
}
