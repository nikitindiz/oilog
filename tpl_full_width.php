<?php
/*
Template Name: Full Width w/o slider bar
*/
?>

<?php get_header(); ?>


  <?php
    // Check if there are any posts to display
    if ( have_posts() ) : ?>
  <!-- CONTENT -->
  <div class="main-content">
      <div class="page-content-header">
        <div class="content-wrapper">
          <h1><?php echo the_title(); ?></h1>
        </div>
      </div>

    <div ng-controller="priceAddController as requestItem">


        <?php

        // The Loop
        while ( have_posts() ) : the_post(); ?>


        <div class="entry">
        <?php the_content(); ?>

        </div>

        <?php endwhile;

        else: ?>
        <p>Sorry, no posts matched your criteria.</p>




    </div>
  </div>
 <!-- / CONTENT -->
  <?php endif; ?>
  <?php get_footer(); ?>

