<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="wrapper clearfix">
	<div class="content <?php mh_content_class(); ?>"><?php
		mh_before_post_content();
		get_template_part('content', get_post_format());
		mh_after_post_content();
		endwhile;
		comments_template();
		endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>