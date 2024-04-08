<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$uc = 'selectionnerVisiteur';
$idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
$leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
$visiteur = $pdo->getNomVisiteur();
$visiteurASelectionner = $idVisiteur;
$mois = getMois(date('d/m/Y'));
$DerniersMois = douzeDerniersMois($mois);
$moisASelectionner = $leMois;
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
$lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
$libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
$montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);

switch ($action) {
    case 'selectionnerVisiteur':
        $lesCles = array_keys($visiteur);
        $visiteurASelectionner = $lesCles[0];
        $lesCles1 = array_keys($DerniersMois);
        $moisASelectionner = $lesCles1[0];
        include 'vues/v_listeVisiteurMois.php';
        break;
    case'validerChoix':
        if (empty($lesFraisForfait) && (empty($lesFraisHorsForfait))) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
            include 'vues/v_erreurs.php';
            header("Refresh: 2;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
        } else {
            $nbJustificatifs=$pdo->getNbjustificatifs($idVisiteur, $leMois);
            include 'vues/v_validerFrais.php';
        }
        break;
    case 'corrigerFrais':
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFrais);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            ajouterErreur('Votre modification a bien été prise en compte!');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFrais.php';
        } else {
            ajouterErreur('Les valeurs des frais doivent être numériques');
            include 'vues/v_erreurs.php';
        }
        break;
    case 'supprimerFrais':
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        //$pdo->supprimerFraisHorsForfait($idFrais);
        break;
    case 'Fraishorsforfait':
        if (isset($_POST['corrigerFHF'])) {
            $pdo->majFraisHorsForfait($id, $idVisiteur, $leMois, $date, $libelle, $montant);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            ajouterErreur('Votre modification a bien été prise en compte!');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFrais.php';
            
        } elseif (isset($_POST['supprimerFHF'])) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
            $pdo->supprimerFraisHorsForfait($id);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            ajouterErreur('Votre suppression a bien été prise en compte');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFrais.php';
        } elseif (isset($_POST['reporterFHF'])) {
            if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
                $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
            }
            $libelle2 = "reporter" . $libelle;
            $pdo->majFraisHorsForfait($id, $idVisiteur, $leMois, $date, $libelle2, $montant);
            $moisSuivant = getMoisSuivant($leMois);
            $pdo->creeNouveauFraisHorsForfait(
                    $idVisiteur,
                    $moisSuivant,
                    $libelle,
                    $date,
                    $montant
            );
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            ajouterErreur('Votre frais a bien été reporté!');
            include 'vues/v_erreurs.php';
            include 'vues/v_validerFrais.php';
        }
        break;
    case 'ValiderFiche':
        echo 'hello';
        $calculFF=$pdo->getCaculFraisForfait($idVisiteur, $leMois);
        $somme1=$calculFF[0][0];
        var_dump($calculFF);
        $calculFHF=$pdo->getCaculFHF($idVisiteur, $leMois);
        $somme2=$calculFHF[0][0];
        var_dump($somme2, $somme1);
        var_dump($calculFHF);
        $calculTotal=$somme1+$somme2;
        var_dump($calculTotal);
        $pdo->totalValide($idVisiteur, $leMois, $calculTotal);
        $etat='VA';
        $pdo->majEtatFicheFrais($idVisiteur, $leMois, $etat);
         var_dump($etat);
        break;
}



