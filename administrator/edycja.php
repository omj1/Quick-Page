<?php
echo $_SERVER['SERVER_NAME'];
echo '<br>';
echo $_SERVER['PHP_SELF'];
echo '<br>';
?>
<script type="text/javascript" src="../js/nicEdit.js"></script>

<script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        //new nicEditor().panelInstance('panelInstance');
        new nicEditor({fullPanel : true, uploadURI : '../nicUpload.php'}).panelInstance('panelInstance');
        //new nicEditor({fullPanel : true, uploadURI : 'http://localhost/szybka-strona/nicUpload.php'}).panelInstance('panelInstance');
        //new nicEditor({iconsPath : '../nicEditorIcons.gif'}).panelInstance('area3');
        //new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
        //new nicEditor({maxHeight : 100}).panelInstance('area5');
  });
  //]]>
  </script>
<?php
if (($_POST['podstrona'] == 'oferta') || ($_POST['podstrona'] == 'strona-glowna')) {
    $opis = $_POST['opis'];
    $opis = str_replace('\"', '"', $opis);
    echo '<center><form method="post" action="index.php">
  
    <fieldset><legend>Edytujesz podstronę: '.$_POST['naglowek'].'</legend>
    <input type="hidden" name="zapis" value="zapis">
    <input type="hidden" name="podstrona" value="'.$_POST['podstrona'].'">
    <input type="text" name="naglowek" value="'.$_POST['naglowek'].'">
    <textarea name="opis" id="panelInstance" cols="80" rows="30" value="">'.$opis.'</textarea>
    <input id="button" type="submit" value="Aktualizuj">
    </fieldset>
    </form></center><br>';
}
elseif ($_POST['podstrona'] == 'kontakt') {
    echo '<form method="post" action="index.php">
        <fieldset><legend>Edycja danych kontaktowych</legend>
        <div id="form-inner">
    <input type="hidden" name="zapis" value="zapis">
    <input type="hidden" name="podstrona" value="'.$_POST['podstrona'].'"><br />
    nazwa firmy: <input type="text" name="nazwa_firmy" value="'.$_POST['nazwa_firmy'].'"><br />
    ulica: <input type="text" name="ulica" value="'.$_POST['ulica'].'"><br />
    kod pocztowy: <input type="text" name="kod" value="'.$_POST['kod'].'"> 
    nazwa miasta:<input type="text" name="miasto" value="'.$_POST['miasto'].'"><br />
    telefon: <input type="text" name="telefon" value="'.$_POST['telefon'].'"><br />
    telefon komórkowy: <input type="text" name="komorka" value="'.$_POST['komorka'].'"><br />
    numer faksu: <input type="tel" name="fax" value="'.$_POST['fax'].'"><br />
    adres email: <input type="email" name="email" value="'.$_POST['email'].'">
    </fieldset>
    <input id="button" type="submit" value="Aktualizuj">
    </div>
    </form>';
}
?>