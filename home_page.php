<?php
/*
 * Template Name: Home Page Template
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
global $wp_query;

$page_object = $wp_query->get_queried_object();
$page_id = $wp_query->get_queried_object_id();

get_header();
?>

<div id="twin_box">
    <div class="left_box">
        <div class="yellow_sq"></div>
        <h4>
            <?php the_field("home_page_left_content_title"); ?>
        </h4>
        <?php the_field("home_page_left_content"); ?>
        <?php
        if (get_field("home_page_left_menus")) {
            ?>
                <?php
                while (the_repeater_field("home_page_left_menus")) {
                    ?>
                    <div style="margin: 10px 0 0 45px;">
                        <h6 style="font-size:13px">
                            <img src="<? echo get_stylesheet_directory_uri(); ?>/img/pdf.gif" height="15" />
                            <a href="<?php the_sub_field("file"); ?>" style="font-size:12px;">
                                Download Menu
                            </a>
                            -<?php the_sub_field("title"); ?>
                        </h6>
                        <p style="margin-left: 0;"><?php the_sub_field("description"); ?></p>
                    </div>
                    <?php
                }
        }
            ?>
    </div>
    <div class="right_box">
        <div class="yellow_sq"></div>
        <h4>
            <?php the_field("home_page_right_content_title"); ?>
        </h4>
        <?php the_field("home_page_right_content"); ?>
    </div>
    <br clear="all"></br>
</div>
<div id="main_content">
    <div class="left_content">
        <?php
        $args = array('post_type' => 'news', 'posts_per_page' => 3);
        $loop = new WP_Query($args);
        while ($loop->have_posts()) : $loop->the_post();
            echo "<div class='front_page_news'>";
            ?><h4 class="news-title"><?php the_title(); ?> - <?php the_date(); ?></h4><?php
        echo '<div class="entry-content">';
        if (has_post_thumbnail()) {
            the_post_thumbnail('home-page-small');
        }
        the_content();
        echo '</div></div>';
    endwhile;
        ?>            
    </div>
    <div class="sidebar">
        <?php // get_sidebar(); ?>
        <ul class="xoxo">
            <?php dynamic_sidebar('socialmedia-widgets'); ?>
        </ul>
    </div>
    <br clear="all"></br>
</div>
<?php get_footer(); ?>