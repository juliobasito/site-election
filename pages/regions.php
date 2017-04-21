<form method="post" id="region-search">
    <select name="region">
        <?php
        foreach ($xml->Regions->Region as $regions) {
            echo '<option value="' . $regions->CodReg3Car . '">' . $regions->LibReg . '</option>';
        }
        ?>
    </select>
    <input type="submit" value="valider" name="valider-region" id="valider-region"/>
</form>
<script>
    $('select[name=region]').select2();
</script>
