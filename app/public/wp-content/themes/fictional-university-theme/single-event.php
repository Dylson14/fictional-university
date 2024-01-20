<!-- File Description: 
This is a single page template specific to the event post type, by naming
our files like single-event the keyword of our custom post type we can
create files like this and customise their looks -->

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
    the_post(); ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('./images/ocean.jpg'); ?>)"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"> <?php the_title(); ?> </h1>
            <div class="page-banner__intro">
                <p>DON'T FORGET TO REPLACE ME LATER!</p>
            </div>
        </div>
    </div>
    <div class="container container--narrow page-section">

        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <!-- get_the_title() explan: allows you to pass in an ID number in the parentheses and it will give you the title for that item instead of the currnet item you're on -->
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event') ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home</a>
                    <span class="metabox__main"> <?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>

            <?php
            $relatedPrograms = get_field('related_programs');

            if ($relatedPrograms) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">Related Program(s)</h2>';
                echo '<ul class="link-list min-list">';
                foreach ($relatedPrograms as $program) {
            ?>
                    <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
            <?php }
                echo '</ul>';
            }

            ?>

        </div>

    <?php };
/* get_footer() loads footer template, same thing as the get_header() */
get_footer();
    ?>