<?php

namespace App\Jobs;

use App\Models\task;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTask implements ShouldQueue
{
    use Queueable;

    public $tries = 5;
    public $backoff = 30 ;
    protected $task;
    /**
     * Create a new job instance.
     */
//    public function __construct(  )
    public function __construct(  Task $task)
    {
        $this->task=$task;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // منطق پردازش وظیفه
            // به عنوان مثال، ارسال اطلاع‌رسانی به وب‌سایت

        } catch (\Exception $e) {

            \Log::error("Error processing task: " . $e->getMessage());

        }
    }
}
