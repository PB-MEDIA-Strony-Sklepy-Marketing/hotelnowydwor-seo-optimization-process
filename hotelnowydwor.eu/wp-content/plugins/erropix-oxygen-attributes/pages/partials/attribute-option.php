<?php
/**
 * @var $option array
 */
?>
<div class="repeater-item" data-repeater-item>
    <div class="row">
        <div class="col-6">
            <input type="text" name="value" placeholder="Value" value="<?= $option['value'] ?>">
        </div>
        <div class="col-6">
            <input type="text" name="label" placeholder="Label" value="<?= $option['label'] ?>">
        </div>
    </div>
    <span class="repeater-delete" data-repeater-delete>&ndash;</span>
</div>
