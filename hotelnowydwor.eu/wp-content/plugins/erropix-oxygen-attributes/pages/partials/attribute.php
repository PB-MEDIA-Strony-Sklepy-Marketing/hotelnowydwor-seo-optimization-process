<?php
/**
 * @var $this      \ERROPiX\Oxygen\Attributes\Main
 * @var $attribute array
 * @var $term_id   int
 * @var $edit_id   int
 */
?>
<tr class="<?= $term_id == $edit_id ? 'active' : '' ?>">
    <td><a href="<?= add_query_arg('edit', $term_id, $this->page_url) ?>"><?= $attribute['label'] ?></a></td>
    <td><?= $attribute['name'] ?></td>
    <td>
        <?= implode(', ', $attribute['components_list']) ?>
        <?php if ($attribute['components_more']): $components_more = $attribute['components_more']; ?>
            <a href="#" data-popper="right">+<?= count($components_more) ?> more</a>
            <div class="oxyatts-popper" style="display:none;">
                <div class="popper-arrow"></div>
                <div><?= join('<br />', $components_more) ?></div>
            </div>
        <?php endif ?>
    </td>
    <td><code><?= $attribute['condition'] ?></code></td>
</tr>
