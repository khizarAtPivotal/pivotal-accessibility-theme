<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

?>

<header 
    x-data="header" 
    role="banner" 
    class="w-full h-24 z-[1001] py-4 flex flex-col justify-center items-center">
    <?php get_template_part('template-parts/skip-link'); ?>

    <div class="container flex justify-between items-center">
        <a 
            class="shrink-0 text-base font-bold flex justify-start items-center w-72" 
            href="<?php echo esc_url(home_url()); ?>" 
            aria-label="<?php echo esc_attr(sprintf(__('%s Logo', 'pivotalaccessibility'), get_bloginfo('name'))); ?>">

            <?php if(has_custom_logo()): ?>
                <?php get_template_part('template-parts/header-logo'); ?>
            <?php else: ?>
                <?php echo esc_html(get_bloginfo('name')); ?>
            <?php endif; ?>
        </a>

        <?php
            wp_nav_menu(array(
                'container' => 'nav',
                'container_aria_label' => 'Primary',
                'container_class' => 'desktop hidden grow lg:flex justify-center items-center flex-wrap',
                'theme_location' => 'primary',
                'menu_class' => 'nav-menu flex justify-end items-center gap-4 font-medium',
                'walker' => new Pivotal_Accessibility_Nav_Walker()
            ));
        ?>

        <div x-data="search" class="relative w-72">
            <?php get_template_part('template-parts/header', 'search-form'); ?>
        </div>

        <button
            class="font-sm font-semibold lg:hidden" 
            x-on:click.prevent="showSidebar ? hide() : show()">
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
