<?php

define('PIVOTAL_ACCESSIBILITY_VERSION', '0.0.1');


add_action("after_setup_theme", "pivotalaccessibility_after_setup_theme");
add_action("wp_enqueue_scripts", "pivotalaccessibility_enqueue_scripts");
add_action('wp_print_styles', "pivotalaccessibility_google_fonts");

add_filter("script_loader_tag", "pivotalaccessibility_add_defer_to_alpine_script", 10, 3);

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

    wp_enqueue_script('pivotalaccessibility-main', pivotalaccessibility_assets('js/main.js'), array('jquery'), pivotalaccessibility_get_version(), true);
    wp_enqueue_style('pivotalaccessibility-style', pivotalaccessibility_assets('css/style.css'), array(), pivotalaccessibility_get_version(), 'all');
   
    // Localize
    wp_localize_script('pivotalaccessibility-main', 'pivotalaccessibilityData', []);

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
     *
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

class Pivotal_Accessibility_Nav_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        // Add a button after the list item's opening tag
        $output .= '<button class="menu-toggle w-6" aria-expanded="false" aria-label="'.__('Toggle sub-menu', 'pivotalaccessibility').'">';
        $output .= '<span class="menu-toggle-icon" aria-hidden="true">'.pivotalaccessibility_svg('chevron-down').'</span>';
        $output .= '</button>';
        
        $output .= '<ul class="sub-menu">';
    }
}
