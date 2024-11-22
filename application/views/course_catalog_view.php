    <section class="saas_home_areax">
        <div class="banner_top" style="padding-top:30px;">
            <div class="container gradient-bg p-5">
                <br/>
                <div class="row mb-5" style="margin-top:95px;">
                    <div class="col-md-8 offset-md-2 text-center">

                        <h2 class="f_p f_size_30 l_height40 f_800 f_color_8 mb_30">Explore Coaching Certification Programs</h2>
                        <p class="f_size_16 l_height30 mb0">At Love2Coach, we provide a comprehensive range of certification programs designed to help you become an expert coach and empower others. Whether you're interested in life coaching, mindset coaching, relationship coaching, or specialized fields like journal therapy, inner child healing, or CBT, our programs equip you with the skills and credentials needed to guide clients toward lasting transformation. Explore our certification courses and take the next step in becoming a world-class coach.</p><br/>
                    </div>
                </div>

                <?php if( count($courses) > 0 ): ?>
                    <div class="row">
                        <?php foreach( $courses as $i=>$c ): 
                            if ($i % 2 == 0) {
                                $boxbg = '#D8DBC6';    
                            } else {
                                $boxbg = '#DDD3CD';    
                            }
                        ?>
                        <div class="col-md-4">

                        

                            <div class="card rounded rounded-xl">
                                <div class="card-body p-2">
                                    <a href="<?php echo base_url() ?>learn/<?php echo $c['course_id'] ?>-<?php echo $c['slug'] ?>"><div class="catalog-img-shape rounded rounded-lg m-4" style="height:220px;background: url('<?php echo base_url() ?>data/courses/<?php echo $c['thumbnail'] ?>') center center / cover no-repeat;"></div></a>
                                    <div class="p-4 pt-0">
                                        <a href="<?php echo base_url() ?>learn/<?php echo $c['course_id'] ?>-<?php echo $c['slug'] ?>"><h3 class="f_size_24 f_600 f_color_8 clamp-2-lines"><?php echo $c['course_title'] ?></h3></a>
                                        <p class="f_size_18 f_p l_height24 mb0 f_color_8 clamp-3-lines" style="min-height:75px;"><?php echo $c['short_description'] ?></p>
                                    

                                        <p class="mt-3 mb-0"><a href="<?php echo base_url() ?>learn/<?php echo $c['course_id'] ?>-<?php echo $c['slug'] ?>" class="f_color_8 f_700 f_p fs-16 fw-semibold">VIEW</a></p>
                                    </div>
                                </div>
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

                        <br/>
            </div>
        </div>
    </section>

