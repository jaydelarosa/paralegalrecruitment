    <section class="wrapper bg-light">
      <div class="container py-17 pt-md-17">
        <div class="row text-center mb-10">
          <div class="col-md-10 col-lg-9 col-xxl-8 mx-auto">
            <!-- <h2 class="fs-15 text-uppercase text-muted mb-3">What We Do?</h2> -->
            <h3 class="display-3 ls-sm mb-2 px-xl-11">Our latest job offers</h3>
            <p class="mb-0">Explore Latest Cabin Crew Opportunities</p>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        

        <?php if( count($jobs) > 0 ): ?>
        <div class="row">

            <?php foreach( $jobs as $x ): ?>
            <div class="col-lg-6 col-xl-6">

                <div class="job-list mb-10">
                    
                    <div class="card card-shadow card-border mb-4 liftx">
                        <div class="card-body p-5">
                        <div class="d-flex flex-row align-items-center">
                          <img src="<?php echo base_url() ?>data/courses/<?php echo $x['image'] ?>" class="mb-0 me-4 rounded" width="70" alt="">
                          <div>
                          <h2 class="display-4 mb-1 fs-28"><?php echo $x['title'] ?></h2>
                          <p class="lead mb-4 pe-xl-10 fs-16 text-line-1"><?php echo substr(strip_tags($x['description']), 0, 70) ?></p>
                          </div>
                        </div>
                        
                        <p class="fs-16">
                            <span class="me-4 fw-medium text-uppercase"><i class="uil uil-map-marker"></i> <span><?php echo $x['location'] ?></span></span><br/>
                            <span class="me-4 fw-medium text-uppercase"><i class="uil uil-file-alt"></i> <span><?php echo $x['job_type'] ?></span></span>
                            <span class="me-0 fw-medium text-uppercase"><i class="uil uil-building"></i> <span><?php echo $x['company'] ?></span></span>
                        </p>
                        <p><a href="<?php echo base_url() ?>jobs/<?php echo $x['job_id'] ?>-<?php echo $x['slug'] ?>" class="btn btn-green rounded">Learn more</a></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>

            </div>
            <?php endforeach; ?>

        </div>
        <?php endif; ?>

        <br/>
        <!-- Pagination -->
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                
                  <div class="pagination-container margin-top-40 margin-bottom-60">
                    <nav class="pagination">
                        <?php 
                            if($this->pagination->create_links()){
                                echo $this->pagination->create_links();
                            }
                        ?>
                    </nav>
                </div>


            </div>
        </div>
        <!-- Pagination / End -->


       
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->

