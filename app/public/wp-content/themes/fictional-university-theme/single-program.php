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
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program') ?>"><i class="fa fa-home" aria-hidden="true"></i>All Programs</a>
                    <span class="metabox__main"> <?php the_title(); ?></span>
                </p>
            </div>
            <div class="generic-content">
                <?php the_content(); ?>
            </div>
            <?php
            $relatedProfessors = new WP_Query(array(
                'posts_per_page' => -1,
                'post_type' => 'professor',
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ));

            if ($relatedProfessors->have_posts()) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
                echo '<ul class="professor-cards">';
                    while ($relatedProfessors->have_posts()) {
                        $relatedProfessors->the_post(); ?>
                        <li class="professor-card__list-item">
                            <a class="professor-card" href="<?php the_permalink(); ?>">
                                <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>" alt="">
                                <span class="professor-card__name"><?php the_title(); ?></span>
                            </a>
                        </li>
                    <?php }
                echo '</ul>';
            }

            wp_reset_postdata();

            $today = date('Ymd');
            $homepageEvents = new WP_Query(array(
                'posts_per_page' => 2,
                'post_type' => 'event',
                'meta_key' => 'event_date',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ),
                    array(
                        'key' => 'related_programs',
                        'compare' => 'LIKE',
                        'value' => '"' . get_the_ID() . '"'
                    )
                )
            ));

            if ($homepageEvents->have_posts()) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Professors</h2>';

                while ($homepageEvents->have_posts()) {
                    $homepageEvents->the_post(); 
                   get_template_part('template-parts/content-event');
             }
            }

            wp_reset_postdata();
            $relatedCampuses = get_field('related_campus');

            if ($relatedCampuses) {
                echo '<hr class="section-break">';
                echo '<h2 class="headline headline--medium">' . get_the_title() . ' is Available at this campuses</h2>';
                echo '<ul class = "min-list link-list">';
                foreach($relatedCampuses as $campus){
                    ?>  
                    <li><a href=""><?php echo get_the_title($campus); ?></a></li>
                    <?php
                }
                echo '</ul>';
            }

            ?>
        </div>

    <?php };
/* get_footer() loads footer template, same thing as the get_header() */
get_footer();
    ?>