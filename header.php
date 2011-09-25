<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name='author-corporate' content='Designed and Developed by Jason Kalish' />
        <meta name='author-cms' content="Developed by Richard Berrill RCBDesigns.net" />
        <meta name='copyright' content='AOK GOURMET -- @copy;2011' />
        <title><?php
/*
 * Print the <title> tag based on what is being viewed.
 * We filter the output of wp_title() a bit -- see
 * twentyten_filter_wp_title() in functions.php.
 */
wp_title('|', true, 'right');
?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />

        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php
        /* We add some JavaScript to pages with the comment form
         * to support sites with threaded comments (when in use).
         */
        if (is_singular() && get_option('thread_comments'))
            wp_enqueue_script('comment-reply');

        /* Always have wp_head() just before the closing </head>
         * tag of your theme, or you will break many plugins, which
         * generally use this hook to add elements to <head> such
         * as styles, scripts, and meta tags.
         */
        wp_head();
        ?>
    </head>

    <body <?php body_class(); ?>>
        <?php // if (current_user_can('manage_options')) { ?>

        <!-- <div id="devHelper">
            Template Loaded: <?php // echo getTemplateName();  ?>
        </div> -->

        <?php //} ?>
        <div id="global_box">

            <div class="top_logo_img"> <a href="../../../index.php"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/aok.gif" alt="AOK GOURMET - On the Go" width="254" height="140" /></a> 
            </div>
            <div id="navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary', // Setting up the location for the main-menu, Main Navigation.
                    'menu_class' => 'sf-menu', //Adding the class for dropdowns
                    'container_id' => 'navwrap', //Add CSS ID to the containter that wraps the menu.
                    'container_class' => 'menu-header',
                    'fallback_cb' => 'wp_page_menu', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
                        )
                );
                ?>

            </div>
            <?php $page_id = $wp_query->post->ID; ?>

            <?php if (get_field('header_image', $page_id)) { ?>
                <div class="main_img">
                    <div id="slides">
                        <div class="slides_container">
                            <?php while (the_repeater_field('header_image', $page_id)): ?>
                                <div class="slide">
                                    <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>" />
                                    <div class="caption" style="bottom:0">
                                        <h2><?php the_sub_field('title'); ?></h2>
                                        <p><?php the_sub_field('caption'); ?></p> 
                                    </div> 
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    randomizeContent("slide");
                </script>
            <?php }
            else if (get_field('header_image', 'options')) { ?>
                <div class="main_img">
                    <div id="slides">
                        <div class="slides_container">
                            <?php while (the_repeater_field('header_image', 'options')): ?>
                                <div class="slide">
                                    <img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('title'); ?>" />
                                    <div class="caption" style="bottom:0">
                                        <h2><?php the_sub_field('title'); ?></h2>
                                        <p><?php the_sub_field('caption'); ?></p> 
                                    </div> 
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    randomizeContent("slide");
                </script>
            <?php } ?>

