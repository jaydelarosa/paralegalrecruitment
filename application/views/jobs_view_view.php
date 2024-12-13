    <section class="wrapper bg-light">
      <div class="container py-16 pt-18 pb-0">
        
        <div class="row mb-10">
          <div class="col-md-8">

            <div class="card card-shadow card-border">
              <div class="card-body">

                  <div class="d-flex align-items-center">
                      <img src="<?php echo base_url() ?>data/courses/<?php echo $job[0]['image'] ?>" class="mb-0 me-4 rounded" width="70" alt="">
                      <div>
                        <h2 class="fs-15 text-uppercase text-muted mb-0" style="color:#726240 !important;"><?php echo $job[0]['company'] ?></h2>
                        <h2 class="display-4 mb-1 fs-30 fw-semibold"><?php echo $job[0]['title'] ?></h2>
                      </div>
                  </div>

                  <hr class="my-8">

                  <p><?php echo ($job[0]['description']) ?></p>

              </div>
            </div>

          </div>
          <div class="col-md-4">
            
            <div class="card card-shadow card-border">
              <div class="card-body">
                  <h2 class="display-4 mb-1 fs-28 fw-semibold">Interested in this job ?</h2>
                  <p class="lead mb-4 pe-xl-10 fs-16"><?php echo $job[0]['sidebar_text'] ?></p>
                  <a href="<?php echo base_url() ?>apply/<?php echo $job[0]['job_id'] ?>-<?php echo $job[0]['slug'] ?>" class="btn btn-lg w-100 btn-primary rounded">Apply Now</a>
                </div>
            </div>

          </div>
        </div>

       
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->


    <?php if( count($other_jobs) > 0 ): ?>
    <section class="wrapper bg-light">
      <div class="container py-12 pt-12 pb-0">

        <div class="row text-centerx mb-10">
          <div class="col-md-8">
            <h3 class="display-3 ls-sm mb-2 fw-semibold">Discover our other opportunities</h3>
          </div>
          <div class="col-md-4 text-end">
            <a class="btn btn-dark rounded" href="<?php echo base_url() ?>jobs" style="background:#FF3838;border-color:#FF3838;">Browse all</a>
          </div>
        </div>
        <!-- /.row -->

          
          <div class="row">
            <?php foreach( $other_jobs as $x ): ?>
            <div class="col-lg-446 col-xl-4">

                <div class="job-list mb-10">
                    
                    <div class="card card-shadow card-border mb-4 liftx">
                        <div class="card-body p-5">
                        <img src="<?php echo base_url() ?>data/courses/<?php echo $x['image'] ?>" class="mb-4 rounded" width="70" alt="">
                        <h2 class="display-4 mb-1 fs-24 fw-semibold"><?php echo $x['title'] ?></h2>
                        
                        <p class="fs-16">
                            <span class="me-4 fw-medium text-uppercase"><i class="uil uil-map-marker"></i> <span><?php echo $x['location'] ?></span></span>
                            <span class="me-4 fw-medium text-uppercase"><i class="uil uil-file-alt"></i> <span><?php echo $x['job_type'] ?></span></span>
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

      </div>
    </section>
    <?php endif; ?>

