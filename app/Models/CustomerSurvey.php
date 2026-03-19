<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSurvey extends Model
{
    use HasFactory;

    protected $table = 'customer_surveys';

    protected $fillable = [
        'customer_name',
        'email',
        'service_satisfaction',
        'resolved_promptly',
        'response_time',
        'support_staff',
        'delivery_satisfaction',
        'delivered_on_time',
        'condition',
        'accurate_description',
        'overall_satisfaction',
        'likely_to_purchase_again',
        'improvement_suggestions',
    ];

    protected $casts = [
        'support_staff' => 'array',
    ];
}
