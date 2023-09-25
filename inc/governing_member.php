<?php

// Register a custom post type for DM Governing Body Members
function create_dm_gbm_post_type() {
    $labels = array(
        'name' => 'DM Governing Body Members',
        'singular_name' => 'Member',
        'add_new' => 'Add New Member',
        'add_new_item' => 'Add New Member',
        'edit_item' => 'Edit Member',
        'new_item' => 'New Member',
        'view_item' => 'View Member',
        'view_items' => 'View Members',
        'search_items' => 'Search Members',
        'not_found' => 'No members found',
        'not_found_in_trash' => 'No members found in Trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'menu_icon' => 'dashicons-businessman',
        'menu_position' => 5,
        'supports' => array('title', 'editor'),
		'menu_position' => 5, 
    );

    register_post_type('governing-member', $args);
}
add_action('init', 'create_dm_gbm_post_type');

function hide_dm_gbm_menu_item() {
    remove_menu_page('edit.php?post_type=governing-member');
}

add_action('admin_menu', 'hide_dm_gbm_menu_item');

// Add a menu item for the plugin in the WordPress admin menu
function add_dm_gbm_plugin_menu() {
    add_menu_page(
        'DM Governing Members',
        'DM Governing Members',
        'manage_options',
        'dm_gbm_plugin',
        'dm_gbm_plugin_page',
        'dashicons-businessman',
        6
    );

    // Add a submenu item under the DM Governing Body Members menu
    add_submenu_page(
        'dm_gbm_plugin',
        'Manage Members',
        'Manage Members',
        'manage_options',
        'dm_gbm_manage_members',
        'dm_gbm_plugin_page'
    );
}
add_action('admin_menu', 'add_dm_gbm_plugin_menu');

// Create the admin page content
function dm_gbm_plugin_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_member']) && check_admin_referer('add_member', 'add_member_nonce')) {
            $member_name = sanitize_text_field($_POST['member_name']);
            $member_designation = sanitize_text_field($_POST['member_designation']);

            if (!empty($member_name) && !empty($member_designation)) {
                $post_id = wp_insert_post(array(
                    'post_title' => $member_name,
                    'post_content' => $member_designation,
                    'post_type' => 'governing-member',
                    'post_status' => 'publish',
                ));
            }
        }
    }

    // Display the form for adding DM Governing Body Members
    ?>
    <div class="wrap">
        <h2>DM Governing Body Members</h2>
        <h3>Add a New Member</h3>
        <form method="post">
            <input type="text" name="member_name" placeholder="Member Name" required>
            <input type="text" name="member_designation" placeholder="Designation" required>
            <input type="submit" name="add_member" value="Add Member">
            <?php wp_nonce_field('add_member', 'add_member_nonce'); ?>
        </form>
        <hr>
        <h3>List of Members</h3>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $members = get_posts(array(
                    'post_type' => 'dm_gbm_member',
                    'posts_per_page' => -1,
                ));

                $counter = 1;

                foreach ($members as $member) {
                    $member_name = esc_html($member->post_title);
                    $member_designation = esc_html(get_post_field('post_content', $member));
                    ?>
                    <tr>
                        <td><?php echo esc_html($counter); ?></td>
                        <td><?php echo $member_name; ?></td>
                        <td><?php echo $member_designation; ?></td>
                    </tr>
                    <?php
                    $counter++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <style>
        /* Styles for the table */
        .wp-list-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
			max-width: 1000px;
        }

        .wp-list-table th,
        .wp-list-table td {
            padding: 10px;
            text-align: left; /* Left-align text in cells */
            border-bottom: 1px solid #cbcbcb;
            border-right: 1px solid #cbcbcb;
        }

        .wp-list-table th {
            color: #000;
            font-weight: bold;
        }

        .wp-list-table th:first-child {
            width: 50px;
            text-align: center;
        }
		.wp-list-table th:last-child {
            width: 120px;
		}
    </style>
    <?php
}

// Shortcode for displaying the list of DM Governing Body Members
function dm_gbm_list_shortcode() {
    $output = '<div class="dm-gbm-list">';
    $output .= '<table class="dm-gbm-list-table">';
    $output .= '<thead>';
    $output .= '<tr>';
    $output .= '<th>No.</th>'; // Row number column
    $output .= '<th>Name</th>';
    $output .= '<th>Designation</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $output .= '<tbody>';

    $members = get_posts(array(
        'post_type' => 'dm_gbm_member',
        'posts_per_page' => -1,
    ));

    $counter = 1;

    foreach ($members as $member) {
        $member_name = esc_html($member->post_title);
        $member_designation = esc_html(get_post_field('post_content', $member));
        $output .= '<tr>';
        $output .= '<td>' . esc_html($counter) . '</td>'; // Row number
        $output .= '<td style="text-align:left">' . $member_name . '</td>';
        $output .= '<td>' . $member_designation . '</td>';
        $output .= '</tr>';
        $counter++;
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    // Add CSS styles
    $output .= '<style>';
    // Add your custom CSS styles here if needed
 
	$output .= '}';
    $output .= '</style>';

    return $output;
}

add_shortcode('dm_gbm_list', 'dm_gbm_list_shortcode');

?>