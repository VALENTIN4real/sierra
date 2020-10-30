<?php
    class Article{
        private $db;
        private $selectArticle;
        private $insertArticle;

        public function __construct($db){
            $this->db = $db;
            $this->insertArticle = $this->db->prepare("INSERT INTO article(idAuteur, auteur, titre, contenu, dateArticle) VALUES(:idAuteur, :auteur, :titreArticle, :contenuArticle, NOW())");
            $this->selectArticle = $this->db->prepare("SELECT auteur, idAuteur, titre, contenu FROM article ORDER BY dateArticle DESC");
            $this->selectMesArticles =$this->db->prepare("SELECT auteur, idAuteur, titre, contenu FROM article WHERE idAuteur = $_SESSION[id] ORDER BY dateArticle DESC");
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

        public function selectArticle(){
            $this->selectArticle->execute();
            
            if ($this->selectArticle->errorCode()!=0){
                print_r($this->selectArticle->errorInfo());
            }
            
            return $this->selectArticle->fetchAll();
        }

        public function selectMesArticles() {
            $this->selectMesArticles->execute();
            
            if ($this->selectMesArticles->errorCode()!=0){
                print_r($this->selectMesArticles->errorInfo());
            }
            
            return $this->selectMesArticles->fetchAll();
        }
    }
?>