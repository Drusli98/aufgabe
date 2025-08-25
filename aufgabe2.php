<?php

class Fahrzeugen
{
    public $Räder;
    public $Ausenspiegel;
    public $Motor;
    public $Pedale;

    public $Geschwendigkeit;

    public $Fahrzeug;

    public function __construct($Fahrzeug, $Räder, $Ausenspiegel, $Motor, $Pedale, $Geschwendigkeit)
    {
        $this->Fahrzeug = $Fahrzeug;
        $this->Räder = $Räder;
        $this->Ausenspiegel = $Ausenspiegel;
        $this->Motor = $Motor;
        $this->Pedale = $Pedale;
        $this->Geschwendigkeit = $Geschwendigkeit;
    }


}

$auto = new Fahrzeugen('Auto', 4, 2, true, true, '100-350 km/h');
$motorad = new Fahrzeugen('Motorrad', 2, 2, true, true, '10-250 km/h');
$fahhrad = new Fahrzeugen('Fahhrad', rand(2, 4), 2, false, true, '10-35 km/h');
$ebike = new Fahrzeugen('Ebike', 2, 2, true, true, '20-40 km/h');

$fahrzeug = [$auto, $motorad, $fahhrad, $ebike];

foreach ($fahrzeug as $key => $fahrzeugen) {
    echo  $fahrzeugen->Fahrzeug . "<br>";
    echo 'Räder: ', $fahrzeugen->Räder, "<br>";
    echo 'Ausenspiegel: ', $fahrzeugen->Ausenspiegel . " " , "<br>";
    echo 'Motor: ', $fahrzeugen->Motor ? 'hat' : 'keiner', "  ", "<br>";
    echo 'Geschwendigkeit: ', $fahrzeugen->Geschwendigkeit, "<br>";
    echo 'Pedale: ', $fahrzeugen->Pedale ? 'hat' : 'keine', "<br>" . "<br>";
}
?>