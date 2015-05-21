<?php
if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
include'../konfiguracja.php';

 define ("MAX_SIZE","100"); 
 function pobierzRozsz($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

 $errors=0;
 if(isset($_POST['Zmien'])) 
 {
 	$logo=$_FILES['image']['name'];
 	if ($logo) 
 	{
 		$nazwapliku = stripslashes($_FILES['image']['name']);
  		$rozszerzenielogo = pobierzRozsz($nazwapliku);
 		$rozszerzenielogo = strtolower($rozszerzenielogo);
 if (($rozszerzenielogo != "jpg") && ($rozszerzenielogo != "jpeg") && ($rozszerzenielogo != "png") && ($rozszerzenielogo != "gif")) 
 		{
		//wyswietla blad w przypadku zlego formatu pliku
 			echo '<h3>Zły format pliku!</h3>';
 			$errors=1;
 		}
 		else
 		{
 $size=filesize($_FILES['image']['tmp_name']);
if ($size > MAX_SIZE*1024)
{
	echo '<h1>Limit objętości pliku logo przekroczony!</h1>';
	$errors=1;
}
$logo_name=time().'.'.$rozszerzenielogo;
$nowanazwa="../szablony/".$szablon."/images/logo.$rozszerzenielogo";
//usuwanie starego logo
if(file_exists("../szablony/".$szablon."/images/logo.jpg")) {
$staranazwa="../szablony/".$szablon."/images/logo.jpg";
unlink($staranazwa); }
if(file_exists("../szablony/".$szablon."/images/logo.png")) {
$staranazwa="../szablony/".$szablon."/images/logo.png";
chmod($staranazwa, 0777);
unlink($staranazwa); }
if(file_exists("../szablony/".$szablon."/images/logo.jpeg")) {
$staranazwa="../szablony/".$szablon."/images/logo.jpeg";
unlink($staranazwa); }
if(file_exists("../szablony/".$szablon."/images/logo.gif")) {
$staranazwa="../szablony/".$szablon."/images/logo.gif";
unlink($staranazwa); }
//koniec usuwania starego logo

$kopiowanie = copy($_FILES['image']['tmp_name'], $nowanazwa);
if (!$kopiowanie) 
{
	echo '<h2>Zmiana nie powiodła się!</h2>';
	$errors=1;
}}}}
 if(isset($_POST['Zmien']) && !$errors) 
 {
 	echo "<h2>Logo zostało zmienione!</h2>";
 }
}
 ?>
<center>
 <form name="nowelogo" method="post" enctype="multipart/form-data"  action="">
     <fieldset><legend>Wybierz plik z komputera aby zmienić logo</legend>
 <input type="file" name="image" value=""><br>
<input id="button" name="Zmien" type="submit" value="Zapisz logo">
     </fieldset>
 </form>
    </center>