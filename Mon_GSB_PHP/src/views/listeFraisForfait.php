<?php
 include 'sommaire.php';

 ?>

<div id="contenu">
      <h2>Renseigner ma fiche frais du mois <?php echo $numMois . "-" . $numAnnee?></h2>

      <form method="POST"  action="valider">
      <div class="corpsForm">

          <fieldset>
            <legend>Eléments forfaitisés
            </legend>
			<?php

            foreach ($lesFraisForfait as $unFrais) {
                $idFrais = $unFrais->idfrais;
                $libelle = $unFrais->libelle;
                $quantite = $unFrais->quantite;
    ?>
					<p>
						<label for="idFrais"><?php echo $libelle ?></label>
						<input type="text" id="idFrais" name= "lesFrais [<?php echo $idFrais ?>]" size="10" maxlength="5" value="<?php echo $quantite ?>" >
					</p>

			<?php
}
?>

          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p>
      </div>

      </form>

<table class="listeLegere">
  	   <h2>Descriptif des éléments hors forfait
       </h2>
             <tr>
                <th class="date">Date</th>
				<th class="libelle">Libellé</th>
                <th class="montant">Montant</th>
                <th class="action">&nbsp;</th>
             </tr>

    <?php

    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
    $libelle = $unFraisHorsForfait['libelle'];
    $date = $unFraisHorsForfait['date'];
    $montant = $unFraisHorsForfait['montant'];
    $id = $unFraisHorsForfait['id'];
    ?>
            <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td><a href="index.php?uc=gererFrais&action=supprimerFrais&idFrais=<?php echo $id ?>"
				onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a></td>
             </tr>
	<?php

}
?>

    </table>
      <form action="saisie_des_fiches/HorsFraisForfait" method="post">
      <div class="corpsForm">

          <fieldset>
            <legend>Nouvel élément hors forfait
            </legend>
            <p>
              <label for="txtDateHF">Date: </label>
              <input type="text" id="txtDateHF" name="dateFrais" size="10" maxlength="10" value placeholder="jj/mm/aaaa"  />
            </p>
            <p>
              <label for="txtLibelleHF">Libellé</label>
              <input type="text" id="txtLibelleHF" name="libelle" size="70" maxlength="256" value="" />
            </p>
            <p>
              <label for="txtMontantHF">Montant : </label>
              <input type="text" id="txtMontantHF" name="montant" size="10" maxlength="10" value="" />
            </p>
          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ajouter" type="submit" value="Ajouter" size="20" />
        <input id="effacer" type="reset" value="Effacer" size="20" />
      </p>
      </div>

      </form>
  </div>


