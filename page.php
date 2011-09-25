<?php
/**
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

get_header(); 
$has_faq = false;
?>

<div id="main_content">
    <div class="left_content">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="yellow_sq"></div>
						<h1 class="page-title"><?php the_title(); ?></h1>
                                        <div class="append-bottom"></div>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
	<?php
	if(get_field("faq")) {
		$has_faq = true;
	}
	?>
<?php endwhile; ?>
    </div>
    <div class="sidebar">
        <?php if($has_faq) { get_sidebar(); } ?>
		<ul class="xoxo">
			<?php dynamic_sidebar( 'socialmedia-widgets' ); ?>
		</ul>
    </div>
    <br clear="all"></br>
</div>
<?php get_footer(); ?>