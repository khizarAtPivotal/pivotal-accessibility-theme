<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if ($args) {
    extract($args);
}


?>

<div x-data id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <?php get_template_part('template-parts/post/partials/image', null);?>
    
    <div class="w-full flex-1 flex justify-start items-start flex-col flex-wrap pt-6">
        <h2 class="text-2xl m-0 mt-4 w-full font-body font-semibold">
            <a class="hover:underline hover:text-primary-darker break-all" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                <?php echo esc_html( get_the_title() ); ?>
            </a>
        </h2>
        
        <div class="mt-4 text-lg">
            <?php the_excerpt(); ?>
        </div>

        <a class="mt-4 font-semibold text-primary-darker underline" href="<?php the_permalink() ?>">
            Read More <span class="sr-only">(<?php the_title(); ?>)</span>
        </a>
    </div>
</div><!-- #post-## -->