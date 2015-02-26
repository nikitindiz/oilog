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

  <!-- CONTENT -->
  <div class="main-content">
    <div class="content-wrapper" ng-controller="priceAddController as requestItem">
        <?php
        // Check if there are any posts to display
        if ( have_posts() ) : ?>

        <!--header class="archive-header">
        <?php
          $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

          ?>
        <h1 class="archive-title"><?php echo $term->name; ?></h1>


        <?php
        // Display optional category description
        if ( category_description() ) : ?>
        <div class="archive-meta"><?php echo category_description(); ?></div>
        <?php endif; ?>
        </header-->

        <div class="content-header">
        <span class="header"><?php echo $term->name; ?></span>
        <hr />
        </div>


        <?php

        // The Loop
        while ( have_posts() ) : the_post(); ?>

        <div class="post">
        <div class="thumb-wrapper">
        <div class="highliter"></div>
        <?php if (has_post_thumbnail( $post->ID )) : ?>
        <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0]; ?>
        <?php endif; ?>
        <div class="image"><img src="<?php echo $image; ?>" alt="" />
            <a class="add-to-request-btn" href="#dummy-link"
            ng-click="addItemToRequestList(priceReqCtrl,
                                               {id: '<?php echo get_the_ID(); ?>',
                                                name: '<?php echo get_the_title(); ?>',
                                                description: '<?php echo excerpt(25); ?>',
                                                link: '<?php the_permalink() ?>',
                                                img: '<?php echo $image; ?>'});">
            <i class="fa fa-plus"></i></a>
          </div>
        </div>
        <div class="description">
        <h1 class="learn-more"><a class="learn-more" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
        <div class="price"><?php echo excerpt(25);?></div>
        </div>
        </div>


        <?php endwhile;

        else: ?>
        <p>Sorry, no posts matched your criteria.</p>


        <?php endif; ?>

    </div>
  </div>
 <!-- / CONTENT -->
  <?php get_footer(); ?>

