<?php
// Genereal functions here

    ?>
<style>
  /* ====================================== */
    #theme_customize_body{
        background:#fff;
        border-radius:12px;
        margin:20px;
        box-sizing:border-box;
        border: 1px solid #0000001a;
        box-shadow: 0 0 10px #0003;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height:calc(100vh + 100px);
        max-width:1200px;
        }
        .contact_information_box {
        max-width: 768px;
        padding: 20px;
        box-shadow: 0 0 10px #00000021;
        border-radius: 12px;
        }
        #customize_main_container {
            display: flex;
            flex-direction: row;
        }
            #customize_side_bar{
              width: 100%;
              max-width:200px;
              background: #0f171c;
              padding:10px;
              height:100vh;
            }
            #customize_side_bar ul{
              display:flex;
              flex-direction:column;
              justify-content:start;
              align-items:center;
              gap:10px;
            }
            #customize_side_bar ul li{
              list-style:none;
              width: 100%;
            }
            #customize_side_bar ul li button {
            text-decoration: none;
            display: block;
            background: #101922;
            padding: 7px 20px;
            color: #fff;
            font-size: 17px;
            border: 1px solid #fdfdfd1f;
            border-radius: 4px;
            transition: all 0.5s;
            cursor:pointer;
            width: 95%;
            text-align:left;
            }
            #customize_side_bar ul li button:hover{
              background: #08A88A;
            }
            #customize_side_bar ul li button.active{
              background: #08A88A;
              position: relative;
            }
            #customize_side_bar ul li button.active::before {
            content: "";
            width: 0px;
            height: 0px;
            position: absolute;
            top: 6px;
            left: -20px;
            transform: rotate(45deg);
            border-top: 25px solid #0f171c;
            border-left: 25px solid transparent;
          }
            /* #customize_side_bar ul li button.active::after {
              content: "";
            width: 0px;
            height: 0px;
            position: absolute;
            top: 6px;
            right: -20px;
            transform: rotate(45deg);
            border-top: 25px solid #1d2327;
            border-left: 25px solid transparent;
          } */
          #customize_editor_bar {
            width: 100%;
            padding: 10px 20px;
            overflow: scroll;
            height: 100vh;
          }
            .editor-tab {
                    display: none; /* Initially hide all editor tabs */
            }
            .active{
              display:block;
            }
            .dm_save_button {
        background: #f6fffd;
        border: none;
        outline: none;
        padding: 5px 15px;
        border-radius: 2px;
        position: absolute;
        top: 35%;
        right: 20px;
        color: #08a88a;
        font-weight: 500;
        cursor: pointer;
        font-size: 16px;
    }
        .dm_save_button2{
            background: #08a88a;
            border: none;
            outline: none;
            padding: 5px 15px;
            border-radius: 2px;
            position: absolute;
            bottom: 20px;
            right: 20px;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
        }
        .dm_sub_menu_title {
            font-size: 30px;
            display: inline-block;
            border-bottom: 2px solid;
            padding-bottom: 7px;
            color: #08a88a;
        }
        /* social form design start */
        .social_account, .basic_information{
          display: flex;
          flex-direction: column;
        }
        .social_account div {
            border: 1px solid #00000026;
            width: auto;
            border-radius: 25px;
            font-size: 15px;
            box-shadow: 0 0 10px #00000017;
            margin-bottom: 15px;
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
            overflow: hidden;
        }
        .social_account div span {
            color: #909191;
            font-weight: 400;
            background: lightgrey;
            width: 190px;
            height: 32px;
            display: flex;
            flex-direction: row;
            justify-content: start;
            align-items: center;
            padding-left:15px;
        }
        .social_account label {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 6px;
            display:none;
        }
        .social_account input {
            padding: 0px 20px;
            border-radius: 4px;
            border: none;
            outline: none !important;
            font-size: 16px;
            font-weight: 500;
            width: 70%;
        }
        h4 {
            font-size: 22px;
        }
        /* social form design end */
        /* bassic information start */
        .basic_information{

        }
        .basic_information input {
            padding: 5px 15px;
            font-size: 16px;
            border: 1px solid #0000001f;
            box-shadow: 0 0 10px #0000000d;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .basic_information label {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 5px;
        }
        input.dm_save_button_desabled {
            background: #7a7a7a2b;
            color: black;
        }
        .save_popup_box {
            background: #0c0c0cab;
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 2;
            top:0px;
            left:0px;
            transform:scale(2.5);
            transition: all 0.5s;
            opacity: 0;
            pointer-events:none;
            user-select: none;
        }
        .save_popup_box div {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px #0000003b;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .save_popup_box div h2 {
            font-size: 25px;
        }
        .save_popup_box button, input[type="submit"] {
            background: #08A88A;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 4px;
            color: #fff;
            transition: all 0.5s;
        }
        .save_popup_box .save_no_btn{
          background:red !important;
          color: #fff;
        }
        .save_popup_box button:hover, input[type="submit"]:hover {
            background: #fff !important;
            color: #000 !important;
            box-shadow: 0 0 10px 0 #00000042;
        }
        .save_popup_box div div {
            display: flex;
            width: 100%;
            flex-direction: revert;
            gap: 20px;
            box-shadow: none;
        }
        .save_popup_box_active {
            transform:scale(1);
            opacity: 1;
            pointer-events:all;
        }
        .main_header {
        background: #08a88a;
        width: 100%;
        position: relative;
        height: 100px;
        padding-top: 20px;
        padding-right: 20px;
        padding-left: 20px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .main_header h2 {
        font-size: 35px;
        color: #fff;
        font-weight: bold;
        padding: 0px !important;
        margin: 0px;
    }
    .main_header p {
        display: inline-block;
        font-size: 18px;
        color: #fff;
        margin: 0px;
    }.main_header p a {
        color: #002b40;
    }
    /* bassic information end */
        /* customize bar end */
        .ds_header_area {
        border-bottom: 1px solid #14141438;
        }
        .ds_editor_body {
        border: 1px solid #00000036;
        padding: 15px;
        border-radius: 10px;
        margin-top: 10px;
        box-shadow: inset 0 0 10px #00000026;
        }
  /* ===================== */
  /* banner area start */
      .ds_banner_area {
          background: #003517;
          height: 90px;
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 40px 10px;
          overflow: hidden;
      }
      p.ds_banner_area img {
          width: 100%;
      }
      .banner_upload_box {
          display: flex;
          flex-direction: row;
          justify-content: start;
          align-items: center;
          gap: 5px;
          margin-bottom: 20px;
      }
      input#upload-image-button {
          background: #08a88a;
          color: #fff;
          border: none;
          outline: none;
          font-size: 16px;
          font-weight: 500;
          padding: 3px 20px;
      }
      .banner_upload_box input[type="text"]{
        padding: 3px 10px;
          font-size: 16px;
          display: inline-block;
          width: 100%;
      }
      button#restore-default-button {
          background: #007e67;
          border: none;
          outline: none;
          padding: 10px 20px;
          border-radius: 4px;
          margin-top: 20px;
          color: #fff;
          font-size: 16px;
          font-weight: 500;
          cursor:pointer;
      }
  /* banner area end */
  img#admin_logo {
    position: absolute;
    left: 20px;
    width: 75px;
    top: 15px;
}
  /* footer area start */
      .ds_footer_area {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: start;
        gap: 20px;
    }
    .ds_footer_area div {
        display: flex;
        flex-direction: column;
        width: 100%;
    }
    .ds_footer_area div label {
        font-size: 17px;
        font-weight: 500;
        margin-bottom: 5px;
    }
    .ds_footer_area div input, textarea {
        padding: 5px 15px;
        border-radius: 5px;
        border: 1px solid #0202021f;
        font-size: 16px;
        font-weight: 400;
    }
    .ds_footer_area textarea {
        height: 130px;
    }
  /* footer area end */
/* color code editor start */
    .color_main_box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    .color_box {
        display: flex;
        flex-direction: revert;
        justify-content: start;
        align-items: center;
        box-shadow: 0 0 10px #0000000d;
        padding: 5px 20px;
    }
    .color_box label {
        font-size: 16px;
        font-weight: 500;
        width: 100%;
    }
    .color_box input[type="color"] {
        background: transparent;
        width: 100px;
        height: 50px;
        border: none;
        box-shadow: 0 0 10px #0000002e;
        padding: 2px 5px;
        border-radius: 2px;
        margin-left: 20px;
        width: 100%;
    }
/* color code editor end */


</style>

<!-- =============================================================================
body
=================================================================================== -->
   <div id="theme_customize_body">
    <!-- header area -->
    <div class="main_header">
      <img id="admin_logo" src="" alt="">
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
        <li><button data-target="contact_tab_editor" class="toggle-tab active">General Settings</button></li>
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
                      <input type="text" class="banner_upload_url" placeholder="Enter your banner URL" name="dm_header_banner" value="<?php echo esc_attr(get_option('dm_header_banner', '/img/banner.png')); ?>">
                      </div>
                      <div class="ds_banner_area"><img src="<?php echo esc_attr(get_option('dm_header_banner', '/img/banner.png')); ?>" id="preview-image"></div>
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
                            <input type="color" name="dm_menu_color" value="<?php echo get_option('dm_menu_color', '#fff'); ?>">
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
                  
              </div>
            </div>
            <!-- settings end-->
            <!-- shortcode start-->
            <div id="shortcode_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Shortcode</h2>
              </div>
              <div class="ds_editor_body">
                  
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
                      <input type="hidden" name="page_options" value="address-info, email-info, phone-number, dm_facebook_username, dm_instagram_username, dm_twitter_username, dm_linkedin_username, dm_whatsapp_link, dm_youtube_username,dm_tiktok_username,dm_telegram_link, dm_header_banner,footer_description, footer_facebook_page_username, footer_copyright_text, dm_primary_color, dm_bg_color, dm_banner_color, dm_secondary_color, dm_heading_color, dm_text_color, dm_link_color, dm_link_hover_color, dm_button_color, dm_button_hover_color, dm_button_bg_color, dm_button_bg_hover_color, dm_menu_bg_color, dm_top_header_color">
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
//javascript code start
      // Get the ul element
      const ul = document.querySelector('#customize_side_bar ul');

      // Add a click event listener to the ul to capture clicks on buttons
      ul.addEventListener('click', function (event) {
          // Check if the clicked element is a button
          if (event.target.tagName === 'BUTTON') {
              // Remove the "active" class from all buttons within the ul
              const buttons = ul.querySelectorAll('button');
              buttons.forEach(button => button.classList.remove('active'));

              // Add the "active" class to the clicked button
              event.target.classList.add('active');
          }
      });

      // Get all buttons with the "toggle-tab" class
      const toggleButtons = document.querySelectorAll('.toggle-tab');

      // Get all editor tabs
      const editorTabs = document.querySelectorAll('.editor-tab');

      // Add click event listeners to each button
      toggleButtons.forEach(button => {
          button.addEventListener('click', function () {
              // Remove the "active" class from all buttons
              toggleButtons.forEach(btn => btn.classList.remove('active'));

              // Add the "active" class to the clicked button
              this.classList.add('active');

              // Get the target tab ID from the "data-target" attribute
              const targetTabId = this.getAttribute('data-target');

              // Toggle the visibility of editor tabs
              editorTabs.forEach(tab => {
                  if (tab.id === targetTabId) {
                      tab.style.display = 'block';
                  } else {
                      tab.style.display = 'none';
                  }
              });
          });
      });

      // Locate the "Save Change" button element by its class
      const saveButton = document.querySelector('.dm_save_button');
      // Locate the custom popup elements
      const savePopup = document.querySelector('.save_popup_box');
      const yesButton = document.querySelector('.save_yes_btn');
      const noButton = document.querySelector('.save_no_btn');
      // Add a click event listener to the "Save Change" button
      saveButton.addEventListener('click', function () {
          // Display the custom popup
          savePopup.classList.add("save_popup_box_active");
      });
      // Add a click event listener to the "Save Change" button
      noButton.addEventListener('click', function () {
          // Display the custom popup
          savePopup.classList.remove("save_popup_box_active");
      });

      jQuery(document).ready(function($) {
          $('#upload-image-button').click(function() {
              var image = wp.media({ title: 'Upload Image', multiple: false }).open()
                  .on('select', function(e) {
                      var uploadedImage = image.state().get('selection').first();
                      var imageSrc = uploadedImage.toJSON().url;
                      $('#preview-image').attr('src', imageSrc);
                      $('input[name="dm_header_banner"]').val(imageSrc);
                      // Show the "Restore Default" button
                      $('#restore-default-button').show();
                  });
          });
          // Handle the "Restore Default" button click
          $('#restore-default-button').click(function() {
              // Set the input value to the default image URL
              $('input[name="dm_header_banner"]').val('<?php echo get_template_directory_uri() . '/img/banner.png'; ?>');
              // Show the default image
              $('#preview-image').attr('src', '<?php echo get_template_directory_uri() . '/img/banner.png'; ?>');
              // Hide the "Restore Default" button
              $(this).hide();
          });

      });
//javascript code end
        // Get the current domain or URL dynamically
        var currentDomain = window.location.origin;
        // Set the src attribute of the image element with the dynamic domain
        var imageElement = document.getElementById('admin_logo');
        imageElement.src = currentDomain + '/wp-content/themes/dm-school-management/img/admin-icon.png';
</script>
<?php 