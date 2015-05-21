<?php
function menu (){
    global $telefon;
    global $komorka;
    echo '
    <div id="panel-menu">
    <left>';
    if ($telefon != "") { echo '<telefon>Telefon:</telefon> '.$telefon;}
    echo '</left>
    <right>';
    if ($komorka != "") { echo '<telefon>Telefon komórkowy:</telefon> '.$komorka;}
    echo '</right>
    </div>
    <div id="nav">
    <ul>
    <li><a href="index.php">Start</a></li>
    <li><a href="index.php?pokaz=oferta">Oferta</a></li>
    <li><a href="index.php?pokaz=galeria">Galeria</a></li>
    <li><a href="index.php?pokaz=kontakt">Kontakt</a></li>
    </ul>
    </div>
    ';
}
function menu_stopka (){
echo '
    <ul>
    <li><a href="index.php">Start</a></li>
    <li><a href="index.php?pokaz=oferta">Oferta</a></li>
    <li><a href="index.php?pokaz=galeria">Galeria</a></li>
    <li><a href="index.php?pokaz=kontakt">Kontakt</a></li>
    </ul>
    ';
}
?>
