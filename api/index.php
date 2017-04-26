
<?php

//echo json_encode(array_keys($_POST)); die;


if (!empty($_POST["commune"])) {
    $explode = explode(".", $_POST["commune"]);
    $region = $explode[0];
    $departement = $explode[1];
    $commune = $explode[2];
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $region . '/' . $departement . '/' . $departement . '' . $commune . '.xml');
    foreach ($xml2->Departement->Commune->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
//        echo $candidat->NomPsn . " a obtenu " . $candidat->NbVoix . " voix, bien joue !</br>";
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
        'votant' => array(
            'number' => $fe->Tours->Tour->Mentions->Votants->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Votants->RapportInscrit,
        ),
        'abstention' => array(
            'number' => $fe->Tours->Tour->Mentions->Abstentions->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Abstentions->RapportInscrit,
        ),
        'blanc' => array(
            'number' => $fe->Tours->Tour->Mentions->Blancs->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Blancs->RapportInscrit,
        )
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
//        echo $candidat->NomPsn . " a obtenu " . $candidat->RapportExprime . " %</br>";
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
        'votant' => array(
            'number' => $fe->Tours->Tour->Mentions->Votants->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Votants->RapportInscrit,
        ),
        'abstention' => array(
            'number' => $fe->Tours->Tour->Mentions->Abstentions->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Abstentions->RapportInscrit,
        ),
        'blanc' => array(
            'number' => $fe->Tours->Tour->Mentions->Blancs->Nombre,
            'percent' => $fe->Tours->Tour->Mentions->Blancs->RapportInscrit,
        )
    ));
    die;
}


if (!empty($_POST["region"])) {
    $candidats = array();
    $xml2 = simplexml_load_file('http://elections.interieur.gouv.fr/telechargements/PR2017/resultatsT1/' . $_POST['region'] . '/' . $_POST["region"] . '.xml');
    foreach ($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
//        echo $candidat->NomPsn . " a obtenu " . $candidat->RapportExprime . " %</br>";
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
        'votant' => array(
            'number' => $xml2->Tours->Tour->Mentions->Votants->Nombre,
            'percent' => $xml2->Tours->Tour->Mentions->Votants->RapportInscrit,
        ),
        'abstention' => array(
            'number' => $xml2->Tours->Tour->Mentions->Abstentions->Nombre,
            'percent' => $xml2->Tours->Tour->Mentions->Abstentions->RapportInscrit,
        ),
        'blanc' => array(
            'number' => $xml2->Tours->Tour->Mentions->Blancs->Nombre,
            'percent' => $xml2->Tours->Tour->Mentions->Blancs->RapportInscrit,
        )
    ));
    die;
}




echo json_encode(array(
    'success' => false,
    'candidats' => false
));
die;