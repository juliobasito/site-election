
<?php


if (!empty($_POST["commune"])) {
    $explode = explode(".", $_POST["commune"]);
    $region = $explode[0];
    $departement = $explode[1];
    $commune = $explode[2];
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $region . '/' . $departement . '/' . $departement . '' . $commune . '.xml');
    foreach ($xml2->Departement->Commune->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        $candidats[] = (array)$candidat;

    }
    $price = array();
    foreach ($candidats as $key => $row) {
        $price[$key] = $row['RapportExprime'];
    }
    array_multisort($price, SORT_DESC, $candidats);
    echo json_encode(array(
        'success' => false,
        'candidats' => $candidats,
    ));
    die;

}
if (!empty($_POST["departement"])) {
    $candidats = array();
    $explode = explode(".", $_POST["departement"]);
    $region = $explode[0];
    $departement = $explode[1];
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $region . '/' . $departement . '/' . $departement . '.xml');
    foreach ($xml2->Departement->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        $candidats[] = (array)$candidat;

    }
    $price = array();
    foreach ($candidats as $key => $row) {
        $price[$key] = $row['RapportExprime'];
    }
    array_multisort($price, SORT_DESC, $candidats);

    echo json_encode(array(

        'success' => false,
        'candidats' => $candidats,
    ));
    die;
}


if (!empty($_POST["region"])) {
    $candidats = array();
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $_POST['region'] . '/' . $_POST["region"] . '.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        $candidats[] = (array)$candidat;
    }
    $price = array();
    foreach ($candidats as $key => $row) {
        $price[$key] = $row['RapportExprime'];
    }
    array_multisort($price, SORT_DESC, $candidats);
    echo json_encode(array(
        'success' => false,
        'candidats' => $candidats,
    ));
    die;
}




echo json_encode(array(
    'success' => false,
    'candidats' => false
));
die;