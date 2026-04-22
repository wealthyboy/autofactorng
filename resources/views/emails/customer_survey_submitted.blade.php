<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>New Customer Survey Submission</title>
</head>

<body>
    <h1>New Customer Satisfaction Survey</h1>

    <p><strong>Customer Name:</strong> {{ $survey->customer_name ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $survey->email ?? 'N/A' }}</p>

    <h2>Section 1: Customer Service Experience</h2>
    <ul>
        <li><strong>Service satisfaction:</strong> {{ $survey->service_satisfaction ?? 'N/A' }}</li>
        <li><strong>Resolved promptly:</strong> {{ $survey->resolved_promptly ?? 'N/A' }}</li>
        <li><strong>Response time:</strong> {{ $survey->response_time ?? 'N/A' }}</li>
        <li><strong>Support staff:</strong> {{ $survey->support_staff ?? 'N/A' }}</li>
    </ul>

    <h2>Section 2: Order & Delivery Experience</h2>
    <ul>
        <li><strong>Delivery satisfaction:</strong> {{ $survey->delivery_satisfaction ?? 'N/A' }}</li>
        <li><strong>Delivered on time:</strong> {{ $survey->delivered_on_time ?? 'N/A' }}</li>
        <li><strong>Condition:</strong> {{ $survey->condition ?? 'N/A' }}</li>
        <li><strong>Accurate description:</strong> {{ $survey->accurate_description ?? 'N/A' }}</li>
    </ul>

    <h2>Section 3: Overall Experience</h2>
    <ul>
        <li><strong>Overall satisfaction:</strong> {{ $survey->overall_satisfaction ?? 'N/A' }}</li>
        <li><strong>Likelihood to purchase again:</strong> {{ $survey->likely_to_purchase_again ?? 'N/A' }}</li>
        <li><strong>Improvement suggestions:</strong> {{ $survey->improvement_suggestions ?? 'N/A' }}</li>
    </ul>

    <p>Submitted at: {{ $survey->created_at }} </p>
</body>

</html>