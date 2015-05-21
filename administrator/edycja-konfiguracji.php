
<?php
if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
    if ($_POST['metoda'] == 'zapis') {
    if(file_exists('../konfiguracja.php')) {
    include'../konfiguracja.php';

//if($_SESSION['user']==$admin_nick) {

$title = $_POST['title'];
$description = $_POST['description'];
$keywords = $_POST['keywords'];
$szablon = $_POST['szablon'];
$backgroundimage = $_POST['backgroundimage'];

        $configure = "<?php\n";
        $configure .= "// plik \n";
        $configure .= "$"."title = "."\"".$title."\";\n";
        $configure .= "$"."description = "."\"".$description."\";\n";
        $configure .= "$"."keywords = "."\"".$keywords."\";\n";
        $configure .= "$"."szablon = "."\"".$szablon."\";\n";
        $configure .= "$"."backgroundimage = "."\"".$backgroundimage."\";\n";
        $configure .= "?>";
    if(file_exists("../konfiguracja.php")) {
    $staranazwa="../konfiguracja.php";
    $kasowanie = unlink($staranazwa);
    if (!$kasowanie) echo "nie udalo sie usunac pliku";
    }
      $fid = fopen("../konfiguracja.php","w");
      fputs($fid,$configure);
      fclose($fid);
      echo "<h3>Dane zostały zaktualizowane</h3>";
}
    }
else  {
    include'../konfiguracja.php';
    global $title;
    global $description;
    global $keywords;
    global $szablon;
    global $backgroundimage;
        function szablonactive($zmienna) {
            global $szablon;
            if ($szablon == $zmienna) {return 'checked';}
        }
        function backgroundimageactive($zmienna) {
            global $backgroundimage;
            if ($backgroundimage == $zmienna) {return 'checked';}
        }
    echo '
    <form action="index.php?pokaz=edycja-konfiguracji" method="post">
    <fieldset>
    <legend>Ustawienia strony</legend>
    <input type="hidden" name="metoda" value="zapis">
    <div id="form-inner">
    Tytuł strony: <input type="text" name="title" size="100" value="'.$title.'" title="Wpisz tytuł strony, najczęścien nazwa firmy, imię i nazwisko, bądź nazwa sprzedawanej usługi lub przedmiotu."><br />
    Opis działalności: <input type="text" name="description" size="100"  value="'.$description.'" title="Krótki opis działalności. Maksymalnie do 250 znaków."><br />
    Słowa kluczowe: <input type="text" name="keywords" size="100" value="'.$keywords.'" title="Wpisz słowa kluczowe oddzielone przecinkami, np: rower, koło, szprycha"><br /><br />
    </div></fieldset>    
    <fieldset><legend>Szablon:</legend><div id="form-inner">
    biznes biały <input type="radio" name="szablon" '.szablonactive($zmienna = "biznes-bialy").' value="biznes-bialy">
    biznes czarny <input type="radio" name="szablon" '.szablonactive($zmienna = "biznes-czarny").' value="biznes-czarny"><br /><br />
    </div></fieldset>    
    <fieldset><legend>Tło strony:</legend><div id="form-inner">
    tak <input type="radio" name="backgroundimage" '.backgroundimageactive($zmienna = "tak").' value="tak">
    nie <input type="radio" name="backgroundimage" '.backgroundimageactive($zmienna = "nie").' value="nie"><br />
    </div>
    </fieldset>
    <input id="button" type="submit" value="Zapisz">
    </form>'; 
    } 
    
}
    ?>
