<?php

?>

<!-- Footer area start -->
<footer id="dm_footer_area">
    <div class="container">
    <!-- footer box start -->
    <div class="dm_footer_box">
        <h3 class="fm_footer_title"><?php bloginfo( 'title' )  ?></h3>
        <p><?php echo get_theme_mod('dm_footer_description');  ?></p>
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
        <div id="fb-root"></div>
            <script async="1" defer="1" crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="nWyKGp8F"></script><div class="fb-page" data-href="https://www.facebook.com/<?php echo get_theme_mod('dm_facebook_page_username');  ?>" data-height="130" data-small-header="" data-adapt-container-width="1" data-hide-cover="" data-show-facepile="true" data-show-posts="true" data-width="600"><blockquote cite="https://www.facebook.com/<?php echo get_theme_mod('dm_facebook_page_username');  ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?php echo get_theme_mod('dm_facebook_page_username');  ?>"></a></blockquote></div>
        </div>
    </div>
    <!-- footer box end -->
    </div>
    <div class="dm_footer_copyright_area">
        <p>© <?php
$fullYearDate = date('Y'); // This will give you the current date and time with the full year.
echo $fullYearDate;
?> <?php echo get_theme_mod('dm_copyright');  ?> | Developed by <a href="https://moksedul.dev/" target="_blank"> Dmoksedul</a></p>
    </div>
</footer>


<?php wp_footer(  )?>
</body>
</html>