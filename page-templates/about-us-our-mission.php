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
        "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.",
        "items" => [
            [],
            [
                "icon" => "target-arrow",
                "subtitle" => "Lorem Ipsum",
                "title" => "Our Mission",
                "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's"
            ],
            [
                "icon" => "target-arrow",
                "subtitle" => "Lorem Ipsum",
                "title" => "Our Mission",
                "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's"
            ],
            [
                "icon" => "target-arrow",
                "subtitle" => "Lorem Ipsum",
                "title" => "Our Mission",
                "description" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's"
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
            <div class="flex flex-col justify-start items-center even:pt-44">
                <div class="flex justify-center items-center shrink-0 p-4 w-96 h-96 border-1 border-gray-300 rounded-full">
                    <div class="w-full h-full bg-primary text-white flex justify-center items-center rounded-full p-16">
                        <?php echo pivotalaccessibility_svg(esc_html($intro["items"][$i]['icon'])); ?>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</section>


<?php

get_footer();