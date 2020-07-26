<?php

namespace Meletisf\Zen\Console\Commands;

use Illuminate\Console\Command;
use Zen;

class RunDiagnostics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zen:diagnose';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Zen Diagnostics';

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
        $results = Zen::runDiagnostics();

        $this->table(['Diagnostic', 'Result', 'Details'], $this->prepareTableArray($results['details']));

        if (! $results['is_healthy']) {
            $this->error('The Application is unhealthy :(');
            return 1;
        }
        else {
            $this->info('The Application is healthy :)');
            return 0;
        }


    }

    /**
     * Transform the data in to the format the are required by the console for tables.
     *
     * @param $results
     * @return array
     */
    private function prepareTableArray($results)
    {
        $output = [];

        foreach ($results as $k => $v) {
            $output[] = [
                'diagnostic'    => $k,
                'result'        => $v,
                'details'       => ($v == 'passed') ? '' : (resolve($k))->getMessage()
            ];
        }

        return $output;
    }
}
