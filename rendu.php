<?php
require __DIR__ . "/vendor/autoload.php";

try{
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=Jeu', "root", "");
} catch (Exception $e){
    echo "erreur de connection à la base de donnée";
}
## ETAPE 0

## CONNECTEZ VOUS A VOTRE BASE DE DONNEE

### ETAPE 1

####CREE UNE BASE DE DONNEE AVEC UNE TABLE PERSONNAGE, UNE TABLE TYPE
/*
 * personnages
 * id : primary_key int (11)
 * name : varchar (255)
 * atk : int (11)s
 * pv: int (11)
 * type_id : int (11)
 * stars : int (11)
 */

/*
 * types
 * id : primary_key int (11)
 * name : varchar (255)
 */


#######################
## ETAPE 2

#### CREE DEUX LIGNE DANS LA TALE types
# une ligne avec comme name = feu
# une ligne avec comme name = eau


#######################
## ETAPE 3

# AFFICHER DANS LE SELECTEUR (<select name="" id="">) tout les types qui sont disponible (cad tout les type contenu dans la table types)

$select_types=$pdo->prepare('SELECT*FROM Types');
$select_types->execute();

$types=$select_types->fetchAll(PDO::FETCH_OBJ);


#######################
## ETAPE 4

# ENREGISTRER EN BASE DE DONNEE LE PERSONNAGE, AVEC LE BON TYPE ASSOCIER

#######################
## ETAPE 5
# AFFICHER LE MSG "PERSONNAGE ($name) CREER"

#######################
## ETAPE 6

# ENREGISTRER 5 / 6 PERSONNAGE DIFFERENT




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
<h1>Acceuil</h1>
<div class="w-100 mt-5">
    <form action="" method="POST" class="form-group">
        <div class="form-group col-md-4">
            <label for="">Nom du personnage</label>
            <input type="text" class="form-control" placeholder="Nom" name="nom_perso">
        </div>

        <div class="form-group col-md-4">
            <label for="">Attaque du personnage</label>
            <input type="text" class="form-control" placeholder="Atk" name="nom_atk">
        </div>
        <div class="form-group col-md-4">
            <label for="">Pv du personnage</label>
            <input type="text" class="form-control" placeholder="Pv" name="nom_pv">
        </div>
        <div class="form-group col-md-4">
            <label for="">Type</label>
            <select name="nom_types" id="">
                <option value="" selected disabled >Choissisez un type</option>

                <?php foreach($types as $key =>$value): ?>
                    <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                <?php endforeach; ?>
            </select>
                
            
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
    <?php 
    if(!empty($_POST)){

        $nom=$_POST["nom_perso"];
        $atk=$_POST["nom_atk"];
        $pv=$_POST["nom_pv"];
        $types=$_POST["nom_types"];
        

        $ajout_form = $pdo->prepare('INSERT INTO Personnages (name,atk,pv,type_id) VALUES ("'.$nom.'",'.$atk.','.$pv.','.$types.')');
        
       

        if($ajout_form->execute()){
            echo "Personnage ".$nom. " créer ";
        }

        
    }
    ?>
</div>

</body>
</html>
