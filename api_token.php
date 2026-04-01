<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = bin2hex(random_bytes(16));
    $file = 'tokens.json';
    
    $tokens = [];
    if (file_exists($file)) {
        $content = file_get_contents($file);
        $tokens = json_decode($content, true) ?? [];
    }
    
    // Clean up old tokens (older than 5 minutes)
    $now = time();
    foreach ($tokens as $k => $v) {
        if ($now - $v > 300) {
            unset($tokens[$k]);
        }
    }
    
    $tokens[$token] = $now;
    file_put_contents($file, json_encode($tokens), LOCK_EX);
    
    echo json_encode(['success' => true, 'token' => $token]);
} else {
    echo json_encode(['success' => false, 'error' => 'Nur POST erlaubt']);
}
?>
