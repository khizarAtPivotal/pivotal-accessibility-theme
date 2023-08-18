<?php

$prev_link = get_previous_post_link('%link');
$next_link = get_next_post_link('%link');

?>

<ul class="list-none m-0 p-0 flex justify-between items-center flex-wrap lg:flex-nowrap gap-4 bg-background-900 my-4 mt-8 w-full">
    <?php if($prev_link): ?>
        <li class="w-full lg:w-1/2 lg:flex-grow">
            <p class="flex justify-start items-center font-sm opacity-75 mb-1 gap-2">
                <span class="w-5 h-auto flex justify-start item-center">
                    <?php echo pivotalaccessibility_svg('tabler-icons/chevron-left'); ?>
                </span> 
                
                <?php esc_html_e('Previous', 'pivotalaccessibility'); ?>
            </p>
            <span class="text-underline font-semibold text-primary-darker">
                <?php echo previous_post_link('%link'); ?>
            </span>
        </li>
    <?php endif; ?>

    <?php if($next_link): ?>
        <li class="w-full lg:w-1/2 lg:flex-grow text-right">
            <p class="flex justify-end items-center font-sm opacity-75 mb-1 gap-2">
                <?php esc_html_e('Next', 'pivotalaccessibility'); ?>

                <span class="w-5 h-auto flex justify-end item-center">
                    <?php echo pivotalaccessibility_svg('tabler-icons/chevron-right'); ?>
                </span>
            </p>
            <span class="text-underline font-semibold text-primary-darker">
                <?php next_post_link('%link'); ?>            
            </span>
        </li>
    <?php endif; ?>
</ul>
