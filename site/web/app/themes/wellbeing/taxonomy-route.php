<?php get_header(); ?>
<div class="singles-image">
    <?php 
    $term = get_queried_object();
    $img = get_field('route_category_header_image', $term); ?>
    
    <?php if (!empty($img)): ?>
        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
    <?php endif; ?>
    <div class="container">
        <div class="singles-text">
            <div class="absolute-bottom"><h2><?php echo $term->name; ?></h2></div>
        </div>
    </div>
</div>
<div class="routes-top-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 pr-5 small-desc-routes-left">
                <?php echo get_field('small_description_routes', $term); ?>
            </div>
            <div class="col-md-4 small-desc-routes-right">
                <?php if (have_rows('specification_right', $term)): 
                    while (have_rows('specification_right', $term)): the_row();
                    echo '<p>' . get_sub_field('add_specification', $term) . '</p>';
                ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="routs-main-content">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
                <div class="row">
                    <div class="col-md-8">
                        <div class="routs-thumbs"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a></div>
                        <div class="routes-tax-title"><h2><?php the_title(); ?></h2></div>
                        <div class="post-text-routes">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="categories_in_links">
                            <div class="categories_in">
                                <?php 
                                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( get_the_ID() ) ));
                                // var_dump($taxonomies);
                                foreach ($taxonomies as $taxonomy) {
                                    // var_dump($taxonomy);
                                    $terms = get_the_terms( $post->ID, $taxonomy );;
                                    if (!empty($terms)) {
                                        foreach ($terms as $term) {
                                            $image = get_field('add_tax_icon', $term);
                                            if (!empty($image)) {
                                                echo "<div class='tax-img-holder'><img src='" .$image. "' alt='Slide Image'></div>";
                                            }       
                                        } 
                                    }  
                                }
                                ?>
                            </div>
                            <div class="go_to_route">
                                <a href="<?php the_permalink(); ?>"><?php _e('Go to page', 'Wellbeing'); ?><span class="arrow-go-places lnr lnr-chevron-right"></span></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mc">
                        <?php 
                        $location = get_field('google_map', $post->ID);
                        if( $location ): ?>
                            <?php 
                            
                                if( $wp_query->current_post == '0') {
                                    $marker_icon_multi = '/app/themes/wellbeing/images/marker-1.png';                      
                                } else {
                                    $marker_icon_multi = '/app/themes/wellbeing/images/marker-small.png';
                                }
                            ?>
                            <?php 
                                if( get_field('add_icon_or_default', $post->ID) ){
                                    $marker_icon = get_field('add_icon_or_default', $post->ID);                      
                                } else {
                                    $marker_icon = '/app/themes/wellbeing/images/marker-medium.png';
                                }
                            ?>
                            <div class="maps-in-post" data-zoom="14">
                                <div class="marker-single" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-title="<?php the_title() ?>" data-icon="<?php echo $marker_icon ?>"></div>
                            </div>
                        <?php endif; ?>
                        <p class="map-adress">
                            <img src="<?php bloginfo('template_directory') ?>/images/map.png"><span><?php echo $location["address"]; ?></span>
                        </p>
                        <?php if (($wp_query->current_post +1) !== ($wp_query->post_count)) {
                          echo '<div class="map-connector"></div>';
                        } ?>
                    </div>
                </div>       
            </div>
            <?php $output_map[$post->ID]['map'] = '<div class="marker" data-lat="'.$location['lat'].'" data-lng="'.$location['lng'].'" data-icon="'.$marker_icon_multi.'" data-title="'.get_the_title().'"></div>'; ?>
            <?php endwhile; wp_reset_postdata(); ?>
            <div class="acf-map-route"><?php
                foreach( $output_map as $key => $map_marker ):
                    echo $map_marker['map'];
                endforeach; ?>
            </div>
        <?php endif;  ?>
        
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
    $('.maps-in-post').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);
</script>







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