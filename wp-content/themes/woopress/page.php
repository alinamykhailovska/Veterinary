<?php
get_header();
?>

<?php

$l = et_page_config();

?>

<?php //do_action('et_page_heading'); ?>

<?php
if ($_SERVER[REQUEST_URI] == "/") {
    include 'main-header-img.php';
}
?>
<div class="container content-page">

    <?php
    if ($_SERVER[REQUEST_URI] == "/") {
        include 'main-page.php';
    }
    ?>

    <div class="page-content sidebar-position-<?php esc_attr_e($l['sidebar']); ?> sidebar-mobile-<?php esc_attr_e($l['sidebar-mobile']); ?>">
        <div class="row">

            <div class="content <?php esc_attr_e($l['content-class']); ?>">
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                    <?php the_content(); ?>

                    <div class="post-navigation">
                        <?php wp_link_pages(); ?>
                    </div>

                    <?php if ($post->ID != 0 && current_user_can('edit_post', $post->ID)): ?>
                        <?php edit_post_link(__('Edit this', ET_DOMAIN), '<p class="edit-link">', '</p>'); ?>
                    <?php endif ?>

                <?php endwhile; else: ?>

                    <h3><?php _e('Страница не найдена', ET_DOMAIN) ?></h3>

                <?php endif; ?>
                <?php


                ?>

            </div>

            <?php
            $page_id = get_queried_object_id();
            if ($page_id == 515): ?>
                <div class="col-md-3 col-md-pull-9 sidebar sidebar-left">
                    <div class="sidebar-widget widget_categories">

                        <?php
                        $categories = get_categories([
                            'taxonomy' => 'category',
                            'type' => 'post',
                            'child_of' => 0,
                            'orderby' => 'sort',
                            'parent' => '',

                        ]);
                        foreach ($categories as $cat) {
                            if ($categories && $cat->parent === 0 && $cat->term_id == 31) {
                                echo '<div class="category-wrapper">';

                                echo '<h4 class="side-li">' . $cat->name . ' </h4><div style="border: 1px solid #E5E5E5;"></div>';
                                $myposts = get_posts(array(
                                    'numberposts' => -1,
                                    'category' => $cat->cat_ID,
                                    'orderby' => 'sort',
                                    'order' => 'ASC',
                                ));
                                echo '<ul class="side-ul">';
                                global $post;
                                foreach ($myposts as $post) {
                                    setup_postdata($post);
                                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                }
                                wp_reset_postdata(); // сбрасываем глобальную переменную пост
                                echo '</ul>';

                                echo '</div>';
                            }
                        } ?>


                    </div>
                </div>
            <?php endif; ?>


            <!--            --><?php //get_sidebar(); ?>

        </div><!-- end row-fluid-->

    </div>
</div><!-- end container -->
<?php
get_footer();
?>
