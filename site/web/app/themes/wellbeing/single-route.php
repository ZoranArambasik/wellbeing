<?php get_header(); ?>
<div class="singles-image route-single-image">
    <?php if ( has_post_thumbnail() ) { 
          the_post_thumbnail('route_head_image');
          }
          else {
              echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
                  . '/images/no-image.jpg" />';
          } 
    ?>
    <div class="container">
        <div class="singles-text routes-singles">
            <div class="absolute-bottom"><h1><?php echo the_title(); ?></h1></div>
        </div>
    </div>
    <img class="lotus-bottom lotus-route" src="<?php bloginfo('template_directory') ?>/images/lotus-white.png">
</div>
<?php
$small_description_routes = get_field('small_description_routes');
$transport_options = get_field('transport_options');
$specification_right = get_field('specification_right');
?>
<?php if ($small_description_routes || $specification_right): ?>
    <div class="routes-top-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 pr-5 small-desc-routes-left">
                    <?php echo get_field('small_description_routes'); ?>
                </div>
                <div class="col-md-4 small-desc-routes-right">
                    <?php if ($transport_options): ?>
                        <div class="check-transportation">
                            <?php if(in_array('By Foot', $transport_options)): ?>
                                <img src="<?php bloginfo('template_directory') ?>/images/hike-41.png">
                            <?php endif; ?>
                            <?php if(in_array('By Bike', $transport_options)): ?>
                                <img src="<?php bloginfo('template_directory') ?>/images/Bike41orange.png">
                            <?php endif; ?>
                            <?php if(in_array('By Bus', $transport_options)): ?>
                                <img src="<?php bloginfo('template_directory') ?>/images/Bus41orange.png">
                            <?php endif; ?>
                            <?php if(in_array('By Car', $transport_options)): ?>
                                <img src="<?php bloginfo('template_directory') ?>/images/Car41orange.png">
                            <?php endif; ?>
                        </div>
                    <?php endif ?>

                    <?php if (have_rows('specification_right')): 
                        while (have_rows('specification_right')): the_row();
                        echo '<p>' . get_sub_field('add_specification') . '</p>';
                    ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

    

<div class="routs-main-content">
    <div class="container">

        <?php
        $routes_main_title = get_field('routes_main_title');
        if ($routes_main_title) {
             echo "<h2 class='routes_main_title'>" . $routes_main_title . '</h2>';
         } 
        // USED FOR DISPLAYING BOTH COMPANIES AND PLACES
        $select_place = get_field('select_place_and_add_activity');
        $get_places_number = count($select_place);
        if (have_rows('select_place_and_add_activity')): $i=1; 
            while (have_rows('select_place_and_add_activity')): the_row(); ?>
                <?php $place = get_sub_field('select_places_for_this_route'); ?>

               <?php if ($place) :  ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="routs-thumbs">
                            <a href="<?php echo get_the_permalink($place->ID); ?>">
                                <?php echo has_post_thumbnail($place->ID) ? get_the_post_thumbnail($place->ID, 'home_page_thumb_route') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                            </a>
                            <div class="content-places-holder">
                                <?php 
                                $terms = get_the_terms( $place->ID, 'main_category' );
                                if (!empty($terms)) {
                                    foreach ($terms as $term) {
                                        $image = get_field('add_tax_icon', $term);
                                        if (!empty($image)) {
                                            echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                        }       
                                    } 
                                }  
                                ?>
                            </div>
                        </div>
                        <div class="routes-tax-title"><h2><?php echo get_the_title($place->ID); ?></h2></div>
                        <div class="post-text-routes">
                            <?php 
                            $place_description = get_field('summary_introduction_text', $place->ID);
                                if ($place_description) {
                                    //$pos = strpos($place_description, ' ', 300);
                                    //if ($pos !== false) {
                                        echo '<div class="from-single-route-small-description">' . strip_tags($place_description) . '</div>';
                                    //}
                                }  
                            ?>
                            <div class="admin-about-activities">
                                <?php if (get_sub_field('time_for_the_activities')): ?>
                                    <div class="activity-time">
                                        <p class="activity-title"><?php _e('Activity', 'Wellbeing'); ?></p><p class="time-for-activities"><i class="far fa-clock"></i> <?php echo get_sub_field('time_for_the_activities'); ?> </p>
                                    </div>
                                <?php endif ?>
                                <?php echo get_sub_field('activiity_for_selected_place_in_the_route', $place->ID); ?>
                                <?php $pdf_icon_and_text = get_sub_field('pdf_icon_and_text'); ?>
                                <?php if ($pdf_icon_and_text): ?>
                                    <p class="pdf-icon-and-text"><a target="_blank" href="<?php echo $pdf_icon_and_text['url']; ?>"><img alt="PDF Download Image" src="<?php bloginfo('template_directory') ?>/images/ic_download.png"> <span><?php echo $pdf_icon_and_text['title']; ?></span></a></p>
                                <?php endif; ?>

                                <?php if (have_rows('more_pdfs_route')): 
                                    while (have_rows('more_pdfs_route')): the_row(); ?>
                                        <?php $pdf_icon_and_text_repeat = get_sub_field('add_new_pdf_route'); ?>
                                        <?php if ($pdf_icon_and_text_repeat): ?>
                                            <p class="pdf-icon-and-text"><a target="_blank" href="<?php echo $pdf_icon_and_text_repeat['url']; ?>"><img alt="PDF Download Image" src="<?php bloginfo('template_directory') ?>/images/ic_download.png"> <span><?php echo $pdf_icon_and_text_repeat['title']; ?></span></a></p>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>


                                <?php $link_r = get_sub_field('add_custom_url');
                                if ($link_r) {
                                    $link_url_r = $link_r['url'];
                                    $link_title_r = $link_r['title'];
                                    $link_target_r = $link_r['target'] ? $link_r['target'] : '_self'; ?>
                                    <p class="custom-route-link">
                                        <a href="<?php echo esc_url( $link_url_r ); ?>" target="<?php echo esc_attr( $link_target_r ); ?>">
                                       <img alt="Custom Link Image" src="<?php bloginfo('template_directory'); ?>/images/ic_link.png">
                                       <span><?php echo $link_title_r; ?></span></a>
                                    </p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php        
                        if ($i == 1) {
                            $marker_icon_multi = '/app/themes/wellbeing/images/marker-1.png';                      
                        } 
                        else {
                            $marker_icon_multi = '/app/themes/wellbeing/images/marker-small.png';
                        }
                    ?>
                    <?php 
                        if( get_field('add_icon_or_default', $place->ID) ){
                            $marker_icon = get_field('add_icon_or_default', $place->ID);                      
                        } 
                        else {
                            $marker_icon = '/app/themes/wellbeing/images/marker-medium.png';
                        }

                    ?>
                    <div class="col-md-4 mc">
                        <?php 
                            $location = get_field('google_map', $place->ID);
                            if( $location ): ?>  
                            <div class="maps-in-post" data-zoom="12">
                                <div class="marker-single" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-title="<?php echo get_the_title($place->ID); ?>" data-icon="<?php echo $marker_icon ?>">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="below-single-route-map">
                            <p class="map-adress map-address-s-route">
                                <img src="<?php bloginfo('template_directory') ?>/images/map.png"><span><?php echo $location["address"]; ?></span>
                            </p>
                        </div>

                        <div class="full-width"><a class="classic-url-orange" href="<?php echo get_the_permalink($place->ID); ?>">

                            <?php 
                                if ($place->post_type =='places') {
                                    _e('Go to place', 'Wellbeing');
                                }
                                elseif ($place->post_type == 'company') {
                                    _e('Go to company', 'Wellbeing');
                                }
                                else {
                                    _e('Go to trail', 'Wellbeing');
                                }

                            ?>
                            </a></div>

                    
                     
                        <?php if ($get_places_number !== $i): ?>
                            <!-- <div class="map-connector"></div> -->
                        <?php endif ?>
                    </div>
                    <?php $thumb = has_post_thumbnail($place->ID) ? get_the_post_thumbnail($place->ID, 'home_page_thumb_route') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                    <?php $output_map[$place->ID]['map'] = 
                        '<div style="display:none;" class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'" data-icon="'.$marker_icon_multi.'" data-title="'. get_the_title($place->ID).'">
                            <div class="in-marker-holder-post">
                                <a href="'.get_the_permalink($place->ID).'">
                                    '.$thumb.'
                                    <div class="favorite-in-map">' . do_shortcode('[favorite_button]') .'</div>
                                    <div class="marker-content-holder">
                                        <div class="marker-title-address">
                                            <p class="marker-title-post">'.get_the_title($place->ID).'</p>
                                            <p class="marker-address-post">'.$location['address'].'</p>
                                        </div>
                                       <span class="arrow-go-places lnr lnr-chevron-right"></span>
                                    </div>
                                </a>
                            </div>
                        </div>'; ?>
                <?php endif; ?>
            </div>
            <?php $i++; endwhile;  wp_reset_postdata(); ?>
        <?php endif; ?>       
<!-- WE START WITH LOOPING THROUGH ROUTES BUT WITH A -->
        <div class="acf-map-route">
            <?php
            foreach( $output_map as $key => $map_marker ): ?>
                <?php echo $map_marker['map']; ?>
            <?php endforeach; ?>  
        </div>

        <?php if (have_rows('how_to_get_around')) : ?>
            <?php $how_to_get = get_field('how_to_get_around'); ?>
            
            <?php while(have_rows('how_to_get_around')) : the_row(); ?>
                <?php $title = get_sub_field('title');
                    $desc = get_sub_field('description'); 
                    $subtitle = get_sub_field('subtitle');
                    $description_subtitle = get_sub_field('description_subtitle');
                    $transport_main_title = get_sub_field('transport_main_title');
                ?>
                <?php if ($title || $desc || $how_to_get['additional_transport_information']['title'] || $how_to_get['additional_transport_information']['description'] || $how_to_get['additional_transport_information']['button']): ?>
                <div class="col-12 with-bottom-border sm-padding mint-green">
                    <div class="how-to-get-around-holder">
                        <?php 
                            echo '<h4 class="how-to-get-around">' . $title . '</h4>';
                            echo '<div class="desc">' . $desc . '</div>';
                            echo '<h5 class="how_subtitle large-h5">' . $subtitle . '</h5>';
                            echo '<div class="description_subtitle">' . $description_subtitle . '</div>';
                        ?>
                    </div>
                    <?php if ($transport_main_title): ?>
                        <h5 class="large-h5 transport-title"><?php echo $transport_main_title; ?></h5>
                    <?php endif ?>
                    <div class="row">
                    <!-- BIKE TRANSPORT -->
                    <?php while (have_rows('transport_options_bike')) : the_row(); ?>
                        <!-- <div class="row"> -->
                            <?php while(have_rows('by_bike')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title bike-green">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/bike-green.png" alt="Bike">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Bike', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                            <?php while(have_rows('by_electric_bike')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title bike-green">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/electric-bike.png" alt="Electrical Bike">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Electric bike', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                        <!-- </div> -->
                    <?php endwhile; ?>
                    <!-- PUBLIC TRANSPORT -->
                    <?php while (have_rows('transport_options_public')) : the_row(); ?>
                        <!-- <div class="row"> -->
                            <?php while(have_rows('electric_public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title bus-grey">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/electric-public-transport.png" alt="Electric Public Transport">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Electric public transport', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else:?> 
                                                            <span class="additional_impact_info">(<?php _e('provided that the Bus is well filled', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                            <?php while(have_rows('biofuel_public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title bus-grey">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/public-transport-green.png" alt="Electric Public Transport">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Biofuel public transport', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else:?> 
                                                            <span class="additional_impact_info">(<?php _e('provided that the Bus is well filled', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>

                            <?php while(have_rows('public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title bus-grey">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/Bus-grey.png" alt="Public Transport">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Public transport', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else: ?> 
                                                            <span class="additional_impact_info">(<?php _e('provided that the Bus is well filled', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                        <!-- </div> -->
                    <?php endwhile; ?>
                     <!-- CART TRANSPORT -->
                    <?php while (have_rows('transport_options_car')) : the_row(); ?>
                        <!-- <div class="row"> -->
                            <?php while(have_rows('electric_public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title car-dark-grey">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/electric-car.png" alt="Electric car">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Electric car', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else: ?> 
                                                            <span class="additional_impact_info">(<?php _e('provided the car is charged with green electricity', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                            <?php while(have_rows('biofuel_public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title car-dark-grey">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/bifuel-car.png" alt="Biofuel car">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Biofuel car', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else: ?> 
                                                            <span class="additional_impact_info">(<?php _e('small car with at least 4 ppl sitting in', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                            <?php while(have_rows('public_transport')) : the_row(); ?>
                                <?php 
                                $add_transportation = get_sub_field('add_transportation');
                                $impact =  get_sub_field('impact');
                                $additional_impact_info = get_sub_field('additional_impact_info');
                                $add_weight = get_sub_field('add_weight');
                                ?>
                                <?php 
                                if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                    <div class="col-md-6 col-12">
                                        <div class="add-transport-image-title car-red">
                                            <div class="inner-add-transportation">
                                                <div class="inner-f-add">
                                                    <img src="<?php bloginfo('template_directory') ?>/images/car-red.png" alt="Car">
                                                    <div class="inner-s-add">
                                                        <h5 class="">
                                                            <?php _e('Car', 'Wellbeing'); ?>
                                                            <?php if ($add_weight): ?>
                                                                <?php echo ' - ' . $add_weight; ?>
                                                            <?php endif ?>    
                                                        </h5>
                                                        <p class="best-choice-text">
                                                        <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                            <?php _e('Best Choice, ', 'Wellbeing'); ?>
                                                        <?php } ?>
                                                        <?php if ($impact): ?>
                                                            <span class="impact"><?php _e($impact, 'Wellbeing'); ?></span>
                                                        <?php endif; ?>
                                                        <?php if ($additional_impact_info): ?>
                                                            <span class="additional_impact_info"><?php echo "(" . $additional_impact_info . ')'; ?></span>
                                                        <?php else: ?> 
                                                            <span class="additional_impact_info">(<?php _e('Not recommended', 'Wellbeing') ?>)</span>
                                                        <?php endif ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endwhile; ?>
                        <!-- </div> -->
                    <?php endwhile; ?>
                    </div>
                    <?php
                    $link = get_sub_field('climate_link');
                        if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <div class="append-climate-button"><a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php if ('additional_info_below_around'): ?>
        <?php while(have_rows('additional_info_below_around')) : the_row(); ?>
            <?php
                $img = get_sub_field('image'); 
                $title = get_sub_field('title'); 
                $description = get_sub_field('description');
                $file = get_sub_field('button');
            ?>
            <?php if ($img || $title || $description || $file): ?>
                <div class="col-12 ln-more-pink">
                    <div class="row">
                        <?php if (!empty($img)): ?>
                            <div class="image-aditional-holder"><img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" /></div>
                        <?php endif; ?>
                        <div class="sm-padding">
                            <?php if ($title): ?>
                                <h3 class="smaller-h3"><?php echo $title; ?></h3>
                            <?php endif ?>
                            <?php if ($description): ?>
                                <div class=""><?php echo $description; ?></div>
                            <?php endif ?>
                            <?php
                            if( $file ): ?>
                                <div class=""><a class="classic-url-orange" target="_blank" href="<?php echo $file['url']; ?>"><?php _e('Download PDF', 'Wellbeing'); ?></a></div>
                            <?php endif; ?>
                            <div class="appended-content"></div>
                            <?php
                            $link = get_sub_field('climate_link');
                                if( $link ): 
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <div class="r-s-l"><a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            
        <?php endwhile; ?>
        <?php endif; ?>   
       
    </div>
</div>
<style type="text/css">
    .maps-in-post {
        height: 302px;
        border-radius: 10px;
        border: 2px solid #DC6016;
    }
    .acf-map-route {
        width: 100%;
        height: 440px;
        margin: 0;
        border-radius: 20px 20px 0px 0px;
    }
    .acf-map-route img {
     max-width: inherit !important;
 }
</style>
<script type="text/javascript">
    (function( $ ) {
        function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker-single');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 12,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        styles: [ { "featureType": "administrative", "stylers": [ { "visibility": "on" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "on" } ] },{ "featureType": "landscape", "stylers": [ { "visibility": "simplified" }, { "color": "#c9e2ce" } ] } ]
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });
    // Center map based on markers.
    centerMap( map );
    // Return map instance.
    return map;

}
    
// map.markers.push( marker );

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
 function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');

    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    var markerIcon = {
        url: $marker.attr('data-icon')
     // scaledSize: new google.maps.Size(40, 40),
     // origin: new google.maps.Point(0, 0),
     // anchor: new google.maps.Point(32,65)
    };

    var markerLabel = $marker.attr('data-title');

    var marker = new MarkerWithLabel({
       map: map,
       animation: google.maps.Animation.DROP,
       position: latLng,
       icon: markerIcon,
       labelContent: markerLabel,
       labelAnchor: new google.maps.Point(18, 12),
       labelClass: "my-custom-class-for-label",
       labelInBackground: true
    });
  // Append to reference for later use.
    map.markers.push( marker );
    // If marker contains HTML, add it to an infoWindow.
    // if( $marker.html() ){

    //     // Create info window.
    //     var infowindow = new google.maps.InfoWindow({
    //         content: $marker.html()
    //     });

    //     // Show info window when marker is clicked.
    //     google.maps.event.addListener(marker, 'click', function() {
    //         infowindow.open( map, marker );
    //     });
    // }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
 function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else {
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function() {
    $('.maps-in-post').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);
</script>





<!-- THE ROUTE MAP AT THE BOTTOM  -->

<script type="text/javascript">
    (function( $ ) {
        function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Create gerenic map.
    var mapArgs = {
        zoom        : $el.data('zoom') || 12,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        styles: [ { "featureType": "administrative", "stylers": [ { "visibility": "on" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "on" } ] },{ "featureType": "landscape", "stylers": [ { "visibility": "simplified" }, { "color": "#c9e2ce" } ] } ]
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    Polyline(map);
    var markerCluster = new MarkerClusterer(map, map.markers, {
        styles: [{'textColor': '#fff', 'url': '/app/themes/wellbeing/images/markerclaster.png', 'width': '37', 'height': '55', 'textSize': '14'}],
    });
    // Center map based on markers.
    centerMap( map );
    // Return map instance.
    return map;

}

    

// POLYLINE
var coords = [];
function Polyline(map) {

   
    var PolyCoordinates = [
        // coords[0],
        // coords[1],
        // coords[2],
        // coords[3],
    ];
    // console.log(coords[0]);

    var coordinates = new google.maps.Polyline({
        path: coords,
        geodesic: true,
        strokeColor: "#FF0222",
        strokeOpacity: 1.0,
        strokeWeight: 2,
    });
    coordinates.setMap(map);

}

 
    
// map.markers.push( marker );

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
 function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');

    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };

    var markerIcon = {
        url: $marker.attr('data-icon')
     // scaledSize: new google.maps.Size(40, 40),
     // origin: new google.maps.Point(0, 0),
     // anchor: new google.maps.Point(32,65)
    };

    var markerLabel = $marker.attr('data-title');

    var marker = new MarkerWithLabel({
       map: map,
       animation: google.maps.Animation.DROP,
       position: latLng,
       icon: markerIcon,
       labelContent: markerLabel,
       labelAnchor: new google.maps.Point(18, 12),
       labelClass: "my-custom-class-for-label",
       labelInBackground: true
    });
  // Append to reference for later use.
    map.markers.push( marker );
    coords.push(latLng);
    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
 function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else {
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function() {
    $('.acf-map-route').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=xxx"></script>
<?php get_footer() ?>