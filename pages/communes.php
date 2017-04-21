<form method="post" id="commune-search" style="display: none">

    <select name="commune">
        <option value="">-- Communes --</option>
        <?php
        foreach ($xml->Regions->Region as $regions) {
            foreach ($regions->Departements->Departement as $departement) {
                foreach ($departement->Communes->Commune as $commune) {
                    echo '<option value="' . $regions->CodReg3Car . '.' . $departement->CodDpt3Car . '.' . $commune->CodSubCom . '">' . $commune->LibSubCom . '</option>';
                }
            }
        }
        ?>
    </select>
<!--    <input type="submit" value="valider" name="valider-communes" id="valider-communes"/>-->
</form>

<script>
    $('select[name=commune]').select2();
</script>
