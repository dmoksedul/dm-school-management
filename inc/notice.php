<?php
// Register a custom post type for dm_notices
function create_dm_notice_post_type() {
    $labels = array(
        'name' => 'DM Notices',
        'singular_name' => 'DM Notice',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New DM Notice',
        'edit_item' => 'Edit DM Notice',
        'new_item' => 'New DM Notice',
        'view_item' => 'View DM Notice',
        'view_items' => 'View DM Notices',
        'search_items' => 'Search DM Notices',
        'not_found' => 'No DM notices found',
        'not_found_in_trash' => 'No DM notices found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-megaphone',
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_menu' => false, // Hide from WordPress sidebar
		'menu_position' => 5, 
    );

    register_post_type('dm_notice', $args);
}
add_action('init', 'create_dm_notice_post_type');

// Add a menu item for the plugin in the WordPress admin menu
function add_dm_notice_plugin_menu() {
    add_menu_page(
        'DM Notice',
        'DM Notice',
        'manage_options',
        'dm-notice-plugin',
        'dm_notice_plugin_page',
        'dashicons-megaphone',
        6
    );
}
add_action('admin_menu', 'add_dm_notice_plugin_menu');

// Create the admin page content
function dm_notice_plugin_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_dm_notice']) && check_admin_referer('add_dm_notice', 'add_dm_notice_nonce')) {
            $dm_notice_title = sanitize_text_field($_POST['dm_notice_title']);
            $pdf_url = upload_dm_pdf_file();

            if (!empty($dm_notice_title) && !empty($pdf_url)) {
                $post_id = wp_insert_post(array(
                    'post_title' => $dm_notice_title,
                    'post_type' => 'dm_notice',
                    'post_status' => 'publish',
                ));

                if ($post_id) {
                    // Save the PDF URL as post meta
                    update_post_meta($post_id, '_dm_notice_pdf_url', $pdf_url);
                }
            }
        } elseif (isset($_POST['delete_dm_notice']) && check_admin_referer('delete_dm_notice_' . $_POST['delete_dm_notice_id'], 'delete_dm_notice_nonce')) {
            $dm_notice_id = intval($_POST['delete_dm_notice_id']);
            wp_delete_post($dm_notice_id, true);
        } elseif (isset($_POST['edit_dm_notice']) && check_admin_referer('edit_dm_notice_' . $_POST['edit_dm_notice_id'], 'edit_dm_notice_nonce')) {
            $new_title = sanitize_text_field($_POST['new_title']);
            $dm_notice_id = intval($_POST['edit_dm_notice_id']);

            if (!empty($new_title) && $dm_notice_id) {
                wp_update_post(array(
                    'ID' => $dm_notice_id,
                    'post_title' => $new_title,
                ));
            }
        }
    }

    // Display the form for adding DM notices
    ?>
    <div class="wrap">
        <h2>DM Notice Plugin</h2>
        <h3>Add a New DM Notice</h3>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="dm_notice_pdf" required>
            <input type="text" name="dm_notice_title" placeholder="DM Notice Title" required>
            <input type="submit" name="add_dm_notice" value="Add DM Notice">
            <?php wp_nonce_field('add_dm_notice', 'add_dm_notice_nonce'); ?>
        </form>
    </div>
    <hr>
    <h3>Uploaded DM Notices</h3>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Publish Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dm_notices = get_posts(array(
                'post_type' => 'dm_notice',
                'posts_per_page' => -1,
            ));

            $counter = 1;

            foreach ($dm_notices as $dm_notice) {
                $pdf_url = get_post_meta($dm_notice->ID, '_dm_notice_pdf_url', true);
                $publish_date = get_the_date('d-m-Y', $dm_notice);
                $edit_nonce = wp_create_nonce('edit_dm_notice_' . $dm_notice->ID);
                $delete_nonce = wp_create_nonce('delete_dm_notice_' . $dm_notice->ID);
                ?>
                <tr>
                    <td><?php echo esc_html($counter); ?></td>
                    <td><a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="dm-notice-link"><?php echo esc_html($dm_notice->post_title); ?></a></td>
                    <td><?php echo esc_html($publish_date); ?></td>
                    <td>
                        <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="button button-primary">View</a>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="delete_dm_notice_id" value="<?php echo esc_attr($dm_notice->ID); ?>">
                            <input type="submit" name="delete_dm_notice" value="Delete" class="button button-danger">
                            <?php wp_nonce_field('delete_dm_notice_' . $dm_notice->ID, 'delete_dm_notice_nonce'); ?>
                        </form>
                    </td>
                </tr>
                <?php
                $counter++;
            }
            ?>
        </tbody>
    </table>
    <div id="edit-dm-notice-popup" class="dm-notice-popup">
        <div class="dm-notice-popup-content">
            <span class="close-popup">&times;</span>
            <h3>Edit DM Notice Title</h3>
            <form id="edit-dm-notice-form" method="post">
                <input type="hidden" id="edit-dm-notice-id" name="edit_dm_notice_id">
                <input type="text" id="new-title" name="new_title" placeholder="New Title" required>
                <input type="submit" name="edit_dm_notice" value="Save Change" class="button button-primary">
                <?php wp_nonce_field('edit_dm_notice_', 'edit_dm_notice_nonce'); ?>
            </form>
        </div>
    </div>

    <style>
        /* Styles for the popup and table */
        .dm-notice-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .dm-notice-popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
        }

        .close-popup {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        tbody {
            text-align: left;
        }

        .wp-list-table th {
            text-align: left;
        }

        .wp-list-table td {
            vertical-align: middle;
        }

        .wp-list-table td:first-child {
            text-align: center;
        }

        .wp-list-table th:first-child {
            width: 50px;
            text-align: center;
        }

        .shortcode_setting {
            margin-top: 100px;
        }
    </style>
    <script>
        // JavaScript for handling the edit dm_notice popup
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-dm-notice-button');
            var popup = document.getElementById('edit-dm-notice-popup');
            var closePopup = popup.querySelector('.close-popup');
            var editForm = document.getElementById('edit-dm-notice-form');
            var editDmNoticeId = document.getElementById('edit-dm-notice-id');
            var newTitleInput = document.getElementById('new-title');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var dmNoticeId = button.getAttribute('data-dm-notice-id');
                    editDmNoticeId.value = dmNoticeId;

                    // Get the current dm_notice title and set it in the input field
                    var currentTitle = button.parentElement.parentElement.querySelector('td:nth-child(2) a').textContent.trim();
                    newTitleInput.value = currentTitle;

                    // Display the popup
                    popup.style.display = 'block';
                });
            });

            closePopup.addEventListener('click', function () {
                // Close the popup
                popup.style.display = 'none';
            });
        });
    </script>
    <?php
}

// Function to upload PDF files for dm_notices
function upload_dm_pdf_file() {
    if ($_FILES['dm_notice_pdf']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = wp_upload_dir();
        $file_name = sanitize_file_name($_FILES['dm_notice_pdf']['name']);
        $file_path = $upload_dir['path'] . '/' . $file_name;

        if (move_uploaded_file($_FILES['dm_notice_pdf']['tmp_name'], $file_path)) {
            return $upload_dir['url'] . '/' . $file_name;
        }
    }

    return '';
}

function dm_notice_list_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_notices = get_posts(array(
        'post_type' => 'dm_notice',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-notice-list">';
    $output .= '<table class="dm-notice-list-table">';
    $output .= '<thead>';
    $output .= '<tr>';
    $output .= '<th>No.</th>'; // Row number column
    $output .= '<th>Title</th>';
    $output .= '<th>Publish Date</th>';
    $output .= '<th>Download</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $output .= '<tbody>';

    $counter = 1;

    foreach ($dm_notices as $dm_notice) {
        $pdf_url = get_post_meta($dm_notice->ID, '_dm_notice_pdf_url', true);
        $publish_date = get_the_date('d-m-Y', $dm_notice);
        $output .= '<tr>';
        $output .= '<td>' . esc_html($counter) . '</td>'; // Row number
        $output .= '<td style="text-align:left"><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-notice-link" style="color: #000; text-decoration: none;font-size: 16px;">' . esc_html($dm_notice->post_title) . '</a></td>';
        $output .= '<td>' . esc_html($publish_date) . '</td>';
        $output .= '<td><a href="' . esc_url($pdf_url) . '" download class="button button-primary">Download</a></td>';
        $output .= '</tr>';
        $counter++;
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    $output .= '.dm-notice-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '    margin-top: 20px;border:1px solid #00000017;';
    $output .= '}';
    $output .= '.dm-notice-list-table th, .dm-notice-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: center; /* Center-align text in cells */';
    $output .= '    border-bottom: 1px solid #cbcbcb;border-right: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-notice-list-table th {';
    $output .= '    color:#000;font-weight:bold';
    $output .= '}';
    $output .= '.dm-notice-link {';
    $output .= '    text-decoration: none;';
    $output .= '}';
	$output .= '.button.button-primary {
    background-color: #fff;
    border-radius: 25px;
    color: #000;
    border: 1px solid #cbcbcb;
    padding: 2px 10px;
    padding-top: 6px;
    border-radius: 25px;
    text-decoration: none;
    transition: 0.5s ease;
    font-size: 14px;
    text-transform: capitalize}';
	$output .= '
	.button.button-primary:hover {
		background-color: #006a4e;
		color: #fff;
		border-color:#006a4e;
	} ';
    $output .= '.date-column {';
    $output .= '    width: 20%; /* Set the width of the date column */';
    $output .= '}';
    $output .= '.button-column {';
    $output .= '    width: 15%; /* Set the width of the button column */';
    $output .= '}';
    $output .= '</style>';

    return $output;
}
add_shortcode('dm_notice_list', 'dm_notice_list_shortcode');

// Shortcode for the dm_notice marquee text slider
function dm_notice_slider_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_notices = get_posts(array(
        'post_type' => 'dm_notice',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-notice-slider" style="border: 1px solid #00000038; padding-top: 8px; border-radius: 25px;">';
    $output .= '<marquee behavior="scroll" direction="left" >';

    foreach ($dm_notices as $dm_notice) {
        $pdf_url = get_post_meta($dm_notice->ID, '_dm_notice_pdf_url', true);
        $dm_notice_title = esc_html($dm_notice->post_title);
        $output .= '<i class="fas fa-book" style="margin-right: 7px; color: #066A00;"></i>';
        $output .= '<a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-notice-link" style="margin-right:15px">'  . $dm_notice_title . '</a>';
    }

    $output .= '</marquee>';
    $output .= '</div>';

    return $output;
}

add_shortcode('dm_notice_slider', 'dm_notice_slider_shortcode');

// Shortcode to display a list of DM notices with titles and download links
function dm_notice_list_title_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_notices = get_posts(array(
        'post_type' => 'dm_notice',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-notice-list-title">';
    $output .= '<table class="dm-notice-list-table">';
    $output .= '<tbody>';

    foreach ($dm_notices as $dm_notice) {
        $pdf_url = get_post_meta($dm_notice->ID, '_dm_notice_pdf_url', true);
        $output .= '<tr>';
        $output .= '<td style="text-align:left"><span class="newAnimate">new</span><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-notice-link-title" style="text-decoration: none;font-size: 16px;">' . esc_html($dm_notice->post_title) . '</a></td>';
        $output .= '<td><a href="' . esc_url($pdf_url) . '" download class="button button-primary"><i class="fas fa-cloud-download-alt"></i></a></td>';
        $output .= '</tr>';
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    $output .= '.dm-notice-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '    margin-top: 20px; border: 1px solid #00000017;';
    $output .= '}';
    $output .= '.dm-notice-list-table th, .dm-notice-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: center;';
    $output .= '    border-bottom: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-notice-list-table th {';
    $output .= '    color: #000; font-weight: bold;';
    $output .= '}';
    $output .= '.dm-notice-link-title {';
    $output .= '    text-decoration: none;color:#000;';
    $output .= '}';
	$output .= '.button.button-primary {
    background-color: #fff;
    border-radius: 25px;
    color: #000;
    border: 1px solid #cbcbcb;
    padding: 2px 10px;
    padding-top: 6px;
    border-radius: 25px;
    text-decoration: none;
    transition: 0.5s ease;
    font-size: 14px;
    text-transform: capitalize}';
	$output .= '
	.button.button-primary:hover {
		background-color: #006a4e;
		color: #fff;
		border-color:#006a4e;
	} ';
    $output .= '.newAnimate {';
    $output .= '    background: red;';
    $output .= '    padding: 0px 8px;';
    $output .= '    color: #fff;';
    $output .= '    border-radius: 100%;';
    $output .= '    margin-right: 5px;';
    $output .= '    font-size: 10px;';
    $output .= '    display: inline-block;';
    $output .= '    animation: 1s newNoticeAnimate linear infinite;';
    $output .= '}';
    $output .= '@keyframes newNoticeAnimate {';
    $output .= '    to {';
    $output .= '        background: #066A00;';
    $output .= '    }';
    $output .= '}';
    $output .= '</style>';

    return $output;
}

add_shortcode('dm_notice_list_title', 'dm_notice_list_title_shortcode');
