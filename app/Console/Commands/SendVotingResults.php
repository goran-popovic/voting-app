<?php

namespace App\Console\Commands;

use App\Mail\VotingResults;
use App\Models\Vote;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Helpers\VoteItems;

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

        $this->results = VoteItems::LIST;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $votes = Vote::select('result')->get();

        if ($votes->isNotEmpty()) {
            foreach ($votes as $vote) {
                if (isset($this->results[$vote->result])) {
                    $this->results[$vote->result]++;
                }
            }

            Mail::to('dev@steadfastcollective.com')->send(new VotingResults($this->results));
        }
    }
}
