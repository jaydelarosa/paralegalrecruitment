<div class="sm-container">
                
                 <!--  ========= PROFILE ========= ---->
                <div class="">
                
                <div class="row">
                    <div class="col-md-12">

                        <?php if( $this->session->userdata('lockaccount_payment') == 'yes' ): ?>
                        <!-- jQuery to trigger the modal -->
                        <script>
                            $(document).ready(function(){
                                // $("#openModalBtn").click(function(){
                                    $("#recordreviewModal").modal('show');
                                // });
                            });
                        </script>

                        <div class="modal fade" id="recordreviewModal" tabindex="-1" role="dialog" aria-labelledby="recordreviewModalLabel" aria-hidden="true">
                            <div class="modal-dialog" style="max-width: 650px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        
                                        <h5 class="modal-title">Account Paused</h5>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="padding: 0px 40px 30px 40px">
                                        <div class="alert alert-danger" role="alert">
                                            Your account is currently on pause. To proceed with your enrollment in the current course, please complete the payment using our secure Stripe integration. 
                                        </div>
                                        <div class="text-center">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- profile box 1 -->
                        <div class="def-box-main" style="margin-top: 0;">
                            <div class="def-box-header">
                                <h5>Payment Required to Continue Course</h5>
                            </div>
                            <div class="def-box-body">

                                <?php if( $notif != ''): ?>
                                <div class="alert alert-<?php echo $notif_type; ?>" role="alert">
                                  <?php echo $notif; ?>
                                </div>
                                <?php endif; ?>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                                    <br/>
                                <button type="submit" class="btn btn-primary cm-btn btn-block btn-load record-submit-btn" id="checkout-button" style="margin-right: 35px;">CHECKOUT</button>
                                

                            </div>
                        </div>
                        <!-- end profile box 1 -->

                        <script src="https://js.stripe.com/v3/"></script>

                        <script type="text/javascript">
                            
                            var stripe = Stripe('pk_test_51HONLJGW0jTwEnVwWGnPxJWpvCQAvXNLa5WQubZ0kM1ltbCGJOeWyJT1DjvTshKuiL8Tc4m5AQvdE7e0YeO1IKhB003eWDd6PW'); // Replace with your Stripe Public Key

                            const course_id = '123'; 

                            document.getElementById('checkout-button').addEventListener('click', function () {
                                fetch('<?php echo base_url() ?>startsubscription/checkout', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({ course_id: course_id }) // Send course_id in the request body
                                })
                                .then(function (response) {
                                    return response.json();
                                })
                                .then(function (session) {
                                    if (session.error) {
                                        alert(session.error);
                                    } else {
                                        return stripe.redirectToCheckout({ sessionId: session.id });
                                    }
                                })
                                .then(function (result) {
                                    if (result.error) {
                                        alert(result.error.message);
                                    }
                                });
                            });
                        </script>



                        

                    </div>
                </div>

                </div>
                <!--  ========= END PROFILE ========= ---->

            </div>