<?php

namespace App\src\controllers;

use App\src\models\Model;

class VerifController {
    // declaration des attributs 
    private $model;

    public function __construct(){   // le constructeur 
        $this->model = new Model;
        
    }

    private function getBddMdp($login){
        return $this->model->getMdpUser($login);
    }

    // Fonction publique
    public function verif(){
        
        $user_login=$_POST['login'];
        $user_mdp=$_POST['mdp'];
        $BonMdp=$this->getBddMdp($user_login)->fetch();

        if ($user_mdp != null && password_verify($user_mdp, $BonMdp->mdp)){
            $_SESSION['token']='ok';
            header("Location:mon-espace");
        }
        else{
            header("Location:./");
        }
    } 
    
    
    private function getinfo($login){
        return ($this->model->getInfosUtilisateur($login))->fetchAll();
    }  

    public function index(){  
        $login = $_POST['login'];
        // var_dump($login);
        $info = $this->getinfo($login);
         
        foreach($info as $info_user){
            $_SESSION['id']= $info_user->id;
            $_SESSION['nom']= $info_user->nom;
            $_SESSION['prenom']= $info_user->prenom;
        }
    }


}