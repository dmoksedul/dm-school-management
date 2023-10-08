<?php

// Enqueue custom plugin styles and scripts
function dm_image_slider_enqueue_scripts() {
    wp_enqueue_script('dm-swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.8.4', true);
    wp_enqueue_style('dm-swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.8.4');
    wp_enqueue_style('dm-image-slider-css', plugins_url('css/styles.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'dm_image_slider_enqueue_scripts');

function dm_image_slider_settings_page() {
    // Check if the current user is an administrator
    if (current_user_can('administrator')) {
        // Handle image delete action
        if (isset($_GET['delete']) && $_GET['delete']) {
            $image_id = sanitize_text_field($_GET['delete']);
            dm_image_slider_delete_image($image_id);
        }
    }

    // Handle image upload (Updated)
    if (isset($_POST['upload_image']) && !empty($_POST['slider_image'])) {
        $image_id = intval($_POST['slider_image']);

        if ($image_id) {
            $uploaded_images = get_option('dm_image_slider_uploaded_images', array());
            $uploaded_images[] = $image_id;
            update_option('dm_image_slider_uploaded_images', $uploaded_images);

            echo '<div class="updated"><p>Image uploaded successfully.</p></div>';
        }
    }

    // Get uploaded images with newest first
    $uploaded_images = get_option('dm_image_slider_uploaded_images', array());
    $uploaded_images = array_reverse($uploaded_images);

    ?>
    <style>
        /* Your custom styles here */
        .swiper-container {
            overflow: hidden !important; 
        }
        .admin_img_box_list .swiper{
            max-width:100% !important;
            padding:10px;
            overflow: hidden;
            border-radius: 12px;
            margin: 30px 20px;
            box-shadow: 0 0 10px 0 #00000026;
            text-align:center;
        }
        .admin_img_box_list .swiper-wrapper{
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
        }
        @media screen and (max-width:540px){
            .admin_img_box_list .swiper-wrapper{
                display: grid;
                grid-template-columns: 1fr;
            }
        }
        .admin_img_box_list .swiper-slide{
            border-radius: 12px;
            margin: 30px 20px;
            box-shadow: 0 0 10px 0 #00000026;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding:10px;
            overflow: hidden;
        }
        .admin_img_box_list .swiper-slide img{
            max-width:100%;
        }
        .admin_img_box_list .delete-image-button{
            background: #135E96;
            padding:5px 20px;
            border-radius:2px;
            color:#fff !important;
            text-decoration:none !important;
            display:block;
            margin:20px 0px;
        }
    </style>
    <div class="wrap">
        <h2>DM Image Slider</h2>
        <!-- Upload image form -->
        <form method="post" action="" style="padding: 10px;
            border-radius: 12px;
            max-width: 500px;
            margin: 30px 20px;
            box-shadow: 0 0 10px 0 #00000026;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
            <div class="image_upload_form">
                <input style="margin-bottom:-5px" type="button" id="upload_image_button" class="button" value="Choose Image" required>
                <input type="hidden" name="slider_image" id="slider_image" value="" required>
                <?php submit_button('Upload Image', 'primary', 'upload_image'); ?>
            </div>
            
            <div id="image_preview" style="display: none;">
                            <?php
                            if (!empty($uploaded_images)) {
                                $image_url = wp_get_attachment_image_url($uploaded_images[0], 'full');
                                if ($image_url) {
                                    echo '<img style="max-width:400px" src="' . esc_url($image_url) . '" alt="Slider Image" style="max-width:100%;">';
                                }
                            }
                            ?>
            </div>
        </form>
        <div class="admin_img_box_list">
            <!-- Display uploaded images -->
        <h3 class="title">Uploaded Image List</h3>
            <div class="item_box">
            <?php foreach ($uploaded_images as $image_id) : ?>
                        <div class="list_item">
                            <?php
                            $image_url = wp_get_attachment_image_url($image_id, 'full');
                            if ($image_url) {
                            ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="Slider Image">
                                <?php
                                // Display the delete button for administrators
                                if (current_user_can('administrator')) {
                                    $delete_url = admin_url('admin.php?page=dm_theme_management&delete=' . $image_id);
                                    ?>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="delete-image-button" style="color: red; text-decoration: underline;">Delete</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
    <style>
        .image_upload_form{
            display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 20px;margin-bottom:20px
        }
        .admin_img_box_list {
            box-shadow: 0 0 10px #0000002e;
            padding: 20px;
            max-width: 1200px;
            border-radius: 12px;
        }
        h3.title {
            font-size: 23px;
            margin-left: 20px;
            border-bottom: 1px solid #00000045;
            padding-bottom: 10px;
        }
        img{
            max-width:100%;
        }
        .item_box {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            max-width: 1200px;
            border-radius: 20px;
            overflow: hidden;
        }
        .list_item {
            box-shadow: 0 0 10px #0000003d;
            margin: 10px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .list_item img {
            max-height: 150px;
            width: 100%;
            height: 100%;
        }
        a.delete-image-button {
            background: #08a88a !important;
            padding: 5px 20px;
            border-radius: 2px;
            color: #fff !important;
            text-decoration: none !important;
            margin: 15px;
        }
    </style>
    <script>
        jQuery(document).ready(function ($) {
            var customUploader;
            $('#upload_image_button').click(function (e) {
                e.preventDefault();
                if (customUploader) {
                    customUploader.open();
                    return;
                }
                customUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });
                customUploader.on('select', function () {
                    var attachment = customUploader.state().get('selection').first().toJSON();
                    $('#slider_image').val(attachment.id);
                    $('#image_preview img').attr('src', attachment.url);
                    $('#image_preview').show(); // Show the preview image
                });
                customUploader.open();
            });
        });
    </script>
    <?php
}


// Delete image from the gallery only
function dm_image_slider_delete_image($image_id) {
    $image_id = intval($image_id);

    if ($image_id) {
        $uploaded_images = get_option('dm_image_slider_uploaded_images', array());

        // Remove the image from the uploaded images array
        $key = array_search($image_id, $uploaded_images);
        if ($key !== false) {
            unset($uploaded_images[$key]);
            update_option('dm_image_slider_uploaded_images', $uploaded_images);
        }
    }
}


// Handle image uploads (Updated)
function dm_image_slider_handle_upload() {
    // No need for this function anymore since we use the media uploader
}

add_action('admin_init', 'dm_image_slider_handle_upload');

// Register the shortcode
function dm_image_slider_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => -1, // Default to display all images
        'animation_speed' => 2000, // Default animation speed in milliseconds (3 seconds)
    ), $atts);

    ob_start();
    ?>
    <div class="swiper-container" style="overflow:hidden; position:relative;">
        <div class="swiper-wrapper">
            <?php
            $uploaded_images = get_option('dm_image_slider_uploaded_images', array());

            // Apply the limit on the number of images displayed
            if ($atts['limit'] > 0) {
                $uploaded_images = array_slice($uploaded_images, 0, $atts['limit']);
            }

            foreach ($uploaded_images as $image_id) {
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                ?>
                <div class="swiper-slide">
                    <img src="<?php echo esc_url($image_url); ?>" style="width:100%; max-width:100%;" alt="Slider Image">
                </div>
                <?php
            }

            if (empty($uploaded_images)) {
                echo 'No images uploaded yet.';
            }
            ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var mySwiper = new Swiper('.swiper-container', {
                loop: true, // Enable loop
                autoplay: {
                    delay: <?php echo intval($atts['animation_speed']); ?>, // Auto-sliding with a specified delay
                    disableOnInteraction: false, // Allow user interactions without stopping autoplay
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                speed: <?php echo intval($atts['animation_speed']); ?>, // Animation speed in milliseconds
                initialSlide: 0, // Start with the first slide
            });
        });
    </script>
    <style>
        .swiper-button-next:after, .swiper-rtl .swiper-button-prev:after {
            content: 'next';
            padding: 10px !important;
            font-size: 15px;
            font-weight: bold;
            background: white;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .swiper-button-prev:after, .swiper-rtl .swiper-button-next:after {
            content: 'prev';
            padding: 10px !important;
            font-size: 15px;
            font-weight: bold;
            background: white;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets.swiper-pagination-horizontal {
            bottom: 15px;
        }
        span.swiper-pagination-bullet {
            background: #fff;
            width: 20px;
            height: 5px;
            border-radius: 0;
            overflow: hidden;
        }
    </style>
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('dm_image_slider', 'dm_image_slider_shortcode');
