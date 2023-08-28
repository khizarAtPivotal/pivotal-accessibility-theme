<?php

require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

define('PIVOTAL_ACCESSIBILITY_VERSION', '0.0.2');

add_action("after_setup_theme", "pivotalaccessibility_after_setup_theme");
add_action("wp_enqueue_scripts", "pivotalaccessibility_enqueue_scripts");
add_action('wp_print_styles', "pivotalaccessibility_google_fonts");
add_action('wp_ajax_pivotalaccessibility_index_search', 'pivotalaccessibility_index_search');
add_action('wp_ajax_nopriv_pivotalaccessibility_index_search', 'pivotalaccessibility_index_search');
add_action('tgmpa_register', 'pivotalaccessibility_register_required_plugins');

add_filter("script_loader_tag", "pivotalaccessibility_add_defer_to_alpine_script", 10, 3);
add_filter("acf/settings/save_json", "pivotalaccessibility_acf_json_save_point");
add_filter("acf/settings/load_json", "pivotalaccessibility_acf_json_load_point");


function pivotalaccessibility_dd() {
    echo '<pre>';
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    echo '</pre>';
    die;
}

function pivotalaccessibility_truncate($string, $length = 100, $append = "&hellip;") {
    $string = trim($string);

    if (strlen($string) > $length) {
        $string = wordwrap($string, $length);
        $string = explode("\n", $string, 2);
        $string = $string[0] . $append;
    }

    return $string;
}

function pivotalaccessibility_assets($path) {
    if (!$path) {
        return;
    }

    return get_template_directory_uri() . '/assets/' . $path;
}

function pivotalaccessibility_svg($filename) {

    if (!$filename) {
        return;
    }

    $file_location = get_template_directory() . '/assets/icons/' . $filename . '.svg';

    if (!file_exists($file_location)) {
        return;
    }

    return file_get_contents($file_location);
}

function pivotalaccessibility_get_version() {
    $version = PIVOTAL_ACCESSIBILITY_VERSION;

    if (!function_exists('wp_get_environment_type')) {
        return $version;
    }

    switch (wp_get_environment_type()) {
        case 'local':
        case 'development':
            $version = time();
            break;
    }

    return $version;
}

function pivotalaccessibility_add_defer_to_alpine_script($tag, $handle, $src) {
    $defer_scripts = array('pivotalaccessibility-alpine', 'pivotalaccessibility-alpine-focus', 'pivotalaccessibility-alpine-collapse', 'pivotalaccessibility-alpine-intersect');

    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }

    return $tag;
}


function pivotalaccessibility_enqueue_scripts() {
    // Scripts
    wp_enqueue_script('pivotalaccessibility-alpine-focus', pivotalaccessibility_assets('js/alpine-focus.min.js'), array(), pivotalaccessibility_get_version(), false);
    wp_enqueue_script('pivotalaccessibility-alpine-collapse', pivotalaccessibility_assets('js/alpine-collapse.min.js'), array(), pivotalaccessibility_get_version(), false);
    wp_enqueue_script('pivotalaccessibility-alpine-intersect', pivotalaccessibility_assets('js/alpine-intersect.min.js'), array(), pivotalaccessibility_get_version(), false);
    wp_enqueue_script('pivotalaccessibility-alpine', pivotalaccessibility_assets('js/alpine.min.js'), array(), pivotalaccessibility_get_version(), false);

    wp_enqueue_script('pivotalaccessibility-twind', pivotalaccessibility_assets('js/twind.min.js'), array(), pivotalaccessibility_get_version(), false);
    wp_add_inline_script('pivotalaccessibility-twind', file_get_contents(get_template_directory(). "/assets/js/head.js"), "after");

    wp_enqueue_script('embla', pivotalaccessibility_assets('js/embla-carousel.umd.js'), array(), "8.0.0", true);

    wp_enqueue_script('pivotalaccessibility-main', pivotalaccessibility_assets('js/main.js'), array('jquery'), pivotalaccessibility_get_version(), true);
    wp_enqueue_style('animxyz', pivotalaccessibility_assets('css/animxyz.min.css'), array(), "0.6.7", 'all');
    wp_enqueue_style('pivotalaccessibility-style', pivotalaccessibility_assets('css/style.css'), array(), pivotalaccessibility_get_version(), 'all');
   
    // Localize
    wp_localize_script('pivotalaccessibility-main', 'pivotalaccessibilityData', [
        '_wpnonce' => wp_create_nonce('pivotalaccessibility_ajax'),
        'homeURL' => esc_url(home_url()),
        'assetsURL' => esc_url(pivotalaccessibility_assets('/')),
        'ajaxURL' => esc_url(admin_url('admin-ajax.php')),
    ]);

    // Extra
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}


function pivotalaccessibility_after_setup_theme() {
    /*
    * Default Theme Support options better have
    */
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /**
     * Add woocommerce support and woocommerce override
     */

    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width' => 1024,
        'product_grid' => array(
            'default_rows' => 3,
            'min_rows' => 3,
            'max_rows' => 3,
            'default_columns' => 4,
            'min_columns' => 4,
            'max_columns' => 4,
        ),
    ));

    $GLOBALS['content_width'] = apply_filters('content_width', 1920);

    register_nav_menus(array(
        'primary' => esc_html__('Primary', 'pivotalaccessibility'),
        'footer' => esc_html__('Footer', 'pivotalaccessibility'),
        'legal' => esc_html__('Legal', 'pivotalaccessibility'),
    ));
}

function pivotalaccessibility_google_fonts() {
    /**
     * Load fonts from google server when Kirki does not exist.
    */

    $fonts = [
        "primary" => "Inter",
        "heading" => "Playfair Display"
    ];

    $base = "//fonts.googleapis.com/css2?";

    $links = [
        "primary" => sprintf(
            '%sfamily=%s:wght@%s&display=swap',
            $base,
            $fonts['primary'],
            join(";", [400, 500, 600, 700])
        ),
        "heading" => sprintf(
            '%sfamily=%s:wght@%s&display=swap',
            $base,
            $fonts['heading'],
            join(";", [400, 500, 600, 700])
        ),
    ];

    wp_register_style($fonts['primary'], $links["primary"]);
    wp_register_style($fonts['heading'], $links["heading"]);

    wp_enqueue_style($fonts['primary']);
    wp_enqueue_style($fonts['heading']);
}

function pivotalaccessibility_index_search() {
    $query = sanitize_text_field($_POST['query']); // Sanitize input
    $post_types = isset($_POST['post_types']) ? $_POST['post_types'] : array('post'); // Sanitize and get selected post types
    $results = pivotalaccessibility_search_query($query, $post_types); // Pass post types to search function

    // Prepare the response array
    $response = array();

    foreach ($results as $result_id) {
        $post = get_post($result_id);
        $response_item = array(
            'title' => $post->post_title,
            'post_type' => $post->post_type,
            'excerpt' => $post->post_excerpt,
            'permalink' => get_permalink($result_id),
        );
        $response[] = $response_item;
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

    wp_die(); // Always include this to terminate the script
}

function pivotalaccessibility_search_query($query, $post_types) {
    $args = array(
        's' => $query,
        'post_type' => json_decode($post_types),
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 5,
    );

    $search_query = new WP_Query($args);
    $results = array();

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $results[] = get_the_ID(); // Store post IDs in the results array
        }
    }

    wp_reset_postdata();
    return $results;
}


function pivotalaccessibility_kses_ruleset() {
    $kses_defaults = wp_kses_allowed_html('post');

    $svg_args = array(
        'svg' => array(
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'stroke-width' => true,
            'stroke' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
            'fill' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ),
        'g' => array('fill' => true),
        'title' => array('title' => true),
        'path' => array(
            'd' => true,
            'fill' => true,
            'stroke' => true,
        ),
        'line' => array(
            "x1" => true,
            "y1" => true,
            "x2" => true,
            "y2" => true
        ),
        'polyline' => array(
            'points' => true
        )
    );

    return array_merge($kses_defaults, $svg_args);
}


function pivotalaccessibility_acf_json_save_point( $path ) {
    return get_template_directory() . '/acf-json';
}

function pivotalaccessibility_acf_json_load_point( $paths ) {
    // Remove the original path (optional).
    unset($paths[0]);

    // Append the new path and return it.
    $paths[] = get_template_directory() . '/acf-json';

    return $paths;
}

function pivotalaccessibility_get_field($field_key, $default_value) {
    if(!function_exists('get_field')) {
        return $default_value;
    }

    $field_value = get_field($field_key);
    
    if(!$field_value || empty($field_value)) {
        return $default_value;
    }

    if(is_array($field_value)) {
        return pivotalaccessibility_recursive_merge($default_value, $field_value);
    }

    return $field_value;
}

function pivotalaccessibility_get_image_field($field_value, $key) {
    $default_value = [
        "url" => pivotalaccessibility_assets("images/pxhere-30748.jpg"),
        "alt" => ""
    ];

    if(!$field_value || !$field_value[$key]) {
        return $default_value[$key];
    }

    return $field_value[$key];
}

function pivotalaccessibility_recursive_merge(array $array1, array $array2): array {
    foreach ($array2 as $key => $value) {
        if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
            $array1[$key] = pivotalaccessibility_recursive_merge($array1[$key], $value);
        } else {
            if ($value !== false && $value !== null && $value !== "") {
                $array1[$key] = $value;
            } elseif ($value === null && isset($array1[$key])) {
                // Replace with default value if new value is null
                $array1[$key] = $array1[$key];
            }
        }
    }
    return $array1;
}


function pivotalaccessibility_register_required_plugins() {
    $plugins = array(
        array(
            'name'      => 'Advanced Custom Fields (ACF)',
            'slug'      => 'advanced-custom-fields',
            'required'  => true,
        ),
        array(
            'name'      => 'Kirki Customizer Framework',
            'slug'      => 'kirki',
            'required'  => true,
        )
    );

    $config = array(
        'id'           => 'pivotalaccessibility', // Unique ID for TGMPA
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins', // Menu slug
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '', // Customize the dismissal message
        'is_automatic' => true,
        'message'      => '', // Customize the notice message
    );

    tgmpa($plugins, $config);
}

class Pivotal_Accessibility_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Add a button after the list item's opening tag
        $output .= '<button class="menu-toggle w-6" aria-expanded="false" aria-label="'.__('Toggle sub-menu', 'pivotalaccessibility').'">';
        $output .= '<span class="menu-toggle-icon" aria-hidden="true">'.pivotalaccessibility_svg('chevron-down').'</span>';
        $output .= '</button>';
        
        $output .= '<ul class="sub-menu">';
    }
}

// Kirki

if (class_exists('Kirki')) {
    new \Kirki\Panel(
        'appearance',
        [
            'priority'    => 10,
            'title'       => esc_html__( 'Appearance', 'pivotalaccessibility' ),
            'description' => esc_html__( 'Change the appearance of the theme.', 'pivotalaccessibility' ),
        ]
    );

    new \Kirki\Section(
        'colors',
        [
            'title'       => esc_html__( 'Colors', 'pivotalaccessibility' ),
            'description' => esc_html__( 'Customize the colors of the theme.', 'pivotalaccessibility' ),
            'panel'       => 'appearance',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Color(
        [
            'settings'    => 'color_primary',
            'label'       => __( 'Primary Color', 'pivotalaccessibility' ),
            'description' => esc_html__( 'Primary color of the theme.', 'pivotalaccessibility' ),
            'section'     => 'colors',
            'default'     => '#457B9D',
        ]
    );
}
