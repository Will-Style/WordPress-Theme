<?php $Core = new WillStyleCore;?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="skype_toolbar" content="skype_toolbar_parser_compatible">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <?php $Core->site_title();?>
	<meta name="robots" content="index,follow">
	<meta name="format-detection" content="telephone=no">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo ROOT;?>dist/ico/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo ROOT;?>dist/ico/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo ROOT;?>dist/ico/favicon-16x16.png">
	<link rel="manifest" href="<?php echo ROOT;?>dist/ico/site.webmanifest">
	<link rel="mask-icon" href="<?php echo ROOT;?>dist/ico/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?> &raquo; フィード" href="<?php echo home_url('/');?>feed/" /><?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo ROOT;?>dist/css/styles.css?date=20200323">
    <?php $Core->ga();?>
</head>
<body data-barba="wrapper">
    <?php 
        $namespace = "default";
        if( is_page(['contact/confirm','contact/complete','social-policy','pp']) ):
            $namespace = "not-loading";
        endif;
        if(isset($_SESSION['mw_wp_form_token'])):
            $namespace = "not-loading";
        endif;
    ?>
    <div id="page" data-barba="container" data-barba-namespace="<?php echo $namespace;?>">
    <?php if( !is_page(['social-policy','pp']) ):?>
        <?php include('inc/global-header.php');?>
    <?php  endif;?>