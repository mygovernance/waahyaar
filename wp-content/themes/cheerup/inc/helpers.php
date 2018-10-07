<?php
/**
 * General Template tags / View Helpers
 */
class Bunyad_Theme_Helpers
{
	/**
	 * View Helper: Output mobile logo
	 */
	public function mobile_logo()
	{
		if (!Bunyad::options()->mobile_logo_2x) {
			return;
		}
		
		// Attachment id is saved in the option
		$id   = Bunyad::options()->mobile_logo_2x;
		$logo = wp_get_attachment_image_src($id, 'full');
		
		if (!$logo) {
			return;
		}
			
		// Have the logo attachment - use half sizes for attributes since it's in 2x size
		if (is_array($logo)) {
			$url = $logo[0]; 
			$width  = round($logo[1] / 2);
			$height = round($logo[2] / 2);
		}
		
		?>
					
		<img class="mobile-logo" src="<?php echo esc_url($url); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" 
			alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />

		<?php
	}
	
	/**
	 * Categories for meta
	 */
	public function meta_cats()
	{
		// Primary category
		if (($cat_label = Bunyad::posts()->meta('cat_label'))) {
			$category = get_category($cat_label);
		}
		else {
			$category = current(get_the_category());
		}
		
		// Object has category taxonomy? i.e., is it a post or a valid CPT?
		if (!in_array('category', get_object_taxonomies(get_post_type()))) {
			return;
		}

		if (is_single() && Bunyad::options()->single_all_cats): // Show all categories? 
					
			 echo get_the_category_list(' ');
					
		elseif (is_object($category)): // Show only Primary 
		
		?>
					
		<a href="<?php 
			echo esc_url(get_category_link($category)); ?>" class="category"><?php echo esc_html($category->name); 
		?></a>

		<?php 
		
		endif;
	}
	
	/**
	 * Get the loop template with handling via a dynamic loop template
	 * for special cases.
	 * 
	 * @param  string  $id
	 * @param  array   $data
	 * @param  array   $options
	 * @see Bunyad_Core::partial()
	 */
	public function loop($id = '', $data = array(), $options = array()) 
	{
		if (empty($id)) {
			$id = 'loop';
		}
		
		// Dynamic loop templates configuration
		$dynamic = array(
			'loop-grid'               => array('number' => 0),
			'loop-grid-3'             => array('number' => 0, 'grid_cols' => 3),
			'loop-list'               => array('number' => 0, 'type' => 'list'),
			'loop-1st-large'          => array('number' => 100),
			'loop-1st-large-list'     => array('type' => 'list', 'number' => 100),
			'loop-1st-overlay'        => array('large' => 'overlay', 'number' => 100),
			'loop-1st-overlay-list'   => array('large' => 'overlay', 'number' => 100, 'type' => 'list'),
			'loop-1-2'                => array(),
			'loop-1-2-list'           => array('type' => 'list'),
			'loop-1-2-overlay'        => array('large' => 'overlay'),
			'loop-1-2-overlay-list'   => array('large' => 'overlay', 'type' => 'list')
		);
		
		// Is a dynamic template?
		if (array_key_exists($id, $dynamic)) {
			
			if (!empty($options)) {
				$dynamic[$id] = array_merge($dynamic[$id], $options);
			}
			
			// Loaded through load more? Ignore mixed/first large
			if (!empty($_GET['first_normal'])) {
				$dynamic[$id]['number'] = 0;	
			}
			
			// Render our dynamic loop
			return Bunyad::core()->partial(
				'loop-dynamic', 
				array_merge($dynamic[$id], $data, array('loop' => $id))
			);
		}
		
		Bunyad::core()->partial($id, $data);
	}
	
	/**
	 * Output meta partial based on theme settings
	 * 
	 * @param string|null $type  From $partials definitions or special cases like 'grid'
	 * @param array       $vars  Varaibles to pass to partial
	 */
	public function post_meta($type = null, $vars = array())
	{
		// Fixed maps that don't change with bunyad options
		// Other recognized that do change: grid, single
		$partials = array(
			'default' => 'post-meta',
			'small'   => 'post-meta',
			'alt'     => 'post-meta-alt',
			'list-b'  => 'post-meta'
		);

		/**
		 * Check if a fixed partial is defined
		 */
		if ($type && array_key_exists($type, $partials)) {
			$partial = $partials[$type];
		}
		else {

			/**
			 * Use a partial based on identifier and its settings
			 */
			
			// Grid has its own setting for meta - can override global
			if ($type == 'grid') {
				$meta_style = Bunyad::options()->post_grid_meta_style;
			}
			
			// Default to global - unless set above and is not empty/default
			if (empty($meta_style)) {
				$meta_style = Bunyad::options()->meta_style;
			}

			// If anything other than default meta, where:
			//  - Default Meta = style-a or empty 
			if (!in_array($meta_style, array('', 'style-a'))) {
				$partial = 'post-meta-' . str_replace('style-', '', $meta_style);
			}
		}

		// Fallback if nothing defined
		if (!isset($partial)) {
			$partial = $partials['default'];

			// Unique case: Fallback for single is not default 'post-meta'
			if ($type == 'single') {
				$partial = $partials['alt'];
			}
		}

		Bunyad::core()->partial('partials/' . $partial, $vars);
	}
	
	/**
	 * Display category label overlay when conditions meet
	 */
	public function meta_cat_label($options = array())
	{
		if (!Bunyad::options()->meta_cat_labels && empty($options['force'])) {
			return;
		}
		
		$class = 'cat-label cf';
		
		if (!empty($options['class'])) {
			$class .= ' ' . $options['class'];
		}
		
		?>
		
		<span class="<?php echo esc_attr($class); ?>"><?php echo $this->meta_cats(); ?></span>
		
		<?php
	}
	
	/**
	 * Get relative width for current block, based on parent column width in 
	 * relation to the whole container.
	 * 
	 * @return  float  Column width in percent number, example 66
	 */
	public function relative_width()
	{
		// Set current column width weight (width/100) - used to determine image sizing 
		$col_relative_width = 1;
		if (isset(Bunyad::registry()->layout['col_relative_width'])) {
			$col_relative_width = Bunyad::registry()->layout['col_relative_width'];
		}
	
		// Adjust relative width if there's a sidebar
		if (Bunyad::core()->get_sidebar() != 'none') {
			$col_relative_width = ($col_relative_width * (8/12)); 
		}
		
		return $col_relative_width * 100;
	}
}


// init and make available in Bunyad::get('helpers')
Bunyad::register('helpers', array(
	'class' => 'Bunyad_Theme_Helpers',
	'init' => true
));