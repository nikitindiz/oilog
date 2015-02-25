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

<?php
  // set up or arguments for our custom query
  $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
  $query_args = array(
    'post_type' => 'products',
    'posts_per_page' => 5,
    'paged' => $paged
  );
  // create a new instance of WP_Query
  $the_query = new WP_Query( $query_args );
?>


<?php $max_posts_per_page = get_option('posts_per_page'); ?>

  <!-- CONTENT -->
  <div class="main-content">
    <div class="content-wrapper" ng-controller="priceAddController as requestItem">

        <?php
        // Check if there are any posts to display
        if ( have_posts() ) : ?>

        <header class="archive-header">
        <h1 class="archive-title">Category: <?php single_cat_title( '', false ); ?></h1>


        <?php
        // Display optional category description
         if ( category_description() ) : ?>
        <div class="archive-meta"><?php echo category_description(); ?></div>
        <?php endif; ?>
        </header>

        <?php

        // The Loop
        while ( have_posts() ) : the_post(); ?>
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>

        <div class="entry">
        <?php the_content(); ?>

         <p class="postmetadata"><?php
          comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
        ?></p>
        </div>

        <?php endwhile;

        else: ?>
        <p>Sorry, no posts matched your criteria.</p>


        <?php endif; ?>

    </div>
  </div>
 <!-- / CONTENT -->
  <?php get_footer(); ?>

