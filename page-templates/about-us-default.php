<?php
/**
 * Template Name: About Us - Default
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package Pivotal Accessibility
 */

get_header();

$data = [
    'intro' => [
        'subtitle' => 'We are here for you',
        'title' => 'Styling Is Our Number One Priority',
        'description' => "
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>

            <p> It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
            
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p> 
        ",
        "images" => [
            ["url" => "https://c.pxhere.com/photos/f1/63/store_clothes_clothing_line_fashion_retail_clothing_store_shop-633917.jpg!d"],
            ["url" => "https://c.pxhere.com/photos/33/f9/dresses_apparel_clothing_clothes_clothes_hangers_wooden_hangers_retail_shop_closet-1149845.jpg!d"],
            ["url" => "https://c.pxhere.com/photos/33/5e/shopping_happy_customers_young_woman_young_man_retail_shop_consumer_store-807554.jpg!d"],
        ]
    ],
];

?>

<section class="my-16">
    <div class="grid grid-cols-2 container">
        <div class="pr-16 flex flex-col justify-start items-end">
            <img class="w-80 h-52 rounded-lg object-cover" src="<?php echo esc_url($data["intro"]["images"][0]["url"]); ?>" alt="" />
            <img 
                class="w-80 h-60 rounded-lg object-cover -mt-16 mr-36" 
                src="<?php echo esc_url($data["intro"]["images"][1]["url"]); ?>" alt="" 
            />
            <img 
                class="w-80 h-72 rounded-lg object-cover -mt-32" 
                src="<?php echo esc_url($data["intro"]["images"][2]["url"]); ?>" alt="" 
            />
        </div>

        <div>
            <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($data['intro']['subtitle']); ?></p>
            <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($data['intro']['title']); ?></h2>
            <div class="prose">
                <?php echo wp_kses_post($data['intro']['description']); ?>
            </div>
        </div>
    </div>
</section>

<?php

get_footer();