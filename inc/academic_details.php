<?php
// Register a custom post type for academic details
function register_dm_academic_details_post_type() {
    $labels = array(
        'name' => 'DM Academic Details',
        'singular_name' => 'DM Academic Detail',
        'menu_name' => 'DM Academic Details',
        'add_new_item' => 'Add New DM Academic Detail',
        'edit_item' => 'Edit DM Academic Detail',
        'view_item' => 'View DM Academic Detail',
        'search_items' => 'Search DM Academic Details',
        'not_found' => 'No DM academic details found',
        'not_found_in_trash' => 'No DM academic details found in trash',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'thumbnail'),
        'rewrite' => array('slug' => 'dm-academic-details'),
        'menu_icon' => 'dashicons-welcome-learn-more', // Change the menu icon
		'menu_position' => 5, 
    );

    register_post_type('dm_academic_detail', $args);
}
add_action('init', 'register_dm_academic_details_post_type');

// Add custom fields for DM academic details links
function add_dm_academic_detail_custom_fields() {
    add_meta_box(
        'dm_academic_details_links',
        'DM Academic Details Links',
        'display_dm_academic_detail_custom_fields',
        'dm_academic_detail',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_dm_academic_detail_custom_fields');

function display_dm_academic_detail_custom_fields($post) {
    // Retrieve existing link data from the database
    $dm_academic_links = get_post_meta($post->ID, 'dm_academic_links', true);

    // Display the input fields for academic links
    ?>
    <div class="dm-academic-links">
        <?php if (is_array($dm_academic_links) && !empty($dm_academic_links)) : ?>
            <?php foreach ($dm_academic_links as $index => $link) : ?>
                <div class="dm-academic-link">
                    <label for="dm_academic_label_<?php echo $index; ?>">Link Title:</label>
                    <input type="text" id="dm_academic_label_<?php echo $index; ?>" name="dm_academic_links[<?php echo $index; ?>][label]" value="<?php echo esc_attr($link['label']); ?>" />

                    <label for="dm_academic_address_<?php echo $index; ?>">Link Address:</label>
                    <input type="text" id="dm_academic_address_<?php echo $index; ?>" name="dm_academic_links[<?php echo $index; ?>][address]" value="<?php echo esc_url($link['address']); ?>" />

                    <button class="remove-dm-academic-link" type="button">Remove</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
        <button class="add-dm-academic-link" type="button">Add New Link</button>
    <script>
        jQuery(document).ready(function($) {
            // Add new academic link field
            $('.add-dm-academic-link').click(function() {
                var dm_academicLinks = $('.dm-academic-links');
                var index = dm_academicLinks.find('.dm-academic-link').length;

                var newLink = `
                    <div class="dm-academic-link">
                        <label for="dm_academic_label_${index}">Link Title:</label>
                        <input type="text" id="dm_academic_label_${index}" name="dm_academic_links[${index}][label]" value="" />

                        <label for="dm_academic_address_${index}">Link Address:</label>
                        <input type="text" id="dm_academic_address_${index}" name="dm_academic_links[${index}][address]" value="" />

                        <button class="remove-dm-academic-link" type="button">Remove</button>
                    </div>
                `;

                dm_academicLinks.append(newLink);
            });

            // Remove academic link field
            $('.dm-academic-links').on('click', '.remove-dm-academic-link', function() {
                $(this).closest('.dm-academic-link').remove();
            });
        });
    </script>
<style>
    #titlediv div.inside {
    display: none;
    }
    div#message a {
    display: none;
    }
    /* Style the academic links container */
.dm-academic-links {
    margin-top: 20px;
}

/* Style each academic link item */
.dm-academic-link {
    margin-bottom: 10px;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
}

.dm-academic-link label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.dm-academic-link input[type="text"] {
    width: 100%;
    padding: 5px;
    margin-bottom: 5px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.dm-academic-link .remove-dm-academic-link {
    background-color: #f44336;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 5px 10px;
    cursor: pointer;
    margin-top: 5px;
}

.dm-academic-link .remove-dm-academic-link:hover {
    background-color: #d32f2f;
}

/* Style the "Add New Link" button */
.add-dm-academic-link {
    background-color: #0073aa;
    color: #fff;
    border: none;
    border-radius: 3px;
    padding: 5px 10px;
    cursor: pointer;
    margin-top: 10px;
}

.add-dm-academic-link:hover {
    background-color: #00599b;
}

</style>
    <?php
}

// Save custom field data when the DM academic detail post is saved
function save_dm_academic_detail_custom_fields($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['dm_academic_links'])) {
        $dm_academic_links = array();

        foreach ($_POST['dm_academic_links'] as $link) {
            $label = sanitize_text_field($link['label']);
            $address = esc_url($link['address']);

            if (!empty($label) && !empty($address)) {
                $dm_academic_links[] = array(
                    'label' => $label,
                    'address' => $address,
                );
            }
        }

        update_post_meta($post_id, 'dm_academic_links', $dm_academic_links);
    }
}
add_action('save_post_dm_academic_detail', 'save_dm_academic_detail_custom_fields');

// Function to display the list of DM academic details
function display_dm_academic_details_list($atts) {
    $atts = shortcode_atts(array(
        'count' => -1, // Default to displaying all DM academic details
        'limit' => -1, // New parameter for limiting the number of details
        'order' => 'newest', // Default to displaying "Newest First"
    ), $atts);

    $args = array(
        'post_type' => 'dm_academic_detail',
        'posts_per_page' => $atts['limit'], // Use the limit parameter
        'orderby' => ($atts['order'] === 'oldest') ? 'date' : 'date', // Order by date
        'order' => ($atts['order'] === 'oldest') ? 'ASC' : 'DESC', // ASC for oldest, DESC for newest
    );

    $dm_academic_details_query = new WP_Query($args);

    ob_start(); // Start output buffering

    echo '<div class="dm-academic-details-box" style="display:grid; gap:20px;">';
    while ($dm_academic_details_query->have_posts()) : $dm_academic_details_query->the_post();
        echo '<div class="dm-academic_detail_item" style="padding:20px;border-radius:4px;border:1px solid #00000010;display: flex;
    justify-content: start;
    align-items: start;
    flex-direction: column;min-height: 230px;box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.08)">';
    
        // Display the DM academic detail post title
        echo '<h3 style="    font-size: 22px;
    line-height: 22px;
    color: #066a00;
    font-weight: 600;margin-left:5px" class="dm-academic-title">' . get_the_title() . '</h3>';
        
        echo  '<div class="dm-acl_logo_info_box" style="display: grid;
    grid-template-columns: 1fr 2fr;
    justify-content: center;
    align-items: center;gap:5px">';
        // Display the featured image (thumbnail)
        if (has_post_thumbnail()) {
            echo '<div class="dm-academic-thumbnail">';
            the_post_thumbnail('thumbnail'); // Use the default WordPress thumbnail size
            echo '</div>';
        }

        // Display DM academic links
        $dm_academic_links = get_post_meta(get_the_ID(), 'dm_academic_links', true);

        if (is_array($dm_academic_links) && !empty($dm_academic_links)) {
            echo '<ul class="dm-academic-links" style="padding:0px">';
            foreach ($dm_academic_links as $link) {
                echo '<li style="list-style:none;font-weight:500;margin-bottom:2px;"><a style="color:#000 !important" class="dm-acd_link" href="' . esc_url($link['address']) . '"><i class="fas fa-caret-right"></i> ' . esc_html($link['label']) . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</div>';

        echo '</div>'; // Close .dm-academic-detail
    endwhile;
    echo '</div>';
    
    echo '<style>';
    echo '.dm-acd_link i{';
    echo 'transition:all 0.5s;';
    echo '}';
    echo '.dm-acd_link:hover{';
    echo 'color:#066A00';
    echo '}';
    echo '.dm-acd_link:hover i{';
    echo 'margin-right:5px;color:#066A00';
    echo '}';
    echo '.dm-academic-details-box {';
    echo '  grid-template-columns: 1fr 1fr; margin:20px 0px;';
    echo '}';
    echo '@media screen and (max-width: 640px) {';
    echo '  .dm-academic-details-box {';
    echo '    grid-template-columns: 1fr';
    echo '  }';
    echo '}';
    echo '
        /* ইনফো বক্স  */
        .dm-sm_info_box{
            min-height:230px
        }
        /* footer about link box */
        .dm-footer_about_box .elementor-icon-list-icon i{
            padding:8px 15px;
            border:1px solid #ffffff38;
            text-align:center;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            font-size:14px !important
        }
        /* page title */
        .dm-elementor-page-title h1{
            background:#066A00;
            padding:10px 10px;
            max-width:1200px;
            width:100%;
            color: #fff !important;
            font-family: "Noto Sans Bengali", Sans-serif;
           font-size: 18px;
           font-weight: 400 !important;
            margin-top:12px;
            text-align:left;
        }
        @media screen and (max-width:1024px){
            .dm-elementor-page-title h1{
            width:97.2%;
        }
        }
        @media screen and (max-width:640px){
            .dm-elementor-page-title h1{
            width:94%;
        }
        .dm-footer_about_box a:hover{
            color: #056839 !important;
        }
    ';
    echo '</style>';

    
    wp_reset_postdata();

    return ob_get_clean(); // Return the buffered output
}
add_shortcode('dm_academic_details_list', 'display_dm_academic_details_list');
// Add custom column for featured image in the post type list
function add_dm_academic_details_thumbnail_column($columns) {
    $new_columns = array(
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'dm_academic_thumbnail' => 'Featured Image', // Custom column for featured image
    );

    return $new_columns;
}
add_filter('manage_dm_academic_detail_posts_columns', 'add_dm_academic_details_thumbnail_column');

// Display featured image in the custom column
function display_dm_academic_details_thumbnail($column_name, $post_id) {
    if ($column_name == 'dm_academic_thumbnail') {
        // Get the featured image URL
        $thumbnail = get_the_post_thumbnail_url($post_id, 'thumbnail'); // You can change 'thumbnail' to any other image size you want

        if ($thumbnail) {
            echo '<img src="' . esc_url($thumbnail) . '" width="50" height="50" alt="Featured Image" />';
        } else {
            echo 'No Image';
        }
    }
}
add_action('manage_dm_academic_detail_posts_custom_column', 'display_dm_academic_details_thumbnail', 10, 2);
?>
