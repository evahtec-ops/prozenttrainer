<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highscores - Prozent Trainer</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #000;
            color: #fff;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #fff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #111;
            border-radius: 12px;
            overflow: hidden;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #222;
            color: #aaa;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
        }
        tr:last-child td {
            border-bottom: none;
        }
        .rank {
            font-weight: bold;
            color: #4285F4;
        }
        .score {
            font-weight: bold;
            color: #34A853;
        }
        .settings {
            font-size: 12px;
            color: #888;
        }
        a.back {
            display: inline-block;
            margin-bottom: 20px;
            color: #4285F4;
            text-decoration: none;
        }
        a.back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <a href="index.html" class="back">&larr; Zurück zum Spiel</a>
    <h1>Allzeit Highscores</h1>
    
    <table>
        <thead>
            <tr>
                <th>Platz</th>
                <th>Name</th>
                <th>Punkte</th>
                <th>Fehler</th>
                <th>Einstellungen</th>
                <th>Datum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $file = 'highscores.txt';
            if (file_exists($file)) {
                $scores = json_decode(file_get_contents($file), true);
                if ($scores && count($scores) > 0) {
                    $rank = 1;
                    foreach ($scores as $score) {
                        echo "<tr>";
                        echo "<td class='rank'>#{$rank}</td>";
                        echo "<td>" . htmlspecialchars($score['name']) . "</td>";
                        echo "<td class='score'>" . htmlspecialchars($score['score']) . "</td>";
                        echo "<td>" . htmlspecialchars($score['wrong']) . "</td>";
                        echo "<td class='settings'>Typ: {$score['type']}<br>Bereich: {$score['base']}<br>Zahlen: {$score['num']}<br>Komma: {$score['dec']}</td>";
                        echo "<td>" . htmlspecialchars($score['date']) . "</td>";
                        echo "</tr>";
                        $rank++;
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>Noch keine Highscores vorhanden.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>Noch keine Highscores vorhanden.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>