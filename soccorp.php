<?php
/**
 * Template Name: Social and Corporate Template
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
<?php if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>
<div class="yellow_sq"></div>
						<h1 class="page-title"><?php the_title(); ?></h1>
                                        <div class="append-bottom"></div>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>
	<?php
	if(get_field("faq")) {
		$has_faq = true;
	}
	endwhile;
	}
	?>
	<div class='location'>
	<h4 class="location-title">Social Catering</h4>
	<?php the_field("sc_description"); ?>
	<?php
			if(get_field("sc_menus")) {
				?>
				<div id="menus">
				<h5>Menus:</h5>
				<?php
				while(the_repeater_field("sc_menus")) {
				?>
					<div class="menu">
						<h6><?php the_sub_field("title"); ?></h6>
						<p><?php the_sub_field("description"); ?></p>
						<img src="<? echo get_stylesheet_directory_uri(); ?>/img/pdf.gif" height="15" /><a href="<?php the_sub_field("file"); ?>">Download Menu</a>
					</div>
				<?php
				}
				?></div><?php
				}
				?>
		</div>
	<div class='location'>
	<h4 class="location-title">Corporate Catering</h4>
	<?php the_field("cc_description"); ?>
	<?php
			if(get_field("cc_menus")) {
				?>
				<div id="menus">
				<h5>Menus:</h5>
				<?php
				while(the_repeater_field("cc_menus")) {
				?>
					<div class="menu">
						<h6><?php the_sub_field("title"); ?></h6>
						<p><?php the_sub_field("description"); ?></p>
						<img src="<? echo get_stylesheet_directory_uri(); ?>/img/pdf.gif" height="15" /><a href="<?php the_sub_field("file"); ?>">Download Menu</a>
					</div>
				<?php
				}
				?></div><?php
				}
		?>
		</div>
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