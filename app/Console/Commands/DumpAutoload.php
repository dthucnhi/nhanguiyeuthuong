<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;

class DumpAutoload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump-autoload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate framework autoload files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $composer;
    public function __construct(Composer $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->description);
        $data=$this->composer->dumpAutoloads();
        $this->info($data);
        $this->composer->dumpOptimized();
        $this->info('Completed!!');
    }
}
