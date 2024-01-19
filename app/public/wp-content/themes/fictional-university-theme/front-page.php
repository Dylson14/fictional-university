<!-- File Description:
This file is really the meats of our website, 
where the main content lives, it's the homepage.
-->
<!--********************** DO NOT DELETE, IMPORTANT COMMENTS HERE **********************-->
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
<?php
/* How do we know if a func is going to output/echo something for us, or if it's simply going to return a value (when you return a value, it's stored in memory, but never outputted to the browser). A good rule of thumb to determine whether a func will output a value or not is if the func starts with the word "get" that it will NOT output a value, it will just return one in memory, on the otherhand, if a WP func starts with the word "the_" then it will output a value for us to use! */
/* the_title();
get_the_title(); */
?>
<!--********************** DO NOT DELETE, IMPORTANT COMMENTS HERE **********************-->

<!-- get_header(), Docs: Loads the header template, includes the header template
for a theme or if a name is specified, then a specialized header will be included 
GPT: used to retrieve and include the header template file in a theme, such template is usually found in the header.php file, and its purpose is to load the header section of a Wordpress theme.
-->
<?php get_header(); ?>

<div class="page-banner">
    <!--  get_theme_file_uri() this allows you to load custom files (CSS, images, etc.), not just the default style.css file, you need to provide the path in the parenthesis where the css file is you wish to load -->
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/library-hero.jpg') ?>)"></div>
    <div class="page-banner__content container t-center c-white">
        <h1 class="headline headline--large">Welcome!</h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>


<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

            <?php
            $today = date('Ymd');
            $homepageEvents = new WP_Query(array(
                'posts_per_page' => -1,
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
                    )
                )
            ));

            while ($homepageEvents->have_posts()) {
                $homepageEvents->the_post(); ?>
                <div class="event-summary">
                    <a class="event-summary__date t-center" href="#">
                        <span class="event-summary__month"><?php 
                        /* get_field() is a custom func from the ACF plugin, the error appears because it does not have the file access to the ACF plugin, 
                        but it works as intended */
                            $eventDate = new DateTime(get_field('event_date'));
                            echo $eventDate->format('M');
                        ?></span>
                        <span class="event-summary__day"><?php 
                            $eventDate = new DateTime(get_field('event_date'));
                            echo $eventDate->format('d');
                        ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p> <?php if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18);
                            }
                             ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                    </div>
                </div>
            <?php }
            ?>

            <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn--blue">View All Events</a></p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
            <!--  -->
            <?php
            /* this is a class that comes out the box with WP, we just need to tell the class what we need to query */
            $homepagePosts = new WP_Query(array(
                'posts_per_page' => 2
            ));

            while ($homepagePosts->have_posts()) {
                $homepagePosts->the_post(); ?>
                <div class="event-summary">
                    <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                        <span class="event-summary__month"><?php the_time('M'); ?></span>
                        <span class="event-summary__day"><?php the_time('d'); ?></span>
                    </a>
                    <div class="event-summary__content">
                        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p><?php if (has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                                echo wp_trim_words(get_the_content(), 18);
                            }
                             ?><a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
                    </div>
                </div>
            <?php }
            wp_reset_postdata(); ?>
            <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <!--  get_theme_file_uri() this allows you to load custom files (CSS, images, etc.), -->
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bus.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Transportation</h2>
                        <p class="t-center">All students have free unlimited bus fare.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <!--  get_theme_file_uri() this allows you to load custom files (CSS, images, etc.), -->
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/apples.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">An Apple a Day</h2>
                        <p class="t-center">Our dentistry program recommends eating apples.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
            <!--  get_theme_file_uri() this allows you to load custom files (CSS, images, etc.), -->
            <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/bread.jpg') ?>)">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">Fictional University offers lunch plans for those in need.</p>
                        <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>

<?php get_footer(); ?>