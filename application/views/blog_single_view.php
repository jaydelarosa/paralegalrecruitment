<section class="wrapper bg-light">
    <br/>
        <div class="container py-17 py-md-16">
                <div class="row">
                    <!-- <div class=" col-lg-1"></div> -->
                    
                    <div class=" col-lg-8">
                        <div class="blog_single mb_50">
                            <img class="img-fluid border-r-8" src="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['blog_media'] ?>" alt="">
                            <div class="blog_content">
                                <!-- <div class="post_date">
                                  <h2><?php echo date('d', strtotime($blogpost[0]['blog_posted'])) ?> <span><?php echo date('M', strtotime($blogpost[0]['blog_posted'])) ?></span></h2>
                              </div> -->
                              <!-- <div class="entry_post_info">
                                  By: <a href="#"><?php echo $blogpost[0]['first_name'] ?></a>
                              </div> -->
                              <a href="#">
                                  <h1 class="f_p f_size_20 f_500 t_color mb-30 gilroy_bold"><?php echo $blogpost[0]['title'] ?></h1>
                              </a>

                               <?php
                                    $profile_picture = 'no-avatar.png';
                                    if( $blogpost[0]['profile_picture'] != '' AND $blogpost[0]['profile_picture'] !== NULL ){
                                        $profile_picture = $blogpost[0]['profile_picture'];
                                    }

                                    // $coachprofileslug = str_replace(' ', '', str_replace('-', '',$blogpost[0]['profile_slug'])).'-'.$blogpost[0]['userid'];
                                    $coachprofileslug = '';
                                ?>

                                <!-- Avatar -->
                                <!-- <div class="freelancer-avatar" style="width: 25px;height: 25px;">
                                    <div class="avatar-box-2 mp-small">
                                        <a href="<?php echo base_url(); ?>coachprofile/<?php echo $coachprofileslug ?>">
                                        <img class="b_radius_0" src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt=""></a>
                                    </div>
                                </div> -->

                              <p class="f_size_14 f_color_15 mb_16 gilroy_medium">
                                <?php if( $blogpost[0]['first_name'] != '' AND $blogpost[0]['last_name'] != '' ): ?>
                                <a href="<?php echo base_url(); ?>coachprofile/<?php echo $coachprofileslug ?>">
                                <img src="<?php echo base_url() ?>avatar/<?php echo $profile_picture ?>" alt="" style="border-radius: 50%;margin-top:-2px;height:28px;width:28px;"><span class="f_color_8 f_size_16">&nbsp;<?php echo $blogpost[0]['first_name'] ?> <?php echo $blogpost[0]['last_name'] ?></span>
                                </a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php endif; ?>
                                <img src="<?php echo base_url() ?>img/ClockCircle.png" width="15" style="margin-top:-2px;"><span class="f_size_14 f_color_15 gilroy_medium">&nbsp;<?php echo date('F d, Y', strtotime($blogpost[0]['blog_posted'])) ?></span>
                              </p>

                              <p class="f_400 mb-30 f_color_10 f_line_height_26 gilroy_medium">
                                <?php echo $blogpost[0]['embed']; ?>
                              <?php 
                                            // $bcontent = $blogpost[0]['content'];

                                            // $filtered_bcontent = preg_replace('/(<[a-z]+)([^>]+)?(style="[^"]*font-[^"]*"[^>]*)(>)|(style="[^"]*font-[^"]*"[^>]*)(<\/[a-z]+>)/i', '$1$4$6', $bcontent);

                                            // // $pattern = '/(https?:\/\/[^\s]+)/i';
                                            // // $replacement = '<a href="$1">$1</a>';
                                            // // $udpated_filtered_bcontent = preg_replace($pattern, $replacement, $filtered_bcontent);

                                            // // $filtered_bcontent = strip_tags($filtered_bcontent);
                                            // // $filtered_bcontent = nl2br($filtered_bcontent);
                                            // $filtered_bcontent = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $filtered_bcontent);
                                            // // $filtered_bcontent = str_replace('<ol>','<ul>',$filtered_bcontent);

                                            echo $bcontent = $blogpost[0]['content'];
                                            // echo trim($filtered_bcontent);
                                        
                                        ?>
                                </p> 
                            </div>
                        </div>

                        <?php //if( count($latest_blogpost) > 0 ): ?>
                        <!-- <div class="blog_post">
                            <div class="widget_title">
                                <h3 class="f_p f_size_20 t_color3">Latest Post</h3>
                                <div class="border_bottom"></div>
                            </div>
                            <div class="row">
                                
                                <?php //foreach( $latest_blogpost as $x ): ?>
                                <div class="col-lg-4 col-sm-6" style="margin-bottom: 30px">
                                    <div class="blog_post_item">
                                        <div class="blog_img">
                                            <img src="<?php //echo base_url() ?>data/blog/<?php echo $x['media'] ?>" alt="">
                                        </div>
                                        <div class="blog_content">
                                            <div class="entry_post_info">
                                                <a href="#"><?php //echo date('M d, Y', strtotime($x['blog_posted'])) ?></a>
                                            </div>
                                            <a href="#">
                                                <h5 class="f_p f_size_16 f_500 t_color"><?php //echo $blogpost[0]['title'] ?></h5>
                                            </a>
                                            <p class="f_400 mb-0"><?php //echo substr(strip_tags($blogpost[0]['content']), 0, 40) ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php //endforeach; ?>
                                
                            </div>
                        </div> -->
                        <?php //endif; ?>

                    </div>
                    <div class=" col-lg-4">

                        <?php if( $blogpost[0]['banner'] != '' OR $blogpost[0]['banner'] != NULL ): ?>
                        <a href="<?php echo ($blogpost[0]['banner_url']!='') ? $blogpost[0]['banner_url'] : '#' ; ?>" target="_blank">
                        <img class="img-fluid border-r-8" src="<?php echo base_url() ?>data/blog/<?php echo $blogpost[0]['banner'] ?>" style="width:100%;"><br/><br/>
                        </a>
                        <?php endif; ?>


                        <div class="blog-single-sidebox box-shadow-1">
                            <h1 class="gilroy_bold f_size_16">Recent Articles</h1>
                            <div class="blog-single-body" style="padding: 15px;">

                                <?php foreach ($latest_blogpost as $recent):?>

                                <a href="<?php echo base_url() ?>blog/single/<?php echo $recent['permalink'] ?>">
                                <div class="d-flex">
                                    <div class="p-2">
                                        <div class="border-r-4" style="height: 65px;width:65px;border: 1px solid #ddd;background: url('<?php echo base_url() ?>data/blog/<?php echo $recent['media'] ?>') no-repeat center center / cover;">
                                            <?php if($recent['media']!= ''): ?>
                                            <!-- <img class="img-fluid blog-recent-img mx-auto d-block" src=""> -->
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="mb-0 f_size_14 p-2 gilroy_medium">
                                        <strong class="gilroy_bold"><?php echo strip_tags($recent['title']) ?></strong><br/>
                                        <?php echo substr(strip_tags($recent['content']), 0,30).'...'; ?><br/>
                                        <img src="<?php echo base_url() ?>img/ClockCircle.png" width="15" style="margin:-2px 0 0 0;"><span class="f_size_12 f_color_15 gilroy_medium"><?php echo date('M d, Y', strtotime($recent['blog_posted']))?></span>
                                    </p>
                                </div>
                                </a>

                                <!-- <div class="row">
                                    <div class="col-md-4">
                                        <img class="img-fluid border-r-6" src="<?php echo base_url() ?>data/blog/<?php echo $recent['media'] ?>" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <p class="mb-0 f_size_14"><?php echo substr(strip_tags($recent['content']), 0,25) ?></p>
                                    </div>
                                </div><br/> -->
                                <?php endforeach; ?>

                            </div>
                        </div>

                        <div class="blog-single-sidebox box-shadow-1">
                            <h1 class="gilroy_bold f_size_16">Share</h1>
                            <div class="blog-single-body text-center">

                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url() ?>blog/single/<?php echo $permalink ?>" target="_blank"><img src="<?php echo base_url() ?>img/Facebook.png" width="32"></a>
                                <!-- <img src="<?php echo base_url() ?>img/Google.png" width="32">
                                <img src="<?php echo base_url() ?>img/Twitter.png" width="32">
                                <img src="<?php echo base_url() ?>img/Instagram.png" width="32"> -->

                            </div>
                        </div>

                    </div>
                    

                </div>
            </div>
        </section>