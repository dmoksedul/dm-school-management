<?php
/*
* The template for displaying Archive Pages
*/ 
get_header(); ?>

  <section id="body_area">
    <div class="container">
      <div id="dm_archive_title">
        <?php
          the_archive_title('<h1 class="title">','</h1>');
          the_author_meta('description');
        ?>
      </div>
      <div id="dm_main_blog_area">
        <?php get_template_part('template-parts/blog_setup'); ?>
      </div>
      <div id="dm_page_nav">
        <?php if ('dm_pagenav') {dm_pagenav(); } else{ ?>
        <?php next_posts_link(); ?>
        <?php previous_posts_link(); ?>
        <?php } ?>
      </div>
      <!-- blog area end -->
      </div>
    </div>
  </section>

  <?php get_footer(); ?>