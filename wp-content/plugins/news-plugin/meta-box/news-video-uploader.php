<?php
// wp_enqueue_media();  
$videos = get_post_meta($post->ID, 'custom_videos', true) ?: [];
?>
<div class="video-repeater">
    <h1>Upload video</h1>
    <div id="video-container">

        <?php
        if (!empty($videos)):
            foreach ($videos as $video_url): ?>
                <div class="repeater-row">
                    <input type="hidden" name="custom_videos[]" value="<?php echo  esc_attr($video_url) ?>" class="video-id-input"><video src="<?php echo  esc_attr($video_url) ?>" autoplay ></video>

                    <button type="button" class="upload-button button">Select Video</button>
                    <button type="button" class="remove-button button">×</button>
                    <?php echo $video_url; ?>
                </div>
        <?php
            endforeach;
        endif; ?>

        <button type="button" id="add-video" class="button button-primary">Add New Video</button>
    </div>
</div>  