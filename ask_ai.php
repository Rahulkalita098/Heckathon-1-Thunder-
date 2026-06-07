<?php
// ask_ai.php - Secure backend handler for the AI Oracle

header('Content-Type: application/json');

// 1. PUT YOUR FREE GEMINI API KEY HERE
$apiKey = 'API KEY'; 

// The Gemini 1.5 Flash model is incredibly fast and free for developers
$apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=' . $apiKey;

// 2. Receive the message from the Javascript frontend
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['error' => 'Message cannot be empty.']);
    exit;
}

// 3. System Prompt: Give the AI its CodeOrbit Persona
$systemPrompt = "You are the 'AI Oracle' for a space-themed JavaScript learning platform called CodeOrbit. 
Your commander is Rahul Kalita.
Keep answers concise, highly formatted (use markdown), and slightly space-themed. 
CRITICAL RULE: Do NOT give direct answers to coding problems. Instead, give hints and guide the user to figure it out themselves.

User's message: " . $userMessage;

// Formulate the request payload for Gemini
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => $systemPrompt]
            ]
        ]
    ]
];
// 4. Send the cURL request to Google
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// FIX: Bypass SSL verification for local development (XAMPP/MAMP)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch); // Capture the exact cURL error if it fails
curl_close($ch);

// 5. Handle the response and send it back to the frontend
if ($response === false) {
    // This will trigger if your server completely blocks the outbound connection
    echo json_encode(['error' => 'cURL Error: ' . $curlError]);
    exit;
}

if ($httpCode !== 200) {
    // This will trigger if Google rejects your API key or request
    echo json_encode(['error' => "API rejected request (HTTP $httpCode). Details: " . $response]);
    exit;
}

$responseData = json_decode($response, true);

// Extract the text from the Gemini response structure
if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
    $aiText = $responseData['candidates'][0]['content']['parts'][0]['text'];
    
    // Simple markdown formatting for code blocks in the chat
    $aiText = preg_replace('/`(.*?)`/', '<code class="bg-black/30 text-[#BFF747] px-1 rounded">$1</code>', $aiText);
    $aiText = nl2br($aiText);

    echo json_encode(['reply' => $aiText]);
} else {
    echo json_encode(['error' => 'The Oracle could not compute a response.']);
}
?>