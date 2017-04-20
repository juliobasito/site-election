<form method="post">
    <select name="departement">
<?php
foreach ($xml->Regions->Region as $regions) {
    foreach ($regions->Departements as $departement) {
        if (count($departement->Departement)>1)
            foreach ($departement->Departement as $subDepartement)
                echo '<option value="' . $subDepartement->CodDpt3Car . '">' . $subDepartement->LibDpt . '</option>';
    }
}
?>
    </select>
    <input type="submit" value="valider" name="valider"/>
</form>
