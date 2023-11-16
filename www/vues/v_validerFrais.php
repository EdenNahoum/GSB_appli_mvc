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
                    if ($visiteur == $visiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo id ?>">
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
<h2>Valider la fiche de frais 
</h2>
<h3>Eléments forfaitisés</h3>
<div class="col-md-4">
    <form method="post" 
          action="index.php?uc=validerFrais&action=validerChoix" 
          role="form">
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
            <button class="btn btn-success" type="submit">Corriger</button>
            <button class="btn btn-danger" type="reset">Réinitialiser</button>
        </fieldset>
    </form>
</div>
</div>

