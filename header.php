<!DOCTYPE html>
<html <?php language_attributes(); ?> ng-app="priceReq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png">
  <?php wp_head(); ?>
  <!--title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title-->
  <title><?php is_front_page() ? bloginfo('description') : wp_title(''); ?> - <?php bloginfo('name'); ?></title>
</head>
<body ng-controller="priceReqController as priceReqCtrl" <?php body_class(); ?> role="document">

  <div class="shade-bg"></div>

  <div class="top-message">Item added to request price list</div>
  <div class="item-marker"></div>
  <!-- TOP MENU -->

  <div class="blue-background top-menu-fixed">
    <div class="content-wrapper">
      <span class="responsive-top-menu-button">
        <a id="show-top-menu-items" href="#show-top-menu"><i class="fa fa-bars"></i></a>
      </span>
      <div class="responsive-top-menu" id="responsive-top-menu">
        <?php /* Primary navigation */
          wp_nav_menu( array(
          'menu'              => 'topmenu',
          'theme_location'    => 'topmenu',
          'depth'             => 1,
          'container'         => '',
          'menu_class'        => 'inline-menu',
          'menu_id'           => 'top-menu'
          ));
        ?>
        <span class="request-list">
          <a href="#dummy-link" class="show-request-list">Request Price List
            <span class="items-counter" ng-show="$storage.requestedItems.length" ng-bind="$storage.requestedItems.length">
            </span>
          </a>
        </span>
      </div>
    </div>
  </div>

  <!-- / TOP MENU -->

  <!-- TOP BAR -->
  <div class="orange-background">
    <div class="content-wrapper logo-bar">
      <div id="top-logo">
        <a href="<?php echo get_home_url(); ?>">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo_02.png" alt="" class="logo-img">
        </a>
      </div>
      <div id="call-to-action">
        <?php if ( is_active_sidebar( 'oilog_call_us' ) ) : ?>
          <?php dynamic_sidebar( 'oilog_call_us' ); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- / TOP BAR -->

  <!-- NAVBAR -->
  <div class="navbar">
    <div class="content-wrapper">
      <span class="responsive-nav-menu-button">
        <a id="show-nav-menu-items" href="#show-nav-menu"><i class="fa fa-bars"></i></a>
      </span>
      <div id="responsive-nav-menu">
        <?php /* Primary navigation */
          wp_nav_menu( array(
          'menu'              => 'primary',
          'theme_location'    => 'primary',
          'depth'             => 1,
          'container'         => '',
          'menu_class'        => 'navbar-menu inline-menu'
          ));
        ?>
        <div class="search-wrapper">
          <?php if ( is_active_sidebar( 'oilog_search_bar' ) ) : ?>
            <?php dynamic_sidebar( 'oilog_search_bar' ); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- / NAVBAR -->
