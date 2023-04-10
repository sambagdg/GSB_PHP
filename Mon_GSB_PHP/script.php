<?php


// connexion a la bd

use function PHPSTORM_META\map;

$dsn = "mysql:dbname=gsb;host=localhost";
$login = "root";
$password = "root";

$pdo = new PDO($dsn, $login, $password);
$req = "SELECT mdp FROM gsb.visiteur";
$query = $pdo->query($req);

$resultat=$query->fetchAll(PDO::FETCH_COLUMN);
    
foreach ($resultat as $key => $value){
    echo"$value </br>";

    //je hash mon mot de passe
   $mdphash = password_hash($value, PASSWORD_DEFAULT);

   $data = [
    'mdp' => $value,
    'mdphash' => $mdphash];

    $req = "UPDATE gsb.visiteur SET mdp=:mdphash WHERE mdp=:mdp";
    $stmt= $pdo->prepare($req);
   
    $stmt->execute($data);
}










echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";


// foreach ($resultat as $value){
//     $mdporigine = $value;

//     $mdphash = password_hash($mdporigine, PASSWORD_DEFAULT);

//     echo"$mdporigine::::::$mdphash";
// }








function afficherEtoire( $cote){

    for( $i = 0; $i< $cote; $i++){
        for($j = 0; $j<$cote; $j++){
            print("*");
        }
        print("<br>");
    }

}

afficherEtoire(3);



/