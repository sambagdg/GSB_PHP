<?php
namespace App\src\controllers;


class DeconnexionController{
    public function deconnexion(){
        session_destroy();
        header('location:./');
    }
}
    
