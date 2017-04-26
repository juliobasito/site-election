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
    $xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiLG2017/resultatsT1/FE.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Nuances->Nuance as $nuance) {
        echo $nuance->LibNua . " a obtenu " . $nuance->RapportExprime . " %</br>";
        $nuance[] = (array)$nuance;
    }
}
?>