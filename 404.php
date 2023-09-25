<?php
/*
* The template for displaying 404 page (not found)
*/ 
get_header(); ?>

  <section id="error_page">
    <div class="container">
      <div class="row">
        <div class="col-md-12 error_page">
            <p>404 Error - Page not Found</p>
            <h1>Oops! Looks Like something was wrong</h1>
            <div class="error_search">
                <?php get_search_form(); ?>
            </div>
            <a href="<?php print home_url(); ?>" class="homepage btn">Back to Home</a>
        </div>
      </div>
    </div>
  </section>

 <?php get_footer(); ?>