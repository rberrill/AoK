<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers 3.0
 */
?>
<div class="footer">
    <div align="center"> 
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer', // Setting up the location for the main-menu, Main Navigation.
                    'menu_class' => 'sf-menu', //Adding the class for dropdowns
                    'container_id' => 'navwrap', //Add CSS ID to the containter that wraps the menu.
                    'container_class' => 'menu-header',
                    'fallback_cb' => 'wp_page_menu', //if wp_nav_menu is unavailable, WordPress displays wp_page_menu function, which displays the pages of your blog.
                        )
                );
                ?>
        <p>Copyright © 2011 AOK GOURMET - All Rights Reserved.<br>
            <br>
            <a href="<?php echo home_url(); ?>/wp-admin">Site Dashboard</a><br>
            <i>For additional menu ideas please call our Catering Office at 847.329.7035</i></p>
    </div>
</div>    </div>
<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
</body>
</html>