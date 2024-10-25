<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Events\CarUpdatedEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CarUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public array $car, public string $actionStatus
    )
    {
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new CarUpdatedEvent($this->car, $this->actionStatus));
    }
}
