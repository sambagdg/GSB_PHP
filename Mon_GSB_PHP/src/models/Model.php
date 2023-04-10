<?php

namespace App\src\models;

use App\app\Database;


class Model{

    private $db;

    public function __construct(){
        $this ->db = new Database;
        
    }

    public function getMdpUser($login){ // function pour recuperer le mot de passe
        return $this->db->query("SELECT mdp FROM visiteur WHERE login =?",[$login]);
    }

    public function getInfosUtilisateur($login)
    {
         return $this->db->query("SELECT id,nom,prenom FROM visiteur WHERE login=?", [$login]);
     
    }
    

}



    
