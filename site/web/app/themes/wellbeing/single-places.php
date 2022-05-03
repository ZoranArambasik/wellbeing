<?php get_header(); ?>
<div class="places-single-post">
    <div class="top-overlay"></div>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                <div class="row align-items-center mb-3">
                    <div class="col-md-8 single-post-title">
                        <h2 class="posttitle"><?php the_title(); ?></h2>
                    </div>
                    <div class="col-md-4">
                        <div class="share-save">
                            <div id="shareBtn" class="btn btn-success clearfix"><?php _e('Share', 'Wellbeing') ?><img src="<?php bloginfo('template_directory') ?>/images/share-icon.png"></div>
                            <div class="fav-singles"><span class="save_fv"><?php _e('Favorite', 'Wellbeing') ?></span><?php echo do_shortcode('[favorite_button]'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="row places-header mx-auto">
                    <?php 
                    $col = '';
                    $add_head_images = get_field('add_header_image');
                    // var_dump($add_head_images['header_image_3']);
                    if ($add_head_images['header_image_3'] == false && $add_head_images['header_image_2'] == false) {
                        $col = 'col-12';
                        $smcol = '';
                    }
                    else if ($add_head_images['header_image_3'] == false || $add_head_images['header_image_2'] == false) {
                        $col = 'col-6';
                        $smcol = 'col-6 img-ff';

                    }
                    else {
                        $col = 'col-8';
                        $smcol = 'col-4';
                    } ?>
                    <div class="<?php echo $col; ?> p-0 image-full max-height">
                        <?php echo has_post_thumbnail() ? the_post_thumbnail('single_head_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                        <?php if (get_field('photographer_name')): ?>
                            <div class="photographer-holder">
                                <div class="photograph-name">
                                    <?php _e('Photo by ', 'Wellbeing'); the_field('photographer_name'); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                    <?php if (have_rows('add_header_image')) : ?>
                        <?php while(have_rows('add_header_image')) : the_row(); ?>
                            <?php $pi2 = get_sub_field('header_image_2'); ?>
                            <?php $pi3 = get_sub_field('header_image_3'); ?>
                            <div class="<?php echo $smcol; ?> p-0 image-full max-height">
                                <?php if (!empty($pi2)): ?>
                                  <div class="image-two">
                                    <img src="<?php echo esc_url($pi2['url']); ?>" alt="<?php echo esc_attr($pi2['alt']); ?>" />
                                    <?php if (get_sub_field('photo_by_two')): ?>
                                        <div class="photographer-holder">
                                            <div class="photograph-name">
                                                <?php _e('Photo by ', 'Wellbeing'); the_sub_field('photo_by_two'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($pi3)): ?>
                                <div class="image-three">
                                    <img src="<?php echo esc_url($pi3['url']); ?>" alt="<?php echo esc_attr($pi3['alt']); ?>" />
                                    <?php if (get_sub_field('photo_by_three')): ?>
                                        <div class="photographer-holder">
                                            <div class="photograph-name">
                                                <?php _e('Photo by ', 'Wellbeing'); the_sub_field('photo_by_three'); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if (have_rows('add_even_more_images')) : ?>
                              <div class="view-all-photos"><?php _e('View all photos', 'Wellbeing'); ?></div>
                              <div class="hiden-images-slide">
                                <div class="slide-images-single-holder">
                                  <div class="close-popup">X</div>
                                  <div class="slide-images-singles">
                                    <?php while(have_rows('add_even_more_images')) : the_row(); ?>
                                        <?php $piR = get_sub_field('add_image'); ?>
                                        <?php if ($piR): ?>
                                            <div class="img-slide-holder">
                                                <figure>
                                                    <?php if (get_sub_field('photo_by')): ?>
                                                    <figcaption>
                                                        <div class="photographer-holder">
                                                            <div class="photograph-name">
                                                                <?php _e('Photo by ', 'Wellbeing'); the_sub_field('photo_by'); ?>
                                                            </div>
                                                        </div>
                                                    </figcaption>
                                                    <?php endif; ?>
                                                    <img src="<?php echo esc_url($piR['url']); ?>" alt="<?php echo esc_attr($piR['alt']); ?>">
                                                    
                                                </figure>
                                            </div>
                                      <?php endif ?>
                                    <?php endwhile; ?>
                                    <?php if (has_post_thumbnail()): ?>
                                       <div class="img-slide-holder">
                                        <figure>
                                            <?php if (get_field('photographer_name')): ?>
                                                <figcaption>
                                                    <div class="photographer-holder">
                                                        <div class="photograph-name">
                                                            <?php _e('Photo by ', 'Wellbeing'); the_field('photographer_name'); ?>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            <?php endif; ?>
                                            <?php the_post_thumbnail('single_head_images'); ?>
                                            
                                        </figure>
                                        </div>
                                    <?php endif ?>
                                    <?php if (!empty($pi2)): ?>
                                       <div class="img-slide-holder">
                                        <figure>
                                            <?php if (get_sub_field('photo_by_two')): ?>
                                                <figcaption>
                                                    <div class="photographer-holder">
                                                        <div class="photograph-name">
                                                            <?php _e('Photo by ', 'Wellbeing'); the_sub_field('photo_by_two'); ?>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            <?php endif; ?>
                                            <img src="<?php echo esc_url($pi2['url']); ?>" alt="<?php echo esc_attr($pi2['alt']); ?>" />
                                            
                                        </figure>
                                        </div>
                                     <?php endif; ?>
                                     <?php if (!empty($pi3)): ?>
                                        <div class="img-slide-holder">
                                        <figure>
                                            <?php if (get_sub_field('photo_by_three')): ?>
                                                <figcaption>
                                                    <div class="photographer-holder">
                                                        <div class="photograph-name">
                                                            <?php _e('Photo by ', 'Wellbeing'); the_sub_field('photo_by_three'); ?>
                                                        </div>
                                                    </div>
                                                </figcaption>
                                            <?php endif; ?>
                                            <img src="<?php echo esc_url($pi3['url']); ?>" alt="<?php echo esc_attr($pi3['alt']); ?>" />
                                            
                                        </figure>
                                        </div>
                                     <?php endif; ?>
                                  </div>
                                </div>
                              </div>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <?php if (get_field('hashtag_title')): ?>
                            <h4 class="hash-title"><img src="<?php bloginfo('template_directory') ?>/images/Lotus-red.png"><?php echo get_field('hashtag_title'); ?></h4>
                        <?php endif; ?>
                        <?php 
                        $summary = get_field('summary_introduction_text');
                            if ($summary) {
                                echo '<div class="from-single-route-small-description">' . strip_tags($summary) . '</div>';
                            }  
                        ?>
                        <?php if (get_field('company_large_description')): ?>
                            <div class="lr-company-desc"><?php echo get_field('company_large_description') ?></div>
                        <?php endif ?>
                        <?php $pdf_icon_and_text = get_field('pdf_icon_and_text'); ?>
                        <?php if ($pdf_icon_and_text): ?>
                            <p class="pdf-icon-and-text"><a target="_blank" href="<?php echo $pdf_icon_and_text['url']; ?>"><img alt="PDF Download Image" src="<?php bloginfo('template_directory') ?>/images/ic_download.png"> <span><?php echo $pdf_icon_and_text['title']; ?></span></a></p>
                        <?php endif; ?>
                        <?php $link_r = get_field('add_custom_url');
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
                    <div class="col-md-4 pl-5 pr-5">
                        <?php $location = get_field('google_map'); ?>
                        <?php if (have_rows('contact_places_company')) : ?>
                            <?php while(have_rows('contact_places_company')) : the_row(); ?>
                            <?php 
                                $phone = get_sub_field('phone');
                                $phone_two = get_sub_field('phone_two');
                                $email = get_sub_field('email');
                                $website = get_sub_field('website');
                                $website_txt = get_sub_field('website_txt');
                                $facebook = get_sub_field('facebook');
                                $instagram = get_sub_field('instagram');
                                $twitter = get_sub_field('twitter');
                                $linkedin = get_sub_field('linkedin');
                                $open_season = get_sub_field('open_season');
                                
                            ?>

                            <?php if ($phone || $email || $website): ?>
                                <h3 class="cont-info"><?php _e('Contact information', 'Wellbeing'); ?></h3>
                            <?php endif; ?>
                            <div class="place-info">
                            <?php if ($phone): ?>
                                <p class="places_phone">
                                    <i class="fas fa-phone"></i><span><?php echo $phone; ?></span>
                                </p>
                            <?php endif ?>
                            <?php if ($phone_two): ?>
                                <p class="places_phone">
                                    <i class="fas fa-phone"></i><span><?php echo $phone_two; ?></span>
                                </p>
                            <?php endif ?>
                            <?php if ($email): ?>
                                <p class="email">
                                    <i class="far fa-envelope"></i><span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                                </p>
                            <?php endif ?>
                            <?php if ($website): ?>
                                <p class="website">
                                    <i class="fas fa-globe"></i><span><a target="_blank" href="<?php echo $website; ?>"><?php echo $website_txt ? $website_txt : $website; ?></a></span>
                                </p>
                            <?php endif ?>
                            <?php if ($location['address']): ?>
                                <p class="map_adress">
                                    <i class="fas fa-map-marker-alt"></i><span><?php echo $location['address']; ?></span>
                                </p>
                            <?php endif ?>
                            <?php if ($facebook): ?>
                                <p class="facebook">
                                    <i class="fab fa-facebook-f"></i><span><a target="_blank" href="<?php echo $facebook; ?>"><?php _e('Facebook', 'Wellbeing'); ?></a></span>
                                </p>
                            <?php endif ?>
                            <?php if ($instagram): ?>
                                <p class="instagram">
                                    <i class="fab fa-instagram"></i><span><a target="_blank" href="<?php echo $instagram; ?>"><?php _e('Instagram', 'Wellbeing'); ?></a></span>
                                </p>
                            <?php endif ?>
                            <?php if ($twitter): ?>
                                <p class="twitter">
                                    <i class="fab fa-twitter"></i><span><a target="_blank" href="<?php echo $twitter; ?>"><?php _e('Twitter', 'Wellbeing'); ?></a></span>
                                </p>
                              <?php endif ?>
                            <?php if ($linkedin): ?>
                                <p class="linkedin">
                                    <i class="fab fa-linkedin-in"></i><span><a target="_blank" href="<?php echo $linkedin; ?>"><?php _e('LinkedIn', 'Wellbeing'); ?></a></span>
                                </p>
                            <?php endif ?>
                            <?php if ($open_season): ?>
                                <p class="open_season">
                                    <span><b><?php _e('Opening season', 'Wellbeing'); ?></b>:</span> <span><?php echo $open_season; ?></span>
                                </p>
                            <?php endif ?>
                            </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php 
                            $terms = get_the_terms( $post->ID, 'main_category' );
                            if (!empty($terms)) {
                                foreach ($terms as $term) {
                                    $image = get_field('add_tax_icon', $term);
                                    if (!empty($image)) {
                                        echo "<div class='tax-img-holder-results tax-img-holder-single-post'><img src='" .$image. "' alt='Slide Image'></div>";
                                    }       
                                } 
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if( $location ): ?>
                            <h3 class="map-title"><?php _e('Where we are at:', 'Wellbeing'); ?></h3>
                            <div class="acf-map" data-zoom="8">
                                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
                            </div>
                        <?php endif; ?>
                        <div class="align-center"><a class="classic-url-pink" href="<?php bloginfo('url') ?>/discover-places"><?php _e('Back to main map', 'Wellbeing'); ?></a></div>
                        <div class="lotus-center"><img src="<?php bloginfo('template_directory') ?>/images/Lotus.png"></div>
                    </div>
                </div>
            </div>       
        <?php endwhile; endif; ?>
        <?php global $post;
        $terms = wp_get_post_terms( $post->ID, 'country');
        if (!empty($terms)) {
            foreach ($terms as $term) {} 
        ?>
        <?php  
        $args = array( 
            // 'posts_per_page' => 6,
            'post_type' => 'places', 
            'post__not_in' => array( $post->ID ),
            'tax_query' => array(
                array(
                    'taxonomy' => $term->taxonomy,
                    'terms' => $term->name,
                    'field' => 'slug'
                )
            )
        );
        $the_query = new WP_Query( $args );?>
        <div class="row nereby-places">
            <?php if ( $the_query->have_posts() ) : ?> 
                <div class="col-12">
                    <h3 class="more-mc"><?php _e('More places nearby:', 'Wellbeing'); ?></h3>
                </div>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class=col-md-6>
                        <div class="places-single-nereby">
                            <a class="show-hover-excerpt" href="<?php the_permalink(); ?>">
                                <?php echo has_post_thumbnail() ? the_post_thumbnail('single_head_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />';
                                // $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( get_the_ID() ) ));
                                // var_dump($taxonomies);
                                // foreach ($taxonomies as $taxonomy) {
                                    // var_dump($taxonomy);
                                    $terms = get_the_terms( $post->ID, 'main_category' );
                                    if (!empty($terms)) {
                                        foreach ($terms as $term) {
                                            $image = get_field('add_tax_icon', $term);
                                            if (!empty($image)) {
                                                echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                            }       
                                        } 
                                    }  
                                // }
                                ?>
                                <h3><?php echo get_the_title(); ?></h3>
                                <?php if (get_field('small_description_home_page', $post->ID)): ?>
                                <p class="display-hover">
                                    <span class="show-excerpt"><?php echo get_field('small_description_home_page', $post->ID); ?></span>
                                </p>
                                <?php endif; ?>
                                <span class="arrow-go-places lnr lnr-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>    
    <?php } ?>
    </div>
</div>

<style type="text/css">
    .acf-map {
        width: 100%;
        height: 0px;
        position: relative;
        padding-bottom: 34%;
        margin: 20px 0px 36px 0;
    }
    .acf-map img {
        max-width: inherit !important;
    }
</style>

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

            // Center map based on markers.
            centerMap( map );

            // Return map instance.
            return map;
        }   


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
        // Create marker instance.
        if (!'<?php the_field('add_icon_or_default') ?>' > 0) {
            var img = '/app/themes/wellbeing/images/marker-medium.png';
        } 
        else {
            img = '<?php the_field('add_icon_or_default') ?>';
        }
        var markerIcon = {
           url: img,
         // scaledSize: new google.maps.Size(40, 40),
         // origin: new google.maps.Point(0, 0),
         // anchor: new google.maps.Point(32,65)
        };

        var markerLabel = '<?php the_title(); ?>';

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
        if( $marker.html() ) {
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
        } 
        else {
            map.fitBounds( bounds );
        }
    }

    // Render maps on page load.
    $(document).ready(function(){
        $('.acf-map').each(function(){
            var map = initMap( $(this) );
        });
    });

    })(jQuery);
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=xxx"></script>
<?php get_footer() ?>