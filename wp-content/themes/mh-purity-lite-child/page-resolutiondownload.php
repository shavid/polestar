<?php /* Template Name: Page-ResolutionDownload */ ?>
<!DOCTYPE html>
<html class="no-js<?php mh_html_class(); ?>" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="container">
<header class="header-wrap">
	<a href="http://polestarstudios.co.uk/" title="Polestar Studios" rel="home">
<div class="logo-wrap" role="banner">
<img class="header-image" src="../../../Images/polestar-records-logo2.jpg" height="299" width="1020" alt="Polestar Studios" scale="0">
</div>
</a>

</header>

<div class="wrapper">
	<?php mh_before_page_content(); ?>
    <div <?php post_class(); ?>>
		<div class="entry clearfix">
        <div id="download-container">
        <?php include('downloads/resolutiondownload.php')?>
</div>
		</div>
	</div>
</div>