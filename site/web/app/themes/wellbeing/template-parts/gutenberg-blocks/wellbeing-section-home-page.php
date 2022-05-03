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
$id = 'wellbeing_section_title' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'wellbeing_section_title';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
?>
<div class="tours-order">
    <!-- <img class="lotus-top" src="app/themes/wellbeing/images/Lotus.png"> -->
    <?php if (get_field('wellbeing_section_title')): ?>
        <div class="places-title"><h2><?php echo get_field('wellbeing_section_title'); ?></h2></div>
    <?php endif ?>
    <?php if (get_field('tours_description')): ?>
        <div class="places-description"><?php echo get_field('tours_description'); ?></div>
    <?php endif ?>
    <?php $columns_tours = get_field('columns_tours'); ?>
    <div class="container">
        <?php if (have_rows('route_post')) : ?>

            <div class="row">
                <?php while(have_rows('route_post')) : the_row(); ?>
                    <?php $add_post = get_sub_field('add_post'); ?>
                    <?php if ($add_post): ?>
                        <?php if ($columns_tours == 'three'): ?>
                            <div class="col-md-4 p-2">
                        <?php elseif($columns_tours == 'two'): ?> 
                            <div class="col-md-6 p-2">
                        <?php elseif($columns_tours == 'one'): ?> 
                            <div class="col-12 p-2">
                    <?php else: ?> 
                            <div class="col-md-6 p-2">
                    <?php endif; ?>
                                <div class="places-holder-post">
                                    <a class="show-hover-excerpt" href="<?php echo get_the_permalink($add_post->ID); ?>">
                                        <?php if ( has_post_thumbnail($add_post->ID) ) { 
                                                echo get_the_post_thumbnail($add_post->ID, 'home_page_thumb_route');
                                              }
                                              else {
                                                  echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
                                                      . '/images/no-image.jpg" />';
                                              } 
                                        ?>
                                        <div class="content-places-holder">
                                            <?php if ($add_post->post_title): ?>
                                                <h3><?php echo $add_post->post_title; ?></h3>
                                            <?php endif ?>
                                            <?php if (get_field('small_description_home_page', $add_post->ID)): ?>
                                            <p class="display-hover">
                                                <span class="show-excerpt"><?php echo get_field('small_description_home_page', $add_post->ID); ?></span>
                                            </p>
                                            <?php endif; ?>
                                            <span class="arrow-go-places lnr lnr-chevron-right"></span>

                                            
                                        </div>
                                    </a>
                                </div>
                            </div>
                    <?php endif ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php
        $link2 = get_field('show_me_button_route');
        if( $link2 ): 
            $link_url = $link2['url'];
            $link_title = $link2['title'];
            $link_target = $link2['target'] ? $link2['target'] : '_self';
            ?>
            <a class="classic-url-forest-blue" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
        
    </div>
</div>
