<?php get_header() ?>
<?php
while(have_posts()) {
  the_post(); ?>

  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p>Don't forget to replace me latter!</p>
      </div>
    </div>
  </div>

  <div class="container container--narrow page-section">

    <?php

      //wp_get_post_parent_id(get_the_id())
      //This function returns the id of the parent page. In this case id = 24 i.e true (zero = false)
      // But if the page doesn't have a parent, it simply returns the id of 0 which is equal to false.
      // So if true (i.e this page has a parent, in other words this is a child page then), display the breadcrumb,
      // else i.e false or zero (i.e this is not a child page), don't display the breadcrumb.

      $theParentID = wp_get_post_parent_id(get_the_id());
      if ($theParentID) {
        ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
          <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParentID); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParentID); ?></a> <span class="metabox__main"><?php the_title() ?></span></p>
        </div>
        <?php
      }
     ?>

    <?php
    $pageHasChildren = get_pages(array(
      'child_of' => get_the_id()
    ));
    if ($theParentID or $pageHasChildren) {

      ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParentID); ?>"><?php echo get_the_title($theParentID); ?></a></h2>
      <ul class="min-list">
        <?php
          // If this is a parent page $theParentID = 0
          // If this is a child page, $theParentID = ID of parent
          if ($theParentID) {
            // if this is a child page i.e $theParentID returns a true/positive value
            $theChildrenOf = $theParentID;
          } else {
            // if this is a parent i.e $theParentID returns a false/zero value
            $theChildrenOf = get_the_id();
          }
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $theChildrenOf,
            'sort_column' => 'menu_order'
          ));
         ?>
        <!-- <li class="current_page_item"><a href="#">Our History</a></li>
        <li><a href="#">Our Goals</a></li> -->
      </ul>
    </div>
  <?php } // ---End if --- ?>

    <p><?php the_content(); ?></p>
    <div class="generic-content">
    </div>

  </div>

<?php } ?>

<?php get_footer() ?>
