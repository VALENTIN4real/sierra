<?php
    class Utilisateur{
        private $db;
        private $insert;
        private $connect;

        public function __construct($db){
            $this->db = $db;
            $this->insert = $this->db->prepare("insert into utilisateur(email,  mdp,  nom,  prenom, idRole, dateInscription) values(:email, :mdp, :nom, :prenom, :role, now())");
            $this->connect = $this->db->prepare("select id, email, mdp, idRole, nom, prenom, dateInscription from utilisateur where email=:email");
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
    }

?>