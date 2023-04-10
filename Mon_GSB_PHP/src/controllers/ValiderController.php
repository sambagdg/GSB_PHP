<?php
namespace App\src\controllers;

use App\src\models\FicheModel;

class ValiderController extends Controller{
    private $model;


    public function __construct(){
        $this->model = new FicheModel;
    }


    public function valider(){
        $id=$_SESSION['id'];
        $mois=date("Ym");
        $lesFrais=$_POST['lesFrais'];

        if($this->model->lesQteFraisValides($lesFrais)==true){
            $this->model->majFraisForfait($id, $mois, $lesFrais);
        }
        else{
            echo"Les valeurs doivents etre numériques!";
        }
    }

    public function index(){
        $this->render('sommaire');
    }

}