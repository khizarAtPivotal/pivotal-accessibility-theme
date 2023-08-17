<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

?>

<header x-data role="banner" class="w-full h-24 z-[1001] py-4">
    <div class="container">
        <?php get_template_part('template-parts/skip-link'); ?>

        <a 
            class="font-semibold" 
            href="<?php echo esc_url( home_url() ); ?>" 
            aria-label="<?php echo esc_attr(sprintf(__('%s Logo', 'lakegeorge'), get_bloginfo('name'))); ?>">
            Pivotal Accessibility
        </a>

        <div class="container flex justify-between xl:justify-center items-stretch gap-4">
            <?php get_template_part('template-parts/headers/partials/logo'); ?>
            
            <div class="hidden xl:flex justify-start items-center p-2">
                <nav role="navigation" aria-label="Primary" class="hidden xl:block h-full">
                </nav>
            </div>

            <?php get_template_part('template-parts/headers/partials/trigger', 'menu'); ?>
        </div>
    </div>
</header>
