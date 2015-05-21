<?php
$zdjecie = $_GET['zdjecie'];

 define ("MAX_SIZE","1000"); 
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
 			echo '<h1>Zły format pliku!</h1>';
 			$errors=1;
 		}
 		else
 		{
 $size=filesize($_FILES['image']['tmp_name']);
if ($size > MAX_SIZE*1024)
{
	echo '<h1>Limit objętości pliku zdjęcia przekroczony!</h1>';
	$errors=1;
}
$logo_name=time().'.'.$rozszerzenielogo;
$nowanazwa="../galeria/$zdjecie";
//usuwanie zdjec starych przed uploadem
if(file_exists($nowanazwa)) {
$kasowanie = unlink($nowanazwa);
if (!$kasowanie)  {echo "nei mozna skasowac pliku";}
$miniatura="../galeria/miniatury/".$zdjecie;
$kasowanie = unlink($miniatura);
if (!$kasowanie)  {echo "nei mozna skasowac miniatury";}
}
$kopiowanie = copy($_FILES['image']['tmp_name'], $nowanazwa); //kopiowanie oryginalu do foledru
$nowanazwaminiatury="../galeria/miniatury/$zdjecie";
$kopiowanie = copy($_FILES['image']['tmp_name'], $nowanazwaminiatury); //kopiowanie miniatury do folderu

//tworzenie miatur
$filename = "../galeria/$zdjecie";
echo $filename;
// Set a maximum height and width
$width = 200;
$height = 200;

// Content type
//header('Content-Type: image/jpeg');

// Get new dimensions
list($width_orig, $height_orig) = getimagesize($filename);

$ratio_orig = $width_orig/$height_orig;

if ($width/$height > $ratio_orig) {
   $width = $height*$ratio_orig;
} else {
   $height = $width/$ratio_orig;
}

// Resample
$image_p = imagecreatetruecolor($width, $height);
$image = imagecreatefromjpeg($filename);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

// Output
$sciezka = "../galeria/miniatury/$zdjecie";
imagejpeg($image_p, $sciezka, 100);

//koniec tworzenia miniatur
if (!$kopiowanie) 
{
	echo '<h1>Zmiana nie powiodła się!</h1>';
	$errors=1;
}}}}
 if(isset($_POST['Zmien']) && !$errors) 
 {
 	echo "<h1>Zdjęcie zostało zmienione!</h1>";
 }

 ?><center>
 <form name="nowelogo" method="post" enctype="multipart/form-data"  action="">
<fieldset><legend>Wybierz plik aby zmienić zdjęcie w galerii</legend>
 <input type="file" name="image"><br>
<input name="Zmien" id="button" type="submit" value="Zapisz zdjęcie"><br>
</fieldset> 
</form></center>