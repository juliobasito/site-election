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
		<li><button type="button" class="btn btn-primary">France</button></li>
		<li><button type="button" class="btn btn-primary">Communes</button></li>
		<li><button type="button" class="btn btn-primary">Departement</button></li>
		<li><button type="button" class="btn btn-primary" href="pages/regions.php">Region</button></li>
	</ul>
	<?php
		$can = new DomDocument();
		$can->load('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/candidatureT1/CandidatureT1.xml');
		$listeCandidat = $can->getElementsByTagName('NomPsn');
		foreach($listeCandidat as $liste){
			 echo $liste->firstChild->nodeValue.'</br>';
		}
	?>
</body>
</html>