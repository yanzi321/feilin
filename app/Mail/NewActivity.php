<?php

namespace App\Mail;

use App\ActivitySummerCamp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewActivity extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var ActivitySummerCamp
     */
    protected $activitySummerCamp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(ActivitySummerCamp $activitySummerCamp)
    {
        $this->activitySummerCamp = $activitySummerCamp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('你有报名需要及时处理')
            ->with([
                'data' => $this->activitySummerCamp,
            ])
            ->view('email.new_activity');
    }
}
