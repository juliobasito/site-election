<?php
$fe = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/FE.xml');

$candidats = array();
foreach ($fe->Tours->Tour->Resultats->Candidats->Candidat as $candidat) {
    $candidats[] = (array)$candidat;
}

$price = array();
foreach ($candidats as $key => $row) {
    $price[$key] = $row['RapportExprime'];
}
array_multisort($price, SORT_DESC, $candidats);
?>


<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css"
          src="https://cdnjs.cloudflare.com/ajax/libs/jvectormap/2.0.4/jquery-jvectormap.css">
    <link rel="stylesheet" href="css/style.css">


    <script src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="jvectormap/jquery.jvectormap.min.js"></script>
    <script src="http://jvectormap.com/js/jquery-jvectormap-fr_regions-mill.js"></script>
    <script src="http://jvectormap.com/js/jquery-jvectormap-fr-mill.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="level0" href="../pages/">France</a></li>
                <li><a class="level0" href="pages/regions.php">Région</a></li>
                <li><a class="level1" href="pages/departements.php">Département</a></li>
                <li><a href="pages/communes.php">Communes</a></li>
            </ul>
        </div>
    </div>

</nav>
<div class="container">

<!--    <div class="container">-->
        <?php
        $xml = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');

        require 'pages/regions.php';
        require 'pages/departements.php';
//        require 'pages/communes.php';
        ?>
<!--    </div>-->
    <div class="container">

        <div id="map-container">
            <div id="map" style="width: 1000px; height: 1000px;"></div>
        </div>

        <div id="chart-container">
            <canvas id="myChart" style="width: 1000px; height: 1000px;"></canvas>

        </div>
    </div>
</div>


</body>
<script>
    ////////CHART////////
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                <?php
                foreach ($candidats as $candidat) {
                    echo '"' . $candidat['NomPsn'] . ' ' . $candidat['PrenomPsn'] . '",';
                }
                echo '""';
                ?>
            ],
            datasets: [{
                backgroundColor: [
                    '#E50077',
                    '#E10001',
                    '#DE7100',
                    '#D4DA00',
                    '#61D700',
                    '#00D30D',
                    '#00D078',
                    '#00B8CC',
                    '#004DC9',
                    '#1A00C5',
                    '#7E00C2',
                    '#BF009E',
                    'transparent'
                ],
                data: [
                    <?php
                    foreach ($candidats as $candidat) {
                        echo str_replace(',', '.', $candidat['RapportExprime']) . ',';
                    }
                    echo 50;
                    ?>
                ]

            }]
        }
    });
    ////////CHART////////


    ////////AJAX////////
    var host = 'http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/';


    function search() {

        $.ajax({
            type: 'GET',
            url: host + 'FE.xml',
            data: '',
            crossDomain: true,
            success: function (data, xhr) {
                console.log('revceived');
                console.log(data);
            },
            error: function (data, xhr) {
                console.log('error');
                console.log(data);
            }
        });

        $('#map-container').html(' <div id="map" style="width: 1000px; height: 1000px;"></div>');
        $('#map').vectorMap({
            map: 'fr_mill'
        });

    }

    $('#map').click(function () {
        search();
        console.log('yes');
    });


    $('.level0').click(function (e) {
        e.preventDefault();
        $('#map-container').html(' <div id="map" style="width: 1000px; height: 1000px;"></div>');

        $('#map').vectorMap({
            map: 'fr_regions_mill'
        });
    });
    $('.level1').click(function (e) {
        e.preventDefault();
        $('#map-container').html(' <div id="map" style="width: 1000px; height: 1000px;"></div>');

        $('#map').vectorMap({
            map: 'fr_mill'
        });
    });
    ////////CHART////////


    $(function () {
        $('#map').vectorMap({
            map: 'fr_regions_mill'
        });
    });
</script>
</html>