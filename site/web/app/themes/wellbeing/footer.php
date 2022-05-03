<?php if (is_page_template('template-wellbeing-company.php')): ?>
	 <?php  
	 $args = array( 'post_type' => 'footer_subscribe', 'posts_per_page' => 1);
	 $the_query = new WP_Query( $args );?>
	   <?php if ( $the_query->have_posts() ) :  ?> 
	    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?> 
	    	<?php the_content(); ?>
	     <?php wp_reset_postdata(); ?>
	   <?php endwhile; endif; ?>
<?php endif; ?>
<?php 
	// is_singular(array('places', 'company', 'trails')) ||
	if (is_page_template('template-wellbeing-company.php')): 
		 
		 $args = array( 'post_type' => 'footer_signup', 'posts_per_page' => 1);
		 $the_query = new WP_Query( $args );
		 if ( $the_query->have_posts() ) :  
		    while ( $the_query->have_posts() ) : $the_query->the_post(); 
		    	the_content();
		      wp_reset_postdata();
		   endwhile; endif;
	endif; 
?>
<section id="footer">
	<div class="top-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-3">
					<div class="footer-description">
						<?php
							if ( is_active_sidebar( 'footer-logo' ) ) : 
								dynamic_sidebar( 'footer-logo' ); 
							endif; 
						 ?>
					</div>
				</div>
				<div class="col-xl-6 mb-3">
					<div class="row">
						<?php if ( is_active_sidebar( 'footer-menu' ) ) : ?>
							<div class="col-md-4 mb-3"><?php dynamic_sidebar( 'footer-menu' ); ?> </div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer-menu-two' ) ) : ?>
							<div class="col-md-4 mb-3"><?php dynamic_sidebar( 'footer-menu-two' ); ?></div>
						<?php endif; ?>
					  		<?php if ( is_active_sidebar( 'footer-menu-three' ) ) : ?>
							<div class="col-md-4 mb-3"><?php dynamic_sidebar( 'footer-menu-three' ); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-xl-6 mb-3 mt-1 ml-md-auto text-xl-right">
					<div class="footer-social-links social-links semi-padding-bottom">
			        	<div class="follow-us"><?php _e('Follow us', 'Wellbeing'); ?>:</div>
			        	<?php if (!empty(get_theme_mod( "Facebook" ))): ?>
			        		<a target="_blank" href="<?php echo get_theme_mod( "Facebook" ); ?>"><i class="fab fa-facebook-f"></i> Facebook</a>
			        	<?php endif ?>
			        	<?php if (!empty(get_theme_mod( "Instagram" ))): ?>
			        		<a target="_blank" href="<?php echo get_theme_mod( "Instagram" ); ?>"><i class="fab fa-instagram"></i> Instagram</a>
			        	<?php endif ?>
			        	<?php if (!empty(get_theme_mod( "Twitter" ))): ?>
			        		<a target="_blank" href="<?php echo get_theme_mod( "Twitter" ); ?>"><i class="fab fa-twitter"></i> Twitter</a>
			        	<?php endif ?>
			        	<?php if (!empty(get_theme_mod( "Linkedin" ))): ?>
			        		<a target="_blank" href="<?php echo get_theme_mod( "Linkedin" ); ?>"><i class="fab fa-linkedin-in"></i> Linkedin</a>
			        	<?php endif ?>
			        	<?php if (!empty(get_theme_mod( "Youtube" ))): ?>
			        		 <a target="_blank" href="<?php echo get_theme_mod("Youtube"); ?>"><i class="fab fa-youtube"></i> Youtube</a>
			        	<?php endif ?>
				    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-3 mb-3">
							<?php
								if ( is_active_sidebar( 'sb-well-image' ) ) : 
									dynamic_sidebar( 'sb-well-image' ); 
								endif; 
							 ?>
						</div>
						<div class="col-md-4 mb-3">
							<?php
								if ( is_active_sidebar( 'footer-europe-image' ) ) : 
									dynamic_sidebar( 'footer-europe-image' ); 
								endif; 
							 ?>
						</div>
						<div class="col-md-3 mb-3">
							<?php
								if ( is_active_sidebar( 'footer-image-right' ) ) : 
									dynamic_sidebar( 'footer-image-right' ); 
								endif; 
							 ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-3">
							<?php
								if ( is_active_sidebar( 'kontakt-info' ) ) : 
									dynamic_sidebar( 'kontakt-info' ); 
								endif; 
							 ?>
						</div>
						<div class="col-md-12">
							<p><b><?php _e('Publisher and contact', 'Wellbeing'); ?>: <a href="mailto:wellbeing@lnu.se">wellbeing@lnu.se</a></b><br><span>© <?php echo date('Y'); ?> <?php _e('by', 'Wellbeing'); ?> SB WELL, <?php _e('hosted by', 'Wellbeing'); ?> Linnaeus <?php _e('University', 'Wellbeing'); ?>.</span></p>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
$current_id = get_the_ID();
$current_post_type = get_post_type($current_id);

	$is_translated = apply_filters( 'wpml_element_has_translations', NULL, $current_id, $current_post_type);
	if (!$is_translated) { ?>
		<div id="google_translate_element"></div>
		<script type="text/javascript">// <![CDATA[
		// function setCookie(key, value, expiry) {
		//   var expires = new Date();
		//   expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
		//   document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
		// }
		function googleTranslateElementInit() {
		// setCookie('googtrans', '/de',1);
		new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages : 'en,de,lt,pl,da,sv'}, 'google_translate_element');
		}
		jQuery(document).ready(function() {
			jQuery('.wpml-ls-menu-item').hide();
		})
		// ]]></script>
		<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
	<?php } ?>

<!-- <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a> -->
<?php wp_footer() ?>
</body>
</html>
