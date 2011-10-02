<?php
/**
 * Template Name: Locations Template
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
	global $post;
	$tmp_post = $post;
    $args = array( 'post_type' => 'locations', 'posts_per_page' => 3 );
$myposts = get_posts($args);
foreach( $myposts as $post ) :	setup_postdata($post);
echo "<div class='location'>";
	?>
	<h4 class="location-title"><?php the_title(); ?> </h4>
	<div class="location-left">
		<ul>
			<li>
				<h5><?php the_field("location_title"); ?></h5>
			</li>
			<li>
				<?php the_field("location_address_1"); ?>
			</li>
			<li>
				<?php the_field("location_address_2"); ?>
			</li>
			<li>
				<p></p>
			</li>
			<li>
				<?php the_field("location_phone"); ?>
			</li>
			<li>
				<?php the_field("location_fax"); ?>
			</li>
			<li>
				<?php the_field("location_email"); ?>
			</li>
                        <li style="margin-top:40px; font-size: 14px;">
                            <?php the_field("location_description"); ?>
                        </li>
		</ul>
	</div>
	<div class="location-right">
		<img src="<?php $image_src = wp_get_attachment_image_src(get_field("location_map"),"map",false); echo $image_src[0]; ?>" />
	</div>
	<br clear="all" />
		<?php
			if(get_field("menus")) {
				?>
				<div id="menus">
				<h5>Menus for this Location:</h5>
				<?php
				while(the_repeater_field("menus")) {
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
		<?php 
		endforeach;	
		$post = $tmp_post;
		?>
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