<?php

namespace App\src\models;

use App\app\Database;

class FicheModel{
    private $db;
    public function __construct(){
        $this ->db = new Database;
    }

    public function getLesFraisForfait($id, $mois)
    {
        return $this->db->query("SELECT fraisforfait.id as idfrais, fraisforfait.libelle as libelle, lignefraisforfait.quantite as quantite
                                 FROM lignefraisforfait
                                 INNER JOIN fraisforfait
		                         ON fraisforfait.id = lignefraisforfait.idfraisforfait
		                         WHERE lignefraisforfait.idvisiteur =? AND lignefraisforfait.mois=?
		                         ORDER BY lignefraisforfait.idfraisforfait", [$id, $mois]);
    }

    public function getLesFraisHorsForfait($id, $mois)
    {
        return $this->db->query('SELECT * FROM lignefraishorsforfait
                                WHERE lignefraishorsforfait.idvisiteur =?
		                        AND lignefraishorsforfait.mois = ?', [$id, $mois]);
    }

    public function getLesMoisDisponibles($id)
    {
        return $this->db->query('SELECT mois from fichefrais where idvisiteur=? order by mois desc', [$id]);
    }


    public function getLesInfosFicheFrais($id,$mois){
        return $this->db->query('SELECT ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur =? and fichefrais.mois =?',[$id,$mois]);
    }



    public function estPremierFraisMois($id,$mois){
        $ok = false;
        $res = $this->db->query("SELECT count(*) as nblignesfrais FROM fichefrais WHERE fichefrais.mois = ? AND fichefrais.idvisiteur = ?", [$mois, $id]);
        $laLigne = $res->fetch();
        if($laLigne->nblignesfrais == 0){
            $ok = true;
        }
        return $ok;
    }



    public function creeNouvellesLignesFrais($id,$mois){
		$dernierMois = $this->dernierMoisSaisi($id)->fetchColumn();
        if($dernierMois!=null){
            $laDerniereFiche = $this->getlesInfosFicheFrais($id,$dernierMois)->fetch();
            if($laDerniereFiche->idEtat=='CR'){
                $this->majEtatFicheFrais($id, $dernierMois,'CL');
            }
        }
        $this->db->query("INSERT INTO fichefrais(`idvisiteur`,`mois`,`nbJustificatifs`,`montantValide`,`dateModif`,`idEtat`) values('$id','$mois',0,0,now(),'CR')");
		$lesIdFrais = $this->getLesIdFrais();
		foreach($lesIdFrais as $uneLigneIdFrais){
			$unIdFrais = $uneLigneIdFrais->idfrais;
            $this->db->query("INSERT INTO lignefraisforfait(`idvisiteur`,`mois`,`idFraisForfait`,`quantite`) 
			values('$id','$mois','$unIdFrais',0)");
		}

	}

    public function dernierMoisSaisi($id){
        return $this->db->query("SELECT max(mois) as dernierMois FROM fichefrais WHERE fichefrais.idvisiteur = ?", [$id]);
    }


    public function majEtatFicheFrais($id,$mois,$etat){
        return $this->db->query("UPDATE ficheFrais SET idEtat = '$etat', dateModif = now() 
		WHERE fichefrais.idvisiteur =? AND fichefrais.mois = ?", [$id, $mois]);
	}


    public function getLesIdFrais(){
        return $this->db->query("SELECT fraisforfait.id as idfrais FROM fraisforfait ORDER BY fraisforfait.id");
	}


    function estEntierPositif($valeur) {
        return preg_match("/[^0-9]/", $valeur) == 0;
        
    }

    function estTableauEntiers($tabEntiers) {
        $ok = true;
        foreach($tabEntiers as $unEntier){
            if(!$this->estEntierPositif($unEntier)){
                 $ok=false; 
            }
        }
        return $ok;
    }



    function lesQteFraisValides($lesFrais){
        return $this->estTableauEntiers($lesFrais);
    }


    public function majFraisForfait($id, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
            $this->db->query("UPDATE lignefraisforfait SET lignefraisforfait.quantite = $qte
			WHERE lignefraisforfait.idvisiteur = '$id' AND lignefraisforfait.mois = '$mois'
			AND lignefraisforfait.idfraisforfait = '$unIdFrais'");
		}
		
	}














}











