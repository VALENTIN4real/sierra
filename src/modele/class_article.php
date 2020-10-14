<?php
    class Article{
        private $db;
        private $insertArticle;

        public function __construct($db){
            $this->db = $db;
            $this->insertArticle = $this->db->prepare("insert into article(idAuteur, auteur, titre, contenu) values(:idAuteur, :auteur, :titreArticle, :contenuArticle)");
        }

        public function insertArticle($idAuteur, $auteur, $titreArticle, $contenuArticle){
            $r = true;
            $this->insertArticle->execute(array(':idAuteur'=>$idAuteur, ':auteur'=>$auteur, ':titreArticle'=>$titreArticle, ':contenuArticle'=>$contenuArticle));
            
            if ($this->insertArticle->errorCode()!=0){
                print_r($this->insertArticle->errorInfo());
                $r=false;
            }
            
            return $r;
        }
    }
?>