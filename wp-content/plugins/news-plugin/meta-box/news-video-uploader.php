<?php
// wp_enqueue_media();  
$videos = get_post_meta($post->ID, 'custom_videos', true) ?: [];
?>
<div class="video-repeater">
    <h1>Upload image</h1>
    <div id="video-container">

        <?php
        if (!empty($videos)):
            foreach ($videos as $video_id): ?>
                <div class="repeater-row">
                    <input type="text" name="custom_videos[]" value="<?php echo  esc_attr($video_id) ?>" class="video-id-input">
                    <button type="button" class="upload-button button">Select Video</button>
                    <button type="button" class="remove-button button">×</button>
                    <?php echo $video_id; ?>
                </div>
        <?php
            endforeach;
        endif; ?>

        <button type="button" id="add-video" class="button button-primary">Add New Video</button>
    </div>
</div>  