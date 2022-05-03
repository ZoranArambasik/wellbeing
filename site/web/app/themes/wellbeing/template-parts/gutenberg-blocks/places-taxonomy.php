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
$id = 'places-taxonomy' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'places-taxonomy';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div class="places-order">
    <!-- <img class="lotus-top" src="app/themes/wellbeing/images/Lotus.png"> -->
    <?php if (get_field('places_title')): ?>
        <div class="places-title"><h2><?php echo get_field('places_title'); ?></h2></div>
    <?php endif ?>
    <?php if (get_field('places_description')): ?>
        <div class="places-description"><?php echo get_field('places_description'); ?></div>
    <?php endif ?>
    <div class="container">
        <div class="row">
        <?php if (have_rows('places_post')) : ?>
                <div class="col-md-4 p-2">
                    <div class="places-holder-post places-holder-post-first">
                    <?php $add_post_first = get_field('add_post_first'); ?>
                    <?php if ($add_post_first): ?>
                        <a class="show-hover-excerpt" href="<?php echo $add_post_first->post_name; ?>">
                            <?php echo has_post_thumbnail($add_post_first) ? get_the_post_thumbnail($add_post_first->ID, 'large') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                            <div class="content-places-holder">
                                <?php 
                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( $add_post_first->ID ) ));
                                // var_dump($taxonomies);
                                foreach ($taxonomies as $taxonomy) {
                                    // var_dump($taxonomy);
                                    $terms = get_the_terms( $add_post_first->ID, $taxonomy );;
                                    if (!empty($terms)) {
                                        foreach ($terms as $term) {
                                            $image = get_field('add_tax_icon', $term);
                                            if (!empty($image)) {
                                                echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                            }       
                                        } 
                                    }  
                                } ?>
                                <?php if ($add_post_first->post_title): ?>
                                    <h3><?php echo $add_post_first->post_title; ?></h3>
                                <?php endif; ?>

                                    <?php if (get_field('small_description_home_page', $add_post_first->ID)): ?>
                                    <p class="display-hover">
                                        <span class="show-excerpt"><?php echo get_field('small_description_home_page', $add_post_first->ID); ?></span>
                                    </p>
                                    <?php endif; ?>
                                    <span class="arrow-go-places lnr lnr-chevron-right"></span>
                            </div>
                        </a>
                    <?php endif ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <?php while(have_rows('places_post')) : the_row(); ?>
                            <div class="col-md-6 p-2">
                                <div class="places-holder-post">
                                    <?php $add_post = get_sub_field('add_post'); ?>
                                    <?php if ($add_post): ?>
                                        <a class="show-hover-excerpt" href="<?php echo $add_post->post_name; ?>">
                                            <?php echo has_post_thumbnail($add_post) ? get_the_post_thumbnail($add_post->ID, 'large') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                                            <div class="content-places-holder">
                                                <?php global $post; ?>
                                                <?php 
                                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( $add_post->ID ) ));
                                                // var_dump($taxonomies);
                                                foreach ($taxonomies as $taxonomy) {
                                                    // var_dump($taxonomy);
                                                    $terms = get_the_terms( $add_post->ID, $taxonomy );;
                                                    if (!empty($terms)) {
                                                        foreach ($terms as $term) {
                                                            $image = get_field('add_tax_icon', $term);
                                                            if (!empty($image)) {
                                                                echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                                            }       
                                                        } 
                                                    }  
                                                } ?>
                                                    
                                                <?php if ($add_post->post_title): ?>
                                                    <h3><?php echo $add_post->post_title; ?></h3>
                                                <?php endif; ?>

                                                <?php if (get_field('small_description_home_page', $add_post->ID)): ?>
                                                <p class="display-hover">
                                                    <span class="show-excerpt"><?php echo get_field('small_description_home_page', $add_post->ID); ?></span>
                                                </p>
                                                <?php endif; ?>
                                                <span class="arrow-go-places lnr lnr-chevron-right"></span>
                                            </div>
                                        </a>
                                    <?php endif ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
        $link2 = get_field('show_me_button');
        if( $link2 ): 
            $link_url = $link2['url'];
            $link_title = $link2['title'];
            $link_target = $link2['target'] ? $link2['target'] : '_self';
            ?>
            <a class="classic-url-pink" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
        
    </div>
    <img class="lotus-bottom" src="<?php bloginfo('template_directory') ?>/images/Lotus.png">
</div>
