<?php

namespace App\Http\Controllers\CustermerSurvey;

use App\Http\Controllers\Controller;
use App\Mail\CustomerSurveySubmitted;
use App\Models\CustomerSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustermerSurveyController extends Controller
{
    /**
     * Show the customer satisfaction survey form.
     */
    public function create()
    {

        $page_title = 'Customer Survey ';

        return view('customer_survey.form', compact('page_title'));
    }

    /**
     * Store the submitted survey and notify support.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',

            'service_satisfaction' => 'required|string|max:50',
            'resolved_promptly' => 'required|string|max:50',
            'response_time' => 'required|string|max:50',
            'support_staff' => 'required|string|max:100',

            'delivery_satisfaction' => 'required|string|max:50',
            'delivered_on_time' => 'required|string|max:50',
            'condition' => 'required|string|max:50',
            'accurate_description' => 'required|string|max:50',

            'overall_satisfaction' => 'required|string|max:50',
            'likely_to_purchase_again' => 'required|string|max:50',
            'improvement_suggestions' => 'nullable|string|max:2000',
        ]);



        $survey = CustomerSurvey::create($data);

        try {
            Mail::to('care@autofactorng.com')->send(new CustomerSurveySubmitted($survey));
        } catch (\Throwable $e) {
            logger()->error('Customer survey notification failed: ' . $e->getMessage());
        }

        return redirect()->route('customer-survey')->with('success', 'Thank you for your response. We have received your feedback.');
    }

    /**
     * Admin listing of survey responses.
     */
    public function index()
    {
        $surveys = CustomerSurvey::latest()->paginate(25);

        return view('admin.customer_surveys.index', compact('surveys'));
    }

    /**
     * Admin show details for a single survey.
     */
    public function show(CustomerSurvey $survey)
    {
        return view('admin.customer_surveys.show', compact('survey'));
    }
}
