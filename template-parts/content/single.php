<?php
/**
 * Template part for displaying content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pivotalaccessibility
 */

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
	<div class="relative h-96 flex flex-start items-stretch gap-4 mb-8 overflow-hidden">
		<div class="absolute inset-0 self-stretch bg-[#000000BF] text-white py-16 px-16 rounded-2xl">
			<h1 class="mb-4">
				<?php the_title(); ?>
			</h1>
		</div>

		<?php if(get_post_thumbnail_id()): ?>
			<div class="h-full w-full rounded-2xl overflow-hidden">
				<?php get_template_part('template-parts/post-image'); ?>
			</div>
		<?php endif; ?>
	</div>
	
	<?php get_template_part('template-parts/content/partials/categories'); ?>

	<div class="entry-content prose">
		<?php
			the_content(
				sprintf(
					wp_kses(
						__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'pivotalaccessibility'),
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
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'pivotalaccessibility'),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php get_template_part('template-parts/content/partials/tags'); ?>
	<?php get_template_part('template-parts/post/partials/author', null, ["type" => "post"]); ?>
</article><!-- #post-## -->
