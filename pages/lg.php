<form method="post" id="lg-search" style="display: none">
    <select name="collectifs"  >
        <option value="">-- Collectifs --</option>
        <?php
        foreach ($xml->Regions->Region as $regions) {
            echo '<option value="' . $regions->CodReg3Car . '">' . $regions->LibReg . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="valider" name="valider-lg" id="valider-lg"/>
</form>
<script>
    $('select[name=region]').select2();
</script>
<?php
if (!empty($_POST["valider-region"])) {
    $candidats = array();
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $_POST['region'] . '/' . $_POST["region"] . '.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        echo $candidat->NomPsn . " a obtenu " . $candidat->RapportExprime . " %</br>";
        $candidats[] = (array)$candidat;
    }
}
?>