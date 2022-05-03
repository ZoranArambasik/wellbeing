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
$id = 'page-slider' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'page-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('slide_page_image') ): ?>
<div class="page-slide-images">
    <div class="container">
        <div class="top-descr-slider">
            <?php echo get_field('top_slider_descriptiopn'); ?>
        </div>
        <div class="pages-slider-holder">
            <div class="pages-slider">
                <?php
                while ( have_rows('slide_page_image') ) : the_row();
                    $image = get_sub_field('add_image'); 
                    ?>
                    <div class="page-sl-image">
                        <?php
                            echo "<img src='" .$image. "' alt='Slide Image'>";
                         ?>
                    </div> 
               <?php endwhile; ?>
            </div>
            <div class="small-prev"></div>
            <div class="small-next"><span class="arrow-go-places lnr lnr-chevron-right"></span></div>
        </div>
       <div class="bottom-descr-slider">
           <?php echo get_field('description_below_slider'); ?>
       </div>
    </div>
</div>
<?php   
endif;
?>
