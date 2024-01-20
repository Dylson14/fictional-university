<!-- File Description:
Wordpress uses page.php for individual pages.
This file has to do with the pages, if it doesn't exist 
wordpress will default to index.php
Depending on the current URL, wordpress will be on the lookout
for different file names in our theme folder(i.e functions.php, page.php etc.). -->

<!--********************** DO NOT DELETE, IMPORTANT COMMENTS HERE **********************-->
<!-- Just know that this content belonged in between the header and footer of the page.php file -->
<!-- /* have_posts(), determines whether current Wordpress query has posts to loop over
    GPT: it's a function used within the loop to check if there are any posts remaining 
    in the current query */ -->
<?php while (have_posts()) {
  /* the function the_post() checks whether the loop has started 
       and then sets the current post by moving, each time, to the next
       post in queue
    */
  the_post(); ?>
  <!-- the_permalink() displays the permalink (the URL) for the current post, within the loop. It's the specific link to a specific page or post in your wordpress site -->
  <!-- <br>
    <br>
    <h1>this is a page, not a post!</h1>
    <h2><?php the_title(); ?></h2>
    <p> <?php the_content(); ?> </p> -->
<?php }; ?>
<?php
/* get_the_ID() explan: Gets the ID of the page or post. Docs: Retrieves the ID of the current item in the WordPress Loop. */
/* wp_get_post_parent_id() explan: within the parenthesis (so takes an arg), we give it an ID for a page or a post, and this func will respond by giving us back the ID number for that page's parent. */
/*  echo "This is my own ID " . get_the_ID(); ?>
      <br>
      <?php echo "This is my parents ID: " . wp_get_post_parent_id(get_the_ID()); 
       /* in an if condition, the value of 0 is set to false, any value ABOVE 1...+ is set to true 
    If the page is a parent page, the value in the if condition is 0, i.e false. Because it has no parent, so the parent ID will be 0, or non-existent*/
/* if(wp_get_post_parent_id(get_the_ID())){
      echo "I am a child page";
    }  */
?>
<!--********************** DO NOT DELETE, IMPORTANT COMMENTS HERE **********************-->


<!-- /* get_header(), Docs: Loads the header template, includes the header template
for a theme or if a name is specified, then a specialized header will be included 
GPT: used to retrieve and include the header template file in a theme, such template is usually found in the header.php file */ -->
<?php get_header(); ?>
<!-- have_posts(), determines whether current Wordpress query has posts to loop over
    GPT: it's a function used within the loop to check if there are any posts remaining 
    in the current query -->
<?php while (have_posts()) {
  /* the function the_post() checks whether the loop has started 
       and then sets the current post by moving, each time, to the next
       post in queue. The the_post() also gives us a range of available funcs to use, such as the_title() and more, see link for more.
       See here: https://developer.wordpress.org/reference/functions/the_post/#comment-4927
    */
    the_post(); 

    pageBanner();
    ?>
    
  <div class="container container--narrow page-section">

    <?php
    /* in an if condition, the value of 0 is set to false, any value ABOVE 1...+ is set to true 
    If the page is a parent page, the value in the if condition is 0, i.e false. Because it has no parent, so the parent ID will be 0, or non-existent, so the code in the if block will not get executed*/
    $theParent = wp_get_post_parent_id(get_the_ID());
    if ($theParent) { ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <!-- get_the_title() explan: allows you to pass in an ID number in the parentheses and it will give you the title for that item instead of the currnet item you're on -->
          <a class="metabox__blog-home-link" href="<?php echo get_the_permalink($theParent) ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a>
          <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>
    <?php } ?>

    <!-- what happens when we go to a page that has no child pages nor any parent page. We wish to not display the side-menu at all -->
    <?php 
    /* if the current page has children, this function will return a collection of any and all children pages. On the other hand, if the current page doesn't have any children, this function won't return anything */
      $testArray = get_pages(array(
        'child_of' => get_the_ID()
      ));
    if ($theParent or $testArray) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a></h2>
        <ul class="min-list">
          <?php
          /* wp_list_pages() lists every page on the website, now we need to see how to render only the children pages 
        "title_li" => NULL, removes the default pages title the func outputs
        */
          /* if on a parent page, use the get_the_ID(), but if you're in the child page, find the id of the parent */
          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages(array(
            "title_li" => NULL,
            "child_of" => $findChildrenOf,
            'sort_column' => 'menu_order'
          ));
          ?>
        </ul>
      </div>
    <?php  } ?>



    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  </div>

<?php }
get_footer(); ?>