<?php
$filme = [
    [
        'titel' => 'Spider-Man: No Way Home',
        'genre' => 'Action',
        'dauer' => 148,
        'altersfreigabe' => '12',
        'preis' => 12.50,
        'bewertung' => 5
    ],
    [
        'titel' => 'Der König der Löwen',
        'genre' => 'Animation',
        'dauer' => 88,
        'altersfreigabe' => '0',
        'preis' => 8.50,
        'bewertung' => 4
    ],
    [
        'titel' => 'Hangover',
        'genre' => 'Komödie',
        'dauer' => 100,
        'altersfreigabe' => '16',
        'preis' => 9.00,
        'bewertung' => 4
    ],
    [
        'titel' => 'Forrest Gump',
        'genre' => 'Drama',
        'dauer' => 142,
        'altersfreigabe' => '12',
        'preis' => 10.00,
        'bewertung' => 5
    ],
    [
        'titel' => 'Es',
        'genre' => 'Horror',
        'dauer' => 135,
        'altersfreigabe' => '16',
        'preis' => 11.00,
        'bewertung' => 3
    ],
    [
        'titel' => 'Avengers: Endgame',
        'genre' => 'Action',
        'dauer' => 181,
        'altersfreigabe' => '12',
        'preis' => 13.50,
        'bewertung' => 5
    ],
    [
        'titel' => 'Toy Story 4',
        'genre' => 'Animation',
        'dauer' => 100,
        'altersfreigabe' => '0',
        'preis' => 7.50,
        'bewertung' => 4
    ],
    [
        'titel' => 'Knives Out',
        'genre' => 'Drama',
        'dauer' => 130,
        'altersfreigabe' => '12',
        'preis' => 9.50,
        'bewertung' => 4
    ],
    [
        'titel' => 'Scary Movie',
        'genre' => 'Komödie',
        'dauer' => 88,
        'altersfreigabe' => '16',
        'preis' => 8.00,
        'bewertung' => 3
    ],
    [
        'titel' => 'The Conjuring',
        'genre' => 'Horror',
        'dauer' => 112,
        'altersfreigabe' => '16',
        'preis' => 10.50,
        'bewertung' => 4
    ]
];

// TODO: Hole die Filterwerte aus der URL
// Verwende $_GET um folgende Parameter zu erfassen:
// - 'genre' (falls vorhanden)
// - 'max_dauer' (falls vorhanden) - maximale Filmlänge
// - 'max_preis' (falls vorhanden) - maximaler Ticketpreis
// - 'mindest_bewertung' (falls vorhanden)

$genre_filter = isset($_GET['genre']) ? trim($_GET['genre']) : '';
$max_dauer = isset($_GET['max_dauer']) ? (int)$_GET['max_dauer'] : 0;
$max_preis = isset($_GET['max_preis']) ? (float)$_GET['max_preis'] : 0.0;
$mindest_bewertung = isset($_GET['mindest_bewertung']) ? (int)$_GET['mindest_bewertung'] : 0;

// TODO: Filtere das $filme Array basierend auf den GET-Parametern
// Erstelle ein neues Array $gefilterte_filme
//
// Hinweise:
// - Verwende eine foreach-Schleife
// - Prüfe für jeden Filter, ob er angewendet werden soll
// - Nur Filme, die alle aktiven Filter erfüllen, sollen im Ergebnis sein
//
// Beispiel-Logik:
// foreach ($filme as $film) {
//     $erfuellt_filter = true;
//
//     // Prüfe ob Genre-Filter erfüllt ist
//     if (!empty($genre_filter) && $film['genre'] !== $genre_filter) {
//         $erfuellt_filter = false;
//     }
//
//     // Weitere Filter prüfen...
//
//     if ($erfuellt_filter) {
//         $gefilterte_filme[] = $film;
//     }
// }

$gefilterte_filme = [];

foreach ($filme as $film) {
    $erfuellt_filter = true;

    if ($genre_filter !== '' && $film['genre'] !== $genre_filter) {
        $erfuellt_filter = false;
    }

    if ($max_dauer > 0 && (int)$film['dauer'] > $max_dauer) {
        $erfuellt_filter = false;
    }

    if ($max_preis > 0 && (float)$film['preis'] > $max_preis) {
        $erfuellt_filter = false;
    }

    if ($mindest_bewertung > 0 && (int)$film['bewertung'] < $mindest_bewertung) {
        $erfuellt_filter = false;
    }

    if ($erfuellt_filter) {
        $gefilterte_filme[] = $film;
    }
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kinoprogramm</title>
</head>
<body>
    <h1>🎬 Kinoprogramm Heute</h1>

    <p>
        <h3>🔍 Filter</h3>
        <form method="GET" action="">
            <label for="genre">Genre:</label>
            <select name="genre" id="genre">
                <?php
                $genres = ['', 'Action', 'Komödie', 'Drama', 'Horror', 'Animation'];
                foreach ($genres as $g) {
                    $label = $g === '' ? '' : $g;
                    $selected = ($g === $genre_filter) ? ' selected' : '';
                    echo '<option value="' . htmlspecialchars($g, ENT_QUOTES, 'UTF-8') . '"' . $selected . '>' . htmlspecialchars($label, ENT_QUOTES, 'UTF-8') . '</option>';
                }
                ?>
            </select>

            <label for="max_dauer">Max. Dauer (Minuten):</label>
            <input type="number" name="max_dauer" id="max_dauer" min="0" value="<?php echo $max_dauer > 0 ? (int)$max_dauer : ''; ?>">

            <label for="max_preis">Max. Preis (€):</label>
            <input type="number" name="max_preis" id="max_preis" min="0" step="0.50" value="<?php echo $max_preis > 0 ? number_format($max_preis, 2, '.', '') : ''; ?>">

            <label for="mindest_bewertung">Mindestbewertung:</label>
            <select name="mindest_bewertung" id="mindest_bewertung">
                <?php
                for ($i = 0; $i <= 5; $i++) {
                    $selected = ($i === (int)$mindest_bewertung) ? ' selected' : '';
                    echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                }
                ?>
            </select>

            <button type="submit">Filter anwenden</button>
            <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>">Alle Filter zurücksetzen</a>
        </form>

    </p>

    <p>
        <?php
        echo 'Es wurden ' . count($gefilterte_filme) . ' Filme gefunden';
        ?>


        <?php if (!empty($gefilterte_filme)): ?>
            <?php foreach ($gefilterte_filme as $film): ?>
                <?php
                $titel = htmlspecialchars($film['titel'], ENT_QUOTES, 'UTF-8');
                $genre = htmlspecialchars($film['genre'], ENT_QUOTES, 'UTF-8');
                $dauerText = 'Dauer: ' . (int)$film['dauer'] . ' Min.';
                $altersfreigabeText = 'FSK: ' . htmlspecialchars($film['altersfreigabe'], ENT_QUOTES, 'UTF-8');
                $preisText = number_format((float)$film['preis'], 2, ',', '') . ' €';
                $bewertung = (int)$film['bewertung'];
                $sterne = str_repeat('★', $bewertung) . str_repeat('☆', 5 - $bewertung);
                $genreFarbe = '#95a5a6';
                $genreFarbeText = '#ffffff';
                switch ($film['genre']) {
                    case 'Action':
                        $genreFarbe = '#e74c3c';
                        break;
                    case 'Komödie':
                        $genreFarbe = '#f1c40f';
                        $genreFarbeText = '#000000';
                        break;
                    case 'Drama':
                        $genreFarbe = '#9b59b6';
                        break;
                    case 'Horror':
                        $genreFarbe = '#2c3e50';
                        break;
                    case 'Animation':
                        $genreFarbe = '#27ae60';
                        break;
                }
                ?>
                <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0; border-radius: 6px;">
                    <h3 style="margin: 0 0 6px 0;"><?php echo $titel; ?></h3>
                    <span style="display: inline-block; padding: 2px 8px; border-radius: 12px; background-color: <?php echo $genreFarbe; ?>; color: <?php echo $genreFarbeText; ?>; font-size: 12px; margin-bottom: 6px;">
                        <?php echo $genre; ?>
                    </span>
                    <div><?php echo htmlspecialchars($dauerText, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div><?php echo htmlspecialchars($altersfreigabeText, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div><?php echo htmlspecialchars($preisText, ENT_QUOTES, 'UTF-8'); ?></div>
                    <div style="font-size: 18px; color: #f1c40f;"><?php echo $sterne; ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php
        if (empty($gefilterte_filme)) {
            echo '<p>Leider wurden keine Filme gefunden. Probieren Sie andere Filter.</p>';
        }
        ?>

    </p>
</body>
</html>

//......