<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if ($args) {
    extract($args);
}

?>

<div x-data class="self-stretch" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="w-full h-full flex-1 flex justify-start items-start flex-col flex-wrap">
        <a href="<?php echo esc_attr( get_the_permalink() ); ?>" class="group w-full h-72 overflow-hidden mb-4 bg-gray-100">
            <?php get_template_part('template-parts/post', 'image');?>
        </a>

        <p class="text-base">
            <?php echo get_the_date('F j, Y'); ?>
        </p>

        <h2 class="text-2xl m-0 mt-1 w-full font-body font-semibold">
            <a class="hover:underline hover:text-primary-darker break-all" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                <?php echo esc_html( get_the_title() ); ?>
            </a>
        </h2>
        <!-- 
        <a class="mt-auto font-semibold text-primary-darker underline" href="<?php the_permalink() ?>">
            Read More <span class="sr-only">(<?php the_title(); ?>)</span>
        </a> -->
    </div>
</div><!-- #post-## -->