<?php
/**
 * @var $this           \ERROPiX\Oxygen\Attributes\Main
 * @var $attributes     array
 * @var $components     array
 * @var $edit_id        int
 * @var $edit_attribute array
 */
?>
<div class="wrap oxyatts-ui">
    <h1 class="hidden"></h1>

    <div class="admin-page-header clearfix">
        <div class="admin-page-title float-left">Oxygen Attributes</div>

        <?php if ($edit_id) : ?>
            <a class="icon-button float-left" href="<?= $this->page_url ?>">
                <?= $this->icon('fa-plus') ?>
            </a>
        <?php endif ?>

        <div class="float-right clearfix">
            <a class="icon-button float-left" href="https://www.erropix.com/support/" target="_blank">
                <?= $this->icon('fa-support') ?>
            </a>
            <a class="icon-button float-left" href="<?= oxyatts_fs()->get_account_url() ?>">
                <?= $this->icon('fa-user') ?>
            </a>
        </div>
    </div>

    <div id="attributes-container">
        <div class="row no-margin">
            <div class="col-md-4 no-padding">
                <form id="attribute-form" action="<?= admin_url('admin-post.php') ?>" method="post" data-dependon-context>
                    <!-- to be loaded by ajax -->
                    <?php wp_nonce_field($this->action_save) ?>
                    <input type="hidden" name="action" value="<?= $this->action_save ?>">

                    <input type="hidden" name="id" value="<?= $edit_attribute['id'] ?>">
                    <input type="hidden" name="edit_id" value="<?= $edit_id ?>">

                    <div class="attribute-field">
                        <label for="attr_label">Label</label>
                        <input type="text" id="attr_label" name="attr_label" value="<?= $edit_attribute['label'] ?>" required>
                    </div>

                    <div class="attribute-field">
                        <label for="attr_name">Attribute</label>
                        <input type="text" id="attr_name" name="attr_name" value="<?= $edit_attribute['name'] ?>" required>
                    </div>

                    <div class="attribute-field">
                        <label for="attr_type">Attribute Type</label>
                        <select id="attr_type" name="attr_type" class="selectize" required>
                            <option value="">Select an attribute type</option>
                            <?php
                            $choices = [
                                'html' => "HTML Attribute",
                                'css' => "CSS Property",
                            ];
                            $this->html_options($choices, $edit_attribute['type']);
                            ?>
                        </select>
                    </div>

                    <div class="attribute-field hidden" data-dependon="#attr_type" data-dependon-value="html">
                        <label for="attr_target">Attribute Target</label>
                        <select id="attr_target" name="attr_target" class="selectize" required>
                            <option value="">Select an attribute target</option>
                            <?php
                            $choices = [
                                'self' => "Wrapper Element",
                                'children' => "Child Elements",
                            ];
                            $this->html_options($choices, $edit_attribute['target']);
                            ?>
                        </select>
                    </div>

                    <div class="attribute-field">
                        <label for="attr_components">Target Components</label>
                        <select id="attr_components" name="attr_components[]" class="selectize" multiple required>
                            <option value="">Select some components</option>
                            <?php
                            $this->html_options($components, $edit_attribute['components']);
                            ?>
                        </select>
                    </div>

                    <div class="attribute-field">
                        <label for="attr_value">Field Condition</label>
                        <input type="text" id="attr_condition" name="attr_condition" value="<?= $edit_attribute['condition'] ?>">
                    </div>

                    <div class="attribute-field">
                        <label for="attr_field">Field Type</label>
                        <select id="attr_field" name="attr_field" class="selectize" required>
                            <option value="">Select a field type</option>
                            <?php
                            $choices = [
                                'textfield' => "Text field",
                                // 'hyperlink' => "Link Selector",
                                'colorpicker' => "Color picker",
                                'dropdown' => "Dropdown menu",
                                'radio' => "Radio buttons",
                                'checkbox' => "Checkbox",
                            ];
                            $this->html_options($choices, $edit_attribute['field']);
                            ?>
                        </select>
                    </div>

                    <div class="attribute-field hidden" data-dependon="#attr_field" data-dependon-value="dropdown|radio">
                        <label for="attr_options">Choices</label>

                        <div class="options-repeater">
                            <script type="text/html" data-repeater-template>
                                <?php
                                $option = [
                                    'value' => '',
                                    'label' => '',
                                ];
                                include 'partials/attribute-option.php';
                                ?>
                            </script>

                            <div class="repeater-header">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Value</strong>
                                    </div>
                                    <div class="col-6">
                                        <strong>Label</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="repeater-list" data-repeater-list="attr_options">
                                <?php
                                foreach ($edit_attribute['options'] as $option) {
                                    include 'partials/attribute-option.php';
                                }
                                ?>
                            </div>

                            <button type="button" class="btn" data-repeater-create>Add</button>
                        </div>
                    </div>

                    <div class="attribute-field hidden" data-dependon="#attr_field" data-dependon-value="checkbox">
                        <div class="row">
                            <div class="col-6">
                                <label for="attr_true_value">Checked Value</label>
                                <input type="text" id="attr_true_value" name="attr_true_value" value="<?= $edit_attribute['true_value'] ?>">
                            </div>
                            <div class="col-6">
                                <label for="attr_false_value">Unchecked Value</label>
                                <input type="text" id="attr_false_value" name="attr_false_value" value="<?= $edit_attribute['false_value'] ?>">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary"><?= $edit_id ? "Update Attribute" : "Create Attribute" ?></button>
                </form>

                <?php if ($edit_id): ?>
                    <form id="attribute-delete-form" action="<?= admin_url('admin-post.php') ?>" method="post">
                        <!-- to be loaded by ajax -->
                        <?php wp_nonce_field($this->action_delete) ?>
                        <input type="hidden" name="action" value="<?= $this->action_delete ?>">

                        <input type="hidden" name="delete_id" value="<?= $edit_id ?>">
                        <button class="btn">Delete</button>
                    </form>
                <?php endif ?>
            </div>
            <div class="col-md-8 no-padding">
                <div id="attributes-list">
                    <table>
                        <thead>
                        <tr>
                            <th>Label</th>
                            <th>Attribute</th>
                            <th>Components</th>
                            <th>Condition</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($attributes as $term_id => $attribute) {
                            include 'partials/attribute.php';
                        }
                        ?>
                        </tbody>
                        <?php if (empty($attributes)): ?>
                            <tfoot>
                            <tr>
                                <td colspan="4">No attributes found, please use the left side form to create new one</td>
                            </tr>
                            </tfoot>
                        <?php endif ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    !function ($) {
        var $form = $('#attribute-form');

        // Selectize dropdowns
        $form.find('select.selectize').selectize({
            onInitialize: function () {
                new SimpleBar(this.$dropdown.get(0));
            }
        });

        // Options repeater
        $form.find('.options-repeater').oxyAttsRepeater();

        // Form dependencies
        $form.oxyAttsDependOn();

        // Delete attribute confirmation
        $('#attribute-delete-form').on('submit', function (e) {
            e.preventDefault();

            if (confirm("Are you sure you want to delete this attribute?")) {
                this.submit();
            }
        });

        // Popper more components list
        $('[data-popper]').each(function () {
            var popper = this.nextElementSibling;

            var popperInstance = new Popper(this, popper, {
                placement: this.dataset.popper,
                modifiers: {
                    arrow: {
                        element: '.popper-arrow'
                    }
                }
            });

            var $this = $(this);
            var $popper = $(popper);

            $this.on('click', function (e) {
                e.preventDefault();
            });

            $this.on('focus', function (e) {
                if (!$popper.is(':visible')) {
                    $popper.fadeIn();
                    popperInstance.update();
                }
            });

            $this.on('blur', function (e) {
                if ($popper.is(':visible')) {
                    $popper.fadeOut();
                }
            });
        });
    }(jQuery);
</script>
