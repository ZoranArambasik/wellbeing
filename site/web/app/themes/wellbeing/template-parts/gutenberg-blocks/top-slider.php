<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-top' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'slider-top';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('slider_images') ): ?>
<div class="slide-image-and-text">
<div class="slide-images">
    <?php
    while ( have_rows('slider_images') ) : the_row();
        $image = get_sub_field('slider_img'); 
        ?>
        <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
            <div class="header-image">
                <?php
                        echo "<img src='" .$image. "' alt='Slide Image'>";
 
                 ?>
                <div class="container">
                    <div class="slider-text">
                        <div class="small-text"><?php the_sub_field('slider_small_text'); ?></div>
                    </div>
                </div>
            </div> 
        </div>

   <?php endwhile; ?>
</div>
<img class="lotus-bottom" src="<?php bloginfo('template_directory') ?>/images/Lotus.png">
<?php   
endif;
?>
</div>