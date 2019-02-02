<?php get_header(); ?>

<div class="page-banner">
<div class="page-banner__bg-image" style="background-image: url(<?php  echo get_theme_file_uri('/images/library-hero.jpg') ?>);"></div>
  <div class="page-banner__content container t-center c-white">
    <h1 class="headline headline--large">Welcome!!</h1>
    <h2 class="headline headline--medium">We think you&rsquo;ll like it here!</h2>
    <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
    <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<!-- Section Events List-->

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
        <?php
          $today = date('Ymd');
          $homepageEventQuery = new WP_Query(
            array(
              'posts_per_page'  =>   2,        //i.e to Show all posts use -1
              'post_type'       =>   'event',   //Custom post type
              'meta_key'        =>   'event_date',  //custom field meta
              'orderby'         =>   'meta_value_num',  // meta type sort order
              'order'           =>   'ASC',   // Ascending order Latest date first
              'meta_query'      =>   array (  // Custom meta data query
                array (
                  'key'         =>   'event_date',
                  'compare'     =>    '>=',   // show date greater than or equal to today. i.e don't show past dates
                  'value'       =>    $today,
                  'type'        =>   'numeric'
                )
              )
            ));
          while ($homepageEventQuery->have_posts()) {
            $homepageEventQuery->the_post();
            ?>
            <div class="event-summary">
              <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php
                  // This is the core php function used to format and retrieve dates
                  // We will pass the custom field value as the argument.
                  // get_field() = returns the field value
                  // the_field() = echos the field value

                  $newDate = new DateTime();
                  $eventDate = $newDate->createFromFormat('d/m/Y', get_field('event_date'));
                  echo $eventDate->format('M')
                  // the_field('event_date');

                  ?></span>
                <span class="event-summary__day"><?php echo $eventDate->format('d') ?></span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php

                // If the Custom Post has a custom Excerpt, display that
                // Else display custom excerpt

                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }
                ?> <br><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>
            <?php
          } wp_reset_postdata();
         ?>




      <p class="t-center no-margin"><a href="<?php
        echo get_post_type_archive_link( 'event' );   // Function for Custom post type archive page permalink
        ?>" class="btn btn--blue">View All Events</a></p>

    </div>
  </div>

  <!-- Load Blog Posts List -->

  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
        <?php
          // Custom query
          $homepagePostsQuery = new WP_Query (
            array(
              'posts_per_page' => '2'
            ));
          //It could  also be written as
          // args = array(
          //   'posts_per_page' => 2
          // );
          // $homepagePostsQuery = new Wp_Query(args);


        while ($homepagePostsQuery->have_posts()) {
            $homepagePostsQuery->the_post(); ?>
            <div class="event-summary">
              <a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
                <span class="event-summary__month"><?php the_time('M') ?></span>
                <span class="event-summary__day"><?php the_time('d') ?></span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php

                // If the Post has a custom Excerpt, display that
                // Else display custom excerpt

                if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }
                 ?><br><a href="<?php the_permalink(); ?>" class="nu gray"> Read more</a></p>
              </div>
            </div>
            <?php
        } wp_reset_postdata();
        ?>


      <p class="t-center no-margin"><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
    </div>
  </div>
</div>

<div class="hero-slider">
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bus.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Free Transportation</h2>
      <p class="t-center">All students have free unlimited bus fare.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/apples.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">An Apple a Day</h2>
      <p class="t-center">Our dentistry program recommends eating apples.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
<div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/bread.jpg') ?>);">
  <div class="hero-slider__interior container">
    <div class="hero-slider__overlay">
      <h2 class="headline headline--medium t-center">Free Food</h2>
      <p class="t-center">Fictional University offers lunch plans for those in need.</p>
      <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>
