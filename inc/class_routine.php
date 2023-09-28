<?php
// Register a custom post type for class routines
function create_dm_class_routine_post_type() {
    $labels = array(
        'name' => 'DM Class Routines',
        'singular_name' => 'DM Class Routine',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New DM Class Routine',
        'edit_item' => 'Edit DM Class Routine',
        'new_item' => 'New DM Class Routine',
        'view_item' => 'View DM Class Routine',
        'view_items' => 'View DM Class Routines',
        'search_items' => 'Search DM Class Routines',
        'not_found' => 'No DM class routines found',
        'not_found_in_trash' => 'No DM class routines found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-calendar',
        'menu_position' => 6,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_menu' => false, // Hide from WordPress sidebar
		'menu_position' => 5, 
    );

    register_post_type('dm_class_routine', $args);
}
add_action('init', 'create_dm_class_routine_post_type');

// Add a menu item for the plugin in the WordPress admin menu
function add_dm_class_routine_plugin_menu() {
    add_menu_page(
        'DM Class Routine',
        'DM Class Routine',
        'manage_options',
        'dm-class-routine-plugin',
        'dm_class_routine_plugin_page',
        'dashicons-calendar',
        6
    );
}
add_action('admin_menu', 'add_dm_class_routine_plugin_menu');

// Create the admin page content
function dm_class_routine_plugin_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_dm_class_routine']) && check_admin_referer('add_dm_class_routine', 'add_dm_class_routine_nonce')) {
            $dm_class_routine_title = sanitize_text_field($_POST['dm_class_routine_title']);
            $pdf_url = upload_dm_class_routine_pdf_file();

            if (!empty($dm_class_routine_title) && !empty($pdf_url)) {
                $post_id = wp_insert_post(array(
                    'post_title' => $dm_class_routine_title,
                    'post_type' => 'dm_class_routine',
                    'post_status' => 'publish',
                ));

                if ($post_id) {
                    // Save the PDF URL as post meta
                    update_post_meta($post_id, '_dm_class_routine_pdf_url', $pdf_url);
                }
            }
        } elseif (isset($_POST['delete_dm_class_routine']) && check_admin_referer('delete_dm_class_routine_' . $_POST['delete_dm_class_routine_id'], 'delete_dm_class_routine_nonce')) {
            $dm_class_routine_id = intval($_POST['delete_dm_class_routine_id']);
            wp_delete_post($dm_class_routine_id, true);
        } elseif (isset($_POST['edit_dm_class_routine']) && check_admin_referer('edit_dm_class_routine_' . $_POST['edit_dm_class_routine_id'], 'edit_dm_class_routine_nonce')) {
            $new_title = sanitize_text_field($_POST['new_dm_class_routine_title']);
            $dm_class_routine_id = intval($_POST['edit_dm_class_routine_id']);

            if (!empty($new_title) && $dm_class_routine_id) {
                wp_update_post(array(
                    'ID' => $dm_class_routine_id,
                    'post_title' => $new_title,
                ));
            }
        }
    }

    // Display the form for adding class routines
    ?>
    <div id="dashboard_notice_box">
        <div class="wrap">
        <h2 style="text-align:center;margin:10px 0px;font-weight:bold; color: #08A88A">Class Routine</h2>
            <!-- <h3>Add a New DM Class Routine</h3> -->
            <form class="upload_form_box" method="post" enctype="multipart/form-data">
                <input type="file" name="dm_class_routine_pdf" required>
                <input type="text" name="dm_class_routine_title" placeholder="Enter Class Routine Title" required>
                <input type="submit" name="add_dm_class_routine" value="Add Class Routine">
                <?php wp_nonce_field('add_dm_class_routine', 'add_dm_class_routine_nonce'); ?>
            </form>
        </div>
        <hr>
        <h3>Uploaded Class Routines List:</h3>    
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
                $dm_class_routines = get_posts(array(
                    'post_type' => 'dm_class_routine',
                    'posts_per_page' => -1,
                ));

                $counter = 1;

                foreach ($dm_class_routines as $dm_class_routine) {
                    $pdf_url = get_post_meta($dm_class_routine->ID, '_dm_class_routine_pdf_url', true);
                    $publish_date = get_the_date('d-m-Y', $dm_class_routine);
                    $edit_nonce = wp_create_nonce('edit_dm_class_routine_' . $dm_class_routine->ID);
                    $delete_nonce = wp_create_nonce('delete_dm_class_routine_' . $dm_class_routine->ID);
                    ?>
                    <tr>
                        <td><?php echo esc_html($counter); ?></td>
                        <td><a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="dm-class-routine-link"><?php echo esc_html($dm_class_routine->post_title); ?></a></td>
                        <td><?php echo esc_html($publish_date); ?></td>
                        <td>
                            <a href="<?php echo esc_url($pdf_url); ?>" target="_blank" class="button button-primary view_button">View</a>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="delete_dm_class_routine_id" value="<?php echo esc_attr($dm_class_routine->ID); ?>">
                                <input type="submit" name="delete_dm_class_routine" value="Delete" class="delete_button">
                                <?php wp_nonce_field('delete_dm_class_routine_' . $dm_class_routine->ID, 'delete_dm_class_routine_nonce'); ?>
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
            background-color: var(--dm_white_color);
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
        .wp-list-table tr:last-child td {
            border-bottom:none;
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
        // JavaScript for handling the edit class routine popup
        document.addEventListener('DOMContentLoaded', function () {
            var editDmClassRoutineButtons = document.querySelectorAll('.edit-dm-class-routine-button');
            var popup = document.getElementById('edit-dm-class-routine-popup');
            var closePopup = popup.querySelector('.close-popup');
            var editForm = document.getElementById('edit-dm-class-routine-form');
            var editDmClassRoutineId = document.getElementById('edit-dm-class-routine-id');
            var newDmClassRoutineTitleInput = document.getElementById('new-dm-class-routine-title');

            function showEditDmClassRoutinePopup(dmClassRoutineId) {
                editDmClassRoutineId.value = dmClassRoutineId;

                // Get the current DM class routine title and set it in the input field
                var currentTitle = document.querySelector('[data-dm-class-routine-id="' + dmClassRoutineId + '"]').parentElement.parentElement.querySelector('td:nth-child(2) a').textContent.trim();
                newDmClassRoutineTitleInput.value = currentTitle;

                // Display the popup
                popup.style.display = 'block';
            }

            editDmClassRoutineButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var dmClassRoutineId = button.getAttribute('data-dm-class-routine-id');
                    showEditDmClassRoutinePopup(dmClassRoutineId);
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

// Function to upload PDF files for DM class routines
function upload_dm_class_routine_pdf_file() {
    if ($_FILES['dm_class_routine_pdf']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = wp_upload_dir();
        $file_name = sanitize_file_name($_FILES['dm_class_routine_pdf']['name']);
        $file_path = $upload_dir['path'] . '/' . $file_name;

        if (move_uploaded_file($_FILES['dm_class_routine_pdf']['tmp_name'], $file_path)) {
            return $upload_dir['url'] . '/' . $file_name;
        }
    }

    return '';
}

// Shortcode for displaying a list of DM class routines
function dm_class_routine_list_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_class_routines = get_posts(array(
        'post_type' => 'dm_class_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-class-routine-list">';
    $output .= '<table class="dm-class-routine-list-table">';
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

    foreach ($dm_class_routines as $dm_class_routine) {
        $pdf_url = get_post_meta($dm_class_routine->ID, '_dm_class_routine_pdf_url', true);
        $publish_date = get_the_date('d-m-Y', $dm_class_routine);
        $output .= '<tr>';
        $output .= '<td>' . esc_html($counter) . '</td>'; // Row number
        $output .= '<td style="text-align:left"><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-class-routine-link" style="color: #000; text-decoration: none;font-size: 16px;">' . esc_html($dm_class_routine->post_title) . '</a></td>';
        $output .= '<td>' . esc_html($publish_date) . '</td>';
        $output .= '<td><a style="" href="' . esc_url($pdf_url) . '" download class="button button-primary">Download</a></td>';
        $output .= '</tr>';
        $counter++;
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    $output .= '.dm-class-routine-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '    margin-top: 20px;border:1px solid #00000017;';
    $output .= '}';
    $output .= '.dm-class-routine-list-table th, .dm-class-routine-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: center; /* Center-align text in cells */';
    $output .= '    border-bottom: 1px solid #cbcbcb;border-right: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-class-routine-list-table th {';
    $output .= '    color:#000;font-weight:bold';
    $output .= '}';
    $output .= '.dm-class-routine-link {';
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
    $output .= '</style>';

    return $output;
}
add_shortcode('dm_class_routine_list', 'dm_class_routine_list_shortcode');

// Shortcode for displaying a DM class routine slider
function dm_class_routine_slider_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_class_routines = get_posts(array(
        'post_type' => 'dm_class_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-class-routine-slider" style="border: 1px solid #00000038; padding-top: 8px; border-radius: 25px;">';
    $output .= '<marquee behavior="scroll" direction="left" >';

    foreach ($dm_class_routines as $dm_class_routine) {
        $pdf_url = get_post_meta($dm_class_routine->ID, '_dm_class_routine_pdf_url', true);
        $dm_class_routine_title = esc_html($dm_class_routine->post_title);
        $output .= '<i class="fas fa-file-pdf" style="margin-right: 7px;color: #066A00;"></i>';
        $output .= '<a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-class-routine-link" style="margin-right:15px">' . $dm_class_routine_title . '</a>';
    }

    $output .= '</marquee>';
    $output .= '</div>';

    return $output;
}
add_shortcode('dm_class_routine_slider', 'dm_class_routine_slider_shortcode');

// Shortcode for displaying a title list of DM class routines
function dm_class_routine_title_list_shortcode($atts) {
    // Default limit is -1 (show all)
    $atts = shortcode_atts(array(
        'limit' => -1,
    ), $atts);

    $limit = intval($atts['limit']);

    $dm_class_routines = get_posts(array(
        'post_type' => 'dm_class_routine',
        'posts_per_page' => $limit,
    ));

    $output = '<div class="dm-class-routine-title-list">';
    $output .= '<table class="dm-class-routine-title-list-table">';
    $output .= '<tbody>';

    foreach ($dm_class_routines as $dm_class_routine) {
        $pdf_url = get_post_meta($dm_class_routine->ID, '_dm_class_routine_pdf_url', true);
        $output .= '<tr>';
        $output .= '<td  style="text-align:left"><span class="newAnimate">new</span><a href="' . esc_url($pdf_url) . '" target="_blank" class="dm-class-routine-link-title" style="text-decoration: none;font-size: 16px;">' . esc_html($dm_class_routine->post_title) . '</a></td>';
        $output .= '<td><a href="' . esc_url($pdf_url) . '" download class="button button-primary"><i class="fas fa-cloud-download-alt"></i></a></td>';
        $output .= '</tr>';
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    $output .= '.dm-class-routine-title-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: separate;';
    $output .= '    border-spacing: 0 10px;';
    $output .= '}';
    $output .= '.dm-class-routine-title-list-table td {';
    $output .= '    padding: 10px;';
    $output .= '    text-align: left;';
    $output .= '    border-bottom: 1px solid #cbcbcb;';
    $output .= '}';
    $output .= '.dm-class-routine-link-title {';
    $output .= '    text-decoration: none;';
    $output .= '}';
    $output .= '.button.button-primary {';
    $output .= '    background-color: #fff;border-radius:25px !important';
    $output .= '    color: #000;';
    $output .= '    border: 1px solid #066A00;';
    $output .= '    padding: 5px 15px;';
    $output .= '}';
    $output .= '.newAnimate {';
    $output .= '    background-color: #FF7F50;';
    $output .= '    color: #fff;';
    $output .= '    padding: 2px 5px;';
    $output .= '    font-size: 12px;';
    $output .= '    border-radius: 3px;';
    $output .= '    margin-right: 5px;';
    $output .= '}';
    $output .= '</style>';

    return $output;
}
add_shortcode('dm_class_routine_list_title', 'dm_class_routine_title_list_shortcode');



?>
