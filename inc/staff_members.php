<?php
// Register a custom post type for DM Staff Members
function create_dm_staff_members_post_type() {
    $labels = array(
        'name' => 'DM Staff Members',
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
        'supports' => array('title', 'editor', 'thumbnail'),
    );

    register_post_type('staff-members', $args);
}
add_action('init', 'create_dm_staff_members_post_type');

function hide_dm_staff_members_menu_item() {
    remove_menu_page('edit.php?post_type=staff-members');
}
add_action('admin_menu', 'hide_dm_staff_members_menu_item');

function add_dm_staff_members_plugin_menu() {
    add_menu_page(
        'DM Staff Members',
        'DM Staff Members',
        'manage_options',
        'dm_staff_members_plugin',
        'dm_staff_members_page',
        'dashicons-businessman',
        6
    );

    add_submenu_page(
        'dm_staff_members_plugin',
        'Manage Members',
        'Manage Members',
        'manage_options',
        'dm_staff_members_manage_members',
        'dm_staff_members_page'
    );
}
add_action('admin_menu', 'add_dm_staff_members_plugin_menu');

function dm_staff_members_page() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_member']) && check_admin_referer('add_member', 'add_member_nonce')) {
            $member_name = sanitize_text_field($_POST['member_name']);
            $member_designation = sanitize_text_field($_POST['member_designation']);

            if (!empty($member_name) && !empty($member_designation)) {
                $post_id = wp_insert_post(array(
                    'post_title' => $member_name,
                    'post_content' => $member_designation,
                    'post_type' => 'staff-members',
                    'post_status' => 'publish',
                ));

                if ($post_id && isset($_FILES['member_image']) && !empty($_FILES['member_image']['name'])) {
                    require_once ABSPATH . 'wp-admin/includes/file.php';
                    require_once ABSPATH . 'wp-admin/includes/media.php';
                    require_once ABSPATH . 'wp-admin/includes/image.php';

                    $attachment_id = media_handle_upload('member_image', $post_id);
                    if (!is_wp_error($attachment_id)) {
                        set_post_thumbnail($post_id, $attachment_id);
                    }
                }
            }
        }

        if (isset($_POST['delete_member']) && check_admin_referer('delete_member', 'delete_member_nonce')) {
            $member_id = intval($_POST['member_id']);
            if ($member_id > 0) {
                wp_delete_post($member_id, true);
            }
        }
    }

    ?>
    <div id="dashboard_notice_box">
        <div class="wrap">
            <h2 style="text-align:center;margin:10px 0px;font-weight:bold; color: #08A88A">Staff Members</h2>
            <form class="upload_form_box" method="post" enctype="multipart/form-data">
                <input type="text" name="member_name" placeholder="Member Name" required>
                <input type="text" name="member_designation" placeholder="Designation" required>
                <input type="file" name="member_image" accept="image/*">
                <input type="submit" name="add_member" value="Add Member">
                <?php wp_nonce_field('add_member', 'add_member_nonce'); ?>
            </form>
            <hr>
            <h3>List of Members</h3>
            <div class="table_list">
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $members = get_posts(array(
                            'post_type' => 'staff-members',
                            'posts_per_page' => -1,
                        ));

                        $counter = 1;

                        foreach ($members as $member) {
                            $member_id = $member->ID;
                            $member_name = esc_html($member->post_title);
                            $member_designation = esc_html(get_post_field('post_content', $member));
                            $member_image = get_the_post_thumbnail_url($member_id, 'thumbnail');
                            ?>
                            <tr>
                                <td><?php echo esc_html($counter); ?></td>
                                <td><?php echo $member_name; ?></td>
                                <td><?php echo $member_designation; ?></td>
                                <td>
                                    <?php if ($member_image): ?>
                                        <img src="<?php echo $member_image; ?>" alt="<?php echo $member_name; ?>" style="max-width: 100px;">
                                    <?php else: ?>
                                        No Image
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                                        <input type="submit" name="delete_member" value="Delete" class="delete_button">
                                        <?php wp_nonce_field('delete_member', 'delete_member_nonce'); ?>
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
    </div>

    <style>
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
        .wrap{
            box-shadow:none !important;
            padding:0px !important
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
    <?php
}

function dm_staff_members_list_shortcode() {
    $output = '<div class="dm-staff-members-list">';
    $output .= '<table class="dm-staff-members-list-table">';
    $output .= '<thead>';
    $output .= '<tr>';
    $output .= '<th>No.</th>';
    $output .= '<th>Name</th>';
    $output .= '<th>Designation</th>';
    $output .= '<th>Image</th>';
    $output .= '</tr>';
    $output .= '</thead>';
    $output .= '<tbody>';

    $members = get_posts(array(
        'post_type' => 'staff-members',
        'posts_per_page' => -1,
    ));

    $counter = 1;

    foreach ($members as $member) {
        $member_name = esc_html($member->post_title);
        $member_designation = esc_html(get_post_field('post_content', $member));
        $member_image = get_the_post_thumbnail_url($member->ID, 'thumbnail');
        $output .= '<tr>';
        $output .= '<td>' . esc_html($counter) . '</td>';
        $output .= '<td>' . $member_name . '</td>';
        $output .= '<td>' . $member_designation . '</td>';
        $output .= '<td>';
        if ($member_image) {
            $output .= '<img src="' . $member_image . '" alt="' . $member_name . '" style="max-width: 100px;">';
        } else {
            $output .= 'No Image';
        }
        $output .= '</td>';
        $output .= '</tr>';
        $counter++;
    }

    $output .= '</tbody>';
    $output .= '</table>';
    $output .= '</div>';

    $output .= '<style>';
    $output .= '.dm-staff-members-list-table {';
    $output .= '    width: 100%;';
    $output .= '    border-collapse: collapse;';
    $output .= '}';
    $output .= '.dm-staff-members-list-table th, .dm-staff-members-list-table td {';
    $output .= '    border: 1px solid #ddd;';
    $output .= '    padding: 8px;';
    $output .= '    text-align: left;';
    $output .= '}';
    $output .= '.dm-staff-members-list-table th {';
    $output .= '    background-color: #f2f2f2;';
    $output .= '}';
    $output .= '</style>';
    ?>
    <style>
        table.dm-staff-members-list-table thead tr th:nth-child(1) {
            width: 100px;
            text-align: center;
        }
        table.dm-staff-members-list-table thead tr th:nth-child(3) {
            width: 200px;
            text-align: center;
        }
        table.dm-staff-members-list-table thead tr th:nth-child(4) {
            width: 200px;
            text-align: center;
        }
        table.dm-staff-members-list-table tbody tr td:nth-child(1) {
            text-align: center;
        }
        table.dm-staff-members-list-table tbody tr td:nth-child(3) {
            text-align: center;
        }
        table.dm-staff-members-list-table tbody tr td:nth-child(4) {
            text-align: center;
        }
    </style>
    <?php
    return $output;
}

add_shortcode('dm_staff_members_list', 'dm_staff_members_list_shortcode');

// Rename the DM Governing Body Members to DM Staff Members
function rename_dm_gbm_to_dm_staff_members($translated_text, $text, $domain) {
    if ($domain === 'default') {
        if ($text === 'DM Governing Body Members') {
            $translated_text = 'DM Staff Members';
        } elseif ($text === 'Governing Body Members') {
            $translated_text = 'Staff Members';
        } elseif ($text === 'Governing Member') {
            $translated_text = 'Staff Member';
        }
    }
    return $translated_text;
}
add_filter('gettext', 'rename_dm_gbm_to_dm_staff_members', 20, 3);
add_filter('ngettext', 'rename_dm_gbm_to_dm_staff_members', 20, 3);
?>
