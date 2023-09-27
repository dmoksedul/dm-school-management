<?php if (have_posts()) :
              while (have_posts()) : the_post(); ?>

              <div class="dm_blog_area">
                  <div class="dm_post_thumb">
                    <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail('post-thumbnails'); ?></a>
                  </div>
                  <div class="dm_post_details">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><i class="fas fa-calendar-alt"></i> <?php echo the_time('D, j - F Y'); ?> <span>At</span> <i class="fas fa-clock"></i> <?php echo the_time('g:i a'); ?></p>
                    <?php
                    $excerpt = get_the_excerpt();
                    if (strlen($excerpt) > 40) {
                        $excerpt = substr($excerpt, 0, 80) . '...';
                    }
                    echo $excerpt;
                    ?>

                  </div>
              </div>
          <?php endwhile;
            else :
              _e('No post found');
            endif; ?>
          