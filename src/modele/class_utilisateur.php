<?php
    class Utilisateur{
        private $db;
        private $insert;
        public function __construct($db){
            $this->db = $db;
            $this->insert  =  $this->db->prepare("insert into utilisateur(email,  mdp,  nom,  prenom, idRole, dateInscription) values(:email, :mdp, :nom, :prenom, :role, now())");
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
    }

?>