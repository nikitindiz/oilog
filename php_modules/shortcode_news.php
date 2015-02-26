<?php

function recent_news_excerpt($limit) {
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

function recent_news_content($limit) {
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

// Add Shortcode
function recent_news_shortcode( $atts , $content = null ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'counter' => '4',
    ), $atts )
  );

  // Code
$output = ' <div class="latest-news">
            <h1 class="top-title icon-latest-news">Latest News</h1>
            <div class="controls">
              <a href="#dummy-link" class="slide-left"><i class="fa fa-chevron-left"></i></a>
              <a href="#dummy-link" class="slide-right"><i class="fa fa-chevron-right"></i></a>
            </div>
            <div class="news-wrapper">
              <ul class="news-items">
                ';
$the_query = new WP_Query( array ( 'posts_per_page' => $posts ) );
while ( $the_query->have_posts() ):
  $the_query->the_post();
  $output .= '<li><h1><a href="'. get_permalink() .'" class="slider_news">' . get_the_title() . '</a></h1><div>' . recent_news_excerpt(50) . '</div></li>';
endwhile;
wp_reset_postdata();
$output .= '
              </ul>
            </div>
          </div>';
return $output;

}
add_shortcode( 'recent-news', 'recent_news_shortcode' );

