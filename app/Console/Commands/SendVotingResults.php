<?php

namespace App\Console\Commands;

use App\Mail\VotingResults;
use App\Models\Vote;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVotingResults extends Command
{
    protected array $results;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voting:results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send voting results daily.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->results = [
            'Doki Doki Literature Club' => 0,
            'Silent Hill 2' => 0,
            'Amnesia: The Dark Descent' => 0,
            'Layers of Fear' => 0
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $votes = Vote::all();

        if ($votes->isNotEmpty()) {
            foreach ($this->results as $key => $result) {
                foreach ($votes as $vote) {
                    if($vote->result === $key) {
                        $this->results[$key]++;
                    }
                }
            }

            Mail::to('dev@steadfastcollective.com')->send(new VotingResults($this->results));
        }
    }
}
