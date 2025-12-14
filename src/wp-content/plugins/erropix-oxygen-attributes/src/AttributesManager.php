<?php

namespace ERROPIX\OxygenAttributes;

use Masterminds\HTML5;

/**
 * Class AttributesManager
 * @package ERROPIX\OxygenAttributes
 */
class AttributesManager
{
    private $page_url;
    private $menu_hookname;
    private $menu_slug = 'oxygen-attributes';
    private $taxonomy = 'oxygen_attribute';
    private $error_code = 'oxyatts';
    private $capability = 'manage_options';
    private $action_save = 'oxyatts_save_attribute';
    private $action_delete = 'oxyatts_delete_attribute';

    private $tag_attributes = [];

    public function __construct()
    {
        oxyatts_fs();

        add_action('admin_menu', [$this, 'admin_menu'], 12);

        if (oxyatts_fs()->can_use_premium_code()) {
            $this->page_url = admin_url("admin.php?page={$this->menu_slug}");

            add_action('init', [$this, 'register_taxonomy']);
            add_action('init', [$this, 'process_migrations']);
            add_action('init', [$this, 'extends_components_params']);

            add_action('admin_notices', [$this, 'admin_notices']);
            add_action('oxygen_vsb_component_attr', [$this, 'render_component_attributes'], 10, 2);
            add_filter('do_shortcode_tag', [$this, 'add_component_attributes_to_children'], 10, 3);

            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
            add_action('oxygen_enqueue_iframe_scripts', [$this, 'oxygen_enqueue_iframe_scripts']);

            add_action("admin_post_{$this->action_save}", [$this, 'post_save_attribute']);
            add_action("admin_post_{$this->action_delete}", [$this, 'post_delete_attribute']);

            add_filter('plugin_action_links', [$this, 'plugin_action_links'], 10, 2);
        }
    }

    /**
     * Register taxonomy for Oxygen attributes
     */
    public function register_taxonomy()
    {
        $args = [
            'labels' => [
                'name' => "Oxygen Attributes",
                'singular_name' => "Oxygen Attribute",
                'menu_name' => "Oxygen Attributes",
            ],
            'hierarchical' => false,
            'public' => false,
            'show_ui' => false,
            'show_admin_column' => false,
            'show_in_nav_menus' => false,
            'show_tagcloud' => false,
            'rewrite' => false,
            'show_in_rest' => false,
        ];

        register_taxonomy($this->taxonomy, [], $args);
    }

    public function rewrite_field_condition($condition, $attributes = null)
    {
        if ($attributes === null) {
            $attributes = $this->get_attributes();
        }

        foreach ($attributes as $attribute) {
            $attr_id = $attribute['id'];
            $attr_name = $attribute['name'];

            if (strpos($condition, $attr_name) !== false) {
                $condition = str_replace($attr_name, $attr_id, $condition);
            }
        }

        return $condition;
    }

    /**
     * Add attributes fields to component
     */
    public function extends_components_params()
    {
        global $oxygen_vsb_components;

        if (empty($oxygen_vsb_components)) {
            return;
        }

        foreach ($oxygen_vsb_components as &$component) {
            $tag = $component->options['tag'];
            $attributes = $this->get_component_attributes($tag);

            if (empty($component->options['params'])) {
                $component->options['params'] = [];
            }

            foreach ($attributes as $attribute) {
                $is_css = ($attribute['type'] == 'css');
                $param_name = ($attribute['type'] === 'css' ? $attribute['name'] : $attribute['id']);

                $param = [
                    "type" => $attribute['field'],
                    "heading" => $attribute['label'],
                    "param_name" => $param_name,
                    "css" => $is_css,
                    "default" => "",
                ];

                if ($condition = $attribute['condition']) {
                    $param['condition'] = $this->rewrite_field_condition($condition, $attributes);
                }

                if ($attribute['type'] == 'html') {
                    if ($attribute['field'] == 'textfield') {
                        $param['class'] = 'oxyatts-testfield';
                        $param['dynamicdatacode'] = sprintf(
                            '<div class="oxygen-dynamic-data-browse" ctdynamicdata data="iframeScope.dynamicShortcodesContentMode" ng-click="iframeScope.setAttrID(\'%s\')" callback="iframeScope.insertShortcodeToCustomAttribute">data</div>',
                            $attribute['id']
                        );
                    }
                }

                switch ($attribute['field']) {
                    case 'dropdown':
                    case 'radio':
                        $param['value'] = $attribute['options_list'];
                        break;

                    case 'checkbox':
                        $param['true_value'] = $attribute['true_value'];
                        $param['false_value'] = $attribute['false_value'];
                        break;
                }

                array_push($component->options['params'], $param);
            }
        }
    }

    public function render_dynamic_data_value($matches)
    {
        $shortcode = base64_decode($matches[1]);
        $shortcode = $this->sign_shortcodes($shortcode);
        return @do_shortcode($shortcode);
    }

    public function process_attribute_value($value)
    {
        if ($value) {
            if ($value === 'NULL') {
                $value = null;
            } else {
                if (strpos($value, 'dyndata_') !== false) {
                    $pattern = '#dyndata_([A-Za-z0-9+/]+={0,2})#';
                    $value = preg_replace_callback($pattern, [$this, 'render_dynamic_data_value'], $value);
                }
            }
        }

        return $value;
    }

    /**
     * Render html tag attributes
     *
     * @param array  $options
     * @param string $tag
     */
    public function render_component_attributes($options, $tag = null)
    {
        if (!$tag) {
            return;
        }

        $attributes = $this->get_component_attributes($tag);

        foreach ($attributes as $attribute) {
            if ($attribute['type'] == 'css' || $attribute['target'] !== 'self') {
                continue;
            }

            $id = $attribute['id'];
            $label = $attribute['label'];
            $name = $attribute['name'];

            if (key_exists($id, $options)) {
                $value = $options[$id];
                if ($value) {
                    $value = $this->process_attribute_value($value);
                    if ($value === null) {
                        printf(' %s', $name);
                    } else {
                        printf(' %s="%s"', $name, esc_attr($value));
                    }
                }
            }
        }
    }

    /**
     * Apply attributes for children elements
     * 
     * @param string       $output Shortcode output.
     * @param string       $tag    Shortcode name.
     * @param array|string $attr   Shortcode attributes array or empty string.
     * 
     * @return string
     */
    public function add_component_attributes_to_children($output, $tag, $attr)
    {
        if (!defined("OXYGEN_IFRAME") && $output && isset($attr['ct_options'])) {
            $options = json_decode($attr['ct_options'], true);

            if (isset($options['original'])) {
                $options = $options['original'];

                $attributes = $this->get_component_attributes($tag);

                $childAttributes = [];
                foreach ($attributes as $attribute) {
                    $id = $attribute['id'];
                    $target = $attribute['target'];
                    $name = $attribute['name'];

                    if ($target == 'children' && !empty($options[$id])) {
                        $value = $options[$id];
                        $value = $this->process_attribute_value($value);

                        if ($value === null) {
                            $value = "";
                        }

                        $childAttributes[$name] = $value;
                    }
                }

                if (!empty($childAttributes)) {
                    $html = new HTML5();
                    $dom = $html->loadHTMLFragment($output);

                    $addedAttibutes = false;
                    if ($dom->childNodes->length) {
                        foreach ($dom->childNodes as $node) {
                            if ($node->childNodes->length) {
                                foreach ($node->childNodes as $child) {
                                    if (is_a($child, 'DOMElement')) {
                                        foreach ($childAttributes as $name => $value) {
                                            $child->setAttribute($name, $value);
                                        }
                                        $addedAttibutes = true;
                                    }
                                }
                            }
                        }
                    }

                    $output = $html->saveHTML($dom);
                }
            }
        }
        return $output;
    }

    /**
     * Get supported components list
     *
     * @return array
     */
    public function get_components_list()
    {
        static $components = null;

        if ($components === null) {
            $components = [
                'ct_section' => 'Section',
                'ct_div_block' => 'Div',
                'ct_new_columns' => 'Columns',
                'ct_headline' => 'Heading',
                'ct_text_block' => 'Text',
                'oxy_rich_text' => 'Rich Text',
                'ct_link_text' => 'Text Link',
                'ct_link' => 'Link Wrapper',
                'ct_link_button' => 'Button',
                'ct_image' => 'Image',
                'ct_video' => 'Video',
                'ct_svg_icon' => 'Icon',
                'ct_fancy_icon' => 'Icon',
                'ct_code_block' => 'Code Block',
                'ct_slide' => 'Slide',
                'oxy_nav_menu' => 'Menu',
                'ct_shortcode' => 'Shortcode',
                'ct_nestable_shortcode' => 'Shortcode Wrapper',
                'oxy_comments' => 'Comments List',
                'oxy_comment_form' => 'Comment Form',
                'oxy_login_form' => 'Login Form',
                'oxy_search_form' => 'Search Form',
                'oxy_tabs_contents' => 'Tabs Contents',
                'oxy_tab' => 'Tab',
                'oxy_tab_content' => 'Tab Content',
                'oxy_header' => 'Header Builder',
                'oxy_header_row' => 'Header Row',
                'oxy_header_center' => 'Row Center',
                'oxy_header_left' => 'Row Left',
                'oxy_header_right' => 'Row Right',
                'oxy_social_icons' => 'Social Icons',
                'oxy_testimonial' => 'Testimonial',
                'oxy_icon_box' => 'Icon Box',
                'oxy_pricing_box' => 'Pricing Box',
                'oxy_progress_bar' => 'Progress Bar',
                'oxy_posts_grid' => 'Easy Posts',
                'oxy_gallery' => 'Gallery',
                'ct_slider' => 'Slider',
                'oxy_tabs' => 'Tabs',
                'oxy_superbox' => 'Superbox',
                'oxy_toggle' => 'Toggle',
                'oxy_map' => 'Google Maps',
                'oxy_soundcloud' => 'SoundCloud',
                'ct_modal' => 'Modal',
                'ct_span' => 'Span',
                'ct_widget' => 'Widget',
                'oxy_dynamic_list' => 'Repeater',
            ];

            // Calculate component frequency usage in attributes
            $attributes = $this->get_attributes();
            $components_usage = [];
            foreach ($components as $tag => $label) {
                $components_usage[$tag] = 0;
                foreach ($attributes as $attribute) {
                    if (in_array($tag, $attribute['components'])) {
                        $components_usage[$tag] += 1;
                    }
                }
            }

            // Sort components by usage frequency, then by label alphabitically
            uksort($components, function ($ak, $bk) use ($components, $components_usage) {
                $result = $components_usage[$bk] - $components_usage[$ak];
                if ($result === 0) {
                    $result = strcmp($components[$ak], $components[$bk]);
                }

                return $result;
            });
        }

        return $components;
    }

    /**
     * Get attributes list
     *
     * @return array|null
     */
    private function get_attributes()
    {
        static $attributes = null;

        if (is_null($attributes)) {
            $components = $this->get_components_list();
            $terms = get_terms([
                'taxonomy' => $this->taxonomy,
                'hide_empty' => false,
                'fields' => 'id=>name',
                'orderby' => 'id',
            ]);

            if (is_wp_error($terms)) {
                $this->set_settings_message($terms->get_error_message(), 'error');
                return [];
            } else {
                $attributes = [];
                foreach ($terms as $term_id => $attr_id) {
                    $attr_label = get_term_meta($term_id, 'attr_label', true);
                    $attr_name = get_term_meta($term_id, 'attr_name', true);
                    $attr_components = get_term_meta($term_id, 'attr_components', true) ?: [];
                    $attr_type = get_term_meta($term_id, 'attr_type', true);
                    $attr_target = get_term_meta($term_id, 'attr_target', true) ?: 'self';
                    $attr_field = get_term_meta($term_id, 'attr_field', true);
                    $attr_options = get_term_meta($term_id, 'attr_options', true) ?: [];
                    $attr_true_value = get_term_meta($term_id, 'attr_true_value', true);
                    $attr_false_value = get_term_meta($term_id, 'attr_false_value', true);
                    $attr_condition = get_term_meta($term_id, 'attr_condition', true);

                    $attr_components_list = array_intersect_key($components, array_flip($attr_components));

                    $attr_options_list = [];
                    if ($attr_field === 'dropdown') {
                        $attr_options_list = [
                            "" => "&nbsp;",
                        ];
                    }
                    foreach ($attr_options as $option) {
                        $key = $option['value'];
                        $attr_options_list[$key] = $option['label'];
                    }

                    $attributes[$term_id] = [
                        'id' => $attr_id,
                        'label' => $attr_label,
                        'name' => $attr_name,
                        'components' => $attr_components,
                        'components_list' => $attr_components_list,
                        'type' => $attr_type,
                        'target' => $attr_target,
                        'field' => $attr_field,
                        'options' => $attr_options,
                        'options_list' => $attr_options_list,
                        'true_value' => $attr_true_value,
                        'false_value' => $attr_false_value,
                        'condition' => $attr_condition,
                    ];
                }
            }
        }

        return $attributes;
    }

    /**
     * Get attributes linked to a component
     *
     * @param string $component
     *
     * @return array
     */
    public function get_component_attributes($component)
    {
        $attributes = $this->get_attributes();

        $component_attributes = [];
        foreach ($attributes as $attribute) {
            if (in_array($component, $attribute['components'])) {
                array_push($component_attributes, $attribute);
            }
        }

        return $component_attributes;
    }

    /**
     * Save attribute
     */
    public function post_save_attribute()
    {
        // Check referer
        check_admin_referer($this->action_save);
        $redirect_to = add_query_arg('settings-updated', 'true', $this->page_url);

        // Prepare data
        $id = $this->POST('id');
        $attr_label = $this->POST('attr_label');
        $attr_name = $this->POST('attr_name');
        $attr_components = $this->POST('attr_components');
        $attr_type = $this->POST('attr_type');
        $attr_target = $this->POST('attr_target');
        $attr_field = $this->POST('attr_field');
        $attr_options = $this->POST('attr_options');
        $attr_true_value = $this->POST('attr_true_value');
        $attr_false_value = $this->POST('attr_false_value');
        $attr_condition = $this->POST('attr_condition');

        // If new attribute, generate a random id
        if (empty($id)) {
            $id = uniqid('attr_');
            $result = wp_insert_term($id, $this->taxonomy);
        } else {
            $result = term_exists($id, $this->taxonomy);
        }

        // Save attribute details as term metadata
        if (is_array($result)) {
            $term_id = $result['term_id'];

            $rs = [];
            $rs['label'] = update_term_meta($term_id, 'attr_label', $attr_label);
            $rs['name'] = update_term_meta($term_id, 'attr_name', $attr_name);
            $rs['components'] = update_term_meta($term_id, 'attr_components', $attr_components);
            $rs['type'] = update_term_meta($term_id, 'attr_type', $attr_type);
            $rs['target'] = update_term_meta($term_id, 'attr_target', $attr_target);
            $rs['field'] = update_term_meta($term_id, 'attr_field', $attr_field);
            $rs['options'] = update_term_meta($term_id, 'attr_options', $attr_options);
            $rs['true_value'] = update_term_meta($term_id, 'attr_true_value', $attr_true_value);
            $rs['false_value'] = update_term_meta($term_id, 'attr_false_value', $attr_false_value);
            $rs['condition'] = update_term_meta($term_id, 'attr_condition', $attr_condition);

            $errors = [];
            foreach ($rs as $l => $r) {
                if (is_wp_error($r)) {
                    $error = $r->get_error_message();
                    $errors[$l] = "<li><b>$l</b>: $error</li>";
                }
            }

            if (empty($errors)) {
                $this->set_settings_message("Attribute data saved successfully");
            } else {
                $errors = implode("\n", $errors);
                $this->set_settings_message("Some errors occured while saving the attribute data:<br/><ul>\n$errors\n</ul>", 'error');
            }

            $redirect_to = add_query_arg('edit', $term_id, $redirect_to);
        } else {
            $error = $result->get_error_message();
            $this->set_settings_message("An error occured: $error", 'error');
        }

        // Redirect to attributes page
        wp_redirect($redirect_to);
    }

    /**
     * Delete attribute
     */
    public function post_delete_attribute()
    {
        // Check referer
        check_admin_referer($this->action_delete);

        // Prepare data
        $term_id = $this->POST('delete_id');

        // Delete the attribute term
        $deleted = wp_delete_term($term_id, $this->taxonomy);
        if ($deleted === true) {
            $this->set_settings_message("Attribute data deleted successfully");
        } else {
            $this->set_settings_message("An error occured while deleting the attribute data", 'error');
        }

        // Redirect to attributes page
        wp_redirect(add_query_arg('settings-updated', 'true', $this->page_url));
    }

    /**
     * Register admin menu page
     */
    public function admin_menu()
    {
        $parent_slug = 'ct_dashboard_page';
        $page_title = 'Oxygen Attributes';
        $menu_title = 'Attributes';
        $capability = $this->capability;
        $menu_slug = $this->menu_slug;
        $function = [$this, 'render_admin_page'];

        $this->menu_hookname = add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
    }

    /**
     * Render admin menu page
     */
    public function render_admin_page()
    {
        if (oxyatts_fs()->can_use_premium_code()) {
            $attributes = $this->get_attributes();
            $components = $this->get_components_list();

            $edit_id = intval($this->GET('edit'));
            $edit_attribute = $this->array_get($attributes, $edit_id);

            if (empty($edit_attribute)) {
                $edit_id = null;

                $edit_attribute = [
                    'id' => '',
                    'label' => '',
                    'name' => '',
                    'components' => [],
                    'type' => 'html',
                    'target' => 'self',
                    'field' => 'textfield',
                    'options' => [],
                    'value' => '',
                    'true_value' => 'true',
                    'false_value' => 'false',
                    'condition' => '',
                ];
            }

            array_walk($attributes, function (&$attribute) {
                $components_list = $attribute['components_list'];
                $components_more = null;

                if (count($components_list) > 3) {
                    $components_more = array_slice($components_list, 3, null, true);

                    $components_list = array_slice($components_list, 0, 3, true);
                    $components_list[''] = '';

                    $attribute['components_list'] = $components_list;
                }

                $attribute['components_more'] = $components_more;
            });

            include $this->path('pages/oxygen-attributes.php');
        }
    }

    /**
     * Enqueue CSS and JS files
     */
    public function admin_enqueue_scripts()
    {
        global $current_screen;

        if ($current_screen->id == $this->menu_hookname) {
            wp_enqueue_style('oxyatts-style', OXYATTR_URL . 'assets/css/style.min.css');
            wp_enqueue_script('oxyatts-script', OXYATTR_URL . 'assets/js/script.min.js');
        }
    }

    public function oxygen_enqueue_iframe_scripts()
    {
        wp_enqueue_script('oxyatts-iframe', OXYATTR_URL . 'assets/js/iframe.min.js', [], null, true);

        $oxyatts = [];
        $attributes = $this->get_attributes();
        foreach ($attributes as $attribute) {
            if ($attribute['type'] == 'css') continue;

            $oxyatts[$attribute['id']] = $attribute['name'];
        }
        wp_localize_script('oxyatts-iframe', 'oxyatts', $oxyatts);
    }

    /**
     * Show admin notices
     */
    public function admin_notices()
    {
        settings_errors($this->error_code);
    }

    /**
     * @param string $message
     * @param string $type
     */
    public function set_settings_message($message, $type = "updated")
    {
        $settings_errors = [
            [
                'setting' => $this->error_code,
                'code' => $this->error_code,
                'message' => $message,
                'type' => $type,
            ],
        ];
        set_transient('settings_errors', $settings_errors, 300);
    }

    /**
     * Sign dynamic data shortcodes before rendering
     */
    private function sign_shortcodes($shortcode)
    {
        global $oxygen_signature;

        // Replace escaped characters
        $shortcode = str_replace('\"', '"', $shortcode);

        // Parse shortcode
        $pattern = get_shortcode_regex(['oxygen']);
        if (preg_match("/$pattern/", $shortcode, $matches)) {
            // Parse attributes
            $tag = $matches[2];
            $atts = trim($matches[3]);
            $args = shortcode_parse_atts($atts);

            // Generate signature attribute
            $signature = $oxygen_signature->generate_signature_shortcode_string($tag, $args, null);

            // Recreate shortcode string
            $shortcode = "[$tag $signature $atts]";
        }

        return $shortcode;
    }

    /**
     * Run data migrations
     */
    public function process_migrations()
    {
        // no migration for this version
    }

    /**
     * @param $actions string[]
     * @param $file    string
     *
     * @return array
     */
    public function plugin_action_links($actions, $file)
    {
        if ($file == OXYATTR_BASE) {
            $new_actions = [
                'manage' => sprintf('<a href="%s" aria-label="Manage Advanced Scripts">Manage</a>', $this->page_url),
            ];

            $actions = array_merge($new_actions, $actions);
        }
        return $actions;
    }

    /**
     * @param string|null $path
     *
     * @return string
     */
    public function path($path = null)
    {
        $base = OXYATTR_DIR;
        if (DIRECTORY_SEPARATOR !== '/') {
            $base = str_replace('\\', '/', $base);
        }
        return $base . trim($path);
    }

    /**
     * @param array      $choices
     * @param mixed|null $value
     * @param bool       $echo
     *
     * @return string
     */
    public function html_options($choices, $value = null, $echo = true)
    {
        $options = '';
        if (is_array($choices)) {
            foreach ($choices as $key => $label) {
                if (is_array($value)) {
                    $selected = in_array($key, $value) ? ' selected' : '';
                } else {
                    $selected = $key === $value ? ' selected' : '';
                }
                $options .= sprintf('<option value="%s"%s>%s</option>', $key, $selected, $label);
            }

            if ($echo) {
                echo $options;
            }
        }

        return $options;
    }

    /**
     * @param string $id
     *
     * @return string
     */
    public function icon($id)
    {
        static $xml = null;

        $output = '';
        if (is_null($xml)) {
            $xml = simplexml_load_file($this->path('assets/images/icons.svg'));
        }

        foreach ($xml->children()->children() as $symbol) {
            $atts = $symbol->attributes();
            if ($atts->id == $id) {
                $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="' . $atts->viewBox . '">';
                $output .= $symbol->children()->asXML();
                $output .= '</svg>';
            }
        }

        return $output;
    }

    /**
     * @param string|integer $key
     * @param mixed|null     $alt
     *
     * @return mixed|null
     */
    public function GET($key, $alt = null)
    {
        return $this->array_get($_GET, $key, $alt);
    }

    /**
     * @param string|integer $key
     * @param mixed|null     $alt
     *
     * @return mixed|null
     */
    public function POST($key, $alt = null)
    {
        return $this->array_get($_POST, $key, $alt);
    }

    /**
     * @param array          $array
     * @param string|integer $key
     * @param mixed|null     $alt
     *
     * @return mixed|null
     */
    public function array_get(array $array, $key, $alt = null)
    {
        if (isset($array[$key])) {
            return $array[$key];
        } else {
            if (strpos($key, '.')) {
                $keys = explode('.', $key);
                foreach ($keys as $k) {
                    if (is_array($array) && key_exists($k, $array)) {
                        $array = $array[$k];
                    } else {
                        return $alt;
                    }
                }
                return $array;
            }
        }

        return $alt;
    }
}
