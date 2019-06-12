<?php
/**
 * Contient des fonctions utilitaires pour la construction des pages (header, footer...)
 */



function get_header(){
    include_once('../settings.php');
    include_once('../content/header.php');
}



function get_footer(){
    include_once('../content/footer.php');
}