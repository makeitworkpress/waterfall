<?php
/** 
 * Displays the header of each template
 *
 * @since 1.0.0
 */
$layout_classes = wa_layout_option_classes(); 
$favicon = wa_retrieve_theme_options('wa_favicon'); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(); ?> - <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        
        <?php if($favicon) {  
            echo '<link href="' . $favicon . '" rel="shortcut icon" type="image/x-icon">';
        } ?>

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		
        <!--[if lt IE 9]>
            <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
        <![endif]-->		

		<?php wp_head(); ?>

	</head>
	<body <?php body_class($layout_classes); ?>>
        <div id="page" class="hfeed site" itemscope="itemscope" itemtype="http://www.schema.org/WebPage">
            <?= wa_ie(); ?>
            <header id="header" class="header clear" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
                <div class="branding left" role="banner" itemscope="itemscope" itemtype="http://schema.org/Organization">
                    <a class="logo" itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?= wa_get_logo(); ?>
                    </a>
                    <meta itemprop="name" content="<?php bloginfo('name'); ?>" />   
                    <meta itemprop="description" content="<?php bloginfo('description'); ?>" />
                </div>
                <nav class="navigation right" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>        
                </nav>
            </header>
            <div id="main" class="main">