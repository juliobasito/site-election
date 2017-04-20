<?php
if (!empty($_POST["valider-region"])) {
    $xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/' . $_POST['region'] . '/' . $_POST["region"] . '.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        echo $candidat->NomPsn . " a obtenu " . $candidat->NbVoix . " voix, bien joue !</br>";
    }
}
?>
<form method="post">
    <select name="region">
        <?php
        foreach ($xml->Regions->Region as $regions) {
            echo '<option value="' . $regions->CodReg3Car . '">' . $regions->LibReg . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="valider" name="valider-region"/>
</form>
