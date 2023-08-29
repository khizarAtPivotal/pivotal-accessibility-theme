<?php
/**
 * Template Name: Team
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Pivotal Accessibility
 */

get_header();

$data = [
    'intro' => [
        'subtitle' => 'We are here for you',
        'title' => 'Our Team',
        'description' => "Welcome to the beating heart of our organization—the dedicated individuals who form the backbone of our NGO. Our team is a diverse tapestry woven together by a shared passion for creating positive change. From our leaders to our volunteers, each member brings unique skills, perspectives, and unwavering dedication to our mission.",
        "image" => ["url" => "https://c.pxhere.com/photos/75/9f/workplace_team_business_meeting_business_people_business_teamwork_office_people-559565.jpg!d"],
        "cta" => [
            "url" => "#",
            "title" => "Learn More"
        ]
    ],
    'members' => [
        'subtitle' => 'Together, We Are Change',
        'title' => 'Growing People Happy And Together',
        'description' => 'Our leadership team comprises individuals who have brought their experience and expertise to guide us toward our goals. Their strategic thinking, dedication, and ability to inspire others drive our projects and initiatives forward.',
        'items' => [
            ['name' => 'Jacob Jones', 'role' => 'Lead Manager'],
            ['name' => 'Jenny Wilson', 'role' => 'Manager'],
            ['name' => 'Kristin Waston', 'role' => 'Management'],
            ['name' => 'Jacob Jones', 'role' => 'Lead Manager'],
        ]
    ],
];

$intro = pivotalaccessibility_get_field('intro', $data["intro"]);
$members = pivotalaccessibility_get_field('members', $data["members"]);

$team_posts = new WP_Query([
    'post_type' => 'member',
    'posts_per_page' => 4,
]);

?>


<section class="my-16">
    <div class="grid grid-cols-2 container">
        <div class="pr-16 flex flex-col justify-start items-end">
            <img 
                class="w-full h-96 self-stretch rounded-lg object-cover" 
                src="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["image"], "url")); ?>" 
                alt="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["image"], "alt")); ?>" 
            />
        </div>

        <div>
            <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($intro['subtitle']); ?></p>
            <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($intro['title']); ?></h2>
            <div class="prose"><?php echo wp_kses_post($intro['description']); ?></div>
            <a class="button button--primary mt-8" href="<?php echo esc_html($intro['cta']['url']); ?>">
                <?php echo esc_html($intro['cta']['title']); ?>
            </a>
        </div>
    </div>
</section>

<section class="my-20">
    <div class="container text-center">
        <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($members['subtitle']); ?></p>
        <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($members['title']); ?></h2>
        <p><?php echo wp_kses_post($members['description']); ?></p>
    </div>

    <div class="container mt-8">
        <div class="grid lg:grid-cols-4 gap-10">
            <?php if ($team_posts->have_posts()) : $index = 0; ?>
                <?php while ($team_posts->have_posts()) : $team_posts->the_post(); ?>
                    <?php
                        $role = pivotalaccessibility_get_field('role', 'Member');
                    ?>
                    <div>
                        <a href="<?php the_permalink(); ?>" class="flex w-full h-80 rounded-xl overflow-hidden mb-2">
                            <?php get_template_part('template-parts/post-image'); ?>
                        </a>
                        <h3 class="text-2xl"><?php the_title(); ?></h3>
                        <p class="text-primary"><?php echo esc_attr($role); ?></p>
                    </div>
                <?php $index++; endwhile; ?>
            <?php endif; wp_reset_postdata(); ?>
        </div>

        <div class="mt-8 flex justify-center items-center">
            <a class="button button--primary" href="/team">View All</a>
        </div>
    </div>
</section>



<?php

get_footer();