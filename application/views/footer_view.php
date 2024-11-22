<?php if( !isset($nofooter) ): ?>
  <!-- <footer class="wrapper image-wrapper bg-contain bg-image bg-overlay-500 p-12" data-image-src="<?php echo base_url() ?>img/footerbg1.png"> -->
  <footer style="background:url('<?php echo base_url() ?>img/footerbg1.png') center top / cover no-repeat;">
  <div class="container pt-13 pb-6">
      
      <div class="row gy-6 gy-lg-0">
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <img class="mb-4" width="220" src="<?php echo base_url() ?>img/logo.png" srcset="<?php echo base_url() ?>img/logo.png 2x" alt="" />
            
            <nav class="nav social social-muted">
              <a href="#"><i class="uil uil-linkedin" style="color:#4EDE79 !important;"></i></a>
              <a href="#"><i class="uil uil-facebook-f" style="color:#4EDE79 !important;"></i></a>
              <a href="#"><i class="uil uil-instagram" style="color:#4EDE79 !important;"></i></a>
            </nav>
            <!-- /.social -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <h4 class="widget-title ls-sm mb-3 text-light">Learn More</h4>
            <ul class="list-unstyled mb-0a">
              <li><a class="text-light" href="<?php echo base_url() ?>jobs">Jobs</a></li>
              <li><a class="text-light" href="<?php echo base_url() ?>blog">Blog</a></li>
              <li><a class="text-light" href="<?php echo base_url() ?>learn/28-wings-to-fly-cabin-crew-training">Wings to Fly: Cabin Crew Training</a></li>
              <li><a class="text-light" href="<?php echo base_url() ?>login">Login</a></li>
            </ul>
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <h4 class="widget-title ls-sm mb-3">&nbsp;</h4>
            <ul class="list-unstyled mb-0">
              <li><a class="text-light" href="<?php echo base_url() ?>testimonials">Testimonials</a></li>
              <li><a class="text-light" href="<?php echo base_url() ?>termsandconditions">Terms of Use</a></li>
              <li><a class="text-light" href="<?php echo base_url() ?>privacy">Privacy Policy</a></li>
            </ul>
          </div>
        </div>
        <!-- /column -->
        
      </div>
      <!--/.row -->

      <hr class="my-8" />

      <div class="text-center">
      <p class="pb-0 text-white">© <script> document.write(new Date().getUTCFullYear());</script> Paralegal Recruitment. All rights reserved.</p>
      </div>

    </div>
    <!-- /.container -->
  </footer>
  <?php endif; ?>

  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>
  <script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  <script type="text/javascript">
        var baseurl = '<?php echo base_url() ?>';
        var userid = '<?php echo $this->session->userdata('user_id') ?>';
        var cpage = '<?php echo isset($page) ? $page : '' ; ?>';

    </script>

  <script src="<?php echo base_url(); ?>assets/js/plugins.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/theme.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>

</html>