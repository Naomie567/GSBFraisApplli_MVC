<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form method="post" 
      action="index.php?uc=suivrePaiment&action=valider" 
      role="form">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="lstV" accesskey="n">Visiteur </label>
                <select id="lstV" name="lstV" class="form-control">
                    <?php
                        foreach ($lesVisite as $unVisiteur) {
                            $idV=$unVisiteur[0];
                            $nom=$unVisiteur[1];
                            $prenom=$unVisiteur[2];
                            if ($unVisiteur == $visiteurASelectionner) {
                       ?>
                            <option selected value="<?php echo $idV ?>">
                        <?php echo $nom.' '.$prenom ?> </option>
                                <?php
                            } else {
                                ?>
                            <option value="<?php echo $nom.' '.$prenom ?>">
                                <?php echo $nom.' '.$prenom ?>
                             </option>
                                <?php
                            }
                        }
                        ?>  

                </select>
            </div>
            <div class="form-group">
                <label for="lstM" accesskey="">Mois </label>
                <select id="lstM" name="lstM" class="form-control">
                    <?php
                        foreach ($lesMois as $unMois) {
                        $mois = $unMois[0];
                        if ($unMois == $moisASelectionner) {
                    ?>
                    <option selected value="<?php echo $unMois ?>">
                        <?php echo $unMois ?>
                    </option>
                        <?php
                            } else {
                        ?>
                    <option value="<?php echo $unMois ?>">
                            <?php echo $unMois ?> 
                    </option>
                        <?php
                            }
                        }
                        ?>    
                </select>
            </div>
           
        </div>
    </div>
    
<button class="btn btn-success" type="submit">Valider</button>
</form>