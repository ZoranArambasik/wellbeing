<?php get_header(); ?>
<div class="singles-image">
    <?php if ( has_post_thumbnail() ) { 
          the_post_thumbnail('route_head_image');
          }
          else {
              echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
                  . '/images/no-image.jpg" />';
          } 
    ?>
    <div class="container">
        <div class="singles-text">
            <div class="absolute-bottom"><h2><?php echo the_title(); ?></h2></div>
        </div>
    </div>
</div>
<?php
$small_description_routes = get_field('small_description_routes');
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
<div class="entry-content">
    <?php $places = get_field('select_places_for_this_route'); ?>
</div>
<div class="routs-main-content">
    <div class="container">
        <?php if ($places) : $i=1; ?>
            <?php $get_places_number = count($places); ?>
                <div class="row">
                    <?php foreach($places as $place): setup_postdata($place); ?>

                    <div class="col-md-8">
                        <div class="routs-thumbs">
                            <a href="<?php echo get_the_permalink($place->ID); ?>">
                                <?php echo has_post_thumbnail($place->ID) ? get_the_post_thumbnail($place->ID, 'home_page_thumb_route') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                            </a>
                            <div class="content-places-holder">
                                <?php 
                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type($place->ID) ));
                                 // var_dump($taxonomies);
                                foreach ($taxonomies as $taxonomy) {
                                    
                                    $terms = get_the_terms( $place->ID, $taxonomy );
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
                            </div>
                        </div>
                        <div class="routes-tax-title"><h2><?php echo get_the_title($place->ID); ?></h2></div>
                        <div class="post-text-routes">
                            <?php echo $place->post_excerpt; ?>
                            <div class="admin-about-activities">
                                <?php echo get_field('text_about_activities', $place->ID); ?>
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
                        <p class="map-adress">
                            <img src="<?php bloginfo('template_directory') ?>/images/map.png"><span><?php echo $location["address"]; ?></span>
                        </p>

                        <div class="full-width"><a class="classic-url-orange" href="<?php echo get_the_permalink($place->ID); ?>"><?php _e('Go to place', 'Wellbeing'); ?></a></div>

                    
                     
                        <?php if ($get_places_number !== $i): ?>
                            <div class="map-connector"></div>
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
                    <?php  $i++; endforeach;  wp_reset_postdata(); ?>


<!-- WE START WITH LOOPING THROUGH ROUTES BUT WITH A -->

                <div class="acf-map-route">
                    <?php
                    foreach( $output_map as $key => $map_marker ): ?>
                        <?php echo $map_marker['map']; ?>
                    <?php endforeach; ?>  
                </div>
                <?php if (have_rows('how_to_get_around')) : ?>
                    <?php while(have_rows('how_to_get_around')) : the_row(); ?>
                        <div class="col-12 with-bottom-border sm-padding mint-green">
                            <?php 
                            $title = get_sub_field('title');
                            $desc = get_sub_field('description');
                            if ($title) {
                                echo '<h4>' . $title . '</h4>';
                            }
                            if ($desc) {
                                echo '<div class="desc">' . $desc . '</div>';
                            }
                            ?>
                            <?php while(have_rows('transport_options')) : the_row(); ?>
                            <div class="row">
                                <?php while(have_rows('by_bike')) : the_row(); ?>
                                    <?php 
                                    $add_transportation = get_sub_field('add_transportation');
                                    $impact =  get_sub_field('impact');
                                    $desc = get_sub_field('description');
                                    ?>
                                    <?php 
                                    if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                        <div class="col-lg">
                                            <div class="add-transport-image-title">
                                            <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                <div class="inner-add-transportation best-choice">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Bike-orange.png" alt="Bike">
                                                        <h5 class=""><?php _e('By Bike', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="best-choice-text"><?php _e('Best Choice', 'Wellbeing'); ?></p>
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="inner-add-transportation">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Bike.png" alt="Bike">
                                                        <h5 class=""><?php _e('By Bike', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                           <?php } ?>
                                            </div>
                                            <?php if ($desc): ?>
                                                <div class="desc"><?php echo $desc; ?></div>
                                            <?php endif ?>
                                        </div>
                                    <?php } ?>
                                    
                                <?php endwhile; ?>
                                <?php while(have_rows('public_transportation')) : the_row(); ?>
                                    <?php 
                                    $add_transportation = get_sub_field('add_transportation');
                                    $impact =  get_sub_field('impact');
                                    $desc = get_sub_field('description');
                                    ?>
                                    <?php 
                                    if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                        <div class="col-lg">
                                            <div class="add-transport-image-title">
                                            <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                <div class="inner-add-transportation best-choice">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Bus-orange.png" alt="Bus">
                                                        <h5 class=""><?php _e('By Public Transport', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="best-choice-text"><?php _e('Best Choice', 'Wellbeing'); ?></p>
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="inner-add-transportation">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Bus.png" alt="Bus">
                                                        <h5 class=""><?php _e('By Public Transport', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                           <?php } ?>
                                            </div>
                                            <?php if ($desc): ?>
                                                <div class="desc"><?php echo $desc; ?></div>
                                            <?php endif ?>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                                <?php while(have_rows('by_car')) : the_row(); ?>
                                    <?php 
                                    $add_transportation = get_sub_field('add_transportation');
                                    $impact =  get_sub_field('impact');
                                    $desc = get_sub_field('description');
                                    ?>
                                    <?php 
                                    if( $add_transportation && in_array('Activate Transportation', $add_transportation) ) { ?>
                                        <div class="col-lg">
                                            <div class="add-transport-image-title">
                                            <?php if( $add_transportation && in_array('Best Choice', $add_transportation) ) { ?>
                                                <div class="inner-add-transportation best-choice">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Car-orange.png" alt="Car">
                                                        <h5 class=""><?php _e('By Car', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="best-choice-text"><?php _e('Best Choice', 'Wellbeing'); ?></p>
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="inner-add-transportation">
                                                    <div class="inner-f-add">
                                                        <img src="<?php bloginfo('template_directory') ?>/images/Car.png" alt="Car">
                                                        <h5 class=""><?php _e('By Car', 'Wellbeing'); ?></h5>
                                                    </div>
                                                    <div class="inner-s-add">
                                                        <p class="impact"><?php echo $impact; ?></p>
                                                    </div>
                                                </div>
                                           <?php } ?>
                                            </div>
                                            <?php if ($desc): ?>
                                                <div class="desc"><?php echo $desc; ?></div>
                                            <?php endif ?>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                            <?php endwhile; ?>
                            <?php while(have_rows('additional_transport_information')) : the_row(); ?>
                                <?php
                                $title = get_sub_field('title'); 
                                $description = get_sub_field('description');
                                $link = get_sub_field('button');
                                ?>
                                <?php if ($title): ?>
                                    <h3 class="smaller-h3 mt-4 mb-3"><?php echo $title; ?></h3>
                                <?php endif ?>
                                <?php if ($description): ?>
                                    <div class=""><?php echo $description; ?></div>
                                <?php endif ?>
                                <?php
                                    if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                    <div class=""><a class="classic-url-orange" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></div>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php if ('additional_info_below_around'): ?>
                <?php while(have_rows('additional_info_below_around')) : the_row(); ?>
                    <div class="col-12 ln-more-pink">
                        <div class="row">
                            <?php
                            $img = get_sub_field('image'); 
                            $title = get_sub_field('title'); 
                            $description = get_sub_field('description');
                            $file = get_sub_field('button');
                            ?>
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
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif ?>   
            </div>
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

    console.log(coords);
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