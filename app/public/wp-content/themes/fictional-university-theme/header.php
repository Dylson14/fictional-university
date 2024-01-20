<!DOCTYPE html>
<!-- sets the page language to english-US -->
<html <?php language_attributes() ?>>

<head>
  <!-- this is how we tell the browser what type of characters or lettters and numbers you're going to be using on the page -->
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta>
  <!-- COMMENT: In WP, instead of manually including our css file using a link, we 
      call a PHP function named wp_head(), and this func is responsible for our head section, 
      it gets the final say in what CSS or other content/links can be loaded in the head. Now we need a way to programatically tell wordpress to load our CSS file and any other relevant links, and that's through the functions.php file. -->
  <!-- allows mobile devices to use their native viewport sizes -->
  <meta name="viewport" content="width=device-width" initial-scale=1>
  </meta>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container">
      <h1 class="school-logo-text float-left">
        <!-- site_url() explan: Retrieves the URL for the current site. Works even when core URL may change, just focuses on the trailing endpoints  -->
        <a href="<?php echo site_url('/'); ?>"><strong>Fictional</strong> University</a>
      </h1>
      <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
      <div class="site-header__menu group">
        <nav class="main-navigation">
          <ul>
            <!-- you don't want your links to just point to the root of the current domain, as in, your URL may change many times, the core root of your URL may change, it may not always be "fictional-university.local", but can change, a more reliable way to get your links working independent of what the core URL is, is to use site_url('<page url here>')  -->
            <li <?php if (is_page('about-us') or wp_get_post_parent_id(0) == 12) echo 'class="current-menu-item"' ?>>
              <a href="<?php echo site_url('/about-us'); ?>">About Us</a>
            </li>

            <li <?php if (get_post_type() == 'program') echo 'class = "current-menu-item"' ?>>
              <a href="<?php echo get_post_type_archive_link('program'); ?>">Programs</a>
            </li>

            <li <?php if (get_post_type() == 'event' or is_page('past-events')) echo 'class = "current-menu-item"' ?>>
              <a href="<?php echo get_post_type_archive_link('event'); ?>">Events</a>
            </li>

            <li><a href="#">Campuses</a></li>

            <li <?php if (get_post_type() == 'post') echo 'class="current-menu-item"' ?>>
              <a href="<?php echo site_url('/blog') ?>">Blog</a>
            </li>
          </ul>
        </nav>
        <div class="site-header__util">
          <a href="#" class="btn btn--small btn--orange float-left push-right">Login</a>
          <a href="#" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
          <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
        </div>
      </div>
    </div>
  </header>