        <!-- <section class="breadcrumb_area">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-6">

                        <form class="form-inline mb_20">
                            <div class="form-group " style="margin-right:15px;">
                                <input type="text" class="form-control mb0 search-form-2" placeholder="Job search, Workplace success...">
                            </div>
                            <button type="submit" class="btn ngreen-btn">Search</button>
                        </form>



                        <p class="f_size_18 f_color_434343 f_500">Popular search:</p>
                        <p class="blog-p-pill">
                            <span>All</span>
                            <span>Coachingly news</span>
                            <span>Learning with Coachingly</span>
                            <span>Tech trends</span>
                            <span>Success story</span>
                        </p>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="border-radius-12 padding-25" style="background-color:#F5F5F7;">
                            <p class="f_size_20 f_color_434343 f_500">Our blog is a space where you'll discover thought-provoking articles, actionable advice, and stories of triumph that demonstrate the transformative impact of personalized coaching. </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
         -->
        
         <section class="wrapper bg-light">
            <div class="container py-17 py-md-16">

                <div class="row text-center mb-10">
                    <div class="col-md-10 col-lg-9 col-xxl-8 mx-auto">
                    <!-- <h2 class="fs-15 text-uppercase text-muted mb-3">What We Do?</h2> -->
                    <h3 class="display-3 ls-sm mb-2 px-xl-11">Blogs</h3>
                    </div>
                    <!-- /column -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12 blog_grid_info">
                        <div class="row">
                            
                            <?php if( count($blogposts) ): ?>
                            <?php foreach( $blogposts as $x ): ?>
                            <div class="col-lg-4">

                                <div class="card card-shadow card-border mb-4">
                                    <!-- <img class="m-4 border-12" src="./assets/img/photos/p1.jpg" alt="" /> -->
                                    <a href="<?php echo base_url() ?>blog/single/<?php echo $x['permalink'] ?>">
                                     <div class="m-4 border-12" style="height:220px;overflow:hidden;background:#fff;background: url('<?php echo base_url() ?>data/blog/<?php echo $x['media'] ?>') no-repeat center center / cover;"></div>
                                    </a>

                                    <div class="card-body ps-4 pe-4 pb-4 pt-0">
                                        <a href="<?php echo base_url() ?>blog/single/<?php echo $x['permalink'] ?>">
                                        <h5 class="card-title text-131F18 fs-20 fw-semibold mb-1 text-line-2"><?php echo $x['title'] ?></h5>
                                        </a>
                                        <p class="card-text mb-2 fw-medium fs-17 text-line-3"><?php echo substr(strip_tags($x['content']), 0, 80) ?>...</p>
                                        <p><a href="<?php echo base_url() ?>blog/single/<?php echo $x['permalink'] ?>" class="text-FF3838 fs-18 mt-2 mb-0 fw-semibold">Read more</a></p>
                                    </div>
                                </div>

                                
                            </div>
                            <?php endforeach; ?>
                            <?php endif;  ?>

                            
                        </div>

                         <!-- Pagination -->
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-md-12 d-flex flex-row justify-content-center">
                                <!-- Pagination -->
                                 <div class="pagination-container margin-top-40 mt-10">
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

                        <!-- <ul class="list-unstyled page-numbers shop_page_number text-left mt_30">
                            <li><span aria-current="page" class="page-numbers current">1</span></li>
                            <li><a class="page-numbers" href="#">2</a></li>
                            <li><a class="next page-numbers" href="#"><i class="ti-arrow-right"></i></a></li>
                        </ul> -->
                    </div>
                    
                    </div>
                </div>
            
        </section>