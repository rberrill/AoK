<?php $page_id = get_the_ID(); ?>
<?php if (get_field('faq', $page_id)) { ?>
    <ul>
        <?php while (the_repeater_field('faq', $page_id)) { ?>
            <li style="margin-bottom: 10px;">
                <h5><?php the_sub_field('question'); ?></h5>
                <span style="font-style:italic;font-size:.75em;"><?php the_sub_field('information'); ?></span>
            </li>
        <?php } ?>
        <ul>
        <?php } ?>
