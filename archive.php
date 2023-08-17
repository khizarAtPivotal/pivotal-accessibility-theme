<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package lakegeorge
 */

get_header(); ?>

<div id="primary" class="content-area <?php echo lakegeorge_blog_page_classes(); ?>">
	<?php get_template_part('template-parts/hero', 'page'); ?>
	<?php get_template_part('template-parts/pages/blog/partials/main'); ?>
</div>

<?php
get_footer();