<?php
    function profilControleur($twig, $db){
        $utilisateur = new Utilisateur($db);
        
        
        $unUtilisateur = $utilisateur->connect($id);

        echo $twig->render('profil.html.twig', array());
    }
?>