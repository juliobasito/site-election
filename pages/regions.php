
<html>
<head>
    <title>jVectorMap demo</title>
    <link rel="stylesheet" href="../jvectormap/jquery-jvectormap-2.0.3.css" type="text/css" media="screen"/>
    <script src="../jvectormap/jquery.js"></script>
    <script src="../jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../jvectormap/jquery-jvectormap-world-mill.js"></script>
</head>
<body>
<?php
if (!empty($_POST["valider-region"])) {
    $candidats = array();
    $xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/' . $_POST['region'] . '/' . $_POST["region"] . '.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        echo $candidat->NomPsn . " a obtenu " . $candidat->RapportExprime . " %</br>";
        $candidats[] = (array)$candidat;
    }
    $price = array();
    foreach ($candidats as $key => $row) {
        $price[$key] = $row['RapportExprime'];
    }
    array_multisort($price, SORT_DESC, $candidats);
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
<script>
    $('select[name=region]').select2();
</script>

<div id="world-map" style="width: 600px; height: 400px"></div>
<script>
    $(function(){
        $('#world-map').vectorMap({map: 'world_mill'});
    });
</script>
</body>
</html>
