<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1>Regions</h1>
	<ul class="list-inline">
		<li><button type="button" class="btn btn-primary"><a href="../">France</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="communes.php">Communes</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="departements.php">Departement</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="#">Region</a></button></li>
	</ul>
	<?php
		if(!empty($_POST["valider"])){
			$xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/'.$_POST['region'].'/'.$_POST["region"].'.xml');
			foreach($xml2->Region->Tours->Tour->Resultats->Candidats->Candidat as $candidat){
				echo $candidat->NomPsn." a obtenu ".$candidat->NbVoix." voix, bien joue !</br>";
			}
		}
		$xml = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');

	?>
	<form method="post">
		<select name="region">
			<?php
				foreach($xml->Regions->Region as $regions){
					echo '<option value="'.$regions->CodReg3Car.'">'.$regions->LibReg.'</option>';
				}
			?>
		</select>
		<input type="submit" value="valider" name="valider"/>
	</form>
</body>
</html>