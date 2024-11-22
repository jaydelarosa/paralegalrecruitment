<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <h3>Courses</h3>
        <hr><br/>

        <?php if( count($courses) > 0 ): ?>
        <div class="row">
            <?php foreach( $courses as $c ): ?>
            <div class="col-md-3">
                
                <a href="<?php echo base_url() ?>courses/<?php echo $c['course_id'] ?>-<?php echo $c['slug'] ?>">
                <div class="rounded r-radius-12 bg-white box-shadow-1 mb-4" style="overflow:hidden;">
                    <div style="background:url('<?php echo base_url() ?>data/courses/<?php echo $c['thumbnail'] ?>') center center / cover no-repeat;height:200px;">

                    </div>
                    <div class="p-3">
                        <div class="d-flex justify-content-between mb-2">
                            <p class="mb-0 f_600 f_color_black p-t-bx-2 ff-inter f_color_000" style="font-size:16px;"><?php echo $c['course_title'] ?></p>
                            <p class="mb-0 text-4B5563 font-weight-light" style="font-size:14px;"><?php echo ($c['course_price']); ?></p>
                        </div>
                        <div class="font-weight-light" style="font-size:13px;color:#4B5563;">
                            <span class="mr-2"><img src="<?php echo base_url() ?>img/c-ico-book.png" width="22" class="mr-1"> <?php echo $c['module_count'] ?> Lessons</span>

                            <span><img src="<?php echo base_url() ?>img/c-ico-star.png" width="17" class="mr-1"> <?php echo $c['no_of_reviews'] ?></span>
                        </div>
                    </div>
                </div>
                </a>

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

                <br/>

</div>