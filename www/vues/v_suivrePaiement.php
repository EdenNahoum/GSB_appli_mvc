<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
?>
<form action="index.php?uc=suivrePaiement&action=validerSuiviPaiement" 
      method="post" role="form">
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un visiteur : </h3>
        </div>
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
    </div>
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un mois : </h3>
        </div>
        <div class="col-md-4">

            <div class="form-group">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
                    <?php
                    foreach ($DerniersMois as $unMois) {
                        $mois = $unMois['mois'];
                        $numAnnee = substr($mois, 0, 4);
                        $numMois = substr($mois, 4, 2);
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
                <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                   role="button">
                </form>           