<?php

?>

<!-- Footer area start -->
<footer id="dm_footer_area">
    <div class="container">
    <!-- footer box start -->
    <div class="dm_footer_box">
        <h3 class="fm_footer_title"><?php bloginfo( 'title' )  ?></h3>
        <p></i><?php print get_option('footer_description', 'Transform your online presence with our professional web design and development services. Specializing in WordPress'); ?></p>
        <ul class="footer_social_box">
            <?php
            $facebook_username = get_option('dm_facebook_username', 'dmoksedul');
            if (!empty($facebook_username)) {
                echo '<li><a target="_blank" href="https://facebook.com/' . $facebook_username . '"><i class="fab fa-facebook-f"></i></a></li>';
            }

            $instagram_username = get_option('dm_instagram_username', 'dmoksedul');
            if (!empty($instagram_username)) {
                echo '<li><a target="_blank" href="https://instagram.com/' . $instagram_username . '"><i class="fab fa-instagram"></i></a></li>';
            }

            $twitter_username = get_option('dm_twitter_username', 'dmoksedul');
            if (!empty($twitter_username)) {
                echo '<li><a target="_blank" href="https://twitter.com/' . $twitter_username . '"><i class="fab fa-twitter"></i></a></li>';
            }

            $linkedin_username = get_option('dm_linkedin_username', 'dmoksedul');
            if (!empty($linkedin_username)) {
                echo '<li><a target="_blank" href="https://linkedin.com/in/' . $linkedin_username . '"><i class="fab fa-linkedin-in"></i></a></li>';
            }

            $whatsapp_link = get_option('dm_telegram_link', 'dmoksedul');
            if (!empty($whatsapp_link)) {
                echo '<li><a target="_blank" href="https://telegram.com/send?phone=' . $whatsapp_link . '"><i class="fab fa-telegram"></i></a></li>';
            }
            // telegram link
            $whatsapp_link = get_option('dm_whatsapp_link', '01518301895');
            if (!empty($whatsapp_link)) {
                echo '<li><a target="_blank" href="https://api.whatsapp.com/send?phone=' . $whatsapp_link . '"><i class="fab fa-whatsapp"></i></a></li>';
            }

            $youtube_link = get_option('dm_youtube_link', 'dmoksedul');
            if (!empty($youtube_link)) {
                echo '<li><a target="_blank" href="https://youtube.com/' . $youtube_link . '"><i class="fab fa-youtube"></i></a></li>';
            }
            // tiktok link
            $youtube_link = get_option('dm_tiktok_username', 'dmoksedul');
            if (!empty($youtube_link)) {
                echo '<li><a target="_blank" href="https://tiktok.com/' . $youtube_link . '"><i class="fab fa-tiktok"></i></a></li>';
            }
            ?>
        </ul>


    </div>
    <!-- footer box end -->
    <!-- footer box start -->
    <div class="dm_footer_box about_box">
        <h3 class="fm_footer_title">আমাদের সম্পর্কে</h3>
        <ul>
            <li><a href="tel:<?php print get_option('phone-number', '+8801518301895'); ?>"><i class="fas fa-phone"></i><?php print get_option('phone-number', '+8801518301895'); ?></a></li>
            <li><a href="mailto:</i><?php print get_option('email-info', 'info@moksedul.dev'); ?>"><i class="fas fa-envelope"></i><?php print get_option('email-info', 'info@moksedul.dev'); ?></a></li>
            <li><a href="#"><i class="fas fa-location-dot"></i><?php print get_option('address-info', 'Rangpur Bangladesh'); ?></a></li>
        </ul>
    </div>
    <!-- footer box end -->
    <!-- footer box start -->
    <div class="dm_footer_box">
        <h3 class="fm_footer_title">অফিসিয়াল ফেসবুক পেজ</h3>
        <div class="dm_facebook_page_box">
        <div id="fb-root"></div>
            <script async="1" defer="1" crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0" nonce="nWyKGp8F"></script><div class="fb-page" data-href="https://www.facebook.com/<?php print get_option('footer_facebook_page_username', 'dmoksedul'); ?>" data-height="130" data-small-header="" data-adapt-container-width="1" data-hide-cover="" data-show-facepile="true" data-show-posts="true" data-width="600"><blockquote cite="https://www.facebook.com/<?php print get_option('footer_facebook_page_username'); ?>" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/<?php print get_option('footer_facebook_page_username', 'dmoksedul'); ?>"></a></blockquote></div>
        </div>
    </div>
    <!-- footer box end -->
    </div>
    <div class="dm_footer_copyright_area">
        <p>© <?php
            $fullYearDate = date('Y'); // This will give you the current date and time with the full year.
            echo $fullYearDate;
            ?> <?php print get_option('footer_copyright_text', 'DM School & College'); ?> | Developed by <a href="https://moksedul.dev/" style="text-decoration: none;
            margin-left: 5px;
            color: #056839;
            font-weight: bold;" target="_blank"> Dmoksedul</a></p>
    </div>
</footer>


<?php wp_footer(  )?>
</body>
</html>