<!DOCTYPE html>
<html lang="en">
<head>

  <!-- CSS Implementing Plugins -->
  <!-- bundlecss:vendor [@@autopath] -->
  <link rel="stylesheet" href="assets/vendor/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="assets/vendor/jquery-ui-dist/jquery-ui.css">
  <link rel="stylesheet" href="assets/vendor/prism/prism.css">

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
  <script src="assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
  <script src="assets/vendor/hs-scroll-to-in-overflowed-container/dist/hs-scroll-to-in-overflowed-container.min.js"></script>
  <script src="assets/vendor/jquery-ui-dist/jquery-ui.min.js"></script>
  <script src="assets/vendor/prism/prism.js"></script>


  <!-- JS Plugins Init. -->
  <script>
    $(document).on('ready', function () {
      // INITIALIZATION OF HEADER
      // =======================================================
      var header = new HSHeader($('#header')).init();


      // INITIALIZATION OF SCROLL TO IN OVERFLOWED CONTAINER
      // =======================================================
      var scrollToInOverflowedContainerNav = new HSScrollToInOverflowedContainer($('.hs-sidebar-sticky'), {
        targetEl: "#snippetsSidebarNav .hs-sidebar-item.active"
      }).init();
    });
  </script>
</body>
</html>
