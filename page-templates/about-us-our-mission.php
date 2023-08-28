<?php
/**
 * Template Name: About Us - Our Mission
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Pivotal Accessibility
 */

get_header();

$data = [
    "intro" => [
        "subtitle" => "Lorem Ipsum is simply",
        "title" => "Our Mission & Vision",
        "description" => "Welcome to our mission webpage, where we proudly showcase our commitment to making a positive impact on the world through three distinct and impactful missions. With a focus on innovation, collaboration, and sustainable solutions, we are dedicated to addressing some of the most pressing challenges of our time. Explore our missions below to learn more about our objectives, strategies, and the progress we've made.",
        "items" => [
            [],
            [
                "icon" => "target-arrow",
                "subtitle" => "Empowerment through Knowledge",
                "title" => "Education",
                "description" => "Our first mission is to empower individuals worldwide by providing access to quality education. We believe that education is the cornerstone of personal and societal development."
            ],
            [
                "icon" => "database-dollar",
                "subtitle" => "Safeguarding Our Planet",
                "title" => "Environmental",
                "description" => "Our efforts have contributed to cleaner air and water, the protection of endangered species, and the adoption of sustainable practices by businesses and individuals alike."
            ],
            [
                "icon" => "users-group",
                "subtitle" => "Building Healthy Communities",
                "title" => "Health",
                "description" => "Our third mission revolves around ensuring access to quality healthcare and promoting overall well-being."
            ]
        ]
    ]
];

$intro = pivotalaccessibility_get_field('intro', $data["intro"]);

?>

<section class="about-us--our-mission my-16">
    <div class="container">
        <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($intro['subtitle']); ?></p>
        <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($intro['title']); ?></h2>
        <div class="prose"><?php echo wp_kses_post($intro['description']); ?></div>
    </div>

    <div class="about-us--our-mission__items container grid lg:grid-cols-3 mt-10">
        <?php for ($i = 1; $i < count($intro["items"]); $i++): ?>
            <div class="flex flex-col justify-start items-center even:pt-40">
                <div class="relative flex justify-center items-center shrink-0 p-4 shadow-md w-80 h-80 border-1 border-gray-300 rounded-full">
                    <div class="w-full h-full bg-primary text-white flex justify-center items-center rounded-full p-16">
                        <?php echo pivotalaccessibility_svg(esc_html($intro["items"][$i]['icon'])); ?>
                    </div>
                </div>

                <div class="relative w-1.5 bg-primary -mt-6 <?php echo $i % 2 == 0 ? 'h-40' : 'h-80'  ?>">
                    <div class="absolute top-full -mt-2 w-4 h-4 rounded-full bg-primary left-1/2 -translate-x-1/2"></div>
                </div>

                <div class="mt-12 flex flex-col text-center px-8">
                    <p class="font-semibold text-primary text-lg"><?php echo esc_html($intro["items"][$i]['subtitle']); ?></p>
                    <h3 class="text-4xl mt-1 mb-3"><?php echo esc_html($intro["items"][$i]['title']); ?></h3>
                    <p><?php echo wp_kses_post($intro["items"][$i]['description']); ?></p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>


<?php

get_footer();