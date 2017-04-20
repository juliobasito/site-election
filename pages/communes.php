
<?php
	include('header.php');
	$can = new DomDocument();
	$can->load('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');
	$listeCandidat = $can->getElementsByTagName('LibSubCom');
	foreach($listeCandidat as $liste)
	{
		 echo $liste->firstChild->nodeValue.'</br>';
		if(!empty($_POST["valider"]))
		{
			$explode = explode(".", $_POST["departement"]);
			$region = $explode[0];
			$departement = $explode[1];
			$commune = $explode[2];
			$xml2 = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/resultatsT1/'.$region.'/'.$departement.'/'.$departement.''.$commune.'.xml');
			foreach($xml2->Departement->Commune->Tours->Tour->Resultats->Candidats->Candidat as $candidat)
			{
				echo $candidat->NomPsn." a obtenu ".$candidat->NbVoix." voix, bien joue !</br>";
			}
		}
	}
	$xml = simplexml_load_file('http://www.interieur.gouv.fr/avotreservice/elections/telechargements/EssaiPR2017/referencePR/listeregdptcom.xml');
?>
	<form method="post">
		<select name="departement">
			<?php
				foreach($xml->Regions->Region as $regions){
					foreach($regions->Departements->Departement as $departement){
						foreach($departement->Communes->Commune as $commune){
							echo '<option value="'.$regions->CodReg3Car.'.'.$departement->CodDpt3Car.'.'.$commune->CodSubCom.'">'.$commune->LibSubCom.'</option>';
						}
					}
				}
			?>
		</select>
		<input type="submit" value="valider" name="valider"/>
	</form>
</body>
</html>