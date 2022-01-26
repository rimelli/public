<!DOCTYPE html>
<html lang="en">
<head>

  <!-- CSS Implementing Plugins -->
  <!-- bundlecss:vendor [@@autopath] -->
  <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.css">
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="assets/vendor/jquery-ui-dist/jquery-ui.css">
  <link rel="stylesheet" href="assets/vendor/prism/prism.css">

  <!-- CSS Front Template -->
  <!-- bundlecss:theme [@@autopath] -->
  <link rel="stylesheet" href="@@autopath/assets/css/theme.css">

  <!-- CSS Front Doc -->
  <link rel="stylesheet" href="@@autopath/assets/css/snippets.css">
</head>
<body>

<div class="js-nav-scroller hs-nav-scroller-horizontal">
  <span class="hs-nav-scroller-arrow-prev" style="display: none;">
    <a class="hs-nav-scroller-arrow-link" href="javascript:;">
      <i class="tio-chevron-left"></i>
    </a>
  </span>

  <span class="hs-nav-scroller-arrow-next" style="display: none;">
    <a class="hs-nav-scroller-arrow-link" href="javascript:;">
      <i class="tio-chevron-right"></i>
    </a>
  </span>

  <!-- ========== MAIN CONTENT ========== -->
  <main class="space-top-3 space-md-2 pl-lg-12 pr-xl-12">
    <div class="row justify-content-lg-end">

      <div class="col-lg-12 space-1">
        <div class="pl-lg-12 pl-xl-12">

          
          

          <!-- Component Block -->
          <div id="component-8" class="hs-docs-content-divider">

            <!-- Tab Wrapper -->
            <div class="tab-wrapper">
              <!-- Nav Classic -->
              <ul class="nav nav-classic nav-tabs align-items-center" id="pills-tab-8" role="tablist" style="border-top: 0.0625rem solid #e7eaf3">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="false">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-posts-tab" data-toggle="pill" href="#pills-posts" role="tab" aria-controls="pills-posts" aria-selected="true">Posts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery" role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                </li>

              </ul>
              <!-- End Nav Classic -->

              <!-- Tab Content -->
              <div class="tab-content" id="pills-tabContent-8">
                <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                    <!-- Page Content -->
                    <div class="row margin-top-25">
                      <div class="col-xl-8 col-lg-8 content-right-offset">
                        
                        <!-- Page Content -->
                        <div class="single-page-section">
                          <h3 class="margin-bottom-25">About</h3>
                        </div>

                      </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="pills-posts" role="tabpanel" aria-labelledby="pills-posts-tab">
                  <h1>Posts</h1>
                </div>

                <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                  <h1>Gallery</h1>

                  <!-- Upload Button -->
                    <div class="uploadButton margin-top-30 margin-bottom-30">
                      <input class="uploadButton-input" type="file" accept=".png,.jpg,.jpeg,.pdf" id="gallery-upload" multiple />
                      <label class="uploadButton-button ripple-effect" for="gallery-upload" id="gallery-upload-label">
                        <i class="fas fa-sync fa-sm fa-spin"></i>
                        <i class="fas fa-cloud-upload-alt fa-lg ico-save"></i>
                        <span>Upload Files</span>
                      </label>
                      <span class="uploadButton-file-name">Maximum file size: 10 MB</span>
                    </div>

                    <!-- Attachments -->
                        <div class="galleries-container margin-top-0 margin-bottom-0 row" id="galleries-container">
                          <?php foreach($galleries AS $gallery){ ?>

                            <div class="col-sm-4 mb-3 gallery-box">
                              <a class="js-fancybox media-viewer" href="javascript:;"
                                 data-hs-fancybox-options='{
                                   "selector": "#galleries-container .js-fancybox",
                                   "speed": 700
                                 }'
                                 data-src="assets/files/profile_galleries/<?php echo $gallery['filename']; ?>.<?php echo $gallery['type']; ?>">
                                <img class="img-fluid rounded" src="assets/files/profile_galleries/<?php echo $gallery['filename']; ?>.<?php echo $gallery['type']; ?>" alt="Image Description">
                              </a>
                            </div>

                      
                          <?php } ?>
                        </div>
                  
                </div>
              </div>
              <!-- End Tab Content -->

            </div>
            <!-- End Tab Wrapper -->
          </div>
          <!-- End Component Block -->
        </div>
      </div>
    </div>
  </main>

</div>








  <!-- JS Global Compulsory @@deleteLine:build -->
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- JS Implementing Plugins -->
  <!-- bundlejs:vendor [@@autopath] -->
  <script src="assets/vendor/hs-header/dist/hs-header.min.js"></script>
  <script src="assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
  <script src="assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
  <script src="assets/vendor/hs-video-player/dist/hs-video-player.min.js"></script>
  <script src="assets/vendor/slick-carousel/slick/slick.js"></script>
  <script src="assets/vendor/hs-scroll-to-in-overflowed-container/dist/hs-scroll-to-in-overflowed-container.min.js"></script>
  <script src="assets/vendor/jquery-ui-dist/jquery-ui.min.js"></script>
  <script src="assets/vendor/prism/prism.js"></script>

  <!-- JSFront -->
  <!-- bundlejs:theme [@@autopath] -->
  <script src="assets/js/front/hs.slick-carousel.js"></script>
  <script src="assets/js/front/hs.autocomplete-local-search.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // INITIALIZATION OF HEADER
      // =======================================================
      var header = new HSHeader($('#header')).init();


      // INITIALIZATION OF VIDEO PLAYER
      // =======================================================
      $('.js-inline-video-player').each(function () {
        var videoPlayer = new HSVideoPlayer($(this)).init();
      });


      // INITIALIZATION OF FANCYBOX
      // =======================================================
      $('.js-fancybox').each(function () {
        var fancybox = $.HSCore.components.HSFancyBox.init($(this));
      });


      // INITIALIZATION OF SLICK CAROUSEL
      // =======================================================
      $('.js-slick-carousel').each(function() {
        var slickCarousel = $.HSCore.components.HSSlickCarousel.init($(this));
      });


      // INITIALIZATION OF SCROLL TO IN OVERFLOWED CONTAINER
      // =======================================================
      var scrollToInOverflowedContainerNav = new HSScrollToInOverflowedContainer($('.hs-sidebar-sticky'), {
        targetEl: "#snippetsSidebarNav .hs-sidebar-item.active"
      }).init();
    });

    $(window).on('load', function () {
      // INITIALIZATION OF AUTOCOMPLET
      // =======================================================
      $.HSCore.components.HSLocalSearchAutocomplete.init('.js-hs-docs-search');
    });
  </script>
</body>
</html>
