<?php
/**
 * Template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package LakeGeorge
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<h1><?php the_title(); ?></h1>
	<div class="entry-content prose">
		<?php
			the_content(
				sprintf(
					wp_kses(
						__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'lakegeorge'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'lakegeorge'),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php get_template_part('template-parts/content/partials/tags'); ?>
	<?php get_template_part('template-parts/post/partials/author', null, ["type" => "post"]); ?>
</article><!-- #post-## -->
