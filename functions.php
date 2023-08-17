<?php

define('PIVOTAL_ACCESSIBILITY_VERSION', '0.0.1');

if (!function_exists('pivotalaccessibility_dd')) {
    /**
     * Var_dump and die method
     *
     * @return void
     */
    function pivotalaccessibility_dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        echo '</pre>';
        die;
    }
}

if (!function_exists('pivotalaccessibility_truncate')) {
    /**
     * Truncates a string with a given length.
     *
     * @param  string  $string
     * @param  int  $length
     * @param  string  $append
     * @return string
     */

    function pivotalaccessibility_truncate($string, $length = 100, $append = "&hellip;")
    {
        $string = trim($string);

        if (strlen($string) > $length) {
            $string = wordwrap($string, $length);
            $string = explode("\n", $string, 2);
            $string = $string[0] . $append;
        }

        return $string;
    }
}


if (!function_exists('pivotalaccessibility_assets')) {
    /**
     * Get assets folder url.
     *
     * @param  string  $path
     * @return string
     */

    function pivotalaccessibility_assets($path)
    {
        if (!$path) {
            return;
        }

        return get_template_directory_uri() . '/assets/' . $path;
    }
}

if (!function_exists('pivotalaccessibility_svg')) {
    /**
     * Get inline svg from a file.
     *
     * @param  string  $filename
     * @return string
     */

    function pivotalaccessibility_svg($filename)
    {

        if (!$filename) {
            return;
        }

        $file_location = get_template_directory() . '/assets/dist/svg/' . $filename . '.svg';

        if (!file_exists($file_location)) {
            return;
        }

        return file_get_contents($file_location);
    }
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

add_action('wp_enqueue_scripts', "pivotalaccessibility_enqueue_scripts");

function pivotalaccessibility_enqueue_scripts() {
    // Scripts
    wp_enqueue_script('lakegeorge-main', pivotalaccessibility_assets('js/main.js'), array('jquery'), pivotalaccessibility_get_version(), false);
    wp_enqueue_style('lakegeorge-style', pivotalaccessibility_assets('css/style.css'), array(), pivotalaccessibility_get_version(), 'all');
   
    // Localize 
    wp_localize_script('lakegeorge-main', 'lakegeorgeData', []);

    // Extra
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}