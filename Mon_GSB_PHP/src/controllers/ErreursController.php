<?php
namespace App\src\controllers;
use App\src\controllers\Controller;

class ErreursController extends Controller{
    public function index(){
        $this->render("erreurs");
    }
}