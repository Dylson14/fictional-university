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
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <!-- get_the_title() explan: allows you to pass in an ID number in the parentheses and it will give you the title for that item instead of the currnet item you're on -->
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('campus') ?>"><i class="fa fa-home" aria-hidden="true"></i>All Campuses</a>
                    <span class="metabox__main"> <?php the_title(); ?></span>
                </p>
            </div>

            <div class="generic-content"><?php the_content(); ?></div>

            <div class="acf-map">
                <?php $mapLocation = get_field('map_location'); ?>
                <div class="marker" data-lat="<?php echo $mapLocation['lat']; ?>" data-lng="<?php echo $mapLocation['lng']; ?>">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo $mapLocation['address'] ?></p>
                </div>
            </div>

            <?php
            $relatedPrograms = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'program',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'related_campus',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ));

            if ($relatedPrograms->have_posts()) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">Programs available at this campus:</h2>';
                echo '<ul class="min-list link-list">';
                while ($relatedPrograms->have_posts()) {
                    $relatedPrograms->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </li>
            <?php }
                echo '</ul>';
            }

            wp_reset_postdata();

            ?>
        </div>

    <?php };
/* get_footer() loads footer template, same thing as the get_header() */
get_footer();
    ?>