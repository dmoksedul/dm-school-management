<?php
/*
* The template for displaying post
*/ 
get_header(); ?>

  <section id="body_area">
    <div class="container">
      <div class="row">
        <div class="col-md-9 dm_single_post_page">
            <?php get_template_part('templates/post_setup', get_post_format() ); ?>
        </div>
        <div class="col-md-3">
          <?php get_sidebar(); ?>
        </div>
      </div>
    </div>
  </section>
      
  <?php get_footer(); 