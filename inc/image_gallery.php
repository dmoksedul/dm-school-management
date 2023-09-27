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
    if (isset($_POST['upload_image']) && !empty($_FILES['gallery_image']['tmp_name'])) {
        $uploaded_image = media_handle_upload('gallery_image', 0);

        if (!is_wp_error($uploaded_image)) {
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
                        <input required type="file" name="gallery_image" id="gallery_image" accept="image/*">
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
            <?php $count = 0; ?>
            <?php $limit = isset($atts['limit']) ? intval($atts['limit']) : PHP_INT_MAX; ?>
            <?php foreach ($uploaded_images as $image_data) : ?>
                <?php
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
                        <?php
                        // Display the delete button for administrators
                        if (current_user_can('administrator')) {
                            $delete_url = admin_url('admin.php?page=dm-image-gallery-settings&delete=' . $image_id);
                            ?>
                            <a href="<?php echo esc_url($delete_url); ?>" class="delete-image-button" style="color: red; text-decoration: underline;">Delete</a>
                        <?php } ?>
                    </div>
                <?php
                    $count++;
                endif;
                ?>
                <style>
                    .dm-image-gallery{
                        display:grid;
                        grid-template-columns:1fr 1fr 1fr;
                        gap:20px;
                        width:800px;
                    }
                    @media screen and (max-width:640px){
                        .dm-image-gallery{
                            grid-template-columns:1fr !important;
                        }
                    }
                    .dm-image-gallery-item{
                        box-shadow:0 0 10px #0000001F;
                        padding:10px;
                        border-radius:12px;
                    }
                    .dm-image-gallery-item img{
                        max-width:250px;
                        border-radius:12px;
                    }
                    .dm-image-gallery-item p{
                        font-size:16px;
                    }
                    .dm-image-gallery-item a{
                        background: #135E96;
                        color: #fff !important;
                        padding:5px 20px;
                        border-radius:2px;
                        text-decoration:none !important;
                        display:inline-block;
                        margin-bottom:5px
                    }
                </style>
            <?php endforeach; ?>
        </div>
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
    if (isset($_POST['upload_image']) && !empty($_FILES['gallery_image']['tmp_name'])) {
        $uploaded_image = media_handle_upload('gallery_image', 0);

        if (!is_wp_error($uploaded_image)) {
            $uploaded_images = get_option('dm_image_gallery_uploaded_images', array());
            $image_title = sanitize_text_field($_POST['image_title']);
            $uploaded_images[] = array('id' => $uploaded_image, 'title' => $image_title);
            update_option('dm_image_gallery_uploaded_images', $uploaded_images);
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
