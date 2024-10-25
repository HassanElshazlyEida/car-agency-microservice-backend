<?php

namespace App\Jobs;

use App\Events\CarUpdated;
use Illuminate\Bus\Queueable;
use App\Enums\ModelStatusEnum;
use App\Http\Resources\CarResource;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CarUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CarResource $carResource, public ModelStatusEnum $actionStatus
    )
    {

    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new CarUpdated($this->carResource, $this->actionStatus));
    }
}
