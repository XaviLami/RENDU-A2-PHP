<?php
require __DIR__ . "/vendor/autoload.php";


$pdo = new PDO('mysql:host=127.0.0.1;dbname=Jeu', "root", "");



## ETAPE 0

## CONNECTEZ VOUS A VOTRE BASE DE DONNEE

## ETAPE 1

## RECUPERER TOUT LES PERSONNAGES CONTENU DANS LA TABLE personnages
$select_personnages = $pdo->prepare('SELECT * FROM Personnages');
$select_personnages->execute();
$personnages = $select_personnages->fetchAll(PDO::FETCH_ASSOC);

## ETAPE 2

## LES AFFICHERS DANS LE HTML
## AFFICHER SON NOM, SON ATK, SES PV, SES STARS

## ETAPE 3

## DANS CHAQUE PERSONNAGE JE VEUX POUVOIR APPUYER SUR UN BUTTON OU IL EST ECRIT "STARS"

## LORSQUE L'ON APPUIE SUR LE BOUTTON "STARS"

## ON SOUMET UN FORMULAIRE QUI METS A JOURS LE PERSONNAGE CORRESPONDANT (CELUI SUR LEQUEL ON A CLIQUER) EN INCREMENTANT LA COLUMN STARS DU PERSONNAGE DANS LA BASE DE DONNEE

#######################
## ETAPE 4
# AFFICHER LE MSG "PERSONNAGE ($name) A GAGNER UNE ETOILES"

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rendu Php</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<nav class="nav mb-3">
    <a href="./rendu.php" class="nav-link">Acceuil</a>
    <a href="./personnage.php" class="nav-link">Mes Personnages</a>
    <a href="./combat.php" class="nav-link">Combats</a>
</nav>
<h1>Mes personnages</h1>
<div class="w-100 mt-5">

<?php
foreach ($personnages as $personnage_value) {
    if(isset($_POST["etoile" . $personnage_value["name"]])){
        
        $personnage_value["stars"]++;
        $ajout_stars = $pdo->prepare('UPDATE Personnages SET stars=:stars WHERE name=:name');
        $ajout_stars->execute([":stars"=>$personnage_value["stars"], ":name"=>$personnage_value["name"]]);
        echo $personnage_value["name"] . " a gagné 1 étoile" . "<br>";
    }
    echo "Personnage : ".$personnage_value["name"] . "  Pv=" .$personnage_value["pv"] . " Atk=" . $personnage_value["atk"] . " Etoiles=" . $personnage_value["stars"] . " " . "<br>"; ?>
    
    <form method=POST>
    <button name="etoile<?php echo $personnage_value["name"] ?>" class="btn"> STARS</button>
    <br>
    <br>
    </form> 

    <?php
}
?>



</div>

</body>
</html>
