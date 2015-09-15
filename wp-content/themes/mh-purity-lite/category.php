<?php get_header(); ?>
<div class="wrapper clearfix">
	<section class="content <?php mh_content_class(); ?>">
		<?php mh_before_page_content(); ?>
		<?php if (category_description()) { ?>
			<section class="cat-desc">
				<?php echo category_description(); ?>
			</section>
		<?php } ?>
		<?php mh_loop_content(); ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>