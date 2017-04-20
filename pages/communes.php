<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<h1>Communes</h1>
	<ul class="list-inline">
		<li><button type="button" class="btn btn-primary"><a href="../">France</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="#">Communes</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="departements.php">Departement</a></button></li>
		<li><button type="button" class="btn btn-primary"><a href="regions.php">Region</a></button></li>
	</ul>
	<?php
		$can = new DomDocument();
		$can->load('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');
		$listeCandidat = $can->getElementsByTagName('LibSubCom');
		foreach($listeCandidat as $liste){
			 echo $liste->firstChild->nodeValue.'</br>';
		}
	?>
</body>
</html>