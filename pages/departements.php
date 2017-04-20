<?php
if (!empty($_POST["valider-departements"])) {
    $explode = explode(".", $_POST["departement"]);
    $region = $explode[0];
    $departement = $explode[1];
    $xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/' . $region . '/' . $departement . '/' . $departement . '.xml');
    foreach ($xml2->Departement->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        echo $candidat->NomPsn . " a obtenu " . $candidat->NbVoix . " voix, bien joue !</br>";
    }
}

?>
<form method="post">
    <select name="departement">
        <?php
        foreach ($xml->Regions->Region as $regions) {
            foreach ($regions->Departements->Departement as $departement) {
                echo '<option value="' . $regions->CodReg3Car . '.' . $departement->CodDpt3Car . '">' . $departement->LibDpt . '</option>';
            }
        }
        ?>
    </select>
    <input type="submit" value="valider" name="valider-departements"/>
</form>
