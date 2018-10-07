<?php
/**
 * Block: Highlights
 */


/**
 * Process the block and setup the query
 * 
 * @var array  $atts  Shortcode attribs by Bunyad_Theme_ShortCodes::_render()
 * @var string $tag   Shortcode used, example: highlights
 * 
 * @see Bunyad_ShortCodes::__call()
 */
$block = new Bunyad_Theme_Block($atts, $tag);
$query = $block->process()->query;


?>

<section <?php Bunyad::markup()->attribs('highlights-block', array('class' => array('cf block', 'highlights-block'), 'data-id' => $block->block_id)); ?>>
	
	<?php echo $block->output_heading(); ?>
	
	<div class="block-content">
		<div class="large cf">
			
		<?php while ($query->have_posts()): $query->the_post(); ?>
		
			<article <?php post_class('grid-post'); ?>>
					
				<div class="post-header">
					<div class="post-thumb">
						<a href="<?php the_permalink(); ?>" class="image-link">
							<?php 
								the_post_thumbnail(
									'cheerup-grid',
									array('title' => strip_tags(get_the_title()))
								); 
							?>
						</a>
						
						<?php Bunyad::get('helpers')->meta_cat_label(); ?>
					</div>
					
					
					<div class="meta-title">
						<?php Bunyad::get('helpers')->post_meta('grid'); ?>
					</div>
				</div>
				
				<div class="post-content post-excerpt cf">
				<?php
		
					// Excerpt
					echo Bunyad::posts()->excerpt(null, Bunyad::options()->post_excerpt_grid, array('add_more' => false));
				 
				?>
				</div><!-- .post-content -->
	
			</article>

		
			<?php
				// This loop is for large posts only 
				if (($query->current_post + 1) == 1): 
					break; 
				endif; 
			?>
		
		<?php endwhile; ?>
			
		</div>


		<div class="posts-list">
		
		<?php while ($query->have_posts()): $query->the_post(); ?>

			<article class="small-post cf">
				<a href="<?php the_permalink() ?>" class="image-link"><?php 
					the_post_thumbnail('cheerup-thumb', array('title' => strip_tags(get_the_title()) )); 
				?>				
				</a>
				
				<div class="content">
					
					<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
					
					<?php 
					Bunyad::core()->partial('partials/post-meta', array('show_title' => false, 'show_cat' => false, 'show_author' => false)); 
					?>
					
				</div>
			</article>
		
		<?php endwhile; ?>

		</div>
	
	</div> <!-- .block-content -->
	
</section>
	
<?php wp_reset_postdata(); ?>