    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
        <h2></h2>

      </div>

        <ul id="menuList">
			<li>Visiteur : <?php
         echo $_SESSION['nom'] . " " . $_SESSION['prenom']; 
         ?> 

         <p></p>
			</li>
           <li class="smenu">
              <a href="saisiFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
           </li>
           <li class="smenu">
              <a href="mesFiches" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
           </li>
 	   <li class="smenu">
              <a href="deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
         </ul>

    </div>