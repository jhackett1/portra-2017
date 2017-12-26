  <footer>
    <nav>
      <?php wp_nav_menu(array( 'theme_location' => 'social' )); ?>
    </nav>
    <nav>
      <?php wp_nav_menu(array( 'theme_location' => 'main' )); ?>
    </nav>
    <h4>All images copyright <?php echo bloginfo('name') . " " . date("Y")?>. Design by <a href="http://smallwins.co.uk">Small Wins</a>.</h4>
    <?php
      if ( function_exists( 'the_custom_logo' ) ) {
        the_custom_logo();
      }
    ?>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>
