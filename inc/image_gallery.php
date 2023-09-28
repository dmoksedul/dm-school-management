<?php
// Enqueue custom plugin styles
function dm_image_gallery_enqueue_styles() {
    wp_enqueue_style('dm-image-gallery-css', plugins_url('css/styles.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'dm_image_gallery_enqueue_styles');

// Admin settings page
function dm_image_gallery_menu() {
    add_menu_page(
        'DM Image Gallery Settings',
        'DM Image Gallery',
        'manage_options',
        'dm-image-gallery-settings',
        'dm_image_gallery_settings_page',
        'dashicons-format-gallery',
        '5'
    );
}

function dm_image_gallery_settings_page() {
    // Check if the current user is an administrator
    if (current_user_can('administrator')) {
        // Handle image delete action
        if (isset($_GET['delete']) && $_GET['delete']) {
            $image_id = sanitize_text_field($_GET['delete']);
            dm_image_gallery_delete_image($image_id);
        }
    }

    // Handle image selection and adding to the gallery
    if (isset($_POST['select_image'])) {
        $selected_image_id = intval($_POST['selected_image']);

        if ($selected_image_id) {
            $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
            $uploaded_images[] = array('id' => $selected_image_id);
            update_option('dm_image_gallery_uploaded_images', $uploaded_images);

            echo '<div class="updated"><p>Image added to the gallery successfully.</p></div>';
        }
    }

    // Get uploaded images
    $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
    $uploaded_images = array_reverse($uploaded_images);

    ?>
    <style>
        /* Your custom styles here */
        .dm-image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .dm-image-gallery-item {
            text-align: center;
        }
    </style>
    <div class="wrap">
        <h2>DM Image Gallery</h2>
        <!-- Select image from media library and add to gallery form -->
        <form method="post" action="" style="border-radius: 12px;
            max-width: 500px;
            margin: 30px 20px;
            box-shadow: 0 0 10px 0 #00000026;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;">
            <div>
                <div style="display: flex;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                gap: 20px;margin-bottom:20px">
                    <a style="margin-bottom:-5px" href="#" id="select_image_button" class="button">Select Image</a>
                    <input type="hidden" name="selected_image" id="selected_image" value="">
                <?php submit_button('Add to Gallery', 'primary', 'select_image'); ?>
                </div>
                <div id="selected_image_preview"></div>

            </div>
        </form>
        <div class="admin_img_box_list">
            <!-- Display uploaded images -->
        <h3 class="title">Uploaded Image List</h3>
        <div class="item_box">
            <!-- Display uploaded images -->
            <?php foreach ($uploaded_images as $image_data) : ?>
                <?php
                $image_id = $image_data['id'];
                $image_url = wp_get_attachment_image_url($image_id, 'full');

                if ($image_url) :
                ?>
                    <div class="list_item">
                        <img src="<?php echo esc_url($image_url); ?>" alt="Image">
                        <?php
                        // Display the delete button for administrators
                        if (current_user_can('administrator')) {
                            $delete_url = admin_url('admin.php?page=dm-image-gallery-settings&delete=' . $image_id);
                            ?>
                            <a href="<?php echo esc_url($delete_url); ?>" class="delete-image-button" style="color: red; text-decoration: underline;">Delete</a>
                        <?php } ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        </div>
        
    </div>
    <style>
        .admin_img_box_list {
            box-shadow: 0 0 10px #0000002e;
            padding: 20px;
            max-width: 1200px;
            border-radius: 12px;
        }
        div#selected_image_preview img {
            max-width: 100%;
            max-height: 350px;
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
            max-height: 350px;
            width: 100%;
            height: 100%;
        }
        a.delete-image-button {
            background: #08a88a;
            padding: 5px 20px;
            border-radius: 2px;
            color: #fff !important;
            text-decoration: none !important;
            margin: 15px;
        }
    </style>
    <script>
        // Add JavaScript to open the media library and handle image selection
        jQuery(document).ready(function ($) {
           
            $('#select_image_button').click(function (e) {
        e.preventDefault();
        var customUploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Select'
            },
            multiple: false,
        });

        customUploader.on('select', function () {
            var attachment = customUploader.state().get('selection').first().toJSON();
            var imageUrl = attachment.url;

            // Update the preview image src
            $('#selected_image_preview').html('<img src="' + imageUrl + '" alt="Selected Image">');
            
            // Update the hidden input field with the selected image's ID
            $('#selected_image').val(attachment.id);

            // Hide the media library
            customUploader.close();
        });

        customUploader.open();
    });
        });
    </script>
    </div>
    <?php
}

add_action('admin_menu', 'dm_image_gallery_menu');

// Delete image from gallery
function dm_image_gallery_delete_image($image_id) {
    $image_id = intval($image_id);

    if ($image_id) {
        $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());

        // Remove the image from the uploaded images array
        foreach ($uploaded_images as $key => $image_data) {
            if ($image_data['id'] === $image_id) {
                unset($uploaded_images[$key]);
                update_option('dm_image_gallery_uploaded_images', $uploaded_images);
                break;
            }
        }
    }
}

function dm_image_gallery_shortcode($atts) {
    ob_start();
    ?>
    <div class="dm-image-gallery">
        <!-- Display uploaded images -->
        <?php
        $count = 0;
        $limit = isset($atts['limit']) ? intval($atts['limit']) : PHP_INT_MAX;
        $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
        $uploaded_images = array_reverse($uploaded_images); // Reverse the order to show the newest images first

        foreach ($uploaded_images as $image_data) :
            if ($count >= $limit) {
                break; // Limit reached
            }

            $image_id = $image_data['id'];
            $image_url = wp_get_attachment_image_url($image_id, 'full');

            if ($image_url) :
        ?>
                <a class="dm-image-gallery-item" data-fancybox="gallery" href="<?php echo esc_url($image_url); ?>">
                    <img src="<?php echo esc_url($image_url); ?>" alt="Image">
                </a>
        <?php
                $count++;
            endif;
        endforeach;
        ?>
    </div>
    <style>
        /* Your custom styles here */
        .dm-image-gallery {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        @media screen and (max-width:768px){
            .dm-image-gallery {
                grid-template-columns: 1fr;
            }
        }
        .dm-image-gallery .dm-image-gallery-item {
            box-shadow: 0 0 10px #0000001f;
            border-radius: 4px;
            position: relative;
            overflow: hidden;
            display: block; /* Make sure the images are displayed as blocks to fit the anchor */
        }
        .dm-image-gallery .dm-image-gallery-item img {
            transition: all 0.5s;
            transform: scale(1.05);
        }
        .dm-image-gallery .dm-image-gallery-item:hover img {
            transform: scale(1.2);
        }
    </style>
    <?php
    $output = ob_get_clean();
    return $output;
}

add_shortcode('dm_image_gallery', 'dm_image_gallery_shortcode');
