<?php

// Register a custom post type for dm_teachers
function register_dm_teacher_post_type() {
    $labels = array(
        'name' => 'DM Teachers',
        'singular_name' => 'DM Teacher',
        'menu_name' => 'DM Teachers',
        'add_new_item' => 'Add New DM Teacher',
        'edit_item' => 'Edit DM Teacher',
        'view_item' => 'View DM Teacher',
        'search_items' => 'Search DM Teachers',
        'not_found' => 'No DM teachers found',
        'not_found_in_trash' => 'No DM teachers found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'thumbnail',),
        'rewrite' => array('slug' => 'dm_teachers'),
        'menu_icon' => 'dashicons-buddicons-buddypress-logo', // Fallback Dashicon
		'menu_position' => 5, 
    );

    register_post_type('dm_teacher', $args); // Change 'teacher' to 'dm_teacher'
}
add_action('init', 'register_dm_teacher_post_type');

// Add custom fields for dm_teacher details
function add_dm_teacher_custom_fields() {
    add_meta_box(
        'dm_teacher_details', // Change 'teacher_details' to 'dm_teacher_details'
        'DM Teacher Details', // Update the metabox title
        'display_dm_teacher_custom_fields', // Change 'display_teacher_custom_fields' to 'display_dm_teacher_custom_fields'
        'dm_teacher', // Change 'teacher' to 'dm_teacher'
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_dm_teacher_custom_fields');

// Display custom fields in the dm_teacher edit screen
function display_dm_teacher_custom_fields($post) {
    // Retrieve the existing values from the database
    $dm_teacher_designation = get_post_meta($post->ID, 'dm_teacher_designation', true);
    $dm_teacher_phone = get_post_meta($post->ID, 'dm_teacher_phone', true);
    $dm_teacher_email = get_post_meta($post->ID, 'dm_teacher_email', true);
    $dm_teacher_qualification = get_post_meta($post->ID, 'dm_teacher_qualification', true);
    $dm_teacher_address = get_post_meta($post->ID, 'dm_teacher_address', true);
    $dm_teacher_facebook = get_post_meta($post->ID, 'dm_teacher_facebook', true);
    $dm_teacher_twitter = get_post_meta($post->ID, 'dm_teacher_twitter', true);
    $dm_teacher_instagram = get_post_meta($post->ID, 'dm_teacher_instagram', true);
    $dm_teacher_linkedin = get_post_meta($post->ID, 'dm_teacher_linkedin', true);
    $dm_teacher_whatsapp = get_post_meta($post->ID, 'dm_teacher_whatsapp', true);

    // Display the input fields for custom fields
    ?>
    <label for="dm_teacher_designation">Designation:</label>
    <input type="text" id="dm_teacher_designation" name="dm_teacher_designation" value="<?php echo esc_attr($dm_teacher_designation); ?>" /><br>

    <label for="dm_teacher_phone">Phone:</label>
    <input type="text" id="dm_teacher_phone" name="dm_teacher_phone" value="<?php echo esc_attr($dm_teacher_phone); ?>" /><br>

    <label for="dm_teacher_email">Email:</label>
    <input type="email" id="dm_teacher_email" name="dm_teacher_email" value="<?php echo esc_attr($dm_teacher_email); ?>" /><br>

    <label for="dm_teacher_qualification">Qualification:</label>
    <input type="text" id="dm_teacher_qualification" name="dm_teacher_qualification" value="<?php echo esc_attr($dm_teacher_qualification); ?>" /><br>

    <label for="dm_teacher_address">Address:</label>
    <textarea id="dm_teacher_address" name="dm_teacher_address"><?php echo esc_textarea($dm_teacher_address); ?></textarea><br>

    <label for="dm_teacher_facebook">Facebook:</label>
    <input type="text" id="dm_teacher_facebook" name="dm_teacher_facebook" value="<?php echo esc_url($dm_teacher_facebook); ?>" /><br>

    <label for="dm_teacher_twitter">Twitter:</label>
    <input type="text" id="dm_teacher_twitter" name="dm_teacher_twitter" value="<?php echo esc_url($dm_teacher_twitter); ?>" /><br>

    <label for="dm_teacher_instagram">Instagram:</label>
    <input type="text" id="dm_teacher_instagram" name="dm_teacher_instagram" value="<?php echo esc_url($dm_teacher_instagram); ?>" /><br>

    <label for="dm_teacher_linkedin">LinkedIn:</label>
    <input type="text" id="dm_teacher_linkedin" name="dm_teacher_linkedin" value="<?php echo esc_url($dm_teacher_linkedin); ?>" /><br>

    <label for="dm_teacher_whatsapp">WhatsApp:</label>
    <input type="text" id="dm_teacher_whatsapp" name="dm_teacher_whatsapp" value="<?php echo esc_html($dm_teacher_whatsapp); ?>" /><br>
    <style>
		#titlediv div.inside {
		margin: 0;
		display: none !important;
	}
	/* Style the dm_teacher information box */
    .post-type-dm_teacher .inside {
        background-color: #f5f5f5;
        padding: 20px;
        border: 1px solid #ddd;
    }
    /* Style the labels for custom fields */
    .post-type-dm_teacher .inside label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }
    /* Style the input fields for custom fields */
    .post-type-dm_teacher .inside input[type="text"],
    .post-type-dm_teacher .inside input[type="email"] {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    /* Style the textarea for custom fields */
    .post-type-dm_teacher .inside textarea {
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    /* Style the Save button */
    .post-type-dm_teacher .submitbox .button {
        background-color: #0073aa;
        color: #fff;
        border: none;
        text-shadow: none;
        box-shadow: none;
    }
    /* Style the Save button on hover */
    .post-type-dm_teacher .submitbox .button:hover {
        background-color: #00599b;
    }
    </style>
    <?php
}

// Save custom field data when the dm_teacher post is saved
function save_dm_teacher_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    // Save dm_teacher details
    if (isset($_POST['dm_teacher_designation'])) {
        update_post_meta($post_id, 'dm_teacher_designation', sanitize_text_field($_POST['dm_teacher_designation']));
    }

    if (isset($_POST['dm_teacher_phone'])) {
        update_post_meta($post_id, 'dm_teacher_phone', sanitize_text_field($_POST['dm_teacher_phone']));
    }

    if (isset($_POST['dm_teacher_email'])) {
        update_post_meta($post_id, 'dm_teacher_email', sanitize_email($_POST['dm_teacher_email']));
    }

    if (isset($_POST['dm_teacher_qualification'])) {
        update_post_meta($post_id, 'dm_teacher_qualification', sanitize_text_field($_POST['dm_teacher_qualification']));
    }

    if (isset($_POST['dm_teacher_address'])) {
        update_post_meta($post_id, 'dm_teacher_address', sanitize_textarea_field($_POST['dm_teacher_address']));
    }

    if (isset($_POST['dm_teacher_facebook'])) {
        update_post_meta($post_id, 'dm_teacher_facebook', esc_url($_POST['dm_teacher_facebook']));
    }

    if (isset($_POST['dm_teacher_twitter'])) {
        update_post_meta($post_id, 'dm_teacher_twitter', esc_url($_POST['dm_teacher_twitter']));
    }

    if (isset($_POST['dm_teacher_instagram'])) {
        update_post_meta($post_id, 'dm_teacher_instagram', esc_url($_POST['dm_teacher_instagram']));
    }

    if (isset($_POST['dm_teacher_linkedin'])) {
        update_post_meta($post_id, 'dm_teacher_linkedin', esc_url($_POST['dm_teacher_linkedin']));
    }

    if (isset($_POST['dm_teacher_whatsapp'])) {
        update_post_meta($post_id, 'dm_teacher_whatsapp', sanitize_text_field($_POST['dm_teacher_whatsapp']));
    }
}
add_action('save_post_dm_teacher', 'save_dm_teacher_custom_fields');

// Function to display the list of dm_teachers
function display_dm_teachers_list($atts) {
    $atts = shortcode_atts(array(
        'count' => -1,
    ), $atts);

    $args = array(
        'post_type' => 'dm_teacher', // Change 'teacher' to 'dm_teacher'
        'posts_per_page' => $atts['count'],
    );

    $dm_teachers_query = new WP_Query($args);

    ob_start(); // Start output buffering

    echo '<div class="dm_teacher-list">';
    while ($dm_teachers_query->have_posts()) : $dm_teachers_query->the_post();
        echo '<div class="dm_teacher">';

        // Display the featured image (dm_teacher's photo)
        if (has_post_thumbnail()) {
            echo '<div class="dm_teacher-photo">';
            the_post_thumbnail('dm_teacher-photo'); // Use the custom image size
            echo '</div>';
        }

        // Display the dm_teacher's name
        $dm_teacher_designation = get_post_meta(get_the_ID(), 'dm_teacher_designation', true);
        echo '<div class="dm_teacher_header">';
        echo '<h2 class="dm_teacher_title">' . get_the_title() . '</h2>';
        echo '<p>' . esc_html($dm_teacher_designation) . '</p>';
        echo '</div>';

        // Display dm_teacher details
        $dm_teacher_phone = get_post_meta(get_the_ID(), 'dm_teacher_phone', true);
        $dm_teacher_email = get_post_meta(get_the_ID(), 'dm_teacher_email', true);
        $dm_teacher_qualification = get_post_meta(get_the_ID(), 'dm_teacher_qualification', true);
        $dm_teacher_address = get_post_meta(get_the_ID(), 'dm_teacher_address', true);
        $dm_teacher_facebook = get_post_meta(get_the_ID(), 'dm_teacher_facebook', true);
        $dm_teacher_twitter = get_post_meta(get_the_ID(), 'dm_teacher_twitter', true);
        $dm_teacher_instagram = get_post_meta(get_the_ID(), 'dm_teacher_instagram', true);
        $dm_teacher_linkedin = get_post_meta(get_the_ID(), 'dm_teacher_linkedin', true);
        $dm_teacher_whatsapp = get_post_meta(get_the_ID(), 'dm_teacher_whatsapp', true);

        echo '<div class="dm_teacher_info_box">';
        echo '<p><b>Qualification: </b> ' . esc_html($dm_teacher_qualification) . '</p>';
        echo '<p><b>Phone: </b> ' . esc_html($dm_teacher_phone) . '</p>';
        echo '<p><b>Email: </b> <a href="mailto:' . esc_html($dm_teacher_email) . '">' . esc_html($dm_teacher_email) . '</a></p>';
        echo '<p><b>Address: </b> ' . esc_html($dm_teacher_address) . '</p>';
        echo '</div>';

        // Display social icons
        echo '<div class="dm_teacher_social_main">';
        echo '<div class="dm_teacher_social_box">';
        if (!empty($dm_teacher_facebook)) {
            echo '<a href="' . esc_url($dm_teacher_facebook) . '"><i class="fab fa-facebook-f"></i></a> ';
        }
        if (!empty($dm_teacher_twitter)) {
            echo '<a href="' . esc_url($dm_teacher_twitter) . '"><i class="fab fa-twitter"></i></a>';
        }
        if (!empty($dm_teacher_instagram)) {
            echo '<a href="' . esc_url($dm_teacher_instagram) . '"><i class="fab fa-instagram"></i></a> ';
        }
        if (!empty($dm_teacher_linkedin)) {
            echo '<a href="' . esc_url($dm_teacher_linkedin) . '"><i class="fab fa-linkedin-in"></i></a> ';
        }
        if (!empty($dm_teacher_whatsapp)) {
            echo '<a href="https://wa.me/' . esc_html($dm_teacher_whatsapp) . '"><i class="fab fa-whatsapp"></i></a>';
        }
        echo '</div>';
        echo '</div>';

        echo '</div>'; // Close .dm_teacher
    endwhile;
    echo '</div>';

    // Start the style block
    echo '<style>';

    // CSS code goes here
    echo '
    /* dm_teacher box */
    .dm_teacher-list{
        display:grid;
        grid-template-columns:1fr 1fr 1fr 1fr;
        gap:20px;
        overflow:hidden;
    }
    @media screen and (max-width:1024px){
        .dm_teacher-list{
        grid-template-columns:1fr 1fr 1fr;
    }
    }
    @media screen and (max-width:768px){
        .dm_teacher-list{
        grid-template-columns:1fr 1fr;
    }
    }
    @media screen and (max-width:640px){
        .dm_teacher-list{
        grid-template-columns:1fr;
    }
    }
    .dm_teacher-list .dm_teacher{
        border: 1px solid #0000001f;
        border-radius:4px;
        overflow:hidden;
        position:relative;
    }
    .dm_teacher_info_box {
        padding: 0px 20px;
    }
    .dm_teacher-photo {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding:0px 0px;
        position:relative;
    }
    .dm_teacher-photo::after{
        width:100%;
        height:100%;
        content:"";
        position:absolute;
        top:0px;
        left:0px;
        background:#0b0d0ebf;
        transform:scale(1);
        opacity:0;
        transition: all 0.5s;
    }
    .dm_teacher-photo img {
        width:100%;
    }
    .dm_teacher_info_box {
        display: flex;
        flex-direction: column;
        margin-bottom:10px
    }
    .dm_teacher_info_box p {
        padding: 0px;
        margin: 0px; 
        display: flex;
        width: 100%;
        font-size:14px;
    }
    .dm_teacher_info_box p b{
        margin-right:5px;
    }
    .dm_teacher_header {
        color: #fff;
        text-align: center;
        padding: 5px;
        padding-bottom:8px;
        width:85%;
        margin:auto;
        margin-bottom:10px;
        transform:skew(-15deg);
        position:relative;
        z-index:2;
        margin-top:-30px;
        border:1px solid #006a4e;
        position:relative;
    }
    .dm_teacher_header::after{
        width:100%;
        height:100%;
        content:"";
        position:absolute;
        top:0px;
        left:0px;
        background:#006a4e;
        transition: all 0.5s;
        z-index:-1;
    }
    .dm_teacher_header .dm_teacher_title{
        font-size:22px;
        text-align:center;
        line-height:22px;
        margin-bottom:5px;
        transform:skew(15deg);
    }
    .dm_teacher_header p{
        line-height:14px;
        margin-bottom:0px;
        transform:skew(15deg);
        font-size:14px;
    }
    .dm_teacher_social_main{
        position:absolute;
        top:30%;
        width:100%;
        left:0%;
        transform:scale(0.3);
        opacity:0;
        transition: all 0.5s;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .dm_teacher_social_box {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        gap: 10px;
        background:#006a4e;
        border-radius:50px;
        padding:8px;
    }
    .dm_teacher_social_box a i{
        color: #fff;
        border: 1px solid #fff;
        border-radius:100%;
        width:22px;
        height:22px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        padding:1px;
        font-size:10px;
        transition: all 0.5s;
    }
    .dm_teacher_social_box a:hover i{
        background: #fff;
        color:#006a4e;
    }
    .dm_teacher-list .dm_teacher:hover .dm_teacher_social_main{
        transform:scale(1);
        opacity:1;
    }
    .dm_teacher-list .dm_teacher:hover .dm_teacher-photo::after{
        opacity:1;
        transform:scale(1)
    }
    .dm_teacher-list .dm_teacher:hover .dm_teacher_header{
        background:#fff;
        color: #000;
        border: 1px dashed #006a4e;
    }
    .dm_teacher-list .dm_teacher:hover  .dm_teacher_header::after{
        width:0%;
    }
    ';

    // End the style block
    echo '</style>';
    wp_reset_postdata();

    return ob_get_clean(); // Return the buffered output
}
add_shortcode('dm_teachers_list', 'display_dm_teachers_list');

// Add custom columns to the admin dashboard for the 'dm_teacher' custom post type
function add_custom_columns_to_dm_teacher_list($columns) {
    // Add a new column for the featured image
    $new_columns = array(
        'cb' => '<input type="checkbox" />',
        'featured_image' => 'Featured Image',
        'title' => 'Title',
        'dm_teacher_designation' => 'Designation',
        'dm_teacher_email' => 'Email',
        'dm_teacher_phone' => 'Phone',
    );

    // Merge the new columns with the existing columns
    return array_merge($columns, $new_columns);
}
add_filter('manage_dm_teacher_posts_columns', 'add_custom_columns_to_dm_teacher_list');

// Populate the custom columns in the admin dashboard for the 'dm_teacher' custom post type
function populate_custom_columns_in_dm_teacher_list($column, $post_id) {
    switch ($column) {
        case 'featured_image':
            // Display the featured image (dm_teacher's photo)
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 50));
            }
            break;

        case 'dm_teacher_designation':
            // Display the dm_teacher's designation
            $dm_teacher_designation = get_post_meta($post_id, 'dm_teacher_designation', true);
            echo esc_html($dm_teacher_designation);
            break;

        case 'dm_teacher_email':
            // Display the dm_teacher's email
            $dm_teacher_email = get_post_meta($post_id, 'dm_teacher_email', true);
            echo '<a href="mailto:' . esc_html($dm_teacher_email) . '">' . esc_html($dm_teacher_email) . '</a>';
            break;

        case 'dm_teacher_phone':
            // Display the dm_teacher's phone
            $dm_teacher_phone = get_post_meta($post_id, 'dm_teacher_phone', true);
            echo esc_html($dm_teacher_phone);
            break;
    }
}
add_action('manage_dm_teacher_posts_custom_column', 'populate_custom_columns_in_dm_teacher_list', 10, 2)
?>