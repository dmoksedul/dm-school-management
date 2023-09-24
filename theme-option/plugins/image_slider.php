<?php

// Enqueue custom plugin styles and scripts
function dm_image_slider_enqueue_scripts() {
    wp_enqueue_script('swiper-js', 'https://unpkg.com/swiper/swiper-bundle.min.js', array(), '6.8.4', true);
    wp_enqueue_style('swiper-css', 'https://unpkg.com/swiper/swiper-bundle.min.css', array(), '6.8.4');
    wp_enqueue_style('dm-image-slider-css', plugins_url('css/styles.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'dm_image_slider_enqueue_scripts');

// Admin settings page
function dm_image_slider_menu() {
    add_menu_page(
        'DM Image Slider Settings',
        'DM Image Slider',
        'manage_options',
        'dm-image-slider-settings',
        'dm_image_slider_settings_page',
        'dashicons-format-gallery'
    );
}

function dm_image_slider_settings_page() {
    // Check if the current user is an administrator
    if (current_user_can('administrator')) {
        // Handle image delete action
        if (isset($_GET['delete']) && $_GET['delete']) {
            $image_id = sanitize_text_field($_GET['delete']);
            dm_image_slider_delete_image($image_id);
        }
    }

    // Handle image upload
    if (isset($_POST['upload_image']) && !empty($_FILES['slider_image']['tmp_name'])) {
        $uploaded_image = media_handle_upload('slider_image', 0);

        if (!is_wp_error($uploaded_image)) {
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
            overflow: hidden !important; /* Hide overflow */
        }
        .admin_img_box_list .swiper{
            max-width:800px;
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
        <form method="post" enctype="multipart/form-data" action="" style="padding: 10px;
            border-radius: 12px;
            max-width: 800px;
            margin: 30px 20px;
            box-shadow: 0 0 10px 0 #00000026;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
            <table class="form-table">
                <tr style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center">
                    <th style="text-align: center; width: 100%; font-size: 18px;line-height:22px" scope="row">Upload Image</th>
                    <td>
                        <label for="slider_image" style="cursor: pointer; background-color: #3498db; color: #fff; padding: 10px 15px; border-radius: 5px; border: 1px solid #3498db;">
                            Choose Image
                        </label>
                        <input required type="file" name="slider_image" id="slider_image" style='width:100%;display:none; text-align:center;margin:auto' accept="image/*">
                    </td>
                </tr>
            </table>
            <?php submit_button('Upload Image', 'primary', 'upload_image'); ?>
        </form>
        <div class="admin_img_box_list">
            <!-- Display uploaded images -->
            <div class="swiper mySwiper">
                <h3>Slider Images</h3>
                <div class="swiper-wrapper">
                    <?php foreach ($uploaded_images as $image_id) : ?>
                        <div class="swiper-slide">
                            <?php
                            $image_url = wp_get_attachment_image_url($image_id, 'full');
                            if ($image_url) {
                            ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="Slider Image">
                                <?php
                                // Display the delete button for administrators
                                if (current_user_can('administrator')) {
                                    $delete_url = admin_url('admin.php?page=dm-image-slider-settings&delete=' . $image_id);
                                    ?>
                                    <a href="<?php echo esc_url($delete_url); ?>" class="delete-image-button" style="color: red; text-decoration: underline;">Delete</a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

add_action('admin_menu', 'dm_image_slider_menu');

// Delete image
function dm_image_slider_delete_image($image_id) {
    $image_id = intval($image_id);

    if ($image_id) {
        $uploaded_images = get_option('dm_image_slider_uploaded_images', array());

        // Remove the image from the uploaded images array
        $key = array_search($image_id, $uploaded_images);
        if ($key !== false) {
            unset($uploaded_images[$key]);
            update_option('dm_image_slider_uploaded_images', $uploaded_images);

            // Delete the image from the media library
            wp_delete_attachment($image_id, true); // Set true to permanently delete the file

            // Optionally, you can delete any image sizes associated with the image
            $metadata = wp_get_attachment_metadata($image_id);
            if ($metadata) {
                foreach ($metadata['sizes'] as $size => $info) {
                    $file = $info['file'];
                    $path = path_join(wp_upload_dir()['basedir'], $file);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            // Optionally, you can delete any additional metadata associated with the image
            wp_delete_post($image_id, true); // Set true to permanently delete the post
        }
    }
}

// Handle image uploads
function dm_image_slider_handle_upload() {
    // Handle image upload
    if (isset($_POST['upload_image']) && !empty($_FILES['slider_image']['tmp_name'])) {
        $uploaded_image = media_handle_upload('slider_image', 0);

        if (!is_wp_error($uploaded_image)) {
            $uploaded_images = get_option('dm_image_slider_uploaded_images', array());
            $uploaded_images[] = $uploaded_image;
            update_option('dm_image_slider_uploaded_images', $uploaded_images);
        }
    }
}

add_action('admin_init', 'dm_image_slider_handle_upload');

// Register the shortcode
function dm_image_slider_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => -1, // Default to display all images
        'animation_speed' => 3000, // Default animation speed in milliseconds (3 seconds)
    ), $atts);

    ob_start();
    ?>
    <div class="swiper-container" style="overflow:hidden">
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
                    <img src="<?php echo esc_url($image_url); ?>" style="max-width:100%;" alt="Slider Image">
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

add_shortcode('dm-image-slider', 'dm_image_slider_shortcode');
