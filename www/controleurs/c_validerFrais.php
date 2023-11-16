<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$uc = 'selectionnerVisiteur';

switch ($action) {
    case 'selectionnerVisiteur':
        $visiteur = $pdo->getNomVisiteur();
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($visiteur);
        $visteurASelectionner = $lesCles[0];
        $mois = getMois(date('d/m/Y'));
        $DerniersMois = douzeDerniersMois($mois);
        include 'vues/v_listeVisiteurMois.php';
        break;
    case'validerChoix':
        $visiteur = $pdo->getNomVisiteur();
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys($visiteur);
        $visteurASelectionner = $lesCles[0];
        $mois = getMois(date('d/m/Y'));
        $DerniersMois = douzeDerniersMois($mois);
        $idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'mois', FILTER_SANITIZE_STRING);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
           $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
           var_dump($lesFraisForfait, $lesFraisHorsForfait);
        if (empty($lesFraisForfait) && (empty($lesFraisHorsForfait)) ){
            ajouterErreur('Pas de fiche de frais pour ce visiteur ce mois');
             include 'vues/v_erreurs.php';
             header("Refresh: 2;URL=index.php?uc=validerFrais&action=selectionnerVisiteur");
    } else {
        include 'vues/v_validerFicheFrais.php';
    }
              

        break;
    case 'validerCreationFrais':
        $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        var_dump($montant);
        valideInfosFrais($dateFrais, $libelle, $montant);
        if (nbErreurs() != 0) {
            include 'vues/v_erreurs.php';
        } else {
            $pdo->creeNouveauFraisHorsForfait(
                    $idVisiteur,
                    $mois,
                    $libelle,
                    $dateFrais,
                    $montant
            );
        }
        break;
    case 'supprimerFrais':
        $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
        $pdo->supprimerFraisHorsForfait($idFrais);
        break;
} 
    
    
    



   