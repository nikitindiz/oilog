<?php
/*
Template Name: Loop Page
*/
?>

<?php get_header(); ?>

<?php

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>


<?php $max_posts_per_page = get_option('posts_per_page'); ?>

  <!-- SLIDER -->
  <div class="top-slider">
    <?php if ( is_active_sidebar( 'oilog_slider' ) ) : ?>
      <?php dynamic_sidebar( 'oilog_slider' ); ?>
    <?php endif; ?>
    <!--ul class="slides">
      <li class="active">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner11-vc-1200x400.jpg" alt="" class="slider-bg">
      </li>
      <li>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/banner31-vc-1200x400.jpg" alt="" class="slider-bg">
      </li>
    </ul>
    <ul class="controls">
      <li class="control-left"><a href=""><i class="fa fa-chevron-left"></i></a></li>
      <li class="control-right"><a href=""><i class="fa fa-chevron-right"></i></a></li>
    </ul-->
  </div>
  <!-- / SLIDER -->

  <!-- CONTENT -->
  <div class="main-content">
    <div class="content-wrapper" ng-controller="priceAddController as requestItem">

      <?php if (have_posts()) : ?>
        <?php $i = 1; while (have_posts() && $i <= 10) : the_post(); ?>

        <?php

        if($i < 3) {
          $post_hide = 'hide';
        } else {
          $post_hide = '';
        }

        ?>

              <?php the_content(); ?>

        <?php $i++; endwhile; ?>
      <?php endif; ?>


    </div>
  </div>
 <!-- / CONTENT -->
  <?php get_footer(); ?>

