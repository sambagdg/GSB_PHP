<?php

namespace App\src\controllers;
use App\src\controllers\Controller;
use App\src\models\FicheModel;

class EtatFraisController extends Controller{
    // declaration des attributs
    private $model;

    public function __construct(){   // le constructeur
        $this->model = new FicheModel();
    }
    public function index(){

        $id = $_SESSION["id"];
        $mois = date("Ym");
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $lesFraisForfait = $this->model->getLesFraisForfait($id,$mois)->fetchAll();
        $lesFraisHorsForfait = $this->model->getLesFraisHorsForfait($id,$mois)->fetchAll();
        $lesInfosFicheFrais = $this->model->getLesInfosFicheFrais($id,$mois)->fetchAll();
        $lesMois = $this->model->getLesMoisDisponibles($id)->fetchAll();




        $this->render("etatFrais",compact('mois','numAnnee','numMois','lesFraisForfait','lesFraisHorsForfait','lesInfosFicheFrais','lesMois'));

    }
}


