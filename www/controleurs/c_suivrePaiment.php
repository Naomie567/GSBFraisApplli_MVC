<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//ceux controleur presebte une liste droulante qui presente tout les visiteur pour les mois valide
//deux colone visiteur mois
//dont etats deja Va
//ensuite bouton valider
//et apres recapitulatif de l'etats des frais apres valide'
//mettre un remboursement c'ewt quoi passer de etas a etat'

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_SPECIAL_CHARS);
switch ($action) {
    case 'suivre':
        $lstVisit=$pdo->getlesvisiteuretmois();
        $lesVisite=array();
        $lesMois=array();
        foreach ($lstVisit as $unVst) {
            array_push($lesVisite, array($unVst['idvisiteur'],$unVst['nom'],$unVst['prenom']));
            $numAnnee = substr($unVst['mois'], 0, 4);
            $numMois = substr($unVst['mois'], 4, 2);
            array_push($lesMois,$numMois.'/'.$numAnnee );
        }
        
        include 'vues/v_suivrePaiment.php';
        break;
  case'valider':
    echo'recapitulatif de l etats des frais';
      $vst = filter_input(INPUT_POST, 'lstV', FILTER_SANITIZE_SPECIAL_CHARS);
      $mois = filter_input(INPUT_POST, 'lstM', FILTER_SANITIZE_SPECIAL_CHARS);
      var_dump($vst);
      var_dump($mois);
      //include 'une vue a creer laquelle jsp';
        //et apres recapitulatif de l'etats des frais apres valide'
        //mettre un remboursement c'ewt quoi passer de etas a etat'
    break;
}