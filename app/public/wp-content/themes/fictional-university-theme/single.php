<!-- File Description:
Wordpress only uses single.php for individual posts.
This file has to do with the single posts, if it doesn't exist 
wordpress will default to index.php
Depending on the current URL, wordpress will be on the lookout
for different file names in our theme folder(i.e functions.php, page.php etc.).
-->

<?php
/* have_posts(), determines whether current Wordpress query has posts to loop over
    GPT: it's a function used within the loop to check if there are any posts remaining 
    in the current query
*/
get_header();

while (have_posts()) {
    /* the function the_post() checks whether the loop has started 
       and then sets the current post by moving, each time, to the next
       post in queue
    */
    the_post(); ?>
    <!-- the_permalink() displays the permalink (the URL) for the current post, within the loop. It's the specific link to a specific page or post in your wordpress site -->
    <br>
    <br>
    <h2><?php the_title(); ?></h2>
    <p> <?php the_content(); ?> </p>
<?php };

get_footer();
?>

<!-- ********************************************************* -->
<!-- This was the old version w/out any comments, I'll leave it here in case
I need it back
    
    <?php

get_header();

while(have_posts()){
        the_post(); ?>
        <h2>  <?php the_title(); ?> </h2>
        <?php the_content(); ?>
    <?php }

get_footer();

?> -->