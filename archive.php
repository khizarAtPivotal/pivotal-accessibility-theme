<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pivotalaccessibility
 */

get_header(); ?>

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

		<?php if($wp_query->max_num_pages > 1): ?>
			<div class="pivotalaccessibility_pagination">

				<?php
					$args = [
						'base'		=> str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'total'		=> $wp_query->max_num_pages,
						'current'	=> max(1, get_query_var('paged')),
						'format'	=> '?paged=%#%',
						'show_all'	=> false,
						'type'		=> 'list',
						'end_size'	=> 0,
						'mid_size'	=> 2,
						'prev_next'	=> true,
						'prev_text'	=> pivotalaccessibility_svg('chevron-left'),
						'next_text'	=> pivotalaccessibility_svg('chevron-right'),
						'add_args'	=> false,
						'add_fragment' => '',
						'aria_current' => "page",
					];

					echo paginate_links($args);
				?>
			</div>

		<?php 
			endif; 

			else:

			get_template_part( 'template-parts/content/none');

			endif;
		?>

	</div>
</div>

<?php
get_footer();
