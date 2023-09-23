<?php
/*
* This templete displaying the heading
*/

?>

<!DOCTYPE html>
<html lang="<?php language_attributes( ); ?>" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(  )?>
</head>
<body <?php body_class( )?>>
    <!-- header area start -->
    <header class="dm_header_area">
        <!-- top_header area start -->
        <!-- <div id="dm_top_header">
            <div class="container">
                <div class="left_box">
                    this is content
                </div>
                <div class="right_box">
                    this is content here
                </div>
            </div>
        </div> -->
        <!-- top_header area end -->
        <!-- header banner start -->
        <div id="dm_header_banner_area">
            <div class="container">
            <img src="<?php echo get_theme_mod('dm_logo'); ?>" alt="">
            </div>
        </div>
        <!-- nav menheader banner end -->
        <!-- navbar area start -->
        <nav id="dm_navbar_area">
            <div class="container">
                <?php wp_nav_menu( array('theme_location' => 'header_menu', 'menu_id' => 'dm_navbar_menu') ); ?>
            </div>
        </nav>
        <!-- navbar area end -->
    </header>
    <!-- header area end -->
    <section id="main_body">
        <?php the_content() ?>
    </section>



<?php wp_footer(  )?>
</body>
</html>