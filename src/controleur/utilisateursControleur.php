<?php

    function utilisateursControleur($twig, $db){
        $form = array();
        $utilisateur = new Utilisateur($db);
        $userList = $utilisateur->mkUserList();

        echo $twig->render('utilisateurs.html.twig', array('form'=>$form, 'userList'=>$userList));
    }
    
?>