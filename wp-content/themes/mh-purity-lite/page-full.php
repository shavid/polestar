<?php /* Template Name: Page - Full Width */ ?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="wrapper">
	<?php mh_before_page_content(); ?>
    <div <?php post_class(); ?>>
		<div class="entry clearfix">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; ?>
    <?php comments_template(); ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>