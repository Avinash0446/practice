<?php

namespace App\Jobs;

use App\Mail\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
                Log::info('📦 Job Created: SendWelcomeEmailJob', [
            'email' => $user->email
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

      
        try {

            Log::info('🚀 Job Started Processing', [
                'email' => $this->user->email
            ]);

            Mail::to($this->user->email)
                ->send(new WelcomeMail($this->user));

            Log::info('✅ Email Sent Successfully', [
                'email' => $this->user->email
            ]);

        } catch (Exception $e) {

            Log::error('❌ Job Failed', [
                'message' => $e->getMessage()
            ]);

            throw $e; // Important for failed_jobs table
        }
    }
}
