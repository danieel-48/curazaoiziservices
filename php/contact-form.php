<?php

// Mailjet API keys
$apiKeyPublic = 'b244af314e90858664a9c06467043537';
$apiKeyPrivate = '8ded0bd37f4953a7f9cb37bb6b5f46b4';

// Get POST data
$name  = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$text  = trim($_POST['text'] ?? ''); ;

// Simple validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required.';
}

if (empty($phone) || !preg_match('/^[0-9]+$/', $phone)) {
    $errors[] = 'Valid phone number is required (numbers only).';
}

if (!empty($errors)) {
    echo json_encode([
        'alert' => 'alert-danger',
        'message' => implode(' ', $errors)
    ]);
    exit;
}

// Prepare Mailjet payload
$data = [
    'FromEmail'          => 'no-reply@curacaoiziservices.com',
    'FromName'           => 'Curazao Izi Services',
    'Subject'            => 'New contact | Submission',
    'Mj-TemplateID'      => '7032689',
    'Mj-TemplateLanguage'=> true,
    'Recipients'         => [
        ['Email' => $email]
    ],
    'Vars'               => [
        'name'  => $name,
        'email' => $email,
        'phone' => $phone,
        'text'  => $text
    ]
];

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.mailjet.com/v3/send');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$apiKeyPublic:$apiKeyPrivate");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


// Execute cURL
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200 || $httpCode == 201) {
    echo json_encode([
        'alert' => 'alert-success',
        'message' => 'Thank you! Your message has been sent successfully.'
    ]);
} else {
    echo json_encode([
        'alert' => 'alert-danger',
        'message' => 'Failed to send message. Please try again later.'
    ]);
}
?>