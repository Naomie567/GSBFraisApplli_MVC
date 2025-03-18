
<html>
    <head>
        <title>Choix Visiteur</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
       
<h2>Valider la fiche de frais</h2>
<div class="row">
    <div class="col-md-4">
        <form action="index.php?uc=validerFrais&action=valider"
              method="post" role="form">
            <div class="form-group">
                <label for="lstMois" accesskey="n">Selectionner un Visiteur : </label>
                <select id="lstVisit" name="lstVisit" class="form-control">
                    <?php
                    foreach (  $listVisiteur as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id ?>">
                                <?php echo $nom . '  ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
    <div class="col-md-4>
            <div class="form-group">
                <label for="lstMois" accesskey="n">Selectionner un Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($listMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = $unMois['numAnnee'];
                        $numMois = $unMois['numMois'];
                        if ($mois == $moisASelectionner) {
                            ?>
                            <option selected value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>    

                </select>
            </div>
            <br>
            
         
             <input class="btn btn-lg btn-success btn-block"
                               type="submit" value="Valider">
        </form>
    </div>
    </div>
