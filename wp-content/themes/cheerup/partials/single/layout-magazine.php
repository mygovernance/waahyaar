<?php
/**
 * Single Post Template: Cover Layout
 */

get_header(); 

// Only usable on a single post and requires the loop starting from a top
// pseudo-header of the post.
if (have_posts()):
	the_post();
endif;

$sub_title = Bunyad::posts()->meta('sub_title');

?>

<div class="main wrap">

	<div <?php
		// Setup article attributes
		Bunyad::markup()->attribs('post-cover-wrapper', array(
			'id'        => 'post-' . get_the_ID(),
			'class'     => join(' ', get_post_class('single-magazine')),
		)); ?>>

	<div class="post-top cf">
		
		<?php echo Bunyad::get('helpers')->meta_cat_label(array('class' => 'color', 'force' => true)); ?>
		
		<h1 class="post-title"><?php the_title(); ?></h1>
		
		<?php if ($sub_title): ?>
		
			<div class="sub-title"><?php echo wp_kses_post(apply_filters('bunyad_sub_title', $sub_title)); ?></div>
		
		<?php endif; ?>
		
		<?php 
			Bunyad::helpers()->post_meta(
				null, 
				array(
					'show_title' => false, 
					'show_cat'   => false,
					'add_class'  => 'the-post-meta'
				)
			); 
		?>
		
		<?php get_template_part('partials/single/social-share-b'); ?>
		
	</div>


	<div class="ts-row cf">
		<div class="col-8 main-content cf">

			<article class="the-post">
			
				<header class="post-header cf">
			
					<?php get_template_part('partials/single/featured'); ?>
					
				</header><!-- .post-header -->
			
				<?php Bunyad::core()->partial('partials/single/post-content', array('author_box' => 'partials/author-box-b')); ?>
					
			</article> <!-- .the-post -->

		</div>
		
		<?php Bunyad::core()->theme_sidebar(); ?>
		
	</div> <!-- .ts-row -->
	
	</div>
</div> <!-- .main -->

<?php get_footer(); ?>