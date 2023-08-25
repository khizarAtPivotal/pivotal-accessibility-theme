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
            [],
            ["url" => "https://c.pxhere.com/photos/f1/63/store_clothes_clothing_line_fashion_retail_clothing_store_shop-633917.jpg!d"],
            ["url" => "https://c.pxhere.com/photos/33/f9/dresses_apparel_clothing_clothes_clothes_hangers_wooden_hangers_retail_shop_closet-1149845.jpg!d"],
            ["url" => "https://c.pxhere.com/photos/33/5e/shopping_happy_customers_young_woman_young_man_retail_shop_consumer_store-807554.jpg!d"],
        ]
    ],
    'logos' => [
        'title' => 'We are also on',
        'images' => [
            [],
            ["url" => pivotalaccessibility_assets('images/amazon-logo.png')],
            ["url" => pivotalaccessibility_assets('images/flipkart.png')],
            ["url" => pivotalaccessibility_assets('images/myntra.png')],
            ["url" => pivotalaccessibility_assets('images/ajio.png')],
        ]
    ],
    'testimonials' => [
        'subtitle' => 'It supports you',
        'title' => 'Preparing For Your Trust And Confidence!',
        'items' => [
            [
                'name' => 'Rodney J. Sabo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.',
                'image' => [
                    "url" => "https://i.pravatar.cc/400?img=69"
                ]
            ],
            [
                'name' => 'Rodney J. Sabo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.',
                'image' => [
                    "url" => "https://i.pravatar.cc/400?img=69"
                ]
            ],
            [
                'name' => 'Rodney J. Sabo',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.',
                'image' => [
                    "url" => "https://i.pravatar.cc/400?img=69"
                ]
            ]
        ]
    ],
    'features' => [
        'subtitle' => 'Who we are',
        'title' => 'We Provide All Types Of Fabric',
        'description' => 'Sed ut perspiciatis unde omnis iste natus voluptatem accusantium doloremque laudantium, totam rem aperiam eaque quae ainventore veritatis et quasi architecto beatae vitae dicta sunte.',
        'image' => [
            "url" => "https://c.pxhere.com/photos/e0/36/cravat_tie_clothing_suit_business_fashion_formal_professional-848646.jpg!d"
        ],
        'items' => [
            [
                'title' => 'Organic Fabric',
                'icon' => 'dna-2',
                'url' => '#'
            ],
            [
                'title' => 'Latest Design',
                'icon' => 'article',
                'url' => '#'
            ],
            [
                'title' => 'All Size Available',
                'icon' => 'ruler-2',
                'url' => '#'
            ],
            [
                'title' => 'Variety Of Fabric',
                'icon' => 'icons',
                'url' => '#'
            ]
        ]
    ],
];

$intro = pivotalaccessibility_get_field('intro', $data["intro"]);
$logos = pivotalaccessibility_get_field('logos', $data["logos"]);

?>

<section class="my-16">
    <div class="grid grid-cols-2 container">
        <div class="pr-16 flex flex-col justify-start items-end">
            <img 
                class="w-80 h-52 rounded-lg object-cover shadow-xl" 
                src="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["1"], "url")); ?>" 
                alt="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["1"], "alt")); ?>" 
            />
            <img 
                class="w-80 h-60 rounded-lg object-cover shadow-xl -mt-16 mr-36" 
                src="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["2"], "url")); ?>" 
                alt="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["2"], "alt")); ?>" 
            />
            <img 
                class="w-80 h-72 rounded-lg object-cover shadow-xl -mt-32" 
                src="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["3"], "url")); ?>" 
                alt="<?php echo esc_url(pivotalaccessibility_get_image_field($intro["images"]["3"], "alt")); ?>" 
            />
        </div>

        <div>
            <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($intro['subtitle']); ?></p>
            <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($intro['title']); ?></h2>
            <div class="prose"><?php echo wp_kses_post($intro['description']); ?></div>
        </div>
    </div>
</section>

<section>
    <div class="container -mb-16 relative z-10">
        <div class="bg-white border-1 border-gray-300 py-8 px-16 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold text-center mb-6">
                <?php echo esc_html($logos['title']); ?>
            </h2>

            <div class="flex justify-center items-center flex-wrap gap-8">
                <img class="w-36 h-auto" src="<?php echo esc_url($logos["images"]["1"]['url']) ?>" alt="">
                <img class="w-36 h-auto" src="<?php echo esc_url($logos["images"]["2"]['url']) ?>" alt="">
                <img class="w-36 h-auto" src="<?php echo esc_url($logos["images"]["3"]['url']) ?>" alt="">
                <img class="w-36 h-auto" src="<?php echo esc_url($logos["images"]["4"]['url']) ?>" alt="">
            </div>
        </div>
    </div>

    <div class="bg-primary w-full relative z-0 py-16">
        <div class="container text-white flex flex-col justify-center items-center">
            <p class="mt-16 mb-2 text-2xl font-semibold">
                <?php echo esc_html($data['testimonials']['subtitle']); ?>
            </p>
            <h2 class="text-4xl">
                <?php echo esc_html($data['testimonials']['title']); ?>
            </h2>
        </div>

        <div class="container">
            <div class="embla flex justify-center items-center mt-4 gap-8">
                <button class="embla__prev w-20 h-20 flex justify-center items-center p-4 text-white transition-all duration-500 ease-out-expo rounded-full disabled:bg-transparent disabled:opacity-50 disabled:text-white hover:bg-[#ffffff0d]">
                    <?php echo pivotalaccessibility_svg('chevron-left'); ?>
                </button>

                <div class="embla__viewport w-112">
                    <div class="embla__container gap-4">
                        <?php foreach ($data["testimonials"]["items"] as $index => $testimonial): ?>
                            <div class="embla__slide bg-white p-8 rounded-lg flex justify-center items-center">
                                <div class="relative w-20 h-20 bg-gray-100 rounded-full shrink-0 mr-4 overflow-hidden">
                                    <img 
                                        class="absolute w-full h-full rounded-full" 
                                        src="<?php echo esc_html($testimonial['image']['url']); ?>" 
                                        alt="">
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-primary">
                                        <?php echo esc_html($testimonial['name']); ?>
                                    </h3>
                                    <p>
                                        <?php echo esc_html($testimonial['description']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button class="embla__next w-20 h-20 flex justify-center items-center p-4 text-white transition-all duration-500 ease-out-expo rounded-full disabled:bg-transparent disabled:opacity-50 disabled:text-white hover:bg-[#ffffff0d]">
                    <?php echo pivotalaccessibility_svg('chevron-right'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="my-16">
    <div class="container grid lg:grid-cols-2">
        <div class="lg:pr-16">
            <p class="mb-2 text-xl text-primary font-semibold"><?php echo esc_html($data['features']['subtitle']); ?></p>
            <h2 class="text-6xl mb-5 text-gray-900"><?php echo esc_html($data['features']['title']); ?></h2>
            <p><?php echo esc_html($data['features']['description']); ?></p>

            <div class="grid lg:grid-cols-4 mt-8 gap-4">
                <?php foreach ($data["features"]["items"] as $index => $feature): ?>
                    <a 
                        class="group border-1 border-primary rounded-lg py-4 px-6 flex flex-col justify-center items-center gap-2 text-center transition-all duration-400 ease-out-expo hover:(bg-primary-100)" 
                        href="<?php echo esc_url($feature['url']); ?>">
                        <span class="flex justify-center items-center w-8 h-8 bg-primary text-white rounded-full p-2 transition-all duration-400 ease-out-expo">
                            <?php echo pivotalaccessibility_svg(esc_html($feature['icon'])); ?>
                        </span>
                        <p class="text-base font-semibold">
                            <?php echo esc_html($feature['title']); ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <img src="<?php echo esc_html($data['features']['image']['url']); ?>" alt="">
        </div>
    </div>
</section>

<?php

get_footer();