<?php

?>

<!-- Footer area start -->
<footer id="dm_footer_area">
    <div class="container">
    <!-- footer box start -->
    <div class="dm_footer_box">
        <h3 class="fm_footer_title"><?php bloginfo( 'title' )  ?></h3>
        <p>Alhamdulillah, Our School based on Allah Suhbhanu wa tayala path. We can make student behavior good for our future generation.</p>
        <ul class="footer_social_box">
            <li><a href="<?php echo get_theme_mod('dm_facebook');  ?>"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="<?php echo get_theme_mod('dm_instagram');  ?>"><i class="fab fa-instagram"></i></a></li>
            <li><a href="<?php echo get_theme_mod('dm_twitter');  ?>"><i class="fab fa-twitter"></i></a></li>
            <li><a href="<?php echo get_theme_mod('dm_linkedin');  ?>"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="<?php echo get_theme_mod('dm_whatsapp');  ?>"><i class="fab fa-whatsapp"></i></a></li>
            <li><a href="<?php echo get_theme_mod('dm_youtube');  ?>"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
    <!-- footer box end -->
    <!-- footer box start -->
    <div class="dm_footer_box about_box">
        <h3 class="fm_footer_title">আমাদের সম্পর্কে</h3>

        <ul>
            <li><a href="#"><i class="fas fa-phone"></i><?php print get_option('phone-number'); ?></a></li>
            <li><a href="#"><i class="fas fa-envelope"></i><?php print get_option('email-info'); ?></a></li>
            <li><a href="#"><i class="fas fa-location-dot"></i><?php print get_option('address-info'); ?></a></li>
        </ul>
    </div>
    <!-- footer box end -->
    <!-- footer box start -->
    <div class="dm_footer_box">
        <h3 class="fm_footer_title">অফিসিয়াল ফেসবুক পেজ</h3>
        <div class="dm_facebook_page_box">
        <?php $custom_html = get_theme_mod('dm_facebook_page_code');
if (!empty($custom_html)) {
    echo $custom_html;
}  ?>
        </div>
    </div>
    <!-- footer box end -->
    </div>
    <div class="dm_footer_copyright_area">
        <p><?php echo get_theme_mod('dm_copyright');  ?></p>
    </div>
</footer>


<?php wp_footer(  )?>
</body>
</html>