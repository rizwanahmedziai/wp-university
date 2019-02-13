<?php
get_header();

while (have_posts()) {
  the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Program Detail!</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Programs</a> <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('D-j-Y'); ?> in <?php echo get_the_category_list(', ') ?></span></p>
    </div>
    <div class="generic-content">
      <?php the_content(); ?>
    </div>


    <?php
    $eventsQuery = new WP_Query(
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
          ),
          array(
            'key'         =>   'related_programs',
            'compare'     =>    'LIKE',   // that contains
            'value'       =>    '"' . get_the_id() . '"'
          )
        )
      ));

      if ($eventsQuery->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
        while ($eventsQuery->have_posts()) {
          $eventsQuery->the_post();
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
      }
     ?>

  </div>

  <?php
}

get_footer();
?>
