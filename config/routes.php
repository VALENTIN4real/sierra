<?php
    function getPage($db){
        $pages['accueil'] = "accueilControleur";
        $pages['contact'] = "contactControleur";
        $pages['inscription'] = "inscriptionControleur";

        if($db!=null){
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
        } else {
            echo "site en maintenance";
        }
    }
?>