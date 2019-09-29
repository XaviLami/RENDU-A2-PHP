<?php
require __DIR__ . "/vendor/autoload.php";

try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=Jeu', "root", "");
} catch (Exception $e){
    echo "erreur de connection à la base de donnée";
}

$select_personnages = $pdo->prepare('SELECT * FROM Personnages WHERE pv>10');
$select_personnages->execute();
$personnages = $select_personnages->fetchAll(PDO::FETCH_OBJ);

## ETAPE 0

## CONNECTEZ VOUS A VOTRE BASE DE DONNEE

## ETAPE 1

## POUVOIR SELECTIONER UN PERSONNE DANS LE PREMIER SELECTEUR

## ETAPE 2

## POUVOIR SELECTIONER UN PERSONNE DANS LE DEUXIEME SELECTEUR

## ETAPE 3

## LORSQUE LON APPPUIE SUR LE BOUTON FIGHT, RETIRER LES PV DE CHAQUE PERSONNAGE PAR RAPPORT A LATK DU PERSONNAGE QUIL COMBAT

## ETAPE 4

## UNE FOIS LE COMBAT LANCER (QUAND ON APPPUIE SUR LE BTN FIGHT) AFFICHER en dessous du formulaire
# pour le premier perso PERSONNAGE X (name) A PERDU X PV (l'atk du personnage d'en face)
# pour le second persoPERSONNAGE X (name) A PERDU X PV (l'atk du personnage d'en face)

## ETAPE 5

## N'AFFICHER DANS LES SELECTEUR QUE LES PERSONNAGES QUI ONT PLUS DE 10 PV


?>


<!doctype html>
<html lang="en">
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
<h1>Combats</h1>
<div class="w-100 mt-5">

    <form method="POST">
        <div class="form-group">
            <select name="personnage1" id="personnage1">
            <?php foreach($personnages as $key =>$value): ?>
                    <option value="<?php echo $value->name?>"><?php echo $value->name?></option>
                <?php endforeach; ?>
            
            </select>
        </div>
        <div class="form-group">
            <select name="personnage2" id="personnage2">
            <?php foreach($personnages as $key =>$value): ?>
                    <option value="<?php echo $value->name?>"><?php echo $value->name?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn">Fight</button>
    </form>
    </div>

    <?php
    if(!empty($_POST["personnage1"])&&!empty($_POST["personnage2"])) {

    $personnage1=$_POST["personnage1"];
    $personnage2=$_POST["personnage2"];

    $select_stats1 = $pdo->prepare('SELECT * FROM Personnages WHERE name IN("'.$personnage1.'","'.$personnage2.'")');
    $select_stats1->execute();
    

    $stats1= $select_stats1->fetchAll(PDO::FETCH_OBJ);
   
     

    $atk_perso1=$stats1[0]->atk;
    $atk_perso2=$stats1[1]->atk;

    $pv_perso1=$stats1[0]->pv;
    $pv_perso2=$stats1[1]->pv;

    while($pv_perso1>0 && $pv_perso2>0 ) {
    $pv_perso1=$pv_perso1-$atk_perso2;
    echo "Le personnage " . $personnage1 . " a perdu " . $atk_perso2 . " PV" . "<br>";
    $pv_perso2= $pv_perso2-$atk_perso1;
    echo "Le personnage " . $personnage2 . " a perdu " . $atk_perso1 . " PV" . "<br>";

    } 
}
?>

</body>
</html>
