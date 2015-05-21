<!DOCTYPE html>  
<?php
//error_reporting(0);
session_start(); //sesje, do logowania
ob_start();  //emulacja headerow
?>
<head>
        <?php head(); ?>
        
<!--[if IE]>
<script src="html5.js" type="text/javascript"></script>
<![endif]-->
    </head>
    <body <?php tloBody(); ?>>
        
            <header>
                <div id="header-inner">
                    <div id="logo">
                       <?php logo (); ?>
                    </div>
                    
                        <?php menu(); ?>
                 
                </div>
            </header>

            <article>
                <div id="article-inner">
                <?php pokaz(); ?>
                </div>
            </article>
            <footer>
                <div id="footer-inner">
               <?php stopka(); ?>
                </div>
            </footer>
        
    </body>
</html>