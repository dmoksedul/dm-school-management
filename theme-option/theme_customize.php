<?php
// Genereal functions here

    ?>
   <div id="theme_customize_body">
    <div class="main_area_option">
      <!-- Header -->
      <?php echo "<h1>DM School Management Customize:</h1>";
      echo "<p>Add Website Contact Information.</p>"; ?>
    </div>
    <!-- middle area start -->
    <section>
    <!-- sidebar area -->
    <div id="customize_side_bar">
      <ul>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
        <li><a href="#">Header Area</a></li>
      </ul>
    </div>
    <!-- webiste customize editor body -->
    <div id="customize_editor_bar">
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
    </section>
    <!-- middle area end -->
  </div>


  <style>
    #theme_customize_body{
        background:#fff;
        padding:20px;
        border-radius:12px;
        margin:20px;
    }
    .contact_information_box{
      max-width:768px;
      padding:20px;
      border: radius 12px;
      box-shadow: 0 0 10px #000;
    }
</style>
<?php 