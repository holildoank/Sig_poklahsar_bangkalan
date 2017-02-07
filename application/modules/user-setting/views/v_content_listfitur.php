<div class="form-group">
    <label class="control-label">List Fitur</label>
    <div class="mt-checkbox-list">
        <?php foreach ($data_fitur->result() as $r): ?>
            <label class="mt-checkbox mt-checkbox-outline"> <?php echo $r->fitur_nama ?>
                <input type="checkbox" value="<?php echo $r->fitur_id ?>" name="listfitur[]" />
                <span></span>
            </label>
        <?php endforeach; ?>
    </div>
</div>
