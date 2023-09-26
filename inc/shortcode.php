<?php
// Wordpress Shordcode
function basic_shortcoder(){
    ?>
    <h1>Moksedul Islam</h1>
    <?php
}

add_shortcode( 'text', 'basic_shortcoder');
