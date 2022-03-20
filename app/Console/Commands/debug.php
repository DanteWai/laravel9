<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'debug';

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
        function findId(array $srq): int
        {
            $map = array_reduce($srq, function ($carry, $item) {

                array_key_exists($item, $carry)
                    ? $carry[$item]++
                    : ($carry[$item] = 1);

                return $carry;
            }, []);

            foreach ($map as $number => $meet){
                if($meet % 2 !== 0){
                    return $number;
                }
            }

            return 0;
        }

        $res = findId([20,1,-1,2,-2,3,3,5,5,1,2,4,20,4,-1,-2,5]);
        print_r($res);
        return $res;
    }
}
