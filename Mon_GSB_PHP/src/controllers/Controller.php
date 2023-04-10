<?php
namespace App\src\controllers;

use App\src\models\FicheModel;
use App\src\models\Model;

abstract class Controller{
    public function render(string $vue, $data=[]){
        
        ob_start();
        extract($data);
        include("../src/views/$vue.php");
        $contenue = ob_get_clean();
        include("../src/views/entete.php"); 
    }
}