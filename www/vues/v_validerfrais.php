<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form method="post" 
      action="index.php?uc=validerFrais&action=corrigermajefraisforfait" 
      role="form">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
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
            <div class="form-group">
                <label for="lstMois" accesskey="n">Visiteur : </label>
                <select id="lstMois" name="lstv" class="form-control">
<?php
foreach ($listVisiteur as $unVisiteur) {
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
                            <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            }
                        }
                        ?>    
                </select>
            </div>
           
        </div>
    </div>
     
    <div class="row">    
        <h2>Valider ma fiche de frais 
        </h2>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4">

            <fieldset>       
<?php
foreach ($lesFraisForfait as $unFrais) {
    $idFrais = $unFrais['idfrais'];
    $libelle = htmlspecialchars($unFrais['libelle']);
    $quantite = $unFrais['quantite'];
    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <button class="btn btn-success" type="submit">Corriger </button>
                <button class="btn btn-danger" type="reset">Restaurer</button>
            </fieldset>

        </div>
    </div>
</form>
<hr>

 
     
    <div class="row">
    <div class="panel panel-info">
        <div style="background-color:  orange; color:white" class="panel-heading">Descriptif des éléments hors forfait</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="date">Date</th>
                    <th class="libelle">Libellé</th>  
                    <th class="montant">Montant</th>  
                    <th class="action">&nbsp;</th> 
                </tr>
            </thead>  
            <tbody>
                <?php
                foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                    $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                    $date = $unFraisHorsForfait['date'];
                    $montant = $unFraisHorsForfait['montant'];
                    $idFHF = $unFraisHorsForfait['id'];
                    ?>  
     <form method="post" 
      action="index.php?uc=validerFrais&action=fraishorsforfait" 
      role="form">     
    
                    <tr>
                        <td>
                            <input type="hidden" name="lstv" value="<?php echo $visiteurASelectionner ?>"/>
                            <input type="hidden" name="lstMois" value="<?php echo $moisASelectionner ?>"/>
                            <input type="hidden" id="idFHF" name="idFHF" accept="" size="10" maxlength="5" accesskey=""value="<?php echo $idFHF?>" class="form-control">
                            <input type="text" id="date" name="date" accept="" size="10" maxlength="5" accesskey="" value="<?php echo $date ?>" class="form-control">
                        </td>
                        <td> 
                            <input type="text" id="libelle" name="libelle"accept="" size="10" maxlength="5" accesskey=""value="<?php echo $libelle ?>" class="form-control">
                        </td>
                        <td>
                              <input type="text" id="montant" name="montant" accept="" size="10" maxlength="5" accesskey="" value="<?php echo $montant ?>" class="form-control">
                        </td>
                        <td><button id="corriger" name="corriger" class="btn btn-success" type="submit">Corriger</button>
                            <button id="reporter" name="reporter" class="btn btn-success" type="submit">Reporter</button>
                            <button id="supprimer" name="supprimer" class="btn btn-danger" type="submit">Supprimer</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>  
        </table>
    </div>
    <label for="justificatif" accesskey="n">Nombre de justificatifs: </label>
    <input type= "text" id="justificatif" name="justificatif" value="<?php echo $nbj ?>"  class="form-control">
    <br>
</div>
          
</form>

<form method="post" 
      action="index.php?uc=validerFrais&action=btnvalider" 
      role="form"> 
    <input type="hidden" name="lstv" value="<?php echo $visiteurASelectionner ?>"/>
   <input type="hidden" name="lstMois" value="<?php echo $moisASelectionner ?>"/>
     <input type="hidden" id="idFHF" name="idFHF" accept="" size="10" maxlength="5" accesskey=""value="<?php echo $idFHF?>" class="form-control">
    <button class="btn btn-success" type="submit">Valider</button>
</form>