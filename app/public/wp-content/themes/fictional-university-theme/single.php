<!-- File Description: 
Wordpress only uses single.php for individual posts.
This file has to do with the single posts, if it doesn't exist 
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
       post in queue */
    the_post(); 
    pageBanner();
    ?>
    <div class="container container--narrow page-section">

        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <!-- get_the_title() explan: allows you to pass in an ID number in the parentheses and it will give you the title for that item instead of the currnet item you're on -->
                    <a class="metabox__blog-home-link" href="<?php echo site_url('/blog') ?>"><i class="fa fa-home" aria-hidden="true"></i> Blog Home</a>
                    <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('M.j.Y'); ?> in <?php echo get_the_category_list(', ') ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

        </div>

    <?php };
/* get_footer() loads footer template, same thing as the get_header() */
get_footer();
    ?>