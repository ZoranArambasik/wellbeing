<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta property="og:image" content="<?php bloginfo('html_type'); ?>"/>
<meta property = "og: title" content = "Article title" />
<meta property = "og: description" content = "Running text or preface to be read." />
<meta property = "og: image" content = "<?php bloginfo('url') ?>/länktillbilden.jpg" />
<meta property = "og: url" content = "<?php bloginfo('url') ?>/länkenillartikeln" />
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6THXMK');</script>
<!-- End Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-F8X8WV9TNB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-F8X8WV9TNB');
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
		if (is_singular(array('places', 'company', 'trails'))) { ?>
			<div id="fb-root"></div>
    	<?php } ?>
	
	<section id="header">
		<div class="mobile-menu-holder icons">
			<button class="menu-icon menu-icon--transparent animated rubberBand">
			    <span></span>
			    <span></span>
			    <span></span>
			</button>
		</div>
		<div class="header container">
			<div class="head-content">
				<div class="header-logo">
					<a href="<?php bloginfo('url') ?>">
					<?php
						if ( is_active_sidebar( 'website-logo' ) ) : 
							dynamic_sidebar( 'website-logo' ); 
						endif; 
					 ?>
					</a>
				</div>
				<div class="desktop-menu">
					<?php 
						if ( is_active_sidebar( 'head-menu' ) ) : 
							dynamic_sidebar( 'head-menu' ); 
						endif;
					?>
				</div>
			</div>
		</div>
	</section>
		


