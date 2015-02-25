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

  <!-- CONTENT -->
<?php if (have_posts()) : ?>
  <?php $i = 1; while (have_posts() && $i <= 8) : the_post(); ?>
  <div class="main-content">
    <div class="page-content-header">
      <div class="content-wrapper">
        <h1><?php echo the_title(); ?></h1>
      </div>
    </div>
    <div class="content-wrapper">
         <div class="the-content">
          <?php echo the_content(); ?>
        </div>
    </div>
  </div>
  <?php $i++; endwhile; ?>
<?php endif; ?>
  <!-- / CONTENT -->


  <?php get_footer(); ?>

