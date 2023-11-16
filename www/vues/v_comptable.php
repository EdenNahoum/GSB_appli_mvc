<?php
/**
 * Vue Comptable
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Eden Nahoum 
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>

 */
?>

<div id="accueil">
    <h2>
        Gestion des frais<small> - Comptable : 
            <?php
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']
            ?></small>
    </h2>
</div>
<div 
    class="row">
    <div class="col-md-12">
        <div style="border-color: orangered" class="panel panel-primary">
            <div style="background-color: orangered"
                 class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-bookmark"></span>
                    Navigation
                </h3>
            </div>
            <div class="panel-body"
                 >    
                <div class="row">
                    <div class="col-xs-12 col-md-12"
                         style="border-color: orangered">
                        <a href="index.php?uc=validerFrais&action=selectionnerVisiteur"
                           class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Valider la fiche de frais</a>
                        <a style="background-color: orangered;border-color: orangered"
                           href="index.php?uc=suivrePaiement&action=suivrePaiement"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Suivre le paiement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


