<?php
namespace App\src\controllers;
use App\src\controllers\Controller;
use App\src\models\FicheModel;


class FraisForfaitController extends Controller {
    // declaration des attributs
    private $model;
    

    public function __construct(){   // le constructeur
        $this->model = new FicheModel;
        
    }

    public function verif_fiches(){
        $mois = date("Ym");
        $id = $_SESSION['id'];

        $premierFraisMois = $this->model->estPremierFraisMois($id,$mois);

        if($premierFraisMois == true){
            $this->model->creeNouvellesLignesFrais($id,$mois);
        }
    }
    public function index(){
        $id = $_SESSION['id'];
        $prenom =  $_SESSION['prenom'];
        // var_dump($id);
      
        $mois = date("Ym");
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $lesFraisForfait = $this->model->getLesFraisForfait($id,$mois)->fetchAll();
        $lesFraisHorsForfait = $this->model->getLesFraisHorsForfait($id,$mois)->fetchAll();
        
        $this->render("listeFraisForfait",compact('mois','numAnnee','numMois','lesFraisForfait','lesFraisHorsForfait'));
    }
}