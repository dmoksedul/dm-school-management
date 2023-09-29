<?php

// Register a custom post type for DM exam routines
function create_dm_exam_routine_post_type() {
    $labels = array(
        'name' => 'DM Exam Routines',
        'singular_name' => 'DM Exam Routine',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New DM Exam Routine',
        'edit_item' => 'Edit DM Exam Routine',
        'new_item' => 'New DM Exam Routine',
        'view_item' => 'View DM Exam Routine',
        'view_items' => 'View DM Exam Routines',
        'search_items' => 'Search DM Exam Routines',
        'not_found' => 'No DM exam routines found',
        'not_found_in_trash' => 'No DM exam routines found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'menu_position' => 5,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_menu' => false, // Display in WordPress sidebar
		'menu_position' => 5, 
    );

    register_post_type('dm_exam_routine', $args);
}
add_action('init', 'create_dm_exam_routine_post_type');

// Add a menu item for the plugin in the WordPress admin menu
function add_dm_exam_routine_plugin_menu() {
    add_menu_page(
        'DM Exam Routine',
        'DM Exam Routine',
        'manage_options',
        'dm-exam-routine-plugin',
        'dm_exam_routine_plugin_page',
        'dashicons-calendar-alt',
        6
    );
}
add_action('admin_menu', 'add_dm_exam_routine_plugin_menu');

// Create the admin page content
function dm_exam_routine_plugin_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_dm_exam_routine']) && check_admin_referer('add_dm_exam_routine', 'add_dm_exam_routine_nonce')) {
            $dm_exam_routine_title = sanitize_text_field($_POST['dm_exam_routine_title']);
            $pdf_url = upload_dm_exam_routine_pdf_file();

            if (!empty($dm_exam_routine_title) && !empty($pdf_url)) {
                $post_id = wp_insert_post(array(
                    'post_title' => $dm_exam_routine_title,
                    'post_type' => 'dm_exam_routine',
                    'post_status' => 'publish',
                ));

                if ($post_id) {
                    // Save the PDF URL as post meta
                    update_post_meta($post_id, '_dm_exam_routine_pdf_url', $pdf_url);
                }
            }
        } elseif (isset($_POST['delete_dm_exam_routine']) && check_admin_referer('delete_dm_exam_routine_' . $_POST['delete_dm_exam_routine_id'], 'delete_dm_exam_routine_nonce')) {
            $dm_exam_routine_id = intval($_POST['delete_dm_exam_routine_id']);
            wp_delete_post($dm_exam_routine_id, true);
        } elseif (isset($_POST['edit_dm_exam_routine']) && check_admin_referer('edit_dm_exam_routine_' . $_POST['edit_dm_exam_routine_id'], 'edit_dm_exam_routine_nonce')) {
            $new_title = sanitize_text_field($_POST['new_title']);
            $dm_exam_routine_id = intval($_POST['edit_dm_exam_routine_id']);

            if (!empty($new_title) && $dm_exam_routine_id) {
                wp_update_post(array(
                    'ID' => $dm_exam_routine_id,
                    'post_title' => $new_title,
                ));
            }
        }
    }

    // Display the form for adding DM exam routines
    ?>
    <div id="dashboard_notice_box">
        <div class="wrap">
            <h2 style="text-align:center;margin:10px 0px;font-weight:bold; color: #08A88A">Exam Routine</h2>  
            <!-- <h3>Add a New DM Exam Routine</h3> -->
            <form class="upload_form_box" method="post" enctype="multipart/form-data">
                <input type="file" name="dm_exam_routine_pdf" required>
                <input type="text" name="dm_exam_routine_title" placeholder="Enter Exam Routine Title" required>
                <input type="submit" name="add_dm_exam_routine" value="Add Exam Routine">
                <?php wp_nonce_field('add_dm_exam_routine', 'add_dm_exam_routine_nonce'); ?>
            </form>
        </div>
        <hr>
        <h3>Uploaded Exam Routines</h3>
        <div class="table_list">
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
                    $dm_exam_routines = get_posts(array(
                        'post_type' => 'dm_exam_routine',
                        'posts_per_page' => -1,
                    ));

                    $counter = 1;

                    foreach ($dm_exam_routines as $dm_exam_routine) {
                        $pdf_url = get_post_meta($dm_exam_routine->ID, '_dm_exam_routine_pdf_url', true);
                        $publish_date = get_the_date('d-m-Y', $dm_exam_routine);
                        $edit_nonce = wp_create_nonce('edit_dm_exam_routine_' . $dm_exam_routine->ID);
                        $delete_nonce = wp_create_nonce('delete_dm_exam_routine_' . $dm_exam_routine->ID);
                        ?>
                        <tr>
                            <td><?php echo esc_html($counter); ?></td>
                            <td><a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="dm-exam-routine-link "><?php echo esc_html($dm_exam_routine->post_title); ?></a></td>
                            <td><?php echo esc_html($publish_date); ?></td>
                            <td>
                                <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="button button-primary view_button">View</a>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="delete_dm_exam_routine_id" value="<?php echo esc_attr($dm_exam_routine->ID); ?>">
                                    <input class="delete_button" type="submit" name="delete_dm_exam_routine" value="Delete">
                                    <?php wp_nonce_field('delete_dm_exam_routine_' . $dm_exam_routine->ID, 'delete_dm_exam_routine_nonce'); ?>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <style>
        /* Styles for the popup and table */
        div#dashboard_notice_box {
            border: 1px solid #0202021f;
            padding: 20px;
            background: #fff;
            max-width: 1200px;
            margin: auto;
            box-shadow: 0 0 10px #0000002e;
            border-radius: 10px;
            margin-top: 20px;
            padding-top: 0px;
        }
        .wrap{
            box-shadow:none !important;
            padding:0px !important;
        }
        form.upload_form_box {
            padding: 30px;
            box-shadow: 0 0 10px #0000002e;
            border-radius: 8px;
            background: #fff;
            margin-bottom: 20px;
            display: flex;
            flex-direction: row;
            gap: 20px;
            align-items: center;
            justify-content: space-between;
        }
        .table_list {
            height: 500px;
            overflow-y: scroll;
        }
        form.upload_form_box input {
            display: block;
            width: 100%;
            border: 1px solid #00000033;
            padding: 3px 10px;
        }
        form.upload_form_box input[type="file"]{
            border:none;
            max-width:200px;
        }
        form.upload_form_box input[type="submit"] {
            background: #08a88a;
            color: #fff;
            width: 250px;
            padding: 8px;
            border-radius: 3px;
            cursor: pointer;
        }
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
            background-color: #ffffff;
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
        table.wp-list-table thead tr th:nth-child(3) {
            width: 150px;
        }
        table.wp-list-table thead tr th:nth-child(4) {
            width: 250px;
        }
        table.wp-list-table tbody tr td:nth-child(2) {
            text-align:left;
        }
        .wp-list-table th {
            border-right: 1px solid #00000040;
            border-bottom: 1px solid #00000040;
            text-align: center;
            background: #08a88a;
            color: #fff !important;
            font-weight: bold;
            font-size: 16px !important;
        }
        .wp-list-table td {
            vertical-align: middle;
            border-right: 1px solid #00000040;
            border-bottom: 1px solid #00000040;
            text-align: center;
        }
        .wp-list-table td:first-child {
            text-align: center;
        }
        .wp-list-table tr:last-child td {
            border-bottom:none;
        }

        .wp-list-table th:first-child {
            width: 50px;
            text-align: center;
        }

        .shortcode_setting {
            margin-top: 100px;
        }
        a.button.view_button {
            border: 1px solid #08A88A;
            color: #fff;
            padding: 0px 15px;
            border-radius: 1px;
            background: #08A88A;
        }
        .button.view_button:hover{
            color: #08A88A;
            background: #fff;
        }
        .delete_button {
            background: #f6f7f7;
            border-color: red;
            box-shadow: none;
            color: red;
            border: 1px solid;
            padding: 4px 10px;
        }
        .delete_button:hover{
            background:red;
            color:#fff;
            cursor:pointer;
        }
    </style>
    <script>
        // JavaScript for handling the edit DM exam routine popup
        document.addEventListener('DOMContentLoaded', function () {
            var editButtons = document.querySelectorAll('.edit-dm-exam-routine-button');
            var popup = document.getElementById('edit-dm-exam-routine-popup');
            var closePopup = popup.querySelector('.close-popup');
            var editForm = document.getElementById('edit-dm-exam-routine-form');
            var editDmExamRoutineId = document.getElementById('edit-dm-exam-routine-id');
            var newTitleInput = document.getElementById('new-title');

            editButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var dmExamRoutineId = button.getAttribute('data-dm-exam-routine-id');
                    editDmExamRoutineId.value = dmExamRoutineId;

                    // Get the current DM exam routine title and set it in the input field
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

// Function to upload DM exam routine PDF files
function upload_dm_exam_routine_pdf_file() {
    if ($_FILES['dm_exam_routine_pdf']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = wp_upload_dir();
        $file_name = sanitize_file_name($_FILES['dm_exam_routine_pdf']['name']);
        $file_path = $upload_dir['path'] . '/' . $file_name;

        if (move_uploaded_file($_FILES['dm_exam_routine_pdf']['tmp_name'], $file_path)) {
            return $upload_dir['url'] . '/' . $file_name;
        }
    }

    return '';
}

// Shortcode for displaying DM exam routine list
function dm_exam_routine_list_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_exam_routines = get_posts(array(
        'post_type' => 'dm_exam_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-exam-routine-list">';
    $output .= '<table class="dm-exam-routine-list-table">';
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

    foreach ($dm_exam_routines as $dm_exam_routine) {
        $pdf_url = get_post_meta($dm_exam_routine->ID, '_dm_exam_routine_pdf_url', true);
        $publish_date = get_the_date('d-m-Y', $dm_exam_routine);
        $output .= '<tr>';
        $output .= '<td>' . esc_html($counter) . '</td>'; // Row number
        $output .= '<td style="text-align:left"><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-exam-routine-link" style="color: #000; text-decoration: none;font-size: 16px;">' . esc_html($dm_exam_routine->post_title) . '</a></td>';
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
    $output .= '.dm-exam-routine-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '    margin-top: 0px;border:1px solid #00000017;';
    $output .= '}';
    $output .= '.dm-exam-routine-list-table th, .dm-exam-routine-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: center; /* Center-align text in cells */';
    $output .= '    border-bottom: 1px solid #cbcbcb;border-right: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-exam-routine-list-table th {';
    $output .= '    color:#000;font-weight:bold';
    $output .= '}';
    $output .= '.dm-exam-routine-link {';
    $output .= '    text-decoration: none;';
    $output .= '}';
	$output .= '.button.button-primary {
    background-color: #ffffff;
    border-radius: 25px;
    color: #056839;
    border: 1px solid #056839;
    padding: 2px 10px;
    padding-top: 6px;
    border-radius: 25px;
    text-decoration: none;
    transition: 0.5s ease;
    font-size: 14px;
    text-transform: capitalize}';
	$output .= '
	.button.button-primary:hover {
		background-color: #056839;
		color: #ffffff;
		border-color:#056839;
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
add_shortcode('dm_exam_routine_list', 'dm_exam_routine_list_shortcode');

// Rename the database table and update options
function rename_exam_routine_plugin() {
    global $wpdb;

    // Rename the custom post type
    $wpdb->update(
        $wpdb->posts,
        array('post_type' => 'dm_exam_routine'),
        array('post_type' => 'exam_routine')
    );

    // Rename post meta keys
    $wpdb->query($wpdb->prepare("UPDATE $wpdb->postmeta SET meta_key = REPLACE(meta_key, %s, %s)", 'exam_routine', 'dm_exam_routine'));

    // Update options
    $options = get_option('exam_routine_plugin_options');
    if (!empty($options)) {
        $updated_options = array();

        foreach ($options as $key => $value) {
            $new_key = str_replace('exam_routine', 'dm_exam_routine', $key);
            $updated_options[$new_key] = $value;
        }

        update_option('dm_exam_routine_plugin_options', $updated_options);
        delete_option('exam_routine_plugin_options');
    }
}
register_activation_hook(__FILE__, 'rename_exam_routine_plugin');

// Shortcode for displaying DM exam routine slider
function dm_exam_routine_slider_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_exam_routines = get_posts(array(
        'post_type' => 'dm_exam_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-exam-routine-slider" style="border: 1px solid #00000038; padding-top: 8px; border-radius: 25px;">';
    $output .= '<marquee behavior="scroll" direction="left" >';

    foreach ($dm_exam_routines as $dm_exam_routine) {
        $pdf_url = get_post_meta($dm_exam_routine->ID, '_dm_exam_routine_pdf_url', true);
        $exam_routine_title = esc_html($dm_exam_routine->post_title);
        $output .= '<i class="fas fa-book" style="margin-right: 7px; color: #066A00;"></i>';
        $output .= '<a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-exam-routine-link" style="margin-right:15px">'  . $exam_routine_title . '</a>';
    }

    $output .= '</marquee>';
    $output .= '</div>';

    return $output;
}

add_shortcode('dm_exam_routine_slider', 'dm_exam_routine_slider_shortcode');

// Shortcode for displaying DM exam routine title list
function dm_exam_routine_title_list_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_exam_routines = get_posts(array(
        'post_type' => 'dm_exam_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-exam-routine-title-list">';
    $output .= '<table class="dm-exam-routine-title-list-table">';
    $output .= '<tbody>';

    foreach ($dm_exam_routines as $dm_exam_routine) {
        $pdf_url = get_post_meta($dm_exam_routine->ID, '_dm_exam_routine_pdf_url', true);
        $output .= '<tr>';
        $output .= '<td  style="text-align:left"><span class="newAnimate">new</span><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-exam-routine-link-title" style="text-decoration: none;font-size: 16px;">' . esc_html($dm_exam_routine->post_title) . '</a></td>';
        $output .= '<td><a href="' . esc_url($pdf_url) . '" download class="button button-primary"><i class="fas fa-cloud-download-alt"></i></a></td>';
        $output .= '</tr>';
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    $output .= '.dm-exam-routine-title-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '    margin-top: 20px; border: 1px solid #00000017;';
    $output .= '}';
    $output .= '.dm-exam-routine-title-list-table th, .dm-exam-routine-title-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: center;';
    $output .= '    border-bottom: 1px solid #cbcbcb; border-right: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-exam-routine-title-list-table th {';
    $output .= '    color: #000; font-weight: bold;';
    $output .= '}';
    $output .= '.dm-exam-routine-link-title {';
    $output .= '    text-decoration: none;';
    $output .= '}';
    $output .= '.button.button-primary {';
    $output .= '    background-color: #fff; border-radius: 25px;';
    $output .= '    color: #000;';
    $output .= '    border: 1px solid #cbcbcb;';
    $output .= '    padding: 5px 10px; padding-top: 6px;';
    $output .= '    border-radius: 25px;';
    $output .= '    text-decoration: none;';
    $output .= '    transition: background-color 0.3s ease; font-size: 14px; text-transform: capitalize;';
    $output .= '}';
    $output .= '.button.button-primary:hover {';
    $output .= '    background-color: #0c4f00; color: #fff;';
    $output .= '}';
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
    $output .= '        background:#066A00;';
    $output .= '    }';
    $output .= '}';
    $output .= '</style>';

    return $output;
}

add_shortcode('dm_exam_routine_list_title', 'dm_exam_routine_title_list_shortcode');
