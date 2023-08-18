<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (isset($args)) {
    extract($args);
}

?>

<section class="pivotalaccessibility_empty-state">
  <div class="pivotalaccessibility_empty-state__svg">
    <?php echo pivotalaccessibility_svg('misc/empty-state'); ?>
  </div>

  <p class="pivotalaccessibility_empty-state__title" role="status">
    <?php echo esc_attr($title) ?: __('Nothing found', 'pivotalaccessibility'); ?>
  </p>
</section>