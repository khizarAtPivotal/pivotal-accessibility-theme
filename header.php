<?php

/**
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */

$header_type = 'default';

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<?php wp_head(); ?>
	
	<script defer src="<?php echo pivotalaccessibility_assets('js/alpine-focus.min.js') ?>"></script>
	<script defer src="<?php echo pivotalaccessibility_assets('js/alpine-collapse.min.js') ?>"></script>
	<script defer src="<?php echo pivotalaccessibility_assets('js/alpine-intersect.min.js') ?>"></script>
	<script defer src="<?php echo pivotalaccessibility_assets('js/alpine.min.js') ?>"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

	<style>
		:root {
			--color-primary: #6F358F;
			--color-primary-darker: #6F358F;
			--color-secondary: #213C7F;
			--color-accent: #FFC978;
			--color-dark: #061735;
			--color-dark-green: #52821C;
			--color-red-400: #f87171;
			--color-red-300: #fca5a5;
			--color-red-700: #b91c1c;

            --color-gray-50: #f9fafb;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-300: #d1d5db;
            --color-gray-400: #9ca3af;
            --color-gray-500: #6b7280;
            --color-gray-600: #4b5563;
            --color-gray-700: #374151;
            --color-gray-800: #1f2937;
            --color-gray-900: #111827;
            --color-gray-950: #030712;

			--ease-out-expo: cubic-bezier(0.19, 1, 0.22, 1);
		}
	</style>

	<script>
		twind.install({
			hash: false,
			variants: [
				['only-sm', '@media screen and (max-width: 768px)'],
				['children', '& > *'],
				['expanded', '&[aria-expanded="true"]'],
			],
			theme: {
				container: {
					center: true,
					padding: {
						"DEFAULT": "1.5rem",
						"sm": "1.5rem",
						"md": "5rem",
						"lg": "5rem",
						"xl": "5rem",
						"2xl": "10rem",
					}
				},
				extend: {
					"colors": {
						"primary": "var(--color-primary)",
						"secondary": "var(--color-secondary)",
						"primary-darker": "var(--color-primary-darker)",
						"dark": "var(--color-dark)",
						"accent": "var(--color-accent)",
						"dark-green": "var(--color-dark-green)",
					},
					"spacing": {
						"112": "28rem",
						"128": "32rem",
						"136": "34rem",
						"144": "36rem",
						"152": "38rem",
					},
					transitionTimingFunction: {
						'in-expo': 'cubic-bezier(0.95, 0.05, 0.795, 0.035)',
						'out-expo': 'cubic-bezier(0.19, 1, 0.22, 1)',
					}
				},
				fontFamily: {
					"display": ["Playfair Display"],
					"body": ["Inter"]
				}
			},
		})
	</script>
</head>

<body <?php body_class(); ?> >

<?php wp_body_open(); ?>

<div id="page" class="site" x-clock>

	<?php get_template_part('template-parts/header', $header_type);?>
	
	<main id="content" class="site-content xl:pt-0" role="main">