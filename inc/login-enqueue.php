<?php
// login css linking
function login_enqueue_register(){
    wp_enqueue_style( 'login_enqueue.min.css', get_stylesheet_directory_uri(  ). '/css/login_enqueue.min.css', array(),' 1.0.0', 'all' );
}
add_action('login_enqueue_scripts' ,'login_enqueue_register');

// login logo  change
function login_logo_change(){
    ?>
    <style>
        #login h1 a, .login h1 a{
            background: url(<?php print get_option('dm_login_logo', '<?php print get_template_directory_uri(). "/img/logo.png" ?>'); ?>);
            background-repeat: no-repeat;
            background-size: contain;
        }
    </style>

    <?php
}
add_action('login_enqueue_scripts' ,'login_logo_change');

// login logo url change
function login_logo_url_change(){
    return home_url();
}
add_filter('login_headerurl' ,'login_logo_url_change');