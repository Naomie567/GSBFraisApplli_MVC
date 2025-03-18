<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */



$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
if (!$action) {
    $action = 'comptablevaliderFrais';
}

switch ($action) {
    case 'comptablevaliderFrais':
        $mois=getMois(date('d/m/Y'));
        $listMois=getLesDouzeDerniersMois($mois);
        $lesClesM = array_keys($listMois);
        $moisASelectionner = $lesClesM[0];
        $listVisiteur=$pdo->getLesVisiteur();
        $lesClesV = array_keys($listVisiteur);
        $visiteurASelectionner = $lesClesV[0];
        include 'vues/v_choix.php'; 
        break;
    case 'valider' :
        $idVisiteur = filter_input(INPUT_POST, 'lstVisit', FILTER_SANITIZE_SPECIAL_CHARS);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois=getMois(date('d/m/Y'));
        $listMois=getLesDouzeDerniersMois($mois);
        $lesClesM = array_keys($listMois);
        $moisASelectionner = $leMois;
        $listVisiteur=$pdo->getLesVisiteur();
        $lesClesV = array_keys($listVisiteur);
        $visiteurASelectionner = $idVisiteur;
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $numAnnee = substr($leMois, 0, 4);
        $numMois = substr($leMois, 4, 2);
        $nbJustificatifs = $pdo->getnbjustificatif($idVisiteur,$leMois);
        $nbj = $nbJustificatifs['nbjustificatifs'];
       // var_dump($nbJustificatifs);
        if (empty($lesFraisForfait)&& empty($lesFraisHorsForfait)){
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            include 'vues/v_choix.php';
            } else {
            include 'vues/v_validerfrais.php';
        }
        
        break;
        
    case'corrigermajefraisforfait':
        $mois=getMois(date('d/m/Y'));
        $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
        $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $pdo-> majFraisForfait($idVisiteur, $mois2, $lesFrais);
        $listMois=getLesDouzeDerniersMois($mois);
        $lesClesM = array_keys($listMois);
        $moisASelectionner = $mois2;
        $listVisiteur=$pdo->getLesVisiteur();
//       $lesClesV = array_keys($listVisiteur);
        $visiteurASelectionner = $idVisiteur;
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois2);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois2);
        $nbJustificatifs = $pdo->getnbjustificatif($idVisiteur,$leMois);
        $nbj= $nbJustificatifs['nbjustificatifs'];
        include 'vues/v_validerfrais.php';
        break;
    case 'fraishorsforfait':
        $nbJustificatifs = $pdo->getnbjustificatif($idVisiteur,$leMois);
        $idF = filter_input(INPUT_POST, 'idFHF', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois=getMois(date('d/m/Y'));
        $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois2);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois2);
        var_dump($idF);
        var_dump($mois,$mois2,$idVisiteur,$date,$libelle,$montant);
        if(isset($_POST["corriger"])){
//          $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
//          $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
//          $ab=$pdo->getvisiteuretmois($idF);
//          var_dump($ab);
            $pdo-> majFraisHorsForfait($idF,$libelle,$date,$montant);
            $listMois=getLesDouzeDerniersMois($mois);
            $lesClesM = array_keys($listMois);
            $moisASelectionner = $mois2;
            $listVisiteur=$pdo->getLesVisiteur();
            $lesClesV[] = array_keys($listVisiteur);
            $visiteurASelectionner = $idVisiteur;
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois2);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois2);
            echo'corriger';
        }
        elseif (isset($_POST["reporter"])) {
            echo'reporter';
            $idF = filter_input(INPUT_POST, 'idFHF', FILTER_SANITIZE_SPECIAL_CHARS);
            $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS);
            $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
            $moisS= moisSuivant($mois2);
            $libellle="reporter".$libelle;
            $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            $mois=getMois(date('d/m/Y'));
            $listMois=getLesDouzeDerniersMois($mois);
            $lesClesM = array_keys($listMois);
            $moisASelectionner = $leMois;
            $listVisiteur=$pdo->getLesVisiteur();
            $lesClesV = array_keys($listVisiteur);
            $visiteurASelectionner = $idVisiteur;
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            $nbJustificatifs = $pdo->getnbjustificatif($idVisiteur,$leMois);
            $nbj= $nbJustificatifs['nbjustificatifs'];
            $pdo->majFraisHorsForfait($idF,$libellle,$date,$montant);
            if ($pdo->estPremierFraisMois($idVisiteur, $moisS)) {
            $pdo->creeNouvellesLignesFrais($idVisiteur, $moisS);
                 }
            //$pdo-> creeNouveauFraisHorsForfait( $idVisiteur,$moisS ,$libellle,$date,$montant);
            }
        elseif (isset($_POST["supprimer"])){
            $idF = filter_input(INPUT_POST, 'idFHF', FILTER_SANITIZE_SPECIAL_CHARS);
            $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
            $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_SPECIAL_CHARS);
            $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
            $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
            $mois=getMois(date('d/m/Y'));
            $listMois=getLesDouzeDerniersMois($mois);
            $lesClesM = array_keys($listMois);
            $moisASelectionner = $leMois;
            $listVisiteur=$pdo->getLesVisiteur();
            $lesClesV = array_keys($listVisiteur);
            $visiteurASelectionner = $idVisiteur;
//          $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
//          $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $numAnnee = substr($leMois, 0, 4);
            $numMois = substr($leMois, 4, 2);
            
            $pdo-> supprimerFraisHorsForfait($idF);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            echo'supprimer';
        }
        
        include 'vues/v_validerfrais.php';
        break;
        //fonction getnbjustificatif dans pdo qu on lapeel et affiche dans la vue dans case valider et tt les autre
    case'btnvalider':
        $idF = filter_input(INPUT_POST, 'idFHF', FILTER_SANITIZE_SPECIAL_CHARS);
        $mois2 = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        $idVisiteur = filter_input(INPUT_POST, 'lstv', FILTER_SANITIZE_SPECIAL_CHARS);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_SPECIAL_CHARS);
        //$montantfraisforfait=$pdo->montantfraisforfait($idVisiteur ,$mois2);
        //$montanthorsforfait=$pdo->montanthorsforfait($idVisiteur ,$mois2);
        $montantfraisforfait=$pdo->montantfraisforfait($idVisiteur ,$mois2);
        $montantfraishorsforfait=$pdo->montanthorsforfait($idVisiteur,$mois2);
        
        $mff=$montantfraisforfait[0];
        $mfhf=$montantfraishorsforfait[0][0];
        $montantotal=$mff+$mfhf;
        $visiteur=$pdo->getVisiteur($idVisiteur);
        $vstNom=$visiteur[0]['nom'];
        $vstPrenom=$visiteur[0]['prenom'];
        $pdo->majFicheFrais($idVisiteur,$mois2,$montantotal);
        $pdo->majEtatFicheFrais($idVisiteur, $mois2, "VA"); //passe l etats de cl a va
        include 'vues/v_valideravecsucces.php';
        break;
}
