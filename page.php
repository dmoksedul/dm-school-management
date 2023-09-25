<?php
get_header(); // Include header template
?>
              <section id="body_area">
    <div class="container">
    <?php
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="dm_entry_header">
                <h1 class="dm_page_title"><?php the_title(); ?></h1>
            </header>
            
            <div class="dm_entry_content">
                <?php the_content(); ?>
            </div>

        </article>
</div>
</section>

<?php
get_footer(); // Include footer template
?>
