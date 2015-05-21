<?php
if (($_POST['podstrona'] == 'oferta') || ($_POST['podstrona'] == 'strona-glowna')) {
$podstrona = $_POST['podstrona'];
$rozsz = '.txt';
    $file = "$podstrona"."$rozsz"; 
    $naglowek = $_POST['naglowek']; 
    //$opis = $_POST['opis'];
    $opis = str_replace('\"', '"', $_POST['opis']);
    
//$dane[2] = str_replace("\r\n", "", $dane[2]);
    $configure = "<?php\n";
    $configure .= "$"."naglowek = "."\"".$naglowek."\";\n";
    $configure .= "$"."opis = "."'".$opis."';\n";
    $configure .= "?>";
    if(file_exists("../teksty/".$podstrona.".php")) {
    $staranazwa="../teksty/".$podstrona.".php";
    $kasowanie = unlink($staranazwa);
    if (!$kasowanie) echo "nie udalo sie usunac pliku";
    }
    $fid = fopen('../teksty/'.$podstrona.'.php','w');
    fputs($fid,$configure);
    fclose($fid);
    echo "<h3>Dane zostały zaktualizowane</h3>";
    echo $naglowek.'<br>';
    echo $opis.'<br>';
   
}
elseif ($_POST['podstrona'] == 'kontakt') {
    if(file_exists('../teksty/kontakt.php')) {
    include'../teksty/kontakt.php';
//if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log'])) {

    $nazwa_firmy = $_POST['nazwa_firmy'];
    $ulica = $_POST['ulica'];
    $kod = $_POST['kod'];
    $miasto = $_POST['miasto'];
    $telefon = $_POST['telefon'];
    $komorka = $_POST['komorka'];
    $fax= $_POST['fax'];
    $email = $_POST['email'];
     
    $configure = "<?php\n";
    $configure .= "$"."nazwa_firmy = "."\"".$nazwa_firmy."\";\n";
    $configure .= "$"."ulica = "."\"".$ulica."\";\n";
    $configure .= "$"."kod = "."\"".$kod."\";\n";
    $configure .= "$"."miasto = "."\"".$miasto."\";\n";
    $configure .= "$"."telefon = "."\"".$telefon."\";\n";
    $configure .= "$"."komorka = "."\"".$komorka."\";\n";
    $configure .= "$"."fax = "."\"".$fax."\";\n";
    $configure .= "$"."email = "."\"".$email."\";\n";
    $configure .= "\n";
    $configure .= "?>";
    if(file_exists("../teksty/".$podstrona.".php")) {
    $staranazwa="../teksty/".$podstrona.".php";
    $kasowanie = unlink($staranazwa);
    if (!$kasowanie) echo "nie udalo sie usunac pliku";
    }
    $fid = fopen("../teksty/kontakt.php","w");
          fputs($fid,$configure);
      fclose($fid);
     echo "<h3>Dane zostały zaktualizowane</h3>";
    echo $nazwa_firmy.'<br>';
    echo $ulica.'<br>';
    echo $kod.'<br>';
    echo $miasto.'<br>';
    echo $telefon.'<br>';
    echo $komorka.'<br>';
    echo $fax.'<br>';
    echo $email.'<br>';
    }
//}
}
?>