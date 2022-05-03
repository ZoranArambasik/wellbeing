<?php get_header(); ?>
<div class="places-single-post">
    <div class="top-overlay"></div>
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  

                <h2 class="posttitle"><?php the_title(); ?></h2>
                <div class="row places-header mx-auto">
                    <div class="col-12 p-0 image-full">
                        <?php echo has_post_thumbnail() ? the_post_thumbnail('single_head_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <?php if (get_field('hashtag_title')): ?>
                            <h4 class="hash-title"><img src="<?php bloginfo('template_directory') ?>/images/Lotus-red.png"><?php echo get_field('hashtag_title'); ?></h4>
                        <?php endif ?>
                    <?php the_content(); ?>
                    </div>
                    <?php  $location = get_field('google_map'); ?>
                    <div class="col-md-4 pl-5 pr-5">
                        <?php if (have_rows('contact_places')) : ?>
                            <?php while(have_rows('contact_places')) : the_row(); ?>
                                <?php 
                                $phone = get_sub_field('phone');
                                $email = get_sub_field('email');
                                $website = get_sub_field('website');
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
                                    <?php if ($email): ?>
                                        <p class="email">
                                            <i class="far fa-envelope"></i><span><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                                        </p>
                                    <?php endif ?>
                                    <?php if ($website): ?>
                                        <p class="website">
                                            <i class="fas fa-globe"></i><span><a href="<?php echo $website; ?>"><?php echo $website; ?></a></span>
                                        </p>
                                    <?php endif ?>
                                    <?php if ($location['address']): ?>
                                        <p class="map_adress">
                                            <i class="fas fa-map-marker-alt"></i><span><?php echo $location['address']; ?></span>
                                        </p>
                                    <?php endif ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php if( $location ): ?>
                            <h3 class="map-title"><?php _e('Where we are at:', 'Wellbeing'); ?></h3>
                            <div class="acf-map" data-zoom="14">
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
                            <a class="" href="<?php the_permalink(); ?>">
                                <?php echo has_post_thumbnail() ? the_post_thumbnail('single_head_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />';
                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( get_the_ID() ) ));
                                // var_dump($taxonomies);
                                foreach ($taxonomies as $taxonomy) {
                                    // var_dump($taxonomy);
                                    $terms = get_the_terms( $post->ID, $taxonomy );
                                    if (!empty($terms)) {
                                        foreach ($terms as $term) {
                                            $image = get_field('add_tax_icon', $term);
                                            if (!empty($image)) {
                                                echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                            }       
                                        } 
                                    }  
                                }
                                ?>
                                <h3><?php echo get_the_title(); ?></h3>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>    
    </div>
    <?php } ?>
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