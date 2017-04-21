<form method="post" id="departement-search" style="display: none">
    <select name="departement" >
        <option value="">-- Département --</option>
        <?php
        foreach ($xml->Regions->Region as $regions) {
            foreach ($regions->Departements->Departement as $departement) {
                echo '<option value="' . $regions->CodReg3Car . '.' . $departement->CodDpt3Car . '">' . $departement->LibDpt . '</option>';
            }
        }
        ?>
    </select>
<!--    <input type="submit" value="valider" name="valider-departements" id="valider-departements"/>-->
</form>
<script>
    $('select[name=departement]').select2();
</script>
