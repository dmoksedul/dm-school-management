<?php
/*
* The template for displaying pages
*/ 
get_header(); ?>

            <header class="dm_entry_header">
                <h1 class="dm_page_title"><?php the_title(); ?></h1>
            </header>

            <div class="dm_entry_content">
                <?php the_content(); ?>
            </div>


  <?php get_footer(); ?>