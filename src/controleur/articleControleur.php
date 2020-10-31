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

    function listeArticlesControleur($twig, $db){
        $form = array();
        $article = new Article($db);
        $listeArticles = $article->selectArticle();
        echo $twig->render('liste_articles.html.twig', array('form'=>$form,'listeArticles'=>$listeArticles));
    }

    function mesArticlesControleur($twig, $db){
        $form = array();
        $article = new Article($db);
        $listeMesArticles = $article->selectMesArticles();
        echo $twig->render('mes_articles.html.twig', array('form'=>$form,'listeMesArticles'=>$listeMesArticles));
    }

    function modifArticleControleur($twig, $db){
        $form = array();

        if(isset($_GET['id'])){
            $article = new Article($db);
            $unArticle = $article->selectById($_GET['id']);

            if ($unArticle!=null){
                $form['article'] = $unArticle;
            } else {
                $form['message'] = 'Article incorrect';
            }
        } else {
            if(isset($_POST['btModifierArticle'])){
                $article = new Article($db);
                $titreArticle = $_POST['titreArticle'];
                $contenuArticle = $_POST['contenuArticle'];
                $id = $_POST['id'];

                $exec=$article->update($titreArticle, $contenuArticle, $id);

                if(!$exec){
                    $form['valide'] = false;
                    $form['message'] = 'Echec de la modification';
                } else {
                    $form['valide'] = true;
                    $form['message'] = 'Modification réussie';
                }
            } else {
                $form['message'] = 'Article non spécifié';
            }
        }

        echo $twig->render('modif_article.html.twig', array('form'=>$form));
    }
?>