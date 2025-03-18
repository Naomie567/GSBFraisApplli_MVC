<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = 'demandeConnexion';
}
switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $visiteur = $pdo->getInfosVisiteur($login, $mdp);
    $comptable= $pdo->getInfosComptable($login, $mdp);
    var_dump($comptable, $visiteur);
    if($visiteur){
        $id = $visiteur['idV'];
        $nom = $visiteur['nomV'];
        $prenom = $visiteur['prenomV'];
        connecterVisiteur($id, $nom, $prenom);
        header('Location: index.php');
    } 
    elseif($comptable){
        var_dump($comptable);
        $idC = $comptable['idC'];
        $nom = $comptable['nomC'];
        $prenom = $comptable['prenomC'];
        connecterComptable($idC, $nom, $prenom);
        header('Location: index.php');
    }
    else{
        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
    } 
   
   
    
    break;
  default:   
include 'vues/v_connexion.php';
 break;
}
