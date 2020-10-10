<?php
    function getPage(){
        $pages['accueil'] = "accueilControleur";
        $pages['contact'] = "contactControleur";

        if (isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 'accueil';
        }

        if (isset($pages[$page])){
            $contenu = $pages[$page];
        } else {
            $contenu = $pages['accueil'];
        }
        return $contenu;
    }
?>