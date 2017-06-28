<!DOCTYPE html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php wp_title(''); ?></title>
    
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--[if IE]>
      <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <![endif]-->

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php echo mytheme_option( 'analytics' ); ?>

    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
    <header class="header total" role="banner" itemscope itemtype="http://schema.org/WPHeader">
      <div class="container">
        <span class="btn-nav"></span>
        
        <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) ?>/library/images/acm-mafa.png" alt="<?php bloginfo('name'); ?>"></a></div>
        
        <nav id="cssmenu" role="navigation" itemscope="" itemtype="http://schema.org/SiteNavigationElement">          
            <?php wp_nav_menu(array(
             'container' => false,                           // remove nav container
             'container_class' => 'menu cf',                 // class of container (should you choose to use it)
             'menu' => __( 'The Main Menu', 'pew' ),  // nav name
             'menu_class' => 'nav top-nav cf',               // adding custom nav class
             'theme_location' => 'main-nav',                 // where it's located in the theme
             'before' => '',                                 // before the menu
                   'after' => '',                                  // after the menu
                   'link_before' => '',                            // before each link
                   'link_after' => '',                             // after each link
                   'depth' => 0,                                   // limit the depth of the nav
             'fallback_cb' => ''                             // fallback function (if there is one)
            )); ?>
        </nav>
      </div>        
    </header>