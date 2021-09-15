<?php
/*
 * The Header for our theme.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (is_single()) {
        global $post;
        $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full'); ?>
        <meta property="og:url" content="<?php echo get_permalink(); ?>">
        <meta property="og:title" content="<?php echo get_the_title(); ?>">
        <meta property="og:description" content="<?php echo substr($post->post_content,0,100); ?>">
        <meta property="og:image" content="<?php echo esc_attr($thumbnail_src[0]); ?>">
        <meta property="og:image:secure_url" content="<?php echo esc_attr($thumbnail_src[0]); ?>">
    <?php } ?>
    <!--    <meta name="description" content="--><?php //bloginfo('description'); ?><!--" />-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <link media="all" rel="stylesheet" type="text/css"
          href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/ie9.css">
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <!--    <script src='https://www.google.com/recaptcha/api.js'></script>-->
    <?php wp_head(); ?>
</head>
<body id="bd" <?php body_class(); ?>>
<?php
$autoshowroom_loading_url=ot_get_option('autoshowroom_loading');
if (ot_get_option('autoshowroom_loading_onoff', 'no') == 'yes') {
?>
<div id="tzloadding">
    <?php if (isset($autoshowroom_loading_url) && !empty($autoshowroom_loading_url)):?>
        <img class="loading_img" src="<?php echo esc_url($autoshowroom_loading_url); ?>"
             alt="<?php esc_attr_e('loading...', 'autoshowroom') ?>"
             />
    <?php else: ?>
        <img class="loading_img" src="<?php echo esc_url(get_template_directory_uri() . '/images/loading.gif'); ?>" alt="<?php esc_attr_e('loading...', 'autoshowroom') ?>">
    <?php endif; ?>
</div>
<?php } ?>