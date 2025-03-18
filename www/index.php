<?php
/**
 * Index du projet GSB
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
require_once 'includes/fct.inc.php';//integrer obligatoirement page des fonction sinn fatal erreur
require_once 'includes/class.pdogsb.inc.php';//integrer obligatoirement page des fonction liee a bdd 
session_start();//lancer la session  c'est une fct php qui va lancer la superglobal session (o la referme session destrot (qd on se deconnecte))
$pdo = PdoGsb::getPdoGsb();//on appelle une foispour toute la classs pdo la bdd on affecte a la variable pdo le resultat d une fontion de la class pdogsb

$estConnecte = estConnecteVisiteur()|| estConnecteComptable();
$estConnecteComptable = estConnecteComptable();
$estConnecteVisiteur = estConnecteVisiteur() ;
//var_dump($estConnecte, $estConnecteComptable);
//on affecte le resultat de la fonction a une variable
require 'vues/v_entete.php';//on fait appelle (pas include si ca marche pas c pas grave c'est que le design)
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_SPECIAL_CHARS);
//on filtre $uc
if (empty($uc) && !$estConnecte) {
    $uc = 'connexion';
} elseif (empty($uc)) {
    $uc = 'accueil';
}

switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';//include 
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include 'controleurs/c_validerFrais.php';
    break;
case 'suivrePaiment' : 
    include 'controleurs/c_suivrePaiment.php';
    break;
}
require 'vues/v_pied.php';//require on appelle sans rediriger
