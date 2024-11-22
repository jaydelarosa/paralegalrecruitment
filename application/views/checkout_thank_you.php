 <section class="download_area" style="padding: 90px 0;height: auto;">
            
            <div class="container">
                

                <br/><br/>
                <div class="download_content text-center">
                    <img class="img-fluid" src="<?php echo base_url() ?>img/newhome/rocket.png" style="max-width:490px;" alt="">


                    <br/><br/>
                    <h1>Thank You!</h1>
                    <br/>
                    
                    <?php if( isset($_GET['courseid']) ): ?>
                    <div class="alert alert-success" role="alert">
                        You have successfully enrolled in the course. Your account details have been sent to your email address. Please check your inbox (and spam/junk folder just in case) for the confirmation and further instructions.
                    </div>
                    <?php else: ?>
                    <div class="alert alert-success" role="alert">
                         Thank you for booking your session! Your coach will reach out to you shortly with further details. Please check your inbox (and spam/junk folder just in case) for the confirmation and next steps.
                    </div>
                    <?php endif; ?>


                    <a class="btn btn-primary" style="margin-top: 20px;" href="<?php echo base_url() ?>">Back to home <i class="arrow_right"></i></a>
                    
                </div>

            </div>

</section>