<?php
error_reporting(0);
session_start(); //sesje, do logowania
ob_start();  //emulacja headerow
if (ini_get('register_globals')){echo "<font color=red>Registor global is ON</a><br>This is a security issue, please change settings inside your php.ini file</font>";}
 else{echo "Register global is OFF";}
?>
<!DOCTYPE html> 
<head>
        <title>Szybka Strona</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css" />
<!--[if IE]>
<script src="html5.js" type="text/javascript"></script>
<![endif]-->
    </head>
    <body>
        <div id="wrapper">
        <header>
            <?php
            require_once '../konfiguracja.php';  
            require_once 'uzytkownik.php';
            global $szablon;
            if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
            global $hasloplik;
            if ($hasloplik == '21232f297a57a5a743894a0e4a801fc3') {
            echo '<div id="haslo-warning">';
            echo "zmień hasło";
            echo '</div>';
            }
            }
            echo '<center><a href="index.php"><img src="../szablony/'.$szablon.'/images/logo.png" align="left"></a>';
            echo '<h1>Panel administracyjny</h1></center>';
            ?>
        
        </header>
        <nav>
            <?php //menu(); ?>
        </nav>
        <hr>
            
        <article>
        <?php
        if($_SESSION['admin'] == 'ok' && isset($_COOKIE['log']))  {
            if ($_POST['zapis'] == 'zapis') {
                require_once 'zapis-danych.php';
            }
            elseif ($_POST['metoda'] == 'edycja') {
                require_once 'edycja.php';
            }
            elseif ($_GET['pokaz'] == 'edycja-konfiguracji') {
                require_once 'edycja-konfiguracji.php';
            }
            elseif ($_GET['pokaz'] == 'zapis-konfiguracji') {
                require_once 'zapis-konfiguracji.php';
            }
            elseif ($_GET['pokaz'] == 'upload-logo') {
                require_once 'upload-logo.php';
            }
            elseif ($_GET['pokaz'] == 'upload-tlo') {
                require_once 'upload-tlo.php';
            }
            elseif ($_GET['pokaz'] == 'edycja-admina') {
                require_once 'edycja-admina.php';
            }
            elseif ($_GET['pokaz'] == 'edycja-galerii') {
                require_once 'edycja-galerii.php';
            }
            elseif ($_GET['pokaz'] == 'upload-zdjecia-kontakt') {
                require_once 'upload-zdjecia-kontakt.php';
            }
            else {
                require_once 'log.php';
            }
        }
        else {
           require_once 'log.php'; 
        }
        ?>
        
        </article>
        
        </div>
        <footer>
            <div class="stopka left"><a href="index.php">Panel Administracyjny</a></div>
        <div class="podglad right"><a href="../index.php" target="_blank">Podgląd</a></div>
        </footer>
    </body>
</html>