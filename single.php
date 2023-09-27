<?php
/*
* The template for displaying post
*/ 
get_header(); ?>

  <section id="body_area">
    <div class="container">
    <?php get_template_part('templates/post_setup', get_post_format() ); ?>
    </div>
  </section>
      
  <?php get_footer(); 