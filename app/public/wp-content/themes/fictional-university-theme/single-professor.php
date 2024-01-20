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
    the_post(); 
    pageBanner();
    ?>
    
    <div class="container container--narrow page-section">

        <div class="container container--narrow page-section">

            <div class="generic-content">
                <div class="row group">

                    <div class="one-third">
                        <?php the_post_thumbnail('professorPortrait'); ?>
                    </div>

                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>

                </div>
            </div>

            <?php
            $relatedPrograms = get_field('related_programs');

            if ($relatedPrograms) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
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