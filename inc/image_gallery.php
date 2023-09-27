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
		'5',
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

    // Handle image upload
    if (isset($_POST['upload_image']) && !empty($_POST['gallery_image'])) {
        $image_id = intval($_POST['gallery_image']);

        if ($image_id) {
            $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
            $image_title = sanitize_text_field($_POST['image_title']);
            $uploaded_images[] = array('id' => $image_id, 'title' => $image_title);
            update_option('dm_image_gallery_uploaded_images', $uploaded_images);

            echo '<div class="updated"><p>Image uploaded successfully.</p></div>';
        }
    }

    // Get uploaded images with titles
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
        <!-- Upload image form with title -->
        <form method="post" enctype="multipart/form-data" action="">
            <table class="form-table">
                <tr>
                    <th scope="row">Upload Image</th>
                    <td>
                        <input type="button" id="upload_image_button" class="button" value="Choose Image">
                        <input type="hidden" name="gallery_image" id="gallery_image" value="">
                        <div id="image_preview" style="display: none;">
                            <!-- Preview image will be shown here -->
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Image Title</th>
                    <td>
                        <input type="text" name="image_title" id="image_title">
                    </td>
                </tr>
            </table>
            <?php submit_button('Upload Image', 'primary', 'upload_image'); ?>
        </form>
        <div class="dm-image-gallery">
            <!-- Display uploaded images with titles -->
            <?php foreach ($uploaded_images as $image_data) : ?>
                <?php
                $image_id = $image_data['id'];
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                $image_title = esc_html($image_data['title']);

                if ($image_url) :
                ?>
                    <div class="dm-image-gallery-item">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $image_title; ?>">
                        <p><?php echo $image_title; ?></p>
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
    <script>
        // Add JavaScript to open the media uploader and toggle image preview
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
                        $('#gallery_image').val(attachment.id);
                        // Display the selected image as a preview
                        $('#image_preview').html('<img src="' + attachment.url + '" alt="Selected Image" style="max-width:100%;">').show();
                    });
                    customUploader.open();
                });
            });
    </script>
    </div>
    <?php
}

add_action('admin_menu', 'dm_image_gallery_menu');

// Delete image
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

// Handle image uploads with titles
function dm_image_gallery_handle_upload() {
    // Handle image upload
    if (isset($_POST['upload_image']) && !empty($_POST['gallery_image'])) {
        $image_id = intval($_POST['gallery_image']);

        if ($image_id) {
            $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
            $image_title = sanitize_text_field($_POST['image_title']);
            $uploaded_images[] = array('id' => $image_id, 'title' => $image_title);
            update_option('dm_image_gallery_uploaded_images', $uploaded_images);

            echo '<div class="updated"><p>Image uploaded successfully.</p></div>';
        }
    }
}

add_action('admin_init', 'dm_image_gallery_handle_upload');

// Shortcode for displaying the image gallery
function dm_image_gallery_shortcode($atts) {
    ob_start();
    ?>
    <div class="dm-image-gallery">
        <!-- Display uploaded images with titles -->
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
            $image_title = esc_html($image_data['title']);

            if ($image_url) :
        ?>
                <div class="dm-image-gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $image_title; ?>">
                    <p><?php echo $image_title; ?></p>
                </div>
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
        }
        .dm-image-gallery .dm-image-gallery-item img {
            transition: all 0.5s;
            transform: scale(1.05);
        }
        .dm-image-gallery-item p {
            background: #181717d9;
            position: absolute;
            width: 100%;
            bottom: -100px;
            padding: 10px;
            color: #fff;
            transition: all 0.5s;
            left: 5%;
            width: 90%;
            border-radius: 4px;
        }
        .dm-image-gallery .dm-image-gallery-item:hover p {
            bottom: 2px;
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
