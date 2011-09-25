<?php
global $post;
$tmp_post = $post;
$args = array('post_type' => 'testimonials', 'posts_per_page' => 1, 'orderby' => 'rand');
$myposts = get_posts($args);
?>
<div id="testimonials">
    <?php
    foreach ($myposts as $post) {
        setup_postdata($post);
        ?><blockquote><?php
    the_field("testimonial_comment");
        ?></blockquote><?php
        ?><p><?php
    the_field("testimonial_name");
        ?></p><?php
    }
    ?>
</div>
<?php
$post = $tmp_post;
?>