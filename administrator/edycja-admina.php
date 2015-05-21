<?php
if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
    if (($_POST['metoda'] == 'zapis') && ($_POST['admin'] != "") && ($_POST['haslo'] != "")) {
        if(file_exists('uzytkownik.php')) {
        include'uzytkownik.php';

        $admin = $_POST['admin'];
        $haslo = (md5($_POST['haslo']));
        $configure = "<?php\n";
        $configure .= "// plik \n";
        $configure .= "$"."loginplik = "."\"".$admin."\";\n";
        $configure .= "$"."hasloplik = "."\"".$haslo."\";\n";
        $configure .= "\n";
        $configure .= "?>";

        $fid = fopen("uzytkownik.php","w");
        fputs($fid,$configure);
        fclose($fid);
        echo "<h3>Dane zostały zaktualizowane</h3>";
    }
    }
    else  {
    echo '<center>
        <form action="index.php?pokaz=edycja-admina" method="post">
        <fieldset>
        <legend>Zmiana danych dla logowania</legend>
   
    <input type="hidden" name="metoda" value="zapis">
    Nazwa administratora: <input type="text" name="admin" value=""><br />
    Hasło administratora: <input type="text" name="haslo" value=""><br />
    <input id="button" type="submit" value="Zapisz">
    </fieldset></form><center>';
    }
}

    
?>
