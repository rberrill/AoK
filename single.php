<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */

get_header(); ?>
    <div class="prepend-1 span-13 append-1">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>

						<?php twentyten_posted_on(); ?>
                                        <div class="append-bottom"></div>
        <?php 
            if(has_post_thumbnail()) {
                $image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                ?>
                <a href="<? echo $image_data[0]; ?>" rel="lightbox"> <?php the_post_thumbnail('home-page-large'); ?></a>
                <?php
            }
        ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'twentyten' ), 'after' => '' ) ); ?>

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s &rarr;', 'twentyten' ), get_the_author() ); ?>
							</a>
<?php endif; ?>

						<p><?php twentyten_posted_in(); ?></p>
				<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'twentyten' ) . ' %title' ); ?>
				<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'twentyten' ) . '' ); ?>

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

    </div>
    <div class="span-8 append-1 last">
<?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>