<!-- File Description:
Wordpress uses page.php for individual pages.
This file has to do with the pages, if it doesn't exist 
wordpress will default to index.php
Depending on the current URL, wordpress will be on the lookout
for different file names in our theme folder(i.e functions.php, page.php etc.). -->

<?php
/* get_header(), Docs: Loads the header template, includes the header template
for a theme or if a name is specified, then a specialized header will be included 
GPT: used to retrieve and include the header template file in a theme, such template is usually found in the header.php file */
get_header();
/* have_posts(), determines whether current Wordpress query has posts to loop over
    GPT: it's a function used within the loop to check if there are any posts remaining 
    in the current query */
while (have_posts()) {
    /* the function the_post() checks whether the loop has started 
       and then sets the current post by moving, each time, to the next
       post in queue
    */
    the_post(); ?>
    <!-- the_permalink() displays the permalink (the URL) for the current post, within the loop. It's the specific link to a specific page or post in your wordpress site -->
    <br>
    <br>
    <h1>this is a page, not a post!</h1>
    <h2><?php the_title(); ?></h2>
    <p> <?php the_content(); ?> </p>
<?php };

get_footer();
?>



<!-- ********************************************************* -->
<!-- This was the old version w/out any comments, I'll leave it here in case
I need it back -->

<!-- <?php

get_header();

while (have_posts()) {
  the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg') ?>)"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>DONT FORGET TO REPLACE ME LATER</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">


    <?php
    $theParent = wp_get_post_parent_id(get_the_ID());
    if ($theParent) {
    ?>

      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>

    <?php } ?>

    <?php
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent || $testArray) { ?>

      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
        <ul class="min-list">
          <?php

          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages([
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          ]);

          ?>
        </ul>
      </div>
    <?php  } ?>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  </div>

<?php }

get_footer();

?> -->