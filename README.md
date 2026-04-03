# Percent Pro | Math Trainer 📈

Ein moderner, webbasierter Rechentrainer für Prozentrechnung. Entwickelt für Schüler und Mathe-Begeisterte, um die Sicherheit im Umgang mit Prozentwert (W), Grundwert (G) und Prozentsatz (p) zu verbessern.

![Version](https://img.shields.io/badge/version-2.1.0-blue.svg)
![License](https://img.shields.io/badge/license-MIT-green.svg)
## 🚀 Live Demo
👉 https://evahtec-ops.github.io/prozenttrainer/

![Live](https://img.shields.io/badge/status-live-brightgreen)

## ✨ Features

- **Zwei Spielmodi:**
  - **Training:** Übe ohne Zeitdruck mit individuellen Einstellungen (Zahlenbereiche, Aufgabentypen, Kommazahlen).
  - **Challenge:** Löse so viele Aufgaben wie möglich in 60 Sekunden und knacke den Highscore.
- **Internationalisierung (i18n):** Vollständige Unterstützung für **Deutsch** und **Englisch** (inkl. lokalisierter Zahlenformate).
- **Globales Leaderboard:** Vergleiche deine Bestleistungen im Challenge-Modus mit anderen Nutzern. Filterbar nach Aufgabentyp.
- **Anti-Cheat System:** Token-basierte Validierung der Scores auf dem Server.
- **Responsive Design:** Optimiert für Desktop, Tablets und Smartphones.
- **Datenschutzkonform:** Keine unnötige Datenerfassung, lokaler Speicher für Nicknamen.

## 🛠 Tech Stack

- **Frontend:** HTML5, CSS3 (Tailwind CSS), Vanilla JavaScript.
- **Backend:** PHP 8.x (für Highscore-API und Validierung).
- **Datenbank:** SQLite (leichtgewichtig und portabel).
- **Animationen:** CSS Transitions & Keyframes.

## 🚀 Installation & Setup

Da die App PHP und SQLite nutzt, wird eine entsprechende Serverumgebung benötigt (z.B. Apache/Nginx mit PHP-Modul).

1. **Repository klonen:**
   ```bash
   git clone https://github.com/evahtec-ops/prozenttrainer.git
   ```
2. **Konfiguration:**
   - Die Datenbank wird beim ersten Aufruf von `get_highscores.php` oder `save_score.php` automatisch erstellt.
   - Passe die Platzhalter im Impressum/Datenschutz in der `index.html` an deine Daten an.

## 📖 Benutzung

1. Öffne die `index.html` über deinen Webserver.
2. Wähle deine Sprache (DE/EN) oben rechts.
3. Gib im Challenge-Modus einen Nicknamen an, um in der Bestenliste zu erscheinen.
4. Nutze die Einstellungen im Trainings-Modus, um gezielt bestimmte Aufgabentypen oder Schwierigkeitsgrade zu üben.

## 📝 Lizenz

Dieses Projekt ist unter der MIT-Lizenz lizenziert. Siehe `LICENSE` für Details.

---

