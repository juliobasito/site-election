	<?php
	include('header.php');
		$can = new DomDocument();
		$can->load('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');
		$listeCandidat = $can->getElementsByTagName('LibDpt');
		foreach($listeCandidat as $liste){
			 echo $liste->firstChild->nodeValue.'</br>';
		}
	?>
</body>
</html>