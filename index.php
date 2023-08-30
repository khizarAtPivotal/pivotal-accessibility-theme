<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header();
?>

<div id="primary" class="content-area">
	<?php $card_type = get_theme_mod('blog_card_type', 'default'); ?>

    <div class="container flex-grow self-stretch">

    <?php if (have_posts()): ?>
        <div class="posts grid lg:grid-cols-3 gap-8 my-12 items-start">

        <?php 
            global $wp_query;

            while (have_posts()): the_post();

            get_template_part('template-parts/post-card', $card_type.get_post_format());

            endwhile;
        ?>
        </div>

    <?php 
        if($wp_query->max_num_pages > 1) {
            get_template_part('template-parts/pagination'); 
        }
    ?>

    <?php 

        else:

        get_template_part( 'template-parts/content/none');

        endif;
    ?>

    </div>
</div><!-- #primary -->


<?php
get_footer();