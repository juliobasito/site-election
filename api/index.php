
<?php


if (empty($_POST)) {
    $fe = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/FE.xml');

    $candidats = array();
    foreach ($fe->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
        $candidats[] = (array)$candidat;
    }

    $price = array();
    foreach ($candidats as $key => $row) {
        $price[$key] = $row['RapportExprime'];
    }
    array_multisort($price, SORT_DESC, $candidats);

    //collectifs
    $felg = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiLG2017/resultatsT1/FE.xml');
    foreach ($felg->Tours->Tour->Resultats->Nuances->Nuance as $nuance) {
        $nuances[] = (array)$nuance;
    }

    $nuances_ = array();
    foreach ($nuances as $key => $row) {
        $nuances_[$key] = $row['RapportExprime'];
    }
    array_multisort($nuances_, SORT_DESC, $nuances);



    echo json_encode(array(
        'success' => false,
        'candidats' => $candidats,
        'nuances' => $nuances
    ));
    die;

}
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