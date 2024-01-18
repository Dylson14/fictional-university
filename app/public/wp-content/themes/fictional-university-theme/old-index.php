<!-- ******DO NOT DELETE!! IMPORTANT COMMENTS!!*******
File Description:
This file is really the meats of our website, 
where the main content lives, it's the homepage.
-->

<!-- get_header(), Docs: Loads the header template, includes the header template
for a theme or if a name is specified, then a specialized header will be included 
GPT: used to retrieve and include the header template file in a theme, such template is usually found in the header.php file, and its purpose is to load the header section of a Wordpress theme.
-->
<?php get_header(); ?>

<?php
/* 
    have_posts(), determines whether current Wordpress query has posts to loop over
    GPT: it's a function used within the loop to check if there are any posts remaining 
    in the current query
*/
while (have_posts()) {
    /* the function the_post() checks whether the loop has started 
       and then sets the current post by moving, each time, to the next
       post in queue
         */
    the_post(); ?>
    <!-- the_permalink() displays the permalink (the URL) for the current post, within the loop. It's the specific link to a specific page or post in your wordpress site -->
    <!-- <br>
    <br>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p> <?php the_content(); ?> </p>
    <hr> -->
<?php };
?> 

<?php get_footer(); ?>
