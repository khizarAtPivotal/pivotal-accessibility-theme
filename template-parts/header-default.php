<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

?>

<header x-data="header" role="banner" class="w-full h-24 z-[1001] py-4">
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
                'container_class' => 'desktop hidden xl:flex',
                'walker' => new Pivotal_Accessibility_Nav_Walker()
            ));
        ?>

        <button class="font-sm font-semibold xl:hidden" x-on:click.prevent="showSidebar ? hide() : show()">
            Open Menu
        </button>

        <div 
            class="fixed z-[1001] top-16 right-6 left-6 rounded-2xl rounded-tr-none bg-white pt-6 px-8 pb-8 border-1 border-gray-900" 
            x-cloak
            x-show="showSidebar"
            x-trap.inert="showSidebar"
            x-transition.origin.top.right
            x-on:keydown.escape.window="hide()">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-base font-semibold">Menu</h2>
                <button 
                    x-on:click="hide()"
                    class="w-6 h-auto"
                    aria-label="Close Menu">
                    <?php echo pivotalaccessibility_svg('x'); ?>
                </button>
            </div>

            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'flex flex-col justify-start items-start gap-4 font-medium',
                    'container' => 'nav',
                    'container_aria_label' => 'Primary',
                    'container_class' => 'mobile xl:hidden',
                    'walker' => new Pivotal_Accessibility_Nav_Walker()
                ));
            ?>
        </div>

    </div>
</header>
