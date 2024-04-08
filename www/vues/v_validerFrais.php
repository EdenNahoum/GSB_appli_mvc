<?php
/**
 * Vue Valider les Frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    Eden Nahoum <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<form method="post" 
      action="index.php?uc=validerFrais&action=corrigerFrais" 
      role="form">
    <div class="row"> 
        <div class="col-md-4">

            <div class="form-group">
                <label for="lstVisiteur" accesskey="n">Choisir le visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($visiteur as $unVisiteur) {
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
        <div class="col-md-4">
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($DerniersMois as $unMois) {
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
        </div>
    </div>
    </br></br></br>
    <div class="row">
        <h2>Valider la fiche de frais 
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
                <button class="btn btn-success CV" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>
            </fieldset>

        </div>

    </div>
</form>
</br></br></br>  



<div class="panel panel-info ">
    <div class="panel-heading CFHF">Descriptif des éléments hors forfait  </div> 

    <table class="table table-bordered table-responsive">
        <tr>
            <th class="date">Date</th>
            <th class="libelle">Libellé</th>
            <th class='montant'>Montant</th>                
        </tr>
        <?php
        foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
            $id = $unFraisHorsForfait['id'];
            $date = $unFraisHorsForfait['date'];
            $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
            $montant = $unFraisHorsForfait['montant'];
            ?>



            <tr>
            <form method="post" 
                  action="index.php?uc=validerFrais&action=Fraishorsforfait"
                  role="form">
                <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
                <input name="lstVisiteur" type="hidden" id="lstVisiteurs" class="form-control" value="<?php echo $visiteurASelectionner ?>">
                <td><input type="hidden" id="idFrais" 
                           name="id"
                           size="10" maxlength="5" 
                           value="<?php echo $id ?>" 
                           class="form-control">
                    <input type="text" id="idFrais" 
                           name="date"
                           size="10" maxlength="5" 
                           value="<?php echo $date ?>" 
                           class="form-control"></td>
                <td><input type="text" id="idFrais" 
                           name="libelle"
                           size="10" maxlength="30" 
                           value="<?php echo $libelle ?>" 
                           class="form-control"></td>
                <td><input type="text" id="idFrais" 
                           name="montant"
                           size="10" maxlength="5" 
                           value="<?php echo $montant ?>" 
                           class="form-control"></td>
                <td><input id="corrigerFHF" name="corrigerFHF" type="submit" value="Corriger" class="btn btn-success"/>
                    <input id="supprimerFHF" name="supprimerFHF" type="submit" value="Supprimer" class="btn btn-danger"/>
                    <input id="reporterFHF" name="reporterFHF" type="submit" value="Reporter" class="btn btn-danger" style="background-color: orangered"/></td>
                    <?php
                }
                ?>
        </form>       
        </tr>
    </table>



</div>
<label for="lstMois" accesskey="n">Nombre de justificatifs: </label>
<input type="" id="idFrais" 
       name="libelle"
       size="10" maxlength="30" 
       value="<?php echo $nbJustificatifs ?>" 
       class="form-control">
</br></br>
<form method="post" 
      action="index.php?uc=validerFrais&action=ValiderFiche" 
      role="form">
    <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
    <input name="lstVisiteur" type="hidden" id="lstVisiteurs" class="form-control" value="<?php echo $visiteurASelectionner ?>">
    <button class="btn btn-success CV" type="submit">Valider</button>

</form> 




