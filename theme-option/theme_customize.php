<?php
// Genereal functions here

    ?>
    <style>
    #theme_customize_body{
        background:#fff;
        padding:20px;
        border-radius:12px;
        margin:20px;
        box-sizing:border-box;
    }
    .contact_information_box {
    max-width: 768px;
    padding: 20px;
    box-shadow: 0 0 10px #00000021;
    border-radius: 12px;
}
    #customize_main_container{
      display:flex;
      flex-direction:row;
    }
    #customize_side_bar{
      width: 100%;
      max-width:200px;
      background: #0f171c;
      padding:10px;
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
    padding: 10px 20px;
    color: #fff;
    font-size: 17px;
    border: 1px solid #fdfdfd1f;
    border-radius: 4px;
    transition: all 0.5s;
    cursor:pointer;
    width: 100%;
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
    top: 10px;
    left: -14px;
    transform: rotate(45deg);
    border-top: 25px solid #1d2327;
    border-left: 25px solid transparent;
  }
    #customize_side_bar ul li button.active::after {
    content: "";
    width: 30px;
    height: 30px;
    position: absolute;
    top: 6px;
    right: -14px;
    background: #08a88a;
    transform: rotate(45deg);
  }
    #customize_editor_bar{
      width: 100%;
      padding:10px;
    }
    .editor-tab {
            display: none; /* Initially hide all editor tabs */
    }
    .active{
      display:block;
    }
</style>
<!-- =============================================================================
body
=================================================================================== -->
   <div id="theme_customize_body">
    <div class="main_area_option">
      <!-- Header -->
      <?php echo "<h1>DM School Management Customize:</h1>";
      echo "<p>Customize your website easily.</p>"; ?>
    </div>
    <!-- middle area start -->
    <section id="customize_main_container">
    <!-- sidebar area -->
    <div id="customize_side_bar">
      <ul>
        <li><button data-target="general_setting_editor_tab" class="toggle-tab active">General Settings</button></li>
        <li><button data-target="header_area_editor_tab" class="toggle-tab">Header Area</button></li>
        <li><button data-target="footer_area_editor_tab" class="toggle-tab">Footer Area</button></li>
        <li><button data-target="color_editor_tab" class="toggle-tab">General Settings</button></li>
        <li><button data-target="" class="toggle-tab">General Settings</button></li>
        <li><button data-target="" class="toggle-tab">General Settings</button></li>
        <li><button data-target="" class="toggle-tab">General Settings</button></li>
        <li><button data-target="" class="toggle-tab">General Settings</button></li>
        <li><button data-target="" class="toggle-tab">General Settings</button></li>
      </ul>
    </div>
    <!-- webiste customize editor body -->
    <div id="customize_editor_bar">
      <!-- tab editor list start -->
      <div class="editor-tab active" id="general_setting_editor_tab">
        <!-- contact information start -->
        <div class="contact_information_box">
          <form class="contact_information_box" action="options.php" method="post">
            <?php wp_nonce_field('update-options') ?>
            <label for="address-info" name="address-info">Address Info</label>
            <input type="text" name="address-info" value="<?php echo get_option('address-info'); ?>" placeholder="Enter Your Address">

            <label for="email-info" name="email-info">Email Info</label>
            <input type="text" name="email-info" value="<?php echo get_option('email-info'); ?>" placeholder="Enter Your Email Address">

            <label for="phone-number" name="phone-number">Phone Number</label>
            <input type="text" name="phone-number" value="<?php echo get_option('phone-number'); ?>" placeholder="Enter Your Address">



            <input type="hidden" name="action" value="update">
            <input type="hidden" name="page_options" value="address-info, email-info, phone-number">
            <input type="submit" name="submit" value="<?php _e('Save Info', 'dmoksedul') ?>">

          </form>
        </div>
      <!-- contact information end -->
      </div>
      <!-- tab editor list end -->
      <!-- tab editor list start -->
      <div class="editor-tab" id="header_area_editor_tab">
        <!-- contact information start -->
        <h1>header area editor</h1>
      <!-- contact information end -->
      </div>
      <!-- tab editor list end -->
      <!-- tab editor list start -->
      <div class="editor-tab" id="footer_area_editor_tab">
        <!-- contact information start -->
        <h1>Footer area editor</h1>
      <!-- contact information end -->
      </div>
      <!-- tab editor list end -->
      <!-- tab editor list start -->
      <div class="editor-tab" id="color_editor_tab">
        <!-- contact information start -->
        <h1>Color editor</h1>
      <!-- contact information end -->
      </div>
      <!-- tab editor list end -->

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












</script>
<?php 