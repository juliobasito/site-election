<form method="post" id="region-search" style="display: none">
    <select name="region"  >
        <option value="">-- Région --</option>
        <?php
        foreach ($xml->Regions->Region as $regions) {
            echo '<option value="' . $regions->CodReg3Car . '">' . $regions->LibReg . '</option>';
        }
        ?>
    </select>
 <input type="submit" value="valider" name="valider-region" id="valider-region"/>
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