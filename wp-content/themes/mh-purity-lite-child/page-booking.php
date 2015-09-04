<?php /* Template Name: Page-Bookings */ ?>
<?php get_header(); ?>

<div class="wrapper">
	<?php mh_before_page_content(); ?>
    <div <?php post_class(); ?>>
		<div class="entry clearfix">
        <div id="booking-container">
        <?php include('booking.php')?>
</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>