<?php
error_reporting(0);
require_once 'konfiguracja.php';
require_once "teksty/kontakt.php";
function head() {
        global $szablon;
        global $title;
        global $description;
        global $keywords;
        echo '
        <title>'.$title.'</title>
        <meta name="description" content="'.$description.'" />
        <meta name="keywords" content="'.$keywords.'" />
        <meta name="author" content="Szybka Strona" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="szablony/'.$szablon.'/css/reset-style.css" />
        <link rel="stylesheet" href="szablony/'.$szablon.'/css/style.css" />';
}
function tloBody() { //funcja wyswietla tlo strony ustawiane w konfiguracja.php poprzez admina
    global $backgroundimage;
    global $szablon;
    if($backgroundimage=='tak') {
    echo ('style="background-image:url(szablony/'.$szablon.'/images/tlo.jpg)"');
    }
}
function pokaz() { //funkcja wyswietla tresc strony
if ($_GET['pokaz']=='') { //jezeli nie przekazano zmiennej - funkcja wyswietla tresc podstron
    $podstrona = 'strona-glowna';
    }
else {
    $podstrona = $_GET['pokaz']; //jezeli przekazono zmienna
}
if ($podstrona == 'kontakt') { //jezeli przekazana zmienna to kontakt
        $rozsz = '.php';
        $plik = "teksty/$podstrona"."$rozsz";
        //$linie = file($plik);
        global $szablon;
        global $nazwa_firmy;
        global $ulica;
        global $kod;
        global $miasto;
        global $telefon;
        global $komorka;
        global $fax;
        global $email;
        echo '<h1>Kontakt</h2>';
        echo '<div class="adres-foto"><img src="szablony/'.$szablon.'/images/kontakt.jpg">';
        if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
               echo '<br><a href="administrator/index.php?pokaz=upload-zdjecia-kontakt">zmień zdjęcie</a>'; 
            }
        echo '</div>';
        echo '<div class="adres">'.$nazwa_firmy.'</h2><br>';
        echo 'ul. '.$ulica.'<br>';
        echo $kod.' ';
        echo $miasto.'<br><div class="kolumna pierwsza">';
        if ($telefon != "") { echo 'telefon:<br>';}
        if ($komorka != "") { echo 'telefon komórkowy:<br>';}
        if ($fax != "") { echo 'fax:<br>';}
        if ($email != "") { echo 'email:';}
        echo '</div><div class="kolumna druga">';
        if ($telefon != "") { echo $telefon.'<br>'; }
        if ($komorka != "") {echo $komorka.'<br>'; }
        if ($fax != "") {echo $fax.'<br>';}
        if ($email != "") {echo $email.'</div>';}
    if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))
  {
        echo '
        <form method="post" action="administrator/index.php">
        <input type="hidden" name="metoda" value="edycja"> 
        <input type="hidden" name="podstrona" value="'.$podstrona.'">
        <input type="hidden" name="nazwa_firmy" value="'.$nazwa_firmy.'">
        <input type="hidden" name="ulica" value="'.$ulica.'">
        <input type="hidden" name="kod" value="'.$kod.'">
        <input type="hidden" name="miasto" value="'.$miasto.'">
        <input type="hidden" name="telefon" value="'.$telefon.'">
        <input type="hidden" name="komorka" value="'.$komorka.'">
        <input type="hidden" name="fax" value="'.$fax.'">
        <input type="hidden" name="email" value="'.$email.'">
        <input id="button" type="submit"  value="Edytuj"></div>';
        }
    }
elseif ($podstrona == 'galeria') { //jezeli przekazana zmienna to galeria wywoluje funkcje galeria z kontrolerow
        galeria();        
}

        else { // jezeli przekazana zmienna rozni sie od kontakt i galeria laduje plik txt podstrony
            $rozsz = '.php';
            require_once "teksty/$podstrona"."$rozsz";
            $opis = str_replace('\"', '"', $opis);
            echo '<div class="ramka-obrazka"><h1>'.$naglowek.'</h1>';
            echo $opis.'</div>';
            if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))
  {
            echo '<br><br><br>
            <form method="post" action="administrator/index.php">
            <input type="hidden" name="metoda" value="edycja"> 
            <input type="hidden" name="podstrona" value="'.$podstrona.'">
            <input type="hidden" name="naglowek" value="'.$naglowek.'">
            <input type="hidden" name="opis" value=\''.$opis.'\'>
            <input id="button" type="submit" value="Edytuj">';
    }
        }
}
function galeria(){ //funkcja wyswietla galerie
        echo '<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>';
        echo '<script type="text/javascript" src="js/lightbox-plugin.js"></script>';
        echo '<h1>Galeria</h1><div class="galeria-inner">';
        if ($handle = opendir('galeria/miniatury')) {
        while (false !== ($file = readdir($handle))) { 
        if ($file != "." && $file != ".." && $file != "index.html") { 
        echo "
        <div class=\"drop-shadow lifted\"><p>
        <a href=\"galeria/$file\" rel=\"lightbox\" id=\"gallery\">
        <img src=\"galeria/miniatury/$file\" style=\"border:none;\">";
        if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))
  {
        echo "</a><br><a href=\"administrator/index.php?pokaz=edycja-galerii&zdjecie=$file\">Zmień</a>";
        }
            
        echo "</p></div>\n";
        //jezeli admin jest zalogowany wyswietli link do edycji zdjęcia
     
        } 
   }
        echo '<br><br></div>';
   closedir($handle); 
}
}
function stopka() {
        global $szablon;
        global $nazwa_firmy;
        global $ulica;
        global $kod;
        global $miasto;
        global $telefon;
        global $komorka;
        global $fax;
        global $email;
        
        echo '<div class="footer-nav">';
        menu_stopka ();
        echo '</div>';
        echo '<div class="footer-adres">'.$nazwa_firmy.'<br>ul. '.$ulica.'<br>'.$kod.' '.$miasto.'</div>';
        echo '<div class="footer-telefon">';
        if ($telefon != "") { echo '<telefon>telefon: </telefon>'.$telefon.'<br>';}
        if ($komorka != "") { echo '<telefon>telefon komórkowy: </telefon>'.$komorka.'<br>';}
        if ($email != "") { echo '<telefon>email: </telefon>'.$email;}        
       echo '</div>';
        echo '<div class="footer-logo"><a href="index.php"><img src="szablony/'.$szablon.'/images/logo.png" height="50px"></a></div>';
        
        echo '<div class="footer-copyright">Wszystkie prawa zastrzeżone &copy '. date("Y").' '.$nazwa_firmy.'';
		//dont remove or modify code between this comments, nie usuwaj i nie edytuj kodu pomiędzy tymi komentarzami
		echo '<a href="http://katet.eu" title="strony internetowe" target="_blank"><img src="images/designed.png" alt="strony internetowe"></a>';
		//dont remove or modify code between this comments, nie usuwaj i nie edytuj kodu pomiędzy tymi komentarzami
		//you are always welcome to donate us, and we will be happy to allow you remowe and modify everything as you lika
		//donate us for 10EU, info@katet.eu at PAYPAL
		echo '</div>';
}

function logo () {
    global $szablon;
    if(file_exists("szablony/".$szablon."/images/logo.png")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.png"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.jpg")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.jpg"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.jpeg")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.jpeg"></a>'; }
    elseif(file_exists("szablony/".$szablon."/images/logo.gif")) {
    echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/logo.gif"></a>'; }
    else {echo ' <a href="index.php"><img src="szablony/'.$szablon,'/images/szybka-strona.png"></a>'; }
    
}
?>
    