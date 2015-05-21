
<?php
require_once 'uzytkownik.php';
require_once '../konfiguracja.php';
global $loginplik;
global $hasloplik;
global $szablon;

$login = isset($_SESSION['login']) ? $_SESSION['login'] : mysql_escape_string($_POST['login']);  //filtracja zmiennej
$pass = (md5($_POST['pass'])); //filtracja + haszowanie hasla
//echo $loginplik.'<br>';
//echo $hasloplik.'<br>';
//echo $login.'<br>';
//echo $pass.'<br>';
//echo $_SESSION['admin'].'<br><br>';

if(isset($_POST['login']) && isset($_POST['pass'])) {
if(($login == $loginplik) && ($pass == $hasloplik))
{
    
    $_SESSION['admin']='ok';  //sesja przyjmuje wartosc 'ok' gdy dane z formularza zgadzaja sie z danymi z bazy
    $_SESSION['login']=$login;

  setcookie("log" , "log", time()+3600, "/","", 0);  //tworzymy ciastko
  header("Location: index.php"); //przenosimy na strone

}
else { echo 'Bląd logowania, próbuj dalej :)'; }  //w przypadku zlych danych
}



if(!isset($_SESSION['admin']) && !isset($_SESSION['login']) && $_SESSION['admin'] != 'ok' && !isset($_POST['submit']) && $_GET['p']!='wyloguj' && !isset($_COOKIE['log'])) 

{
echo'
<center><br><br>
<form action="index.php" method="POST">
Login: <input type="text" name="login"><br/>
Haslo: <input type="password" name="pass"><br/>
<input id="button" type="submit" name="submit" value="Zaloguj"></form></center>';

}

if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log'])) { 

echo 'Jestes zalogowany jako '.$_SESSION['login'].'!, <a href="index.php?p=wyloguj">Wyloguj</a><div id="podglad"><a href="../index.php" target="_blank">Podgląd</a></div>';
    echo '<center>';
    echo '<div class="nav"><fieldset><legend>Zarządzanie treścią</legend>';
    echo '<ul><li><a href="../index.php">edytuj strone główną</a></li>';
    echo '<li><a href="../index.php?pokaz=oferta">edytuj ofertę</a></li>';
    echo '<li><a href="../index.php?pokaz=galeria">edytuj galerię</a></li>';
    echo '<li><a href="../index.php?pokaz=kontakt">edytuj dane kontaktowe</a></li>';
    echo '<li><a href="index.php?pokaz=upload-tlo">zmień tlo</a></li>';
    echo '<li><a href="index.php?pokaz=upload-logo">zmiana logo</a></li></ul></fieldset></div>';
    
    echo '<div class="nav"><fieldset><legend>Ustawienia</legend><ul>';
    echo '<li><a href="index.php?pokaz=edycja-konfiguracji">konfiguracja</a></li>';
    echo '<li><a href="index.php?pokaz=edycja-admina">edycja-admina</a></li>';
    echo '</ul></fieldset></div><div class="nav">';
    echo '<ul><li><a href="index.php?p=wyloguj">Wyloguj ' . $_SESSION['login'].'</a></li></ul>';
    echo '</center>';

if($_GET['p']=='wyloguj') { 
session_destroy(); //kasujemy sesje
setcookie("log" , "log", time()-3600, "/","", 0);  //kasujemy cookies
header("Location: index.php");  //przenosimy na strone logowania
}
}
?>
<!--</body>/-->