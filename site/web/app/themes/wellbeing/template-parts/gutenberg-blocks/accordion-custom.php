<?php

/**
 * Accordion Custom Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-custom' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'accordion-custom';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
// Load values and assign defaults.
if( have_rows('add_accordion') ): ?>
<div class="accordion-section">
    <div class="container">
        <?php while ( have_rows('add_accordion') ) : the_row();
            $title = get_sub_field('title');
            $description = get_sub_field('description');
        ?>
        <div class="acc-holder">
            <div class="acc-title">
                <h5 class="font-weight-bold"><span><?php echo $title; ?></span><span class="lnr lnr-chevron-down"></span></h5>
            </div>
            <div class="acc-description">
                <?php echo $description; ?>
            </div>
        </div>
       <?php endwhile; ?>
    </div>
</div>
<?php endif; ?>
