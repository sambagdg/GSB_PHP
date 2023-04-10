<?php
namespace App\src\controllers;
use App\src\controllers\Controller;

class AccueilController extends Controller{
    public function index(){
        $this->render("accueil");
    }
    
}