<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if ($args) {
  extract($args);
}

?>

<form 
    class="search-form flex justify-end items-center bg-gray-100 border-1 border-gray-900 rounded-full" 
    role="search" 
    method="get" 
    action="<?php echo esc_url(home_url('/')); ?>">
    <label class="group relative">
        <span class="block text-gray-900 text-base mb-1 font-normal pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 transition-all duration-500 ease-out-expo group-focus-within:-translate-x-4 group-focus-within:-translate-y-10 group-focus-within:scale-75 group-focus-within:font-semibold group-focus-within:text-gray-900">
            <?php echo esc_html__('Search for:', 'pivotalaccessibility'); ?>
        </span>
        <input type="search" class="search-field bg-transparent border-none outline-none rounded-full" value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit h-10 w-10 p-3 flex justify-center items-center">
        <?php echo pivotalaccessibility_svg('search'); ?>
    </button>
</form>