<?php

namespace App\Console\Commands;

use App\Counter;
use App\CounterId;
use App\CounterRepository;
use Illuminate\Console\Command;

class Count extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';
    /**
     * @var CounterRepository
     */
    private $counterRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CounterRepository $counterRepository)
    {
        parent::__construct();
        $this->counterRepository = $counterRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $aggregateRootId = CounterId::create();
        $to = (int) $this->ask('Number of counts?');
        $counter = $this->counterRepository->retrieve($aggregateRootId);
        for ($x = 0; $x < $to; $x++) {
            /** @var Counter $countAggregateRoot */
            $counter->count();
        }
        $this->counterRepository->persist($counter);
    }
}
