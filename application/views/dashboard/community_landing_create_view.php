<div class="sm-container" <?php echo isset($smcontainer) ? $smcontainer : '' ; ?>>
                
        

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

                      <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>communitylanding">
                          
                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Landing Page Sub Title</div>

                            <div class="form-group">
                                <input type="text" name="sub_title" value="<?php echo isset($landingpages[0]['sub_title']) ? $landingpages[0]['sub_title'] : '' ; ?>" >
                            </div>
                        </div> -->

                        <div class="frm-block">
                            <div class="frm-lbl">Landing Page Title</div>

                            <div class="form-group">
                                <input type="text" name="title1" value="<?php echo isset($landingpages[0]['title1']) ? $landingpages[0]['title1'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Landing Top Content </div>

                            <div class="form-group">
                                <textarea style="height: 200px;" name="content1" class="form_script_editorx"><?php echo isset($landingpages[0]['content1']) ? ($landingpages[0]['content1']) : '' ; ?></textarea>
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



                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 2</div>

                            <div class="form-group">
                                <input type="text" name="title2" value="<?php echo isset($landingpages[0]['title2']) ? $landingpages[0]['title2'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 2</div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content2" class="form_script_editorx"><?php echo isset($landingpages[0]['content2']) ? ($landingpages[0]['content2']) : '' ; ?></textarea>
                            </div>
                        </div>


                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 3</div>

                            <div class="form-group">
                                <input type="text" name="title3" value="<?php echo isset($landingpages[0]['title3']) ? $landingpages[0]['title3'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 3</div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content3" class="form_script_editorx"><?php echo isset($landingpages[0]['content3']) ? ($landingpages[0]['content3']) : '' ; ?></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 4</div>

                            <div class="form-group">
                                <input type="text" name="title4" value="<?php echo isset($landingpages[0]['title4']) ? $landingpages[0]['title4'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 4</div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content4" class="form_script_editorx"><?php echo isset($landingpages[0]['content4']) ? ($landingpages[0]['content4']) : '' ; ?></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 5</div>

                            <div class="form-group">
                                <input type="text" name="title5" value="<?php echo isset($landingpages[0]['title5']) ? $landingpages[0]['title5'] : '' ; ?>" >
                            </div>
                        </div>

                        <!-- <div class="frm-block">
                            <div class="frm-lbl">Section Content 5</div>

                            <div class="form-group">
                                <textarea style="height: 100px;" name="content5" class="form_script_editorx"><?php echo isset($landingpages[0]['content5']) ? ($landingpages[0]['content5']) : '' ; ?></textarea>
                            </div>
                        </div> -->

                        <?php 
                        
                        if( isset($landingpages[0]) ){
                            $mentor_name = explode('|', $landingpages[0]['mentor_name']);
                            $mentor_bio = explode('|', $landingpages[0]['mentor_bio']);
                            $mentor_special = explode(',', $landingpages[0]['mentor_special']);
                            $mentor_avatar = explode('|', $landingpages[0]['mentor_avatar']);
                        }

                        for ($m=1; $m <= 3; $m++): 
                       
                        if( isset($landingpages[0]) ){
                            $mentor_special_1 = explode('|', $mentor_special[$m-1]);
                        }

                        ?>
                        <div class="row">
                            <div class="col-md-8">
                                
                                <div class="frm-block">
                                    <div class="frm-lbl"><?php echo $m ?>. Coach Name & Bio</div>
                                    <div class="form-group">
                                        <input type="text" name="mentor_name[]" value="<?php echo isset($mentor_name[$m-1]) ? $mentor_name[$m-1] : '' ; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <textarea name="mentor_bio[]" style="height:120px;"><?php echo isset($mentor_bio[$m-1]) ? $mentor_bio[$m-1] : '' ; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <?php if(  isset($mentor_avatar[$m-1]) ): ?>
                                        <p class="coach-avatar<?php echo $m ?>"><?php echo isset($mentor_avatar[$m-1]) ? $mentor_avatar[$m-1] : '' ; ?> &nbsp;<a href="#" class="remove-l-avatar" m="<?php echo $m ?>">[Remove]</a></p>
                                        <?php endif; ?>
                                        
                                        <input type="file" name="mentor_avatar<?php echo $m ?>" accept="image/*">
                                        <input type="hidden" name="mentor_avatar_h<?php echo $m ?>" class="mentor_avatar_h<?php echo $m ?>" value="<?php echo isset($mentor_avatar[$m-1]) ? $mentor_avatar[$m-1] : '' ; ?>">
                                    </div>
                                </div>

                            </div>
                           
                            <div class="col-md-4">
                                
                                <div class="frm-block">
                                    <div class="frm-lbl">Areas of Specialisation</div>

                                    <div class="form-group">
                                        <input type="text" name="mentor_special<?php echo $m ?>[]" value="<?php echo isset($mentor_special_1[0]) ? $mentor_special_1[0] : '' ; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mentor_special<?php echo $m ?>[]" value="<?php echo isset($mentor_special_1[1]) ? $mentor_special_1[1] : '' ; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mentor_special<?php echo $m ?>[]" value="<?php echo isset($mentor_special_1[2]) ? $mentor_special_1[2] : '' ; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mentor_special<?php echo $m ?>[]" value="<?php echo isset($mentor_special_1[3]) ? $mentor_special_1[3] : '' ; ?>" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="mentor_special<?php echo $m ?>[]" value="<?php echo isset($mentor_special_1[4]) ? $mentor_special_1[4] : '' ; ?>" >
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr/>
                        <?php endfor; ?>
                        
                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 6</div>

                            <div class="form-group">
                                <input type="text" name="title6" value="<?php echo isset($landingpages[0]['title6']) ? $landingpages[0]['title6'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 6</div>

                            <div class="form-group">
                                <textarea style="height: 140px;" name="content6"><?php echo isset($landingpages[0]['content6']) ? ($landingpages[0]['content6']) : '' ; ?></textarea>
                            </div>
                        </div>

                        <hr/>
                        <?php 

                        if( isset($landingpages[0]) ){
                            $multiple_title = explode('|', $landingpages[0]['multiple_title1']);
                            $multiple_content = explode('|', $landingpages[0]['multiple_content1']);
                        }
                        
                        for ($b=1; $b <= 6; $b++): ?>

                            <div class="frm-block">
                                <div class="frm-lbl">Box title <?php echo $b ?></div>

                                <div class="form-group">
                                    <input type="text" name="multiple_title1[]" value="<?php echo isset($multiple_title[$b-1]) ? $multiple_title[$b-1] : '' ; ?>" >
                                </div>
                            </div>

                            <div class="frm-block">
                                <div class="frm-lbl">Box Content <?php echo $b ?></div>

                                <div class="form-group">
                                    <textarea style="height: 140px;" name="multiple_content1[]"><?php echo isset($multiple_content[$b-1]) ? $multiple_content[$b-1] : '' ; ?></textarea>
                                </div>
                            </div>
                            <hr/>

                        <?php endfor; ?>

                        <div class="frm-block">
                            <div class="frm-lbl">Heading 1</div>

                            <div class="form-group">
                                <input type="text" name="heading1" value="<?php echo isset($landingpages[0]['heading1']) ? $landingpages[0]['heading1'] : '' ; ?>" >
                            </div>
                        </div>

                        <hr/>


                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 7</div>

                            <div class="form-group">
                                <input type="text" name="title7" value="<?php echo isset($landingpages[0]['title7']) ? $landingpages[0]['title7'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 7</div>

                            <div class="form-group">
                                <textarea style="height: 140px;" name="content7"><?php echo isset($landingpages[0]['content7']) ? ($landingpages[0]['content7']) : '' ; ?></textarea>
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Title 8</div>

                            <div class="form-group">
                                <input type="text" name="title8" value="<?php echo isset($landingpages[0]['title8']) ? $landingpages[0]['title8'] : '' ; ?>" >
                            </div>
                        </div>

                        <div class="frm-block">
                            <div class="frm-lbl">Section Content 8</div>

                            <div class="form-group">
                                <textarea style="height: 140px;" name="content8"><?php echo isset($landingpages[0]['content8']) ? ($landingpages[0]['content8']) : '' ; ?></textarea>
                            </div>
                        </div>


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