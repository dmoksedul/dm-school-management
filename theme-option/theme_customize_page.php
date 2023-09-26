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
            border-top: 25px solid #1d2327;
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





</style>
<!-- =============================================================================
body
=================================================================================== -->
   <div id="theme_customize_body">
    <!-- header area -->
    <div class="main_header">
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
                    <input type="text" name="email-info" value="<?php echo get_option('email-info'); ?>" placeholder="Enter Your Email Address">
                    
                    <label for="phone-number" name="phone-number">Phone Number</label>
                    <input type="text" name="phone-number" value="<?php echo get_option('phone-number'); ?>" placeholder="Enter Your Phone">

                    <label for="address-info" name="address-info">Address Info</label>
                    <input type="text" name="address-info" value="<?php echo get_option('address-info'); ?>" placeholder="Enter Your Address">
                  </div>
                  <h4>Social Information</h4>
                  <div class="social_account">
                  <!-- facebook usernames -->
                    <label for="dm_facebook_username" name="dm_facebook_username">Facebook Username</label>
                    <div><span>https://facebook.com/</span><input type="text" name="dm_facebook_username" value="<?php echo get_option('dm_facebook_username'); ?>" placeholder="Enter Your facebook username"></div>
                  <!-- Instagram usernames -->
                    <label for="dm_instagram_username" name="dm_instagram_username">Instagram Username</label>
                    <div><span>https://instagram.com/</span><input type="text" name="dm_instagram_username" value="<?php echo get_option('dm_instagram_username'); ?>" placeholder="Enter Your instagram username"></div>
                  <!-- Twitter usernames -->
                    <label for="dm_twitter_username" name="dm_twitter_username">Twitter Username</label>
                    <div><span>https://twitter.com/</span><input type="text" name="dm_twitter_username" value="<?php echo get_option('dm_twitter_username'); ?>" placeholder="Enter Your facebook username"></div>
                  <!-- Linkedin usernames -->
                    <label for="dm_linkedin_username" name="dm_linkedin_username">Linkedin Username</label>
                    <div><span>https://linkedin.com/in/</span><input type="text" name="dm_linkedin_username" value="<?php echo get_option('dm_linkedin_username'); ?>" placeholder="Enter Your facebook username"></div>
                  <!-- Whatsapp usernames -->
                    <label for="dm_whatsapp_link" name="dm_whatsapp_link">Whatsapp Link</label>
                    <div><span>https://api.whatsapp.com/</span><input type="text" name="dm_whatsapp_link" value="<?php echo get_option('dm_whatsapp_link'); ?>" placeholder="Enter Your whatsapp link"></div>
                  <!-- Youtube usernames -->
                    <label for="dm_youtube_username" name="dm_youtube_username">Youtube Link</label>
                    <div><span>https://www.youtube.com/</span><input type="text" name="dm_youtube_username" value="<?php echo get_option('dm_youtube_username'); ?>" placeholder="Enter Your youtube link"></div>
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
                  
              </div>
            </div>
            <!-- header end-->
            <!-- footer start-->
            <div id="footer_tab_editor" class="editor-tab">
              <div class="ds_header_area">
                <h2 class="dm_sub_menu_title">Footer Area</h2>
              </div>
              <div class="ds_editor_body">
                  
              </div>
            </div>
            <!-- footer end-->
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
                    <input type="hidden" name="page_options" value="address-info, email-info, phone-number, dm_facebook_username, dm_instagram_username, dm_twitter_username, dm_linkedin_username, dm_whatsapp_link, dm_youtube_username">
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


  

<!-- javascript codes -->
<script>
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



</script>
<?php 