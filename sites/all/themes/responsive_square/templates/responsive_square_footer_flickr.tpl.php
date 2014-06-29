<div class="span6">
  <div id="flickr_badge_wrapper">
    <script src="http://www.flickr.com/badge_code_v2.gne?count=8&display=latest&size=t&layout=x&source=user_set&set=<?php print $user_set; ?>"></script>
  </div>
  <div class="gallery-details fixed">

    <a href="#">
      <img src="<?php print drupal_get_path('theme', 'responsive_square')?>/images/flickr-logo.png" alt="">
    </a>

    <?php print $text; ?>
  </div>
</div>
