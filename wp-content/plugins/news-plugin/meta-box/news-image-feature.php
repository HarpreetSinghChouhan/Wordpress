<?php
$images = get_post_meta($post->ID, 'custom_images', true)  ?: [];
//  echo "<h1></h1>"
// var_dump($post->ID);
?>
<div class="image-repeater">
  <h1>Upload image</h1>
  <div id="image-container">
    

    <?php
    if (!empty($images)) :
      foreach ($images as $image_id): ?>
        <div class="repeater-row">
          <input type="hidden" name="custom_images[]" value="<?php echo  esc_attr($image_id) ?>" class="image-id-input">
          <img src="<?php echo  esc_attr($image_id) ?>" alt="new image" width="400px" height="200px" >
          <button type="button" class="upload-button button">Select Video</button>
          <button type="button" class="remove-button button">×</button>
          <?php// echo $image_id; ?>
        </div>
    <?php
      endforeach;
    endif;
    ?>
    <button type="button" id="Add_image" class="button button-primary">Add new Images </button>
  </div>
</div>