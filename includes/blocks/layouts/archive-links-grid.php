<?php

/**
 * Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'blockhaus-select-page-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'blockhaus-select-page';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$links = get_field('archive_links');

// var_dump($links);

if($links): 

$count = count($links);
if($count === 1) {
  $cols = 'lg:grid-cols-1';
  $img_size = 'profile';
} else {
  $cols = 'lg:grid-cols-2';
  $img_size = 'thumbnail';
}

endif;
?>

<aside id="<?php echo $id;?>" class="grid <?php echo $cols;?> gap-6 lg:bg-neutral-light-100 rounded-md lg:p-6">
  
<?php 

if( have_rows('archive_links') ):

  // Loop through rows.
  while( have_rows('archive_links') ) : the_row();

      // Load sub field value.
      $title = get_sub_field('link_text');
      $img = get_sub_field('link_image');
      
      ?>
      
      <a class="flex flex-col lg:flex-row group items-center bg-neutral-light-100 lg:bg-primary-default rounded-md overflow-hidden" href="<?php the_sub_field('link');?>" rel="bookmark" aria-label="Read <?php echo $title;?>">
      <?php if($img) {
        echo wp_get_attachment_image( $img, $img_size, "", array( 'class' => 'w-full object-cover aspect-video lg:aspect-square lg:w-auto bg-accent' ));
      } ?>
      <div class="flex flex-col gap-2 p-6">
        <span class="font-bold"><?php echo $title;?></span>
        <span class="bg-yellow-300 group-focus:bg-white group-hover:bg-white transition-all duration-200 group-focus:-rotate-2 group-hover:-rotate-2 border border-current w-fit px-2 shadow-retro inline-flex -rotate-1">Read More</span>
      </div>
    </a>
     
  <?php endwhile;

// No value.
else :
  // Do something...
endif;?>



</aside>
