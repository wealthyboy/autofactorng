<?php

namespace App\Mail;

use App\Models\CustomerSurvey;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerSurveySubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public CustomerSurvey $survey;

    /**
     * Create a new message instance.
     */
    public function __construct(CustomerSurvey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Customer Satisfaction Survey Submission')
            ->view('emails.customer_survey_submitted')
            ->with(['survey' => $this->survey]);
    }
}
