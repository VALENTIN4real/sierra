<?php
    function nouvelArticleControleur($twig, $db){
        $formArticle = array();

        if(isset($_POST['btArticle'])){
            $idAuteur = $_SESSION['id'];
            $auteur = $_SESSION['prenom'];
            $titreArticle = $_POST['titreArticle'];
            $contenuArticle = $_POST['contenuArticle'];
            $formArticle['valide'] = true;

            $unArticle = new Article($db);
            $exec = $unArticle->insertArticle($idAuteur, $auteur, $titreArticle, $contenuArticle);
            
            if(!$exec){
                $formArticle['valide'] = false;
                $formArticle['message'] = 'Problème d\'insertion dans la table article';
            }

            $formArticle['idAuteur'] = $idAuteur;
            $formArticle['auteur'] = $auteur;
            $formArticle['titre'] = $titreArticle;
            $formArticle['contenu'] = $contenuArticle;
        }
        echo $twig->render('nouvel_article.html.twig', array('formArticle'=>$formArticle));
        
    }

    function listeArticles($twig, $db){
        $form = array();
        $article = new Article($db);
        $listeArticles = $article->selectArticle();
        echo $twig->render('liste_articles.html.twig', array('form'=>$form,'listeArticles'=>$listeArticles));
    }
?>