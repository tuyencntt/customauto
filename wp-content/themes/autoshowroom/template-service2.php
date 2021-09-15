<?php
/*
 * Template Name: Template Service 2
 */
?>
<?php get_header(); ?>
<?php get_template_part('template_inc/inc','menu'); ?>
<?php get_template_part('template_inc/inc','title-breadcrumb'); ?>
    <section class="container-content auto-page-content service2">
        <?php
        while (have_posts()) : the_post() ;
            ?>
            <div <?php post_class() ?>>
                <?php the_content();
                wp_link_pages();
                ?>
            </div>
            <?php
            comments_template();
        endwhile;
        ?>
    </section>
<?php
get_template_part('template_inc/inc','contact');
get_template_part('template_inc/inc','footer');
get_footer();
?>