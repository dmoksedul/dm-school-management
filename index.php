<?php
/*
* The main template file
*/ 
get_header(); ?>

<section id="body_area">
    <div class="container">
    <header class="dm_entry_header">
    <h1 class="dm_page_title">
        <?php
        if (is_home()) {
            echo 'Blog'; // Display "Blog" for the blog page
        } elseif (is_category()) {
            single_cat_title(); // Display the category title
        } else {
            the_title(); // Display the title for individual posts or pages
        }
        ?>
    </h1>
</header>


      <!-- blog area start -->
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
  </section>

<?php get_footer(); ?>

