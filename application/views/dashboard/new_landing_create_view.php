<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        <?php
            if( isset($landingpages[0]['content1']) ){
                $content1 = explode('|', $landingpages[0]['content1']);
            }
        ?>

        <div class="row">
            <div class="col-md-8">
                
                <div class="def-box-main" style="margin-top: 0;">
                    <div class="def-box-header">
                        <h5>Add new landing page</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="def-box-body">

                      <?php if( $notif != ''): ?>
                      <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                        <?php echo $notif; ?>
                      </div>
                      <?php endif;?>

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>newlanding">
                          
                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Landing Page Sub Title</div>

                            <div class="form-group">
                                <input type="text" name="sub_title" value="<?php echo isset($landingpages[0]['sub_title']) ? $landingpages[0]['sub_title'] : '' ; ?>" >
                            </div>
                        </div> -->

                        <div class="frm-block">
                            <div class="frm-lbl">Sub Title</div>

                            <div class="form-group">
                                <input type="text" name="content1[]" value="<?php echo isset($content1[0]) ? $content1[0] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Landing Page Title</div>

                            <div class="form-group">
                                <input type="text" name="content1[]" value="<?php echo isset($content1[1]) ? $content1[1] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Landing Top Content </div>

                            <div class="form-group">
                                <textarea style="height: 200px;" name="content1[]" class="form_script_editorx"><?php echo isset($content1[2]) ? $content1[2] : '' ; ?></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Slug</div>

                            <div class="form-group">
                                <input type="text" name="slug" value="<?php echo isset($landingpages[0]['slug']) ? $landingpages[0]['slug'] : '' ; ?>">
                                <small id="emailHelp" class="form-text text-muted">slug is the text at the end of the URL, make sure to replace space with "-" this will be the category. https://www.speedymentors.com/c/[slug]</small>
                                <small id="emailHelp" class="form-text text-muted">ex. https://www.speedymentors.com/c/<b>business-analysis-work-experience-program</b>/</small>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Meta Tag Title</div>

                            <div class="form-group">
                                <input type="text" name="title_tags" value="<?php echo isset($landingpages[0]['title_tags']) ? $landingpages[0]['title_tags'] : '' ; ?>">
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Meta Description</div>

                            <div class="form-group">
                                <input type="text" name="meta_description" value="<?php echo isset($landingpages[0]['meta_description']) ? $landingpages[0]['meta_description'] : '' ; ?>">
                            </div>
                        </div>

                        <hr/>


                        <div class="frm-block">
                            <div class="frm-lbl">Form Title</div>

                            <div class="form-group">
                                <input type="text" name="content1[]" value="<?php echo isset($content1[3]) ? $content1[3] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Form Content</div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content1[]" class="form_script_editorx"><?php echo isset($content1[4]) ? $content1[4] : '' ; ?></textarea>
                            </div>
                        </div>



                        <?php 
                            $zx = 0;
                            // for ($i=1; $i <= 8; $i++): 
                            for ($i = 5, $a = 5, $b = 6; $i <= 12; $i++, $a += 2, $b += 2):
                                $zx++;
                            // $indexc1 = 4 + $i;

                            // if ($indexc1 % 2 == 0) { //even
                            //     $content1x = $indexc1;
                            //     $title1x = $indexc1 - 1;
                            // } else { //odd
                            //     $title1x = $indexc1;
                            //     $content1x = $indexc1 + 1;
                            // }
                            // echo $title1x.'/'.$content1x;
                        ?>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Title <?php echo $zx ?></div>

                            <div class="form-group">
                                <input type="text" name="content1[]" value="<?php echo isset($content1[$a]) ? $content1[$a] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content <?php echo $zx ?></div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content1[]" class="form_script_editorx"><?php echo isset($content1[$b]) ? $content1[$b] : '' ; ?></textarea>
                            </div>
                        </div>
                        
                        <?php endfor; ?>


                        <hr/>
                        <?php 

                        if( isset($landingpages[0]) ){
                            $faq_title = explode('|', $landingpages[0]['faq_title']);
                            $faq_content = explode('|', $landingpages[0]['faq_content']);
                        }

                        for ($f=1; $f <= 8; $f++): ?>

                            <div class="frm-block">
                                <div class="frm-lbl">FAQ title <?php echo $f ?></div>

                                <div class="form-group">
                                    <input type="text" name="faq_title[]" value="<?php echo isset($faq_title[$f-1]) ? $faq_title[$f-1] : '' ; ?>" >
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">FAQ Content <?php echo $f ?></div>

                                <div class="form-group">
                                    <textarea style="height: 140px;" name="faq_content[]"><?php echo isset($faq_content[$f-1]) ? ($faq_content[$f-1]) : '' ; ?></textarea>
                                </div>
                            </div>
                            <hr/>

                        <?php endfor; ?>

                        

                          <input type="hidden" name="info_page_id" value="<?php echo isset($landingpages[0]['info_page_id']) ? $landingpages[0]['info_page_id'] : '0' ; ?>">
                          <input type="hidden" name="user_hash" value="<?php echo $this->session->userdata('user_hash') ?>">
                          <button type="submit" class="btn btn-primary cm-btn btn-block" data-loading-text="Posting.." style="margin-right: 35px;">Publish</button>

                      </form>

                    </div>
              </div>

            </div>
                    
        </div>

       

</div>