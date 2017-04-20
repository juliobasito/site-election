<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>Departement</h1>
<ul class="list-inline">
	<li><button type="button" class="btn btn-primary"><a href="../">France</a></button></li>
	<li><button type="button" class="btn btn-primary"><a href="communes.php">Communes</a></button></li>
	<li><button type="button" class="btn btn-primary"><a href="#">Departement</a></button></li>
	<li><button type="button" class="btn btn-primary"><a href="regions.php">Region</a></button></li>
</ul>

<?php
if(!empty($_POST["valider"])){
	$explode = explode(".", $_POST["departement"]);
	$region = $explode[0];
	$departement = $explode[1];
	$xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/'.$region.'/'.$departement.'/'.$departement.'.xml');
	foreach($xml2->Departement->Tours->Tour->Resultats->Candidats->Candidat as $candidat){
		echo $candidat->NomPsn." a obtenu ".$candidat->NbVoix." voix, bien joue !</br>";
	}
}
$xml = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');

?>
<form method="post">
	<select name="departement">
		<?php
		foreach($xml->Regions->Region as $regions){
			foreach($regions->Departements->Departement as $departement){
				echo '<option value="'.$regions->CodReg3Car.'.'.$departement->CodDpt3Car.'">'.$departement->LibDpt.'</option>';
			}
		}
		?>
	</select>
	<input type="submit" value="valider" name="valider"/>
</form>
</body>		  </body>
</html>