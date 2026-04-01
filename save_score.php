<?php
header('Content-Type: application/json');

// Nur POST-Requests erlauben
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // JSON-Daten empfangen
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data && isset($data['score']) && isset($data['token'])) {
        $token = $data['token'];
        $fileTokens = 'tokens.json';
        $tokens = [];
        
        if (file_exists($fileTokens)) {
            $tokens = json_decode(file_get_contents($fileTokens), true) ?? [];
        }
        
        // 1. Token existiert?
        if (!isset($tokens[$token])) {
            echo json_encode(['success' => false, 'error' => 'Ungültiger oder abgelaufener Token (Anti-Cheat)']);
            exit;
        }
        
        $startTime = $tokens[$token];
        $elapsed = time() - $startTime;
        
        // Token entfernen, damit er nicht mehrfach genutzt werden kann
        unset($tokens[$token]);
        file_put_contents($fileTokens, json_encode($tokens), LOCK_EX);
        
        // 2. Zeit-Check (Spiel dauert 60 Sekunden, wir erlauben 55 bis 120 Sekunden Toleranz)
        if ($elapsed < 55) {
            echo json_encode(['success' => false, 'error' => 'Zeit zu kurz (Anti-Cheat)']);
            exit;
        }
        if ($elapsed > 120) {
            echo json_encode(['success' => false, 'error' => 'Zeit abgelaufen (Anti-Cheat)']);
            exit;
        }
        
        // 3. Score-Check (niemand schafft mehr als 150 Punkte in 60s)
        if ((int)$data['score'] > 150) {
            echo json_encode(['success' => false, 'error' => 'Punktzahl unrealistisch hoch (Anti-Cheat)']);
            exit;
        }

        // Daten formatieren
        $entry = [
            'name' => htmlspecialchars($data['name'] ?? 'Anonym'),
            'score' => (int)$data['score'],
            'wrong' => (int)$data['wrong'],
            'type' => htmlspecialchars($data['type'] ?? ''),
            'base' => htmlspecialchars($data['base'] ?? ''),
            'num' => htmlspecialchars($data['num'] ?? ''),
            'dec' => htmlspecialchars($data['dec'] ?? ''),
            'date' => date('d.m.Y H:i', strtotime($data['date'] ?? 'now'))
        ];

        // In Datei speichern (eine JSON-Zeile pro Eintrag oder als komplettes JSON-Array)
        $file = 'highscores.txt';
        
        $currentScores = [];
        if (file_exists($file)) {
            $content = file_get_contents($file);
            $currentScores = json_decode($content, true) ?? [];
        }

        $currentScores[] = $entry;

        // Nach Punkten absteigend sortieren
        usort($currentScores, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Nur die besten 100 behalten
        $currentScores = array_slice($currentScores, 0, 100);

        file_put_contents($file, json_encode($currentScores, JSON_PRETTY_PRINT), LOCK_EX);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Ungültige Daten oder fehlender Token']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Nur POST erlaubt']);
}
?>
