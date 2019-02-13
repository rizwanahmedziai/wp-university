<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
  <div class="page-banner__content container container--narrow">
    <h1 class="page-banner__title">Past Events</h1>
    <div class="page-banner__intro">
      <p>A recap of our Past Events.</p>
    </div>
  </div>
</div>

<div class="container container--narrow page-section">

  <?php
  $today = date('Ymd');
  $pastEvents = new WP_Query(
    array(
      'paged'           =>   get_query_var( 'paged', 1 ),
      'post_type'       =>   'event',   //Custom post type
      'meta_key'        =>   'event_date',  //custom field meta
      'orderby'         =>   'meta_value_num',  // meta type sort order
      'order'           =>   'ASC',   // Ascending order Latest date first
      'meta_query'      =>   array (  // Custom meta data query
        array (
          'key'         =>   'event_date',
          'compare'     =>    '<',   // show date greater than or equal to today. i.e don't show past dates
          'value'       =>    $today,
          'type'        =>   'numeric'
        )
      )
    ));
  while($pastEvents->have_posts()) {
    $pastEvents->the_post(); ?>
    <div class="event-summary">
      <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
        <span class="event-summary__month"><?php
          // This is the core php function used to format and retrieve dates
          // We will pass the custom field value as the argument.
          // get_field() = returns the field value
          // the_field() = echos the field value

          $newDate1 = new DateTime(get_field('event_date'));
          // $eventDate1 = $newDate1;
          $eventDate1 = $newDate1->createFromFormat('d/m/Y', get_field('event_date'));
          echo $eventDate1->format('M')
          // ?></span>
        <span class="event-summary__day"><?php echo $eventDate1->format('d') ?></span>
      </a>
      <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
        <p><?php echo wp_trim_words(get_the_content(), 18) ?> <br><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
      </div>
    </div>
    <?php
  }
  wp_reset_postdata();
    echo paginate_links(array(
      'total' => $pastEvents->max_num_pages
    ));
  ?>

</div>


<?php get_footer(); ?>
