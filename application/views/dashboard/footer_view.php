</div>
    </div>

    <script type="text/javascript">
    	var baseurl = '<?php echo base_url() ?>';
        var userid = '<?php echo $this->session->userdata('user_id') ?>';
        var roleid = '<?php echo $this->session->userdata('role_id') ?>';

        var currentpage = '<?php echo isset($currentpage) ? $currentpage : '' ; ?>';

        <?php if( isset($chatallowed) ): ?>
        var chatallowed = <?php echo $chatallowed ?>;
        <?php else: ?>
        var chatallowed = 0;
        <?php endif; ?>

        <?php if( isset($haschatajax) ): ?>
        var hc = <?php echo $haschatajax ?>;
        <?php else: ?>
        var hc = 0;
        <?php endif; ?>

        <?php if( !empty($chartlabels) ): ?>
        var chartlabels = [<?php echo $chartlabels ?>];
        <?php endif; ?>

        <?php if( !empty($basechartdata) ): ?>
        var barchartdataset = [<?php echo $basechartdata ?>];
        <?php endif; ?>

    </script>

    <script type="text/javascript">
        $(document).ready(function() {

                var visitortime = new Date();
                var visitortimezone = -visitortime.getTimezoneOffset()/60;
                $.ajax({
                    type: "GET",
                    url: "<?php echo base_url() ?>schedjobs/setclienttimezone",
                    data: 'timez='+ visitortimezone
                });
        });
    </script>

    <?php if( isset($submitvideo) ): ?>
    <script src="https://cdn.WebRTC-Experiment.com/RecordRTC.js"></script>
    <?php endif; ?>
        

    <?php if( isset($submitvideo) ): ?>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/recordvideo.js?t=<?php echo time() ?>"></script>
    <?php endif; ?>
    

    <?php if(isset($haseditor)): ?>
    <!--summernote-->
    <script src="<?php echo base_url(); ?>js/summernote/dist/summernote.js"></script>
    <script>

        jQuery(document).ready(function(){

            $('.form_script_editor, .handler_script_editor').summernote({
                height: 275,                 // set editor height
                // minHeight: 275,             // set minimum height of editor
                maxHeight: 275,             // set maximum height of editor
                // focus: true,               // set focus to editable area after initializing summernote
                toolbar: [
                     ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    // ['fontname', ['fontname']],
                    // ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['codeview']],
                ]
            });

            $('.note-codable').height(275);
            // $('.note-toolbar').remove();
            // $('div.note-editor').addClass('codeview');
            // $('div.note-editor.codeview button').addClass('disabled');
            // $("div.note-editor.codeview button[data-event='codeview']").removeClass('disabled').addClass('active');
        });

    </script>
    <?php endif; ?>


    <?php if( isset($haschart)): ?>
    <!--Chart JS-->
	<script src="<?php echo base_url(); ?>js/chart-js/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>js/chartJs-init.js"></script>
	<?php endif; ?>

    <?php if( isset($hasselect2)): ?>
    <!--select2-->
    <script src="<?php echo base_url(); ?>js/select2.js"></script>
    <!--select2 init-->
    <script src="<?php echo base_url(); ?>js/select2-init.js"></script>
    <?php endif; ?>

    <script>
        <?php if( isset($modules) ): ?>
            var modulescount = <?php echo count($modules) ?>;
        <?php else: ?>
            var modulescount = 0;
        <?php endif; ?>
        
        <?php if( isset($totalitems) ): ?>
            var totalitems = <?php echo $totalitems ?>;
        <?php else: ?>
            var totalitems = 0;
        <?php endif; ?>
        
        <?php if( isset($total_lessons) ): ?>
            var lessonscount = <?php echo $total_lessons ?>;
        <?php else: ?>
            var lessonscount = 0;
        <?php endif; ?>
    </script>
	
    <!-- My Js Files -->
    <script src="<?php echo base_url(); ?>js/dashboard.js?t=<?php echo time(); ?>"></script>

    <?php if( isset($pagecoursecontent) ): ?>
    <script>
       
        // Automatically clicks the first <a> inside the .card-body div
        $(document).ready(function(){
            //$('.card-b-1 a:first-child').click();
        });
    </script>
    <?php endif; ?>
    
</body>

</html>