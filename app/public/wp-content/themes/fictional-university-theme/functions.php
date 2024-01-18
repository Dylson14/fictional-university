<?php 
/* <!-- All the other files are called template files, 
they control the HTML that the public will see.
This file is more private, our behind-the-scenes file. 
This is where we can have a conversation with the Wordpress system itself--> */

function university_files(){
    /* we bring in JS files with wp_enqueue_script() func, takes 5 args, 1st is the nickname which can be anything, 2nd is the path of the JS file. We use get_theme_file_uri() to point to specific file location. When loading JS, it takes more args than a CSS file. In the 3rd arg, WP wants to know of any file dependencies, an example of a dependency is jquery, if there is no dependencies just place NULL and the 4th arg is the version number, the last arg is WP asking us if we want to load the file right before the closing body tag, which you can say true for yes and false for no. */
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    /* in this func, we can load as many CSS or JS files we wish. To do so we'll need to call on a WP func. wp_enqueue_ style()*/
    /* for  wp_enqueue_ style('a','b); in the parentheses it takes 2 arguments, first is a nickname for the file. and the 2nd arg is the location that points to the file*/
    /* get_stylesheet_uri(), a func that gets the default stylesheet (style.css), so no need to point to the css file. So if those were your 2 arguments you'd get: 
        wp_enqueue_style('university_main_styles', get_stylesheet_uri());
    */
    /* TO LOAD JS files: you need to change wp_enqueue_style to wp_enqueue_script */
    /* wp_enqueue_style('university_main_styles', get_stylesheet_uri()) <- explanation for this is found above; */
    /* get_theme_file_uri() this allows you to load custom files (CSS, images, etc.), not just the default style.css file, you need to provide the path in the parenthesis where the css file is you wish to load*/
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
    /* For the font awesome & google fonts, we are no longer pointing to a file, as such, we didn't use  get_theme_file_uri() func, instead just pointed to the URL directyl*/
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

/* add_action() explan: WP lets us give this function instructions and tell it 
what to do with the add_action() func, it takes 2 arguments, The 1st argument is where we tell WP what type of instructions we are giving it, depeneding on what we are trying to do WP will run it at different times */
/* wp_enqueue_scripts, this special WP hook is used to load a file. Telling WP we want to load some CSS or JS files.  */
/* the 2nd arg. is giving WP the name of a func we want to run. The name can be anything we wish. You'll then need to create this function with the exact name, as you can see above^ */
add_action('wp_enqueue_scripts','university_files');

function university_features() {
    /* register_nav_menu(), allows us to enable a menu option*/
    /* register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two'); */
    /* when you want to enable a feature for your theme, this is the func that you call: 
        add_theme_support(), the feature we are interested in is the title_tag */
    add_theme_support('title-tag');
}
/*  We need to tell WP to generate an appropriate title tag for each screen, after_setup_theme, this hook fires after the theme is loaded, used to perform basic set up, registration and init actions for a theme  */
add_action('after_setup_theme', 'university_features');
?>
