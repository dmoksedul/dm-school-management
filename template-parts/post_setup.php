<?php if (have_posts()) :
              while (have_posts()) : the_post(); ?>

              <div class="dm_blog_post_area">
                  <span class="dashicons dashicons-format-<?php echo get_post_format( $post->ID ) ?>"></span>
                  
                  <div style="margin-top:10px" class="dm_blog_post_thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('post-thumbnails'); ?></a>
                  </div>
                  <div class="dm_post_details">
                    <h2><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                  </div>
              </div>
          <?php endwhile;
            else :
              _e('No post found');
            endif; ?>
            