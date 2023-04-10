<?php
session_start();

use App\Autoloader;
use App\src\controllers\AccueilController;
use App\src\controllers\ConnexionController;
use App\src\controllers\DeconnexionController;
use App\src\controllers\EtatFraisController;
use App\src\controllers\VerifController;
use App\src\controllers\FraisForfaitController;
use App\src\controllers\ListeMoisController;
use App\src\controllers\ValiderController;

// définition d'une costante contenant le dossier racine du project
define('ROOT', dirname(__DIR__));
// importarion de l'autoloader
require_once ROOT."/Autoloader.php";
Autoloader::register();


$url = ($_GET['url']) ?? null;





if($url == "connexion" ){
    $verif = new VerifController();
    $verif->verif();
    $verif->index();

}

if($url=="mon-espace" && isset($_SESSION['token'])){
    $accueil = new AccueilController();
    $accueil->index();
}

elseif ($url =="saisiFrais"&& isset($_SESSION['token']) ){
    $saisi = new FraisForfaitController();
    $saisi->verif_fiches();
    $saisi->index();
}

elseif ($url =="valider" && isset($_SESSION['token']) ){
    $valid = new ValiderController;
    $valid->valider();
    $valid->index();
}
elseif ($url == "mesFiches"&& isset($_SESSION['token'])){
    $mesfiches = new ListeMoisController();
    $mesfiches->index();
}

elseif($url == 'deconnexion'){
    $deconnexion = new DeconnexionController();
    $deconnexion->deconnexion();
}

elseif($url == 'afficher_mes_fiches'&& isset($_SESSION['token'])){
    $etat = new EtatFraisController;
    $etat->index();
}

else{
    $connexion = new ConnexionController();
    $connexion->index();
}