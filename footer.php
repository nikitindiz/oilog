
  <div class="blue-background footer-line"></div>
  <div class="content-wrapper footer-additional">
    <div class="footer-nav">
      <ul class="footer-menu">
        <li><a href="#dummy-link">About Us</a></li>
        <li><a href="#dummy-link">Contact Us</a></li>
      </ul>
    </div>
    <div class="footer-copyright">
      &copy; 2015 - 2016 Oilog Inc. All Rights Reserved.
    </div>
  </div>

  <div class="popup-price-window">
   <div class="product-wrapper">
    <div class="product-list" ng-show="requestedItems.length">
      <div class="logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo_02.png" alt="" class="logo-img">
      </div>
      <h1>You are going to request prices for selected items:</h1>
      <ul>
        <li ng-repeat="requestItem in requestedItems" ng-init="itemIndex = 1">
          <div class="item-thumb">
            <a href="{{requestItem.link}}">
              <img ng-src="{{requestItem.img}}" alt="{{requestItem.name}}">
            </a>
          </div>
          <div class="item-data-wrapper">
            <div class="item-header"><a href="{{requestItem.link}}" class="item-header">{{requestItem.name}}</a></div>
            <div class="item-descr">{{requestItem.description}}</div>
          </div>
          <a href="#delete-item" class="remove-item-from-list" ng-click="removeItem($index)"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="contact-info">
        <h1>Contact information:</h1>
        <div class="hint">Please fill contact information below to process</div>
        <form action="">
          <label for="name">
            <input type="text" placeholder="Your Name">
          </label>
          <label for="email">
            <input type="text" placeholder="Your Email">
          </label>
          <label for="phone">
            <input type="text" placeholder="Phone">
          </label>
          <div class="submit-btn">
            <input type="submit" value="Send Request">
          </div>
        </form>
      </div>
    </div>
    <div class="product-list" ng-hide="requestedItems.length">
      <div class="logo">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo_02.png" alt="" class="logo-img">
      </div>
      <div class="contact-info">
        <h1>Nothing to request</h1>
        <div class="hint">Please click on a photo to add item to request list</div>
      </div>
    </div>
   </div>
    <a href="#close-list" class="close-list"><i class="fa fa-close"></i></a>
  </div>

  <?php wp_footer(); ?>

  <!-- Vendor JS -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/vendor.js"></script>
  <!-- Page JS -->
  <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/script.js"></script>
</body>
</html>
