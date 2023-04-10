<?php
namespace App\src\controllers;
use App\src\controllers\Controller;
use App\src\models\FicheModel;

class ListeMoisController extends Controller {
    // declarations des attributs
    private $model;

    public function __construct(){   // le constructeur
        $this->model = new FicheModel();
    }
    public function index(){
        $id = $_SESSION['id'];
        $mois = date("Ym");
        $numAnnee = substr($mois, 0, 4);
        $numMois = substr($mois, 4, 2);
        $lesMois = $this->model->getLesMoisDisponibles($id)->fetchAll();


       $this->render("listeMois",compact('lesMois','numAnnee','numMois'));
        
    }
}