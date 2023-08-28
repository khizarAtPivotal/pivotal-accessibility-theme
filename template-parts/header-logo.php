<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if ($args) {
  extract($args);
}

$custom_logo_id = get_theme_mod('custom_logo');
$logo = wp_get_attachment_image_src($custom_logo_id, 'full');

?>

<img
    class="w-auto h-auto max-w-[12rem] max-h-[6rem] md:max-w-[15rem] md:max-h-[3.5rem]"
    src="<?php echo has_custom_logo() ? $logo[0] : ""; ?>"
    alt="<?php echo esc_attr(sprintf(__('%s Logo', 'pivotalaccessibility'), get_bloginfo('name'))); ?>"
    width="<?php echo has_custom_logo() ?? esc_attr($logo[1]); ?>"
    height="<?php echo has_custom_logo() ?? esc_attr($logo[2]); ?>"
/>