  <?php if( !isset($nofooter) ): ?>
  <!-- <footer class="wrapper image-wrapper bg-contain bg-image bg-overlay-500 p-12" data-image-src="./img/footerbg1.png"> -->
  <footer style="background:url('./img/footerbg1.png') center top / cover no-repeat;">
    <div class="container py-14 py-md-16">
      
      <div class="row gy-6 gy-lg-0">
        <div class="col-md-4 col-lg-4">
          <div class="widget">
            <img class="mb-4" width="220" src="<?php echo base_url() ?>img/logo.png" srcset="<?php echo base_url() ?>img/logo.png 2x" alt="" />

            <div class="newsletter-wrapper">
              <!-- Begin Mailchimp Signup Form -->
              <div id="mc_embed_signup2">
                <form action="https://elemisfreebies.us20.list-manage.com/subscribe/post?u=aa4947f70a475ce162057838d&amp;id=b49ef47a9a" method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate dark-fields" target="_blank" novalidate="">
                  <div id="mc_embed_signup_scroll2">
                    <div class="mc-field-group input-group form-floating">
                      <input type="email" value="" name="EMAIL" class="required email form-control" placeholder="Email Address" id="mce-EMAIL2" style="border-radius: 0 !important;">
                      <label for="mce-EMAIL2">Email Address</label>
                      <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2" class="btn btn-primary ">
                    </div>
                    <div id="mce-responses2" class="clear">
                      <div class="response" id="mce-error-response2" style="display:none"></div>
                      <div class="response" id="mce-success-response2" style="display:none"></div>
                    </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1" value=""></div>
                    <div class="clear"></div>
                  <div style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;" data-lastpass-icon-root=""></div></div>
                </form>
              </div>
              <!--End mc_embed_signup-->
            </div>
<!--             
            <nav class="nav social social-muted">
              <a href="#"><i class="uil uil-linkedin"></i></a>
              <a href="#"><i class="uil uil-facebook-f"></i></a>
              <a href="#"><i class="uil uil-instagram"></i></a>
            </nav> -->
            <!-- /.social --> 
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-6 col-lg-6 offset-md-1 offset-lg-1">

          <h5 class="text-light fs-fig fw-medium fs-50 fs-fig">Start your HR career</h5>

          <div class="row">
            <div class="col-md-4 col-lg-4">
              <div class="widget">
                <h4 class="widget-title ls-sm mb-3 text-light fw-medium fs-fig">Useful Links</h4>
                <ul class="list-unstyled text-white mb-0">
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
                <h4 class="widget-title ls-sm mb-3 text-light fw-medium fs-fig">Support Links</h4>
                <ul class="list-unstyled text-light mb-0">
                  <li><a class="text-light" href="<?php echo base_url() ?>testimonials">Testimonials</a></li>
                  <li><a class="text-light" href="<?php echo base_url() ?>termsandconditions">Terms of Use</a></li>
                  <li><a class="text-light" href="<?php echo base_url() ?>privacy">Privacy Policy</a></li>
                </ul>
              </div>
            </div>
            <!-- /column -->

            <div class="col-md-4 col-lg-4">
              <div class="widget">
                <h4 class="widget-title ls-sm mb-3 text-light fw-medium fs-fig">Reach Us</h4>
                <ul class="list-unstyled text-light mb-0">
                  <li>Example  Galvin St. 
                  Example  33060</li>
                  <li>info@paralegalrecruitment.com</li>
                </ul>
              </div>
            </div>
            <!-- /column -->
          </div>

        </div>
        <!-- /column -->
        
        
      </div>
      <!--/.row -->

      <hr class="my-6" />

      <div class="text-centerx">
      <p class="pb-0 text-light">© <script> document.write(new Date().getUTCFullYear());</script> • Commitment to Excellence!</p>
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