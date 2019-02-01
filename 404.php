<?php get_header(); ?>

<h2>Error 404!</h2>

<?php while(have_posts()) {
  the_post(); ?>
  <?php
} ?>
<?php get_footer(); ?>
