<div class="sm-container">
                
                 <!--  ========= PROFILE ========= ---->
                <div class="">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if( 1==1 ): ?>
                        <!-- jQuery to trigger the modal -->
                        <script>
                            $(document).ready(function(){
                                // $("#openModalBtn").click(function(){
                                    //$("#recordreviewModal").modal('show');
                                // });
                            });
                        </script>

                        
                        <?php endif; ?>

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Achieve Your Certification Today!</h5>
                            </div>
                            <div class="def-box-body">
                                
                                <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->
                                <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                                
                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                <p>Welcome to our Certification Program! Whether you're looking to advance your career or validate your skills, our certification is the perfect step forward.</p>

                                <div id="mycertificate" class="text-center" style="background:#F6F6F6;border-radius:12px;padding:20px;padding:180px 0;background:url('<?php echo base_url() ?>img/Certificate-of-Completion.png') center center / contain no-repeat;">
                                    
                                    <?php if( count($certificate) == 0 ):?>
                                    <div class="modal fade" id="recordreviewModal" tabindex="-1" role="dialog" aria-labelledby="recordreviewModalLabel" aria-hidden="true" style="display:contents;">
                                        <div class="modal-dialog" style="max-width: 650px;">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    
                                                    <h5 class="modal-title">Certification</h5>
            
                                                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                                                    <!--<span aria-hidden="true">&times;</span>-->
                                                    <!--</button>-->
                                                </div>
                                                <div class="modal-body" style="padding: 30px 40px 30px 40px">
                                                    <div class="alert alert-success" role="alert">
                                                        Congratulations on completing the training program! 🎉 Your hard work and dedication have truly paid off. As a final step, please confirm your certificate purchase. If you'd like to choose between the online version or a hard copy, please make your selection at your earliest convenience.
                                                    </div>
                                                    <div class="text-center">
                                                    <a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $_GET['courseid'] ?>&certificate=<?php echo $_GET['certificate'] ?>" class="btn btn-success text-white">Continue</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                </div>
                                
                                <?php if( count($certificate) > 0 ):?>
                                <a href="#" style="border-radius:6px;color:#000;" class="btn btn-primary cm-btn btn-load mt-2 btn-block generatePDF">Download Certificate</a>
                                <?php else: ?>
                                <a href="<?php echo base_url() ?>stripe/checkout?courseid=<?php echo $_GET['courseid'] ?>&certificate=<?php echo $_GET['certificate'] ?>" style="border-radius:6px;color:#000;" class="btn btn-primary cm-btn btn-load mt-2 btn-block">Get Certificate</a>
                                <?php endif; ?>
                                
                                </div>

                            </div>
                        </div>
                        <!-- end profile box 1 -->



                        

                    </div>
                </div>

                </div>
                <!--  ========= END PROFILE ========= ---->

            </div>