<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
		<li><a href="../pages/">France</a></li>
		<li><a href="pages/communes.php">Communes</a></li>
		<li><a href="pages/departements.php">Departement</a></li>
		<li><a href="pages/regions.php">Region</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->

</nav>
	<?php
		$can = new DomDocument();
		$can->load('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/candidatureT1/CandidatureT1.xml');
		$listeCandidat = $can->getElementsByTagName('NomPsn');
		foreach($listeCandidat as $liste){
			 echo $liste->firstChild->nodeValue;
		}
	?>
</body>
</html>