<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Vote;
use Throwable;

class ProcessVote implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Parameters
     *
     * @var array
     */
    protected array $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Vote::create([
            'user_id' => $this->params['user']->id,
            'result' => $this->params['vote_result'],
            'ip_address' => $this->params['ip_address'],
            'location' => $this->params['location'],
        ]);
    }

    /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        $user = $this->params['user'];

        if($user->vote()->exists()) {
            $user->vote->delete();
        }
        
        $user->update([
            'voted' => false
        ]);
    }
}
