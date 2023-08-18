<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pivotalaccessibility
 */

get_header(); ?>

<div class="flex justify-center items-center px-page py-28 min-h-[var(--hero-height)]">
	<div class="flex flex-col justify-center items-center">
		<h1 class="text-9xl m-0 text-center leading-none text-gray-600">
			<?php esc_html_e('404', 'pivotalaccessibility'); ?>
		</h1>

		<p class="text-2xl text-text-900 opacity-75 m-0">
			<?php esc_html_e('Page not found', 'pivotalaccessibility'); ?>
		</p>
		
		<a href="<?php echo esc_url( home_url() ); ?>" class="button button--primary mt-10">
			<?php esc_html_e('Go to homepage', 'pivotalaccessibility'); ?>
		</a>
	</div>
</div>

<?php
get_footer();
