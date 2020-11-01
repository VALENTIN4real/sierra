<?php
    class Utilisateur{
        private $db;
        private $insert;
        private $connect;
        private $mkUserList;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $this->db->prepare("INSERT INTO utilisateur(email,  mdp,  nom,  prenom, idRole, dateInscription) VALUES(:email, :mdp, :nom, :prenom, :role, NOW())");
            $this->connect = $this->db->prepare("SELECT id, email, mdp, idRole, nom, prenom, dateInscription FROM utilisateur WHERE email=:email");
            $this->mkUserList = $this->db->prepare("SELECT id, email, idRole, nom, prenom, DATE_FORMAT(dateInscription, '%d/%m/%Y') AS dateInscription FROM utilisateur ORDER BY id");
        }

        public function insert($email, $mdp, $role, $nom, $prenom){
            $r = true;
            $this->insert->execute(array(':email'=>$email, ':mdp'=>$mdp, ':role'=>$role, ':nom'=>$nom,':prenom'=>$prenom));
            
            if ($this->insert->errorCode()!=0){
                print_r($this->insert->errorInfo());
                $r=false;
            }
            
            return $r;
        }

        public function connect($email){
            $unUtilisateur = $this->connect->execute(array(':email'=>$email));

            if($this->connect->errorCode()!=0){
                print_r($this->connect->errorInfo());
            }

            return $this->connect->fetch();
        }

        public function mkUserList(){
            $this->mkUserList->execute();

            if($this->mkUserList->errorCode()!=0){
                print_r($this->mkUserList->errorInfo());
            }

            return $this->mkUserList->fetchAll();
        }
    }

?>