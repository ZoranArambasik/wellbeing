<?php
/**
 * Search & Filter Pro 
 *
 * Sample Results Template
 * 
 * @package   Search_Filter
 * @author    Ross Morsali
 * @link      https://searchandfilter.com
 * @copyright 2018 Search & Filter
 * 
 * Note: these templates are not full page templates, rather 
 * just an encaspulation of the your results loop which should
 * be inserted in to other pages by using a shortcode - think 
 * of it as a template part
 * 
 * This template is an absolute base example showing you what
 * you can do, for more customisation see the WordPress docs 
 * and using template tags - 
 * 
 * http://codex.wordpress.org/Template_Tags
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script type="text/javascript">

  jQuery(document).ready(function() {

      var show_map = localStorage.getItem('show-map');
      if(show_map === 'true') {
          jQuery('#show-listings').hide();
          jQuery('#show-map').css({'visibility': 'visible', 'height': 'calc(100vh - 68px)'});
      } else {
        jQuery('#show-listings').show();
        jQuery('#show-map').css({'visibility': 'hidden', 'height': '0vh'});
      }
      
      jQuery(".view-map").click(function(event) {
          event.preventDefault();
          jQuery('#show-listings').hide();
          jQuery('#show-map').css({'visibility': 'visible', 'height': 'calc(100vh - 68px)'});
          localStorage.setItem('show-map', 'true');
      });
      jQuery(".view-list").click(function(event) {
          event.preventDefault();
          jQuery('#show-listings').show();
          jQuery('#show-map').css({'visibility': 'hidden', 'height': '0vh'});
          localStorage.removeItem('show-map', 'true');
      });
  });
 
</script>

<div class="favourite-content-overlay"></div>
<div class="favourite-content">
  <span class="lnr lnr-cross"></span>
 <div class="favourite-holder"> <?php echo do_shortcode('[user_favorites]'); ?> </div>
 <div class="kopche"><a href="<?php bloginfo('url') ?>/print"><?php _e('Print Favorites', 'Wellbeing') ?></a></div>

</div>
<div class="view-map-list">
	<div class="view-list">
      <img src="<?php bloginfo('template_directory') ?>/images/view-list.png">
		  <?php _e('View list', 'Wellbeing'); ?>
	</div>
	<div class="view-map">
		<i class="far fa-map"></i>  <?php _e('View Map', 'Wellbeing'); ?>
	</div>
</div>
<div class="favorites-button">
  <?php _e('View my favorites', 'Wellbeing'); ?> <img src="/app/uploads/2021/01/Heart-1.png">
</div>
<div id="show-listings" class="search-results search-results-posts">
    <?php global $post; ?>
    <?php if ( $query->have_posts()): ?>
    	<div class="f-res p-3"><?php _e('All Results', 'Wellbeing'); ?> <?php echo '(' . $query->found_posts . ')'; ?></div>
        <div class="row no-gutters">
    		<?php while ($query->have_posts()): $query->the_post(); ?>
          <div class="col-md-6 p-2">
              <div class="places-holder-post places-search-post">
                <div class="favorite"><?php echo do_shortcode('[favorite_button]'); ?></div>
                  <a class="show-hover-excerpt" href="<?php the_permalink(); ?>">
                      <?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail($post->ID, 'route_single_place_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                      <div class="content-places-holder">
                        <?php $taxonomies = get_object_taxonomies( (object) array( 'post_type' => get_post_type( $post->ID ) ));
                        // var_dump($taxonomies);
                          foreach ($taxonomies as $taxonomy) {
                              // var_dump($taxonomy);
                              $terms = get_the_terms( $post->ID, $taxonomy );;
                              if (!empty($terms)) {
                                  foreach ($terms as $term) {
                                      $image = get_field('add_tax_icon', $term);
                                      if (!empty($image)) {
                                          echo "<div class='tax-img-holder-results'><img src='" .$image. "' alt='Slide Image'></div>";
                                      }       
                                  } 
                              }  
                          } ?>
                          <h3><?php the_title(); ?></h3>
                          <?php if (get_field('small_description_home_page', $post->ID)): ?>
                            <p class="display-hover">
                              <span class="show-excerpt"><?php echo get_field('small_description_home_page', $post->ID); ?></span>
                            </p>
                          <?php endif; ?>
                          <span class="arrow-go-places lnr lnr-chevron-right"></span>
                      </div>
                  </a>
              </div>
          </div>
        	<?php endwhile; ?>
        </div>
    <?php else: ?>
            <div class="col-12 sorry-no-posts">
            <h2 class="mt-5"><?php _e('We’re sorry!', 'Wellbeing') ?></h2>
            <p><?php _e('We can’t seem to find any wellbeing business, place, or route that matches your search.', 'Wellbeing') ?></p>
            <?php _e('If you can’t find what you’re searching for please:', 'Wellbeing') ?>
            <ul>
                <li><?php _e('try to doublecheck your spelling,', 'Wellbeing') ?></li>
                <li><?php _e('try other search terms,', 'Wellbeing') ?></li>
                <li><?php _e('use our filter function or,', 'Wellbeing') ?></li>
                <li><?php _e('view our map and zoom in on your next destination!', 'Wellbeing') ?></li>
            </ul>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>

<div id="show-map" class="search-results search-results-map">
<?php if ( $query->have_posts()): ?>
	<div class="row no-gutters">
		<div class="acf-map-route">
		<?php while ($query->have_posts()): $query->the_post(); ?>
			<?php 

          // if ($post->post_type == 'route') {
          //   $get_places_number = ' ';
          //   $places = get_field('select_places_for_this_route', $post->ID); 
          //   if ($places) {
          //     $get_places_number = count($places);
          //   }
          //   $marker_icon = '/app/themes/wellbeing/images/route-marker.png';
          // }

          // else {
          //     $get_places_number = ' ';
          //     if( get_field('add_icon_or_default', $post->ID) ){
          //         $marker_icon = get_field('add_icon_or_default', $post->ID);                      
          //     } else {
          //         $marker_icon = '/app/themes/wellbeing/images/marker-small.png';
          //     }
          // }
          if( get_field('add_icon_or_default', $post->ID) ){
              $marker_icon = get_field('add_icon_or_default', $post->ID);                      
          } else {
              $marker_icon = '/app/themes/wellbeing/images/marker-small.png';
          }
			?>
			<?php 
			$location = get_field('google_map', $post->ID);
			if( $location ):  ?>
	           <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>" data-title="<?php the_title() ?>" data-icon="<?php echo $marker_icon; ?>">
		            <div class="in-marker-holder-post">
		                <a href="<?php the_permalink(); ?>">
		                    <?php echo has_post_thumbnail($post->ID) ? get_the_post_thumbnail($post->ID, 'route_single_place_images') : '<img src="' . get_bloginfo( 'stylesheet_directory' )  . '/images/no-image.jpg" />'; ?>
                        <div class="favorite-in-map"><?php echo do_shortcode('[favorite_button]'); ?></div>
		                    <div class="marker-content-holder">
                                <div class="marker-title-address">
    		                        <p class="marker-title-post"><?php the_title(); ?></p>
                                    <p class="marker-address-post"><?php echo $location['address']; ?></p>
                                </div>
	                           <span class="arrow-go-places lnr lnr-chevron-right"></span>
		                    </div>
		                </a>
		            </div>
              </div>
			<?php endif; ?>
    	<?php endwhile; ?>
   		</div>
    </div>
    <?php else: ?>
        <div class="col-12 sorry-no-posts no-posts-on-map">
            <h2 class="mt-5"><?php _e('We’re sorry!', 'Wellbeing') ?></h2>
            <p><?php _e('We can’t seem to find any wellbeing business, place, or route that matches your search.', 'Wellbeing') ?></p>
            <?php _e('If you can’t find what you’re searching for please:', 'Wellbeing') ?>
            <ul>
                <li><?php _e('try to doublecheck your spelling,', 'Wellbeing') ?></li>
                <li><?php _e('try other search terms,', 'Wellbeing') ?></li>
                <li><?php _e('use our filter function or,', 'Wellbeing') ?></li>
                <li><?php _e('view our map and zoom in on your next destination!', 'Wellbeing') ?></li>
            </ul>
        </div>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
</div>

    <style type="text/css">
        .acf-map-route {
            width: 100%;
            height: calc(100vh - 68px);
            margin: 0;
            outline: none;
            position: absolute;
        }
        .acf-map-route img {
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
            disableDefaultUI: true,
            // zoomControl: true,
            mapTypeId   : google.maps.MapTypeId.ROADMAP,
            styles: [ { "featureType": "administrative", "stylers": [ { "visibility": "on" } ] },{ "featureType": "poi", "stylers": [ { "visibility": "on" } ] },{ "featureType": "landscape", "stylers": [ { "visibility": "simplified" }, { "color": "#c9e2ce" } ] } ]
        };
        var map = new google.maps.Map( $el[0], mapArgs );
        var zoomControlDiv = document.createElement('div');
        var zoomControl = new ZoomControl(zoomControlDiv, map);
        zoomControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(zoomControlDiv);
        // Add markers.
        map.markers = [];
        $markers.each(function(){
            initMarker( $(this), map );
        });
        // Center map based on markers.
        centerMap( map );

        var markerCluster = new MarkerClusterer(map, map.markers, {
            styles: [{'textColor': '#fff', 'url': '/app/themes/wellbeing/images/markerclaster.png', 'width': '37', 'height': '55', 'textSize': '14'}],
        });
        // Return map instance.
        return map;

    }

    function ZoomControl(controlDiv, map) {
      
      // Creating divs & styles for custom zoom control
      controlDiv.style.padding = '10px';

      // Set CSS for the control wrapper
      var controlWrapper = document.createElement('div');
      
      controlWrapper.style.cursor = 'pointer';
      controlWrapper.style.textAlign = 'center';
     
      controlDiv.appendChild(controlWrapper);
      
      // Set CSS for the zoomIn
      var zoomInButton = document.createElement('div');
      zoomInButton.className = 'zoom-in-btn';
      controlWrapper.appendChild(zoomInButton);
        
      // Set CSS for the zoomOut
      var zoomOutButton = document.createElement('div');
      zoomOutButton.className = 'zoom-out-btn';

      controlWrapper.appendChild(zoomOutButton);

      // Setup the click event listener - zoomIn
      google.maps.event.addDomListener(zoomInButton, 'click', function() {
        map.setZoom(map.getZoom() + 1);
      });
        
      // Setup the click event listener - zoomOut
      google.maps.event.addDomListener(zoomOutButton, 'click', function() {
        map.setZoom(map.getZoom() - 1);
      });  
        
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
        // var markerIconRouteNumber = $marker.attr('places-number');
        var marker = new MarkerWithLabel({
           map: map,
           animation: google.maps.Animation.DROP,
           position: latLng,
           icon: markerIcon,
           // label: {color: '#fff', fontSize: '17px', fontWeight: '600', text: markerIconRouteNumber},
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