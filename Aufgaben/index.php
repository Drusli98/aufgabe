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
        'genre' => 'Komidie',
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
        'genre' => 'Komidie',
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

$genre_filter = $_GET['genre'] ?? ''; // TODO: Implementiere die $_GET Logik
$max_dauer = (int)($_GET['max_dauer'] ?? 0); // TODO: Implementiere die $_GET Logik
$max_preis = (int)($_GET['max_preis'] ?? 0); // TODO: Implementiere die $_GET Logik
$mindest_bewertung = (int)($_GET['mindest_bewertung'] ?? 0); // TODO: Implementiere die $_GET Logik

// TODO: Filtere das $filme Array basierend auf den GET-Parametern
// Erstelle ein neues Array $gefilterte_filme
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
//     if (!empty($genre_filter) && $film['genre'] !== $genre_filter &&) {
//         $erfuellt_filter = false;
//     }
//
//     // Weitere Filter prüfen...
//
//     if ($erfuellt_filter) {
//         $gefilterte_filme[] = $film;
//     }
// }

$gefilterte_filme = []; // TODO: Implementiere die Filterlogik hier

foreach ($filme as $film) {
    $erfuellt_filter = true;

    if (!empty($genre_filter) && $film['genre'] !== $genre_filter) {
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Kinoprogramm</title>
</head>
<body>
<h1 class="d-flex justify-content-center  align-items-center">🎬 Kinoprogramm Heute</h1>
<!-- TODO: Erstelle ein HTML-Formular für die Filter -->
<!-- Das Formular soll folgende Eingabefelder haben:
 1. Dropdown für Genre (name="genre")
    - Optionen: "", "Action", "Komödie", "Drama", "Horror", "Animation"
 2. Zahlenfeld für maximale Filmlänge in Minuten (name="max_dauer")
 3. Zahlenfeld für maximalen Ticketpreis (name="max_preis", step="0.50")
 4. Dropdown für Mindestbewertung (name="mindest_bewertung")
    - Optionen: 0, 1, 2, 3, 4, 5
 5. Submit-Button "Filter anwenden"


 Wichtig:
 - Verwende method="GET"
 - Setze die value-Attribute der Felder auf die aktuellen Filterwerte
 - Füge einen "Alle Filter zurücksetzen" Button hinzu
-->

<form method="GET" action="" class="container mt-5 p-4 border rounded bg-light shadow-sm">
    <h3 class="mb-4 d-flex justify-content-center ">🔍 Filter</h3>
    <div class="row g-3 justify-content-around align-items-end mb-3">
        <div class="col-md-2">
            <label for="genre" class="form-label"> Genre:</label>
            <select class="form-select" name="genre" id="genre">
                <option selected disabled>Genre:</option>
                <?php
                $genres = ['Action', 'Komidie', 'Drama', 'Horror', 'Animation'];
                foreach ($genres as $g) {
                    echo '<option value="' . $g . '">' . $g . '</option>';
                }
                ?>
            </select>
        </div>
        <div class='col-md-2  justify-content-center '>
            <label for="max_dauer" class="form-label">Dauer(Minuten)</label>
            <input class="form-control" type="number" name="max_dauer" id="max_dauer" min="0">
        </div>

        <div class='col-md-2'>
            <label for="max_preis" class="from-label">Max.Preis (€)</label>
            <input class="form-control" type="number" name="max_preis" id="max_preis" min="0">
        </div>


        <div class="col-md-2">
            <label for="mindest_bewertung" class="form-label">Mindestbewertung ★</label>
            <select class="form-select" name="mindest_bewertung" id="mindest_bewertung"
                    style="width: 150px; ">
                <option selected disabled>Mindestbewertung:</option>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    $selected = ($i === $mindest_bewertung);
                    echo '<option value="' . $i . '" ' . ($selected ? 'selected' : '') . ' >' . $i . '</option>';
                } ?>
            </select>
        </div>
    </div>


    <br>

    <div class="d-flex justify-content-center">
        <button class="btn btn-primary" type="submit">Filter anwenden</button>
    </div>
</form>


<div class="row justify-content-center align-items-center">
    <div class="col-4  mt-4 p-2 border bg-light shadow-sm align-items-center">
        <div class="d-flex justify-content-center">
            <?php
            // TODO: Zeige die Anzahl der gefundenen Filme an
            if (count($gefilterte_filme) > 0) {
                echo "Es wurde :" . count($gefilterte_filme) . " filme(en) gefunden" . '<br>';
            } else if (empty($gefilterte_filme)) {
                echo 'Keine Filme';
            }
            ?>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center flex-wrap mt-4">
    <?php foreach ($gefilterte_filme as $film) { ?>
        <?php $bewertung = (int)$film['bewertung'];
        $sterne = str_repeat("★", $bewertung) . str_repeat("☆", 5 - $bewertung); ?>
        <div class="card  shawod-sm m-4" style="max-width: 22rem">
            <div class="card-body">
                <h5 class="card-titel"><?= $film['titel'] ?></h5>
                <p class="card-text">🎥 Genre: <?= $film['genre'] ?></p>
                <p class="card-text">⏰ Dauer: <?= $film['dauer'] ?></p>
                <p class="card-text">💰 Preis: <?= $film['preis'] ?></p>
                <p class="card-text">📅 Altersfreigabe: <?= $film['altersfreigabe'] ?></p>
                <p class="card-text"><?= $sterne ?></p>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>



