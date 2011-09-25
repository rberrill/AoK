<?php

// Quick function just to show what template is being loaded
function getTemplateName () {
    foreach ( debug_backtrace() as $called_file ) {
	foreach ( $called_file as $index ) {
            if ( !is_array($index[0]) AND strstr($index[0],'/themes/') AND !strstr($index[0],'footer.php') ) {
                $template_file = $index[0] ;
            }
	}
    }
    $template_contents = file_get_contents($template_file) ;
    preg_match_all("(Template Name:(.*)\n)siU",$template_contents,$template_name);
    $template_name = trim($template_name[1][0]);
    if ( !$template_name ) { $template_name = '(default)' ; }
    $template_file = array_pop(explode('/themes/', basename($template_file)));
  return $template_file . ' > '. $template_name ;
}


// Menu setup functions/superfish information
register_nav_menu('footer','Footer Nav Menu');

// Modify the excerpt length in use on our site
function new_excerpt_length($length) {
	return 55;
}
add_filter('excerpt_length', 'new_excerpt_length',999);

// Add custom image sizes in so that we can use the built in wordpress code to resize and crop images
if (function_exists("add_theme_support")) {
    add_theme_support('post-thumbnails');
    add_image_size('header',770,300,true);
    add_image_size('home-page-small',110,110,true);
    add_image_size('map',300,300,true);
}

// Add our custom post types to the Right now portion of the dashboard
function ucc_right_now_content_table_end() {
  $args = array(
    'public' => true ,
    '_builtin' => false
  );
  $output = 'object';
  $operator = 'and';

  $post_types = get_post_types( $args , $output , $operator );

  foreach( $post_types as $post_type ) {
    $num_posts = wp_count_posts( $post_type->name );
    $num = number_format_i18n( $num_posts->publish );
    $text = _n( $post_type->labels->singular_name, $post_type->labels->name , intval( $num_posts->publish ) );
    if ( current_user_can( 'edit_posts' ) ) {
      $num = "<a href='edit.php?post_type=$post_type->name'>$num</a>";
      $text = "<a href='edit.php?post_type=$post_type->name'>$text</a>";
    }
    echo '<tr><td class="first b b-' . $post_type->name . '">' . $num . '</td>';
    echo '<td class="t ' . $post_type->name . '">' . $text . '</td></tr>';
  }

}
add_action( 'right_now_content_table_end' , 'ucc_right_now_content_table_end' );

// Remove the admin bar links for logged in users that we don't use
function remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('new-acf');
	$wp_admin_bar->remove_menu('new-media');
	$wp_admin_bar->remove_menu('new-link');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// Enqueue the scripts in use on the site, much cleaner than doing it int he head and easier to manage later
function add_our_scripts() {
    if (!is_admin()) { // Add the scripts, but not to the wp-admin section.
        // Adjust the below path to where scripts dir is, if you must.
        $scriptdir = get_stylesheet_directory_uri()."/js/";

        // Remove the wordpresss inbuilt jQuery.
        wp_deregister_script('jquery');

        // Lets use the one from Google AJAX API instead.
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js', false, '1.6.2');

        wp_register_script( 'slides', $scriptdir.'slides.min.jquery.js', false, '1.1.8');
        wp_register_script( 'slides_load', $scriptdir.'slides_load.js', false, '1.0.0');

//        wp_register_script( 'superfish', $scriptdir.'sf/js/superfish.js', false, '1.4.8');
//        wp_register_style( 'superfish-css', $scriptdir.'sf/css/superfish.css', false, '1.4.8');
//        wp_register_script( 'sf_load', $scriptdir.'sf_load.js', false, '1.0.0');

        //load the scripts and style.
        wp_enqueue_script('jquery');

        wp_enqueue_script('slides');
        wp_enqueue_script('slides_load');

//        wp_enqueue_script('superfish');
//        wp_enqueue_style('superfish-css');
//        wp_enqueue_script('sf_load');
    } // end the !is_admin function
} //end add_our_scripts function
add_action( 'wp_head', 'add_our_scripts',0);

function getPathHierarchy() {
    $requestPath = explode("/",$_SERVER["REQUEST_URI"]);
                                $pathHierarchy = array();
                                foreach($requestPath as $path) {
                                    if($path) {
                                        $pathHierarchy[] = $path;
                                    }
                                }

                                return $pathHierarchy;
}

function add_first_and_last($output) {
  $output = preg_replace('/class="menu-item/', 'class="first-menu-item menu-item', $output, 1);
  $output = substr_replace($output, 'class="last-menu-item menu-item', strripos($output, 'class="menu-item'), strlen('class="menu-item'));
  return $output;
}
add_filter('wp_nav_menu', 'add_first_and_last');

function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Socialmedia Widgets', 'twentyten' ),
		'id' => 'socialmedia-widgets',
		'description' => __( 'Socialmedia widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

function my_testimonials_columns($columns)
{
	$columns = array(
		'cb'	 	=> '<input type="checkbox" />',
                'title' => 'Title',
                'comment'=> 'Comment',
		'name' 	=> 'Name',
		'date'		=>	'Date',
	);
	return $columns;
}
 
function my_custom_columns($column)
{
	global $post;
        if($column == 'name')
	{
		if(get_field('testimonial_name'))
		{
			echo get_field('testimonial_name');
		}
		else
		{
			echo '';
		}
	}
        if($column == 'comment') {
                if(get_field('testimonial_comment'))
		{
			echo get_field('testimonial_comment');
		}
		else
		{
			echo '';
		}
        }
}
 
add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-testimonials_columns", "my_testimonials_columns");
?>
