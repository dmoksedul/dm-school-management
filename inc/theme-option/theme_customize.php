<?php
// Genereal functions here

    ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(  ) . '/css/theme_option.min.css' ?>"/>

<!-- =============================================================================
body
=================================================================================== -->
   <div id="theme_customize_body">
    <!-- header area -->
    <div class="main_header">
      <img id="admin_logo" src="<?php echo get_template_directory_uri() . '/img/admin-icon.png'; ?>" alt="">
      <h2>DM School Management</h2>
      <p>Developer : <a target="_blank" href="https://moksedul.dev/">Moksedul Islam</a></p>
      <button type="button" class="dm_save_button">Save Change</button>
    </div>
    <div class="main_area_option">

    <!-- middle area start -->
    <section id="customize_main_container">
    <!-- sidebar area -->
    <div id="customize_side_bar">
      <ul>
        <li><button data-target="contact_tab_editor" class="toggle-tab active">General</button></li>
        <li><button data-target="header_tab_editor" class="toggle-tab">Header Area</button></li>
        <li><button data-target="footer_tab_editor" class="toggle-tab">Footer Area</button></li>
        <li><button data-target="color_setting_tab_editor" class="toggle-tab">Theme Color</button></li>
        <li><button data-target="setting_tab_editor" class="toggle-tab">Settings</button></li>
        <li><button data-target="shortcode_tab_editor" class="toggle-tab">Shortcode</button></li>
      </ul>
    </div>
    <!-- webiste customize editor body -->
    <div id="customize_editor_bar">
    <form id="main_submit_form" action="options.php" method="post">
            <?php wp_nonce_field('update-options') ?>

            <!-- contact information start-->
            <div id="contact_tab_editor" class="editor-tab active">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Contact Information:</h2>
              </div>
              <div class="ds_editor_body">
                  <h4>Basic Information</h4>
                  <div class="basic_information">
                    
                    <label for="email-info" name="email-info">Email Address</label>
                    <input type="text" name="email-info" value="<?php echo get_option('email-info', 'info@moksedul.dev'); ?>" placeholder="Enter Your Email Address">
                    
                    <label for="phone-number" name="phone-number">Phone Number</label>
                    <input type="text" name="phone-number" value="<?php echo get_option('phone-number', '+8801518301895'); ?>" placeholder="Enter Your Phone">

                    <label for="address-info" name="address-info">Address Info</label>
                    <input type="text" name="address-info" value="<?php echo get_option('address-info', 'Rangpur Bangladesh'); ?>" placeholder="Enter Your Address">
                  </div>
                  <h4>Social Information</h4>
                  <div class="social_account">
                      <!-- facebook usernames -->
                        <label for="dm_facebook_username" name="dm_facebook_username">Facebook Username</label>
                        <div><span>https://facebook.com/</span><input type="text" name="dm_facebook_username" value="<?php echo get_option('dm_facebook_username', 'dmoksedul'); ?>" placeholder="Enter Your facebook username"></div>
                      <!-- Instagram usernames -->
                        <label for="dm_instagram_username" name="dm_instagram_username">Instagram Username</label>
                        <div><span>https://instagram.com/</span><input type="text" name="dm_instagram_username" value="<?php echo get_option('dm_instagram_username', 'dmoksedul'); ?>" placeholder="Enter Your instagram username"></div>
                      <!-- Twitter usernames -->
                        <label for="dm_twitter_username" name="dm_twitter_username">Twitter Username</label>
                        <div><span>https://twitter.com/</span><input type="text" name="dm_twitter_username" value="<?php echo get_option('dm_twitter_username', 'dmoksedul'); ?>" placeholder="Enter Your facebook username"></div>
                      <!-- Linkedin usernames -->
                        <label for="dm_linkedin_username" name="dm_linkedin_username">Linkedin Username</label>
                        <div><span>https://linkedin.com/in/</span><input type="text" name="dm_linkedin_username" value="<?php echo get_option('dm_linkedin_username', 'dmoksedul'); ?>" placeholder="Enter Your facebook username"></div>
                      <!-- Whatsapp usernames -->
                        <label for="dm_whatsapp_link" name="dm_whatsapp_link">Whatsapp number</label>
                        <div><span>https://api.whatsapp.com/</span><input type="text" name="dm_whatsapp_link" value="<?php echo get_option('dm_whatsapp_link', 'dmoksedul'); ?>" placeholder="Enter Your whatsapp number"></div>
                      <!-- Whatsapp usernames -->
                        <label for="dm_telegram_link" name="dm_telegram_link">Telegram Username</label>
                        <div><span>https://telegram.com/</span><input type="text" name="dm_telegram_link" value="<?php echo get_option('dm_telegram_link', 'dmoksedul'); ?>" placeholder="Enter Your telegram username"></div>
                      <!-- Youtube usernames -->
                        <label for="dm_tiktok_username" name="dm_tiktok_username">Tiktok Username</label>
                        <div><span>https://www.tiktok.com/</span><input type="text" name="dm_tiktok_username" value="<?php echo get_option('dm_tiktok_username', 'dmoksedul'); ?>" placeholder="Enter Your Tiktok username"></div>
                      <!-- Youtube usernames -->
                        <label for="dm_youtube_username" name="dm_youtube_username">Youtube Username</label>
                        <div><span>https://www.youtube.com/</span><input type="text" name="dm_youtube_username" value="<?php echo get_option('dm_youtube_username', 'dmoksedul'); ?>" placeholder="Enter Your youtube link"></div>
                      <!-- Youtube usernames -->
                  </div>
                </div>
            </div>
            <!-- contact information end-->

            <!-- contact header start-->
            <div id="header_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Header Area</h2>
              </div>
              <div class="ds_editor_body">
                  <div>
                    <div>
                      <h4>Upload Header Bannner Image</h4>
                      <p>Image max size <b>(width:1366px and height: 152px)</b> and <b>transparent</b>.</p>
                    </div>
                      <div class="banner_upload_box">
                      <input type="button" class="button-secondary ds_banner_area_upload_btn" value="Upload Banner Image" id="upload-image-button"><span>or</span>
                      <input type="text" class="banner_upload_url" placeholder="Enter your banner URL" name="dm_header_banner" value="<?php echo esc_attr(get_option('dm_header_banner', "<?php echo get_template_directory_uri() . '/img/banner.png'; ?>")); ?>">
                      </div>
                      <div class="ds_banner_area"><img src="<?php echo esc_attr(get_option('dm_header_banner', '/img/banner.png')); ?>" id="banner_image"></div>
                      <button type="button" id="restore-default-button">Restore Default</button>
                      <br><br><br>
                        <h4>Header Color</h4>
                      <!-- color area color -->
                      <div class="color_main_box">
                        <!-- banner color -->
                        <div class="color_box">
                            <label for="dm_banner_color" name="dm_banner_color">Banner Background Color</label>
                            <input type="color" name="dm_banner_color" value="<?php echo get_option('dm_banner_color', '#003517'); ?>">
                        </div>
                        <!-- menu text color -->
                        <div class="color_box">
                            <label for="dm_menu_color" name="dm_menu_color">Menu Color</label>
                            <input type="color" name="dm_menu_color" value="<?php echo get_option('dm_menu_color', '#ffffff'); ?>">
                        </div>
                        <!-- menu text color -->
                        <div class="color_box">
                            <label for="dm_menu_bg_color" name="dm_menu_bg_color">Menu Background Color</label>
                            <input type="color" name="dm_menu_bg_color" value="<?php echo get_option('dm_menu_bg_color', '#056839'); ?>">
                        </div>
                        <!-- top header color -->
                        <div class="color_box">
                            <label for="dm_top_header_color" name="dm_top_header_color">Menu Background Color</label>
                            <input type="color" name="dm_top_header_color" value="<?php echo get_option('dm_top_header_color', '#056839'); ?>">
                        </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- header end-->
            <!-- footer start-->
            <div id="footer_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Footer Area</h2>
              </div>
              <div class="ds_editor_body">
                <!-- footer description here -->
                <div class="ds_footer_area">
                <div>
                    <label for="footer_description" name="footer_description">Footer short description</label>
                    <textarea name="footer_description" placeholder="Enter Your Footer Description"><?php echo get_option('footer_description','Transform your online presence with our professional web design and development services. Specializing in WordPress'); ?></textarea>
                </div>


                <!-- footer footer_facebook_page_username here -->
                  <div>
                    <label for="footer_facebook_page_username" name="footer_facebook_page_username">Facebook Page Username</label>
                      <input type="text" name="footer_facebook_page_username" value="<?php echo get_option('footer_facebook_page_username', 'dmoksedul'); ?>" placeholder="Enter Your Facebook Username">
                  </div>
                <!-- footer footer_copyright_text here -->
                  <div>
                    <label for="footer_copyright_text" name="footer_copyright_text">Footer Copyright Text</label>
                      <input type="text" name="footer_copyright_text" value="<?php echo get_option('footer_copyright_text', 'DM School'); ?>" placeholder="Enter your copyright text">
                  </div>
                </div>
              </div>
            </div>
            <!-- footer end-->

            <!-- settings start-->
            <div id="color_setting_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Settings</h2>
              </div>
              <div class="ds_editor_body">
                  <div class="color_main_box">
                    <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_bg_color" name="dm_bg_color">Background Color</label>
                          <input type="color" name="dm_bg_color" value="<?php echo get_option('dm_bg_color', '#ffffff'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_primary_color" name="dm_primary_color">Primary Color</label>
                          <input type="color" name="dm_primary_color" value="<?php echo get_option('dm_primary_color', '#056839'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_heading_color" name="dm_heading_color">Heading Color</label>
                          <input type="color" name="dm_heading_color" value="<?php echo get_option('dm_heading_color', '#000000'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_secondary_color" name="dm_secondary_color">Secondary Color</label>
                          <input type="color" name="dm_secondary_color" value="<?php echo get_option('dm_secondary_color', '#012330'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_text_color" name="dm_text_color">Text Color</label>
                          <input type="color" name="dm_text_color" value="<?php echo get_option('dm_text_color', '#000000'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_link_color" name="dm_link_color">Link Color</label>
                          <input type="color" name="dm_link_color" value="<?php echo get_option('dm_link_color', '#39835d'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_linkdm_link_hover_color_color" name="dm_link_hover_color">Link Hover Color</label>
                          <input type="color" name="dm_link_hover_color" value="<?php echo get_option('dm_link_hover_color', '#ff0000'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_button_color" name="dm_button_color">Button Color</label>
                          <input type="color" name="dm_button_color" value="<?php echo get_option('dm_button_color', '#ffffff'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_button_hover_color" name="dm_button_hover_color">Button Hover Color</label>
                          <input type="color" name="dm_button_hover_color" value="<?php echo get_option('dm_button_hover_color', '#ffffff'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_button_bg_color" name="dm_button_bg_color">Button Background Color</label>
                          <input type="color" name="dm_button_bg_color" value="<?php echo get_option('dm_button_bg_color', '#39835d'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_button_bg_hover_color" name="dm_button_bg_hover_color">Button Background Hover Color</label>
                          <input type="color" name="dm_button_bg_hover_color" value="<?php echo get_option('dm_button_bg_hover_color', '#ff0000'); ?>">
                      </div>
                      <!-- primary color -->
                      <div class="color_box">
                          <label for="dm_white_color" name="dm_white_color">White Color</label>
                          <input type="color" name="dm_white_color" value="<?php echo get_option('dm_white_color', '#ffffff'); ?>">
                      </div>
                  </div>
              </div>
            </div>
            <!-- settings end-->
            <!-- settings start-->
            <div id="setting_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Settings</h2>
              </div>
              <div class="ds_editor_body">
                  <div class="login_page_box">
                    <h4>Upload Login Page Logo</h4>
                    <div class="login_logo_upload_box">
                        <input type="button" class="button-secondary ds_banner_area_upload_btn" value="Upload Login Logo" id="upload_login_logo_button"><span>or</span>
                        <input type="text" class="banner_upload_url" placeholder="Enter your banner URL" name="dm_login_logo" value="<?php echo esc_attr(get_option('dm_login_logo', '<?php echo get_template_directory_uri() . "/img/logo.png"; ?>')); ?>">
                    </div>
                    <div id="login_logo_preview">
                        <img src="<?php echo esc_attr(get_option('dm_login_logo', '<?php echo get_template_directory_uri() . "/img/logo.png"; ?>')); ?>" id="dm_login_logo">
                        <button type="button" id="restore_login_logo">Restore Default</button>
                    </div>
                  </div>
              </div>
            </div>
            <!-- settings end-->
            <!-- shortcode start-->
            <div id="shortcode_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Theme Shortcode</h2>
              </div>
              <div class="ds_editor_body">
                  <div>
                    <h4>Image Slider Shortcode:</h4>
                    <p><b>[dm_image_slider]</b></p>
                    If you use limit slider to use limit functions.
                    <p><b>[dm_image_slider limit=5]</b></p>
                  </div>
                  <div>
                    <h4>Image Gallery Shortcode:</h4>
                    <p><b>[dm_image_gallery]</b></p>
                    If you use limit slider to use limit functions.
                    <p><b>[dm_image_gallery limit=5]</b></p>
                  </div>
                  <div>
                    <h4>Teachers Shortcode:</h4>
                    <p><b>[dm_teachers_slider]</b></p>
                    <p><b>[dm_teacherslist]</b></p>
                    If you use limit slider to use limit functions.
                    <p><b>[dm_teachers_slider limit=5]</b></p>
                    <p><b>[dm_teacherslist limit=5]</b></p>
                  </div>
                  <div>
                    <h4>Notice Shortcode:</h4>
                    <p><b>[dm_notice_slider]</b></p>
                    <p><b>[dm_notice_list]</b></p>
                    <p><b>[dm_notice_list_title]</b></p>
                    If you use limit slider to use limit functions.
                    just use <b>[limit=5]</b>
                  </div>
                  <div>
                    <h4>Class Routine Shortcode:</h4>
                    <p><b>[dm_class_routine_slider]</b></p>
                    <p><b>[dm_class_routine_list]</b></p>
                    <p><b>[dm_class_routine_list_title]</b></p>
                    If you use limit slider to use limit functions.
                    just use <b>[limit=5]</b>
                  </div>
                  <div>
                    <h4>Exam Routine Shortcode:</h4>
                    <p><b>[dm_exam_routine_slider]</b></p>
                    <p><b>[dm_exam_routine_list]</b></p>
                    <p><b>[dm_exam_routine_list_title]</b></p>
                    If you use limit slider to use limit functions.
                    just use <b>[limit=5]</b>
                  </div>
                  <div>
                    <h4>Academic Details List Shortcode:</h4>
                    <p><b>[dm_academic_details_list]</b></p>
                    If you use limit slider to use limit functions.
                    just use <b>[limit=5]</b>
                  </div>
                  <div>
                    <h4>Governing Member List Shortcode:</h4>
                    <p><b>[dm_gbm_list]</b></p>
                    If you use limit slider to use limit functions.
                    just use <b>[limit=5]</b>
                  </div>
              </div>
            </div>
            <!-- shortcode end-->




            
                <!-- popup box for save change start -->
                  <div class="save_popup_box">
                    <div>
                    <h2>Do you want to save change?</h2>
                    <div>
                      <!-- ================================================================================================================== -->
                      <input type="hidden" name="action" value="update">
                      <input type="hidden" name="page_options" value="address-info, email-info, phone-number, dm_facebook_username, dm_instagram_username, dm_twitter_username, dm_linkedin_username, dm_whatsapp_link, dm_youtube_username,dm_tiktok_username,dm_telegram_link, dm_header_banner,footer_description, footer_facebook_page_username, footer_copyright_text, dm_primary_color, dm_bg_color, dm_banner_color, dm_secondary_color, dm_heading_color, dm_text_color, dm_link_color, dm_link_hover_color, dm_button_color, dm_button_hover_color, dm_button_bg_color, dm_button_bg_hover_color, dm_menu_bg_color, dm_top_header_color, dm_menu_color, dm_login_logo">
                      <input class="save_yes_btn" type="submit" name="submit" value="<?php _e('Yes', 'dmoksedul') ?>">

                      <button type="button" class="save_no_btn">Cancel</button>
                    </div>
                    </div>
                  </div>
                <!-- popup box for save change end -->
          </form>

    </div>
    </section>
    <!-- middle area end -->
  </div>


  

<!-- ==================================================================
              JavaScript Code here
=================================================================== -->
<!-- Include the external JavaScript file -->
<script>
jQuery(document).ready(function($) {
          // Handle the "Restore Default" button click
          
          $('#restore-default-button').click(function() {
              // Set the input value to the default image URL
              $('input[name="dm_header_banner"]').val('<?php echo get_template_directory_uri() . "/img/banner.png"; ?>');
              // Show the default image
              $('#banner_image').attr('src', '<?php echo get_template_directory_uri() . "/img/banner.png"; ?>');
              // Hide the "Restore Default" button
              $(this).hide();
          });
          $('#restore_login_logo').click(function() {
              // Set the input value to the default image URL
              $('input[name="dm_login_logo"]').val('<?php echo get_template_directory_uri() . "/img/logo.png"; ?>');
              // Show the default image
              $('#dm_login_logo').attr('src', '<?php echo get_template_directory_uri() . "/img/logo.png"; ?>');
              // Hide the "Restore Default" button
              $(this).hide();
          });

      });
</script>
<script src="<?php echo get_template_directory_uri() . '/js/dashboard_setting.js'; ?>"></script>
<?php 