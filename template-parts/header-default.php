<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

?>

<header x-data role="banner" class="w-full h-24 z-[1001] py-4">
    <?php get_template_part('template-parts/skip-link'); ?>

    <div class="container flex justify-between">
        <a 
            class="shrink-0 font-semibold flex justify-center items-center" 
            href="<?php echo esc_url( home_url() ); ?>" 
            aria-label="<?php echo esc_attr(sprintf(__('%s Logo', 'pivotalaccessibility'), get_bloginfo('name'))); ?>">
            Pivotal Accessibility
        </a>

        <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu flex justify-end items-center gap-4 font-medium',
                'container' => 'nav',
                'container_aria_label' => 'Primary',
                'container_class' => 'hidden xl:flex',
                'walker' => new Pivotal_Accessibility_Nav_Walker()
            ));
        ?>

        <?php get_template_part('template-parts/headers/partials/trigger', 'menu'); ?>
    </div>
</header>
