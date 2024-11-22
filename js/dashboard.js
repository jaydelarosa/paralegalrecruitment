(function(){
var measurer = $('<span>', {
                style: "display:inline-block;word-break:break-word;visibility:hidden;white-space:pre-wrap;display:none;"})
   .appendTo('body');
function initMeasurerFor(textarea){
  if(!textarea[0].originalOverflowY){
    textarea[0].originalOverflowY = textarea.css("overflow-y");    
  }  
  var maxWidth = textarea.css("max-width");
  measurer.text(textarea.text())
      .css("max-width", maxWidth == "none" ? textarea.width() + "px" : maxWidth)
      .css('font',textarea.css('font'))
      .css('overflow-y', textarea.css('overflow-y'))
      .css("max-height", textarea.css("max-height"))
      .css("min-height", textarea.css("min-height"))
      .css("min-width", textarea.css("min-width"))
      .css("padding", textarea.css("padding"))
      .css("border", textarea.css("border"))
      .css("box-sizing", textarea.css("box-sizing"))
}
function updateTextAreaSize(textarea){
  textarea.height(measurer.height());
  var w = measurer.width();
  if(textarea[0].originalOverflowY == "auto"){
      var mw = textarea.css("max-width");
      if(mw != "none"){
        if(w == parseInt(mw)){
          textarea.css("overflow-y", "auto");
        } else {
          textarea.css("overflow-y", "hidden");
        }
      }
   }
   textarea.width(w + 2);
}
$('textarea.autofit').on({
    input: function(){      
        var text = $(this).val();  
        if($(this).attr("preventEnter") == undefined){
           text = text.replace(/[\n]/g, "<br>&#8203;");
        }
        measurer.html(text);                       
        updateTextAreaSize($(this));       
    },
    focus: function(){
     initMeasurerFor($(this));
    },
    keypress: function(e){
      if(e.which == 13 && $(this).attr("preventEnter") != undefined){
        e.preventDefault();
      }
    }
});
})();

$(document).ready(function () {

    // $('.content').css("min-height", $('.sidebar-left').height() );

     $('.filter-drop').click(function(){
     
        var ishow = $(this).attr('ishow');

        if( ishow == 0 ){
            $('.filter-box-options').fadeIn();
            $('.filter-drop').attr('ishow', 1);
        }
        else{
            $('.filter-box-options').fadeOut();
            $('.filter-drop').attr('ishow', 0);
        }

         return false;
    });

    $('.sl-plus').click(function(){
        var student_limit = $('.student_limit').val();
        $('.student_limit').val( +student_limit + +1 );

    });

    $('.sl-minus').click(function(){
        
        var student_limit = $('.student_limit').val();

        if( student_limit > 1 ){
            $('.student_limit').val( +student_limit - +1 );
        }

    });



    $('.datepicker').datepicker();


    $("#datepicker_href").datepicker({
        dateFormat: 'dd/mm/yy'}).on("changeDate", function (e) {
        // alert(e);
        // console.log(e);
        window.location.replace(baseurl+'bookedsessions/?s='+e.date);

    });

        




    $('[data-toggle="tooltip"]').tooltip();


    $('.readmorebtn').click(function(){

        var par = $(this).attr('par');

        if($('#' + par).css('display') == 'none'){
          $('#' + par).show();
          // $('#' + par + 'dots').hide();
          $(this).html('Read less');
        }
        else{
          $('#' + par).hide();
          // $('#' + par + 'dots').show();
          $(this).html('Read more');
        }

        return false;

    });

     $('.btn-gojs').click(function(){

        var btnurl = $(this).attr('btnurl');
        window.location.href = btnurl;

    });


    /************* Start Navbar JS *********** */

    if ($(window).width() > 1024) {
        $('.sidebar-left').toggleClass('left-active');
        $('.content').toggleClass('full-width');
        $('.profile-container').toggleClass('right-active');
        
        // $('#notifications').mouseup(function () { 
        //   $('.profile-avatar-drop').hide();
        //     $('.notification-drop').slideToggle();
        // });

        // $('#profile-avatar').mouseup(function () { 
        //    $('.notification-drop').hide();
        //     $('.profile-avatar-drop').slideToggle();
        // });
        // $('#navbarAvatarButton2').on('click', function () {
        //     // $('.navbar-profile-list').slideToggle();
        //     $('.notification-drop').hide();
        //     $('.profile-avatar-drop').slideToggle();
        // });

        // $('#navbarNotificationButton2').on('click', function () {
        //     // $('.navbar-profile-list').slideToggle();

        //     $('.profile-avatar-drop').hide();
        //     $('.notification-drop').slideToggle();
        // });
     }


    $('#sidebarCollapseLeft').on('click', function () {
        $('.sidebar-left').toggleClass('left-active');
        $('.content').toggleClass('full-width');
        $(this).toggleClass('button-right-loop');
        // $('.sidebar-left').hide("slide", { direction: "left" }, 300);
    });

    $('#hideRightSidebar').on('click', function () {
        $('.profile-container').toggleClass('right-active');
        $(this).toggleClass('button-left-loop');
        $('.block').toggleClass('full-width');
        $(this).toggleClass('right-zero');
        // $('.sidebar-left').hide("slide", { direction: "left" }, 300);
    });

    $('.navbarAvatarButton').on('click', function () {
        // $('.navbar-profile-list').slideToggle();
        $('.notification-drop').hide();
        $('.profile-avatar-drop').slideToggle();
    });

    $('.navbarNotificationButton').on('click', function () {
        // $('.navbar-profile-list').slideToggle();
        $('.profile-avatar-drop').hide();
        $('.notification-drop').slideToggle();

        $.ajax({
            url: baseurl+"dashboard/readnotifications",
            type:'POST',
            dataType: 'json',
            data: {},
            success: function(response){
                
                // $.each(response, function (i, notif) {
                    
                //     $('#notif-' + notif.notification_id ).removeClass('notif-new');
               
                // });

                $('.notif-bubble-count').addClass('notif-bubble');
                $('.notif-bubble-count').removeClass('notif-bubble-count');

                
            }
        }); 

        return false;

    });

    $('.clearnotificationajax').on('click', function () {
        // $('.navbar-profile-list').slideToggle();
        // $('.profile-avatar-drop').hide();
        // $('.notification-drop').slideToggle();

        $.ajax({
            url: baseurl+"dashboard/clearnotifications",
            type:'POST',
            dataType: 'json',
            data: {},
            success: function(response){
                
                 $.each(response, function (i, notif) {
                    
                    $('#class-notif-' + notif.notification_id ).hide();
               
                });

                $('.no-new-notifications').hide();
                // $('.view-all-notif').hide();
                $('.view-all-notif').before('<li class="no-new-notifications text-center"><span><i>No new notifications</i></span></li>');
                
            }
        }); 

        return false;

    });

    var notifp = 5;
    $('.view-all-notif').on('click', function () {

        $.ajax({
            url: baseurl+"dashboard/morenotifications",
            type:'POST',
            dataType: 'json',
            data: { next: notifp },
            success: function(response){
                
                $('.view-all-notif').before(response);

                if( response != '' ){
                    $('.no-new-notifications').hide();
                }
                
                notifp = notifp + 6;
            }
        }); 

        return false;

    });

    /************* End Navbar JS *********** */
    /*====================================================*/
    /************* Start Tabs JS *********** */

        jQuery.fn.lightTabs = function(options){
            
            var createTabs = function(){
                block = this;
                i = 0;
                
                showPage = function(i){
                    $(block).children("div").children("div").hide();
                    $(block).children("div").children("div").eq(i).show();
                    $(block).children("ul").children("li").removeClass("active");
                    $(block).children("ul").children("li").eq(i).addClass("active");
                }
                
                showPage(0);				
                
                $(block).children("ul").children("li").each(function(index, element){
                    $(element).attr("data-page", i);
                    i++;                        
                });
                
                $(block).children("ul").children("li").click(function(){
                    showPage(parseInt($(this).attr("data-page")));
                });				
            };		
            return this.each(createTabs);
        };	
        $(".block").lightTabs();
        
        /*********************************************************************** */
        
        jQuery.fn.rightLightTabs = function(options){
            
            var rightCreateTabs = function(){
                profile_container = this;
                x = 0;
                
                rightShowPage = function(i){
                    $(profile_container).children("div").hide();
                    $(profile_container).children("div").eq(i).show();
                    $(profile_container).children("section").children("ul.profile-tab").children("li").removeClass("active");
                    $(profile_container).children("section").children("ul.profile-tab").children("li").eq(i).addClass("active");
                }
                
                rightShowPage(0);				
                
                $(profile_container).children("section").children("ul.profile-tab").each(function(index, element){
                    $(element).attr("data-page-right", x);
                    x++;                        
                });
                
                $(profile_container).children("section").children("ul.profile-tab").click(function(){
                    rightShowPage(parseInt($(this).attr("data-page-right")));
                });				
            };		
            return this.each(rightCreateTabs);
        };	
        $(".sub-prof-box").rightLightTabs();


        jQuery.fn.rightLightTabs2 = function(options){
            
            var rightCreateTabs2 = function(){
                profile_container2 = this;
                x = 0;
                
                rightShowPage2 = function(i){
                    $(profile_container2).children("div").hide();
                    $(profile_container2).children("div").eq(i).show();
                    $(profile_container2).children("section").children("ul.profile-tab2").children("li").removeClass("active");
                    $(profile_container2).children("section").children("ul.profile-tab2").children("li").eq(i).addClass("active");
                }
                
                rightShowPage2(0);       
                
                $(profile_container2).children("section").children("ul.profile-tab2").each(function(index, element){
                    $(element).attr("data-page-right", x);
                    x++;                        
                });
                
                $(profile_container2).children("section").children("ul.profile-tab2").click(function(){
                    rightShowPage2(parseInt($(this).attr("data-page-right")));
                });       
            };    
            return this.each(rightCreateTabs2);
        };  
        $(".profile-container2").rightLightTabs2();


        // Links Add Active Class
        $('body').on('click', 'ul.profile-tab', function() {
            $('ul.profile-tab.active').removeClass('active');
            $(this).addClass('active');
        });

         // Links Add Active Class
        $('body').on('click', 'ul.profile-tab2', function() {
            $('ul.profile-tab2.active').removeClass('active');
            $(this).addClass('active');
        });

        $(function() {
            $('#myTextArea').on('keyup paste', function() {
              var $el = $(this),
                  offset = $el.innerHeight() - $el.height();
          
              if ($el.innerHeight() < this.scrollHeight) {
                // Grow the field if scroll height is smaller
                $el.height(this.scrollHeight - offset);
              } else {
                // Shrink the field and then re-set it to the scroll height in case it needs to shrink
                $el.height(1);
                $el.height(this.scrollHeight - offset);
              }
            });
          });
        
    /************* End Tabs JS *********** */


    $('.profilebrowse').change(function(e) {

        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

            var file = e.originalEvent.srcElement.files[i];

            // var img = document.createElement("img");
            var reader = new FileReader();
            reader.onloadend = function() {
                 // img.src = reader.result;
                 $('.profileimage').attr('src', reader.result);
            }
            reader.readAsDataURL(file);
            // $("input").after(img);
        }
    });

    $('.fileattachment').change(function(e) {

        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

            var file = e.originalEvent.srcElement.files[i];
            
            // alert(file.size);

            // console.log(filex);
            if( file.size <= 50000000 ){
                // var img = document.createElement("img");
                var reader = new FileReader();
                reader.onload = function(readerEvt) {


                    var currentTimestamp = new Date().getTime();
                    catchmntfile = userid+currentTimestamp + '_' + file.name;
                    // catchmntfile = file.name;
                    catchmntdata = reader.result;
                    attachfile = file;
                    
                    $('.chatbox-attachment').html( '<i class="fas fa-file"></i> ' + file.name + ' <i class="fa fa-remove removeattachment"></i>' );
                    $('.writechatmessage').focus();
                    // alert(3);
                }
                reader.readAsDataURL(file, 'UTF-8');
                // $("input").after(img);
            }
            else{
                catchmntfile = '';
                catchmntdata = '';
                attachfile = '';

                $('.chatbox-attachment').html( '<i style="color:red;">File should not be more than 50 MB</i>' );
                $('.writechatmessage').focus();
            }
        }
    });

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    $(document).on("click", ".removeattachment", function (event) {

        catchmntfile = '';
        catchmntdata = '';

        $('.chatbox-attachment').html( '&nbsp;' );
        $('.writechatmessage').focus();

    });

    // $('.showpass').click(function(){
    $(document).on("click", ".showpass", function (event) {

        var currtype = $( '.' + $(this).attr('passfield') ).attr('type');



        if( currtype == 'text' ){
            $( '.' + $(this).attr('passfield') ).attr('type','password');
            $(this).html('<i class="fa fa-eye-slash"></i>');
        }
        else{
            $( '.' + $(this).attr('passfield') ).attr('type','text');
            $(this).html('<i class="fa fa-eye"></i>');
        }

    });


    // $('.btn-load').click(function(){

    //     // var loadertxt = $(this).attr('loader');
    //     // $(this).html('sadasdasd');

    //     var btn = $(this);
    //     var resettxt = btn.html();
    //     btn.prop("disabled",true);
    //     btn.val(btn.html( btn.attr('data-loading-text') )); 

    //     setTimeout(function() {
    //         btn.html( resettxt );
    //         btn.prop("disabled",false);
    //     }, 10000);

    //     return true;

    // });

    $(document).on("click", ".viewapplicationajax", function () {
         
        var mentor_id = $(this).attr("mentor_id");
        var mentor_status = $(this).attr("mentor_status");

        $('.ma_goals_activities').prop("checked", false);
        $('.ma_1_on_1_tasks').prop("checked", false);
        $('.ma_sample_projects').prop("checked", false);
        $('.ma_hands_on_support').prop("checked", false);

        $.ajax({
            url: baseurl+"mentorapplication/get_mentor_details",
            type:'POST',
            dataType: 'json',
            data: { mentor_id: mentor_id, mentor_status: mentor_status },
            success: function(response){
                
                
                $('.ma_certified').val( response[0]['certified'] );
                $('.ma_acc_provider').val( response[0]['accreditation_provider'] );

                if(response[0]['certificate_file']!=''){
                    $('.ma_certificate').html('<a href="'+baseurl+'avatar/'+response[0]['certificate_file']+'" style="font-size: 14px;">'+response[0]['certificate_file']+'</a>');
                }
                else{
                    $('.ma_certificate').html('<i>No certificate</i>');
                }
                
                
                $('.ma_fullname_header').html( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                $('.ma_date_applied').html( response[0]['date_applied_format'] );
                $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response[0]['ma_profile_picture'] );

                $('.ma_fullname').val( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                $('.ma_email').val( response[0]['email'] );
                // $('.ma_jobtitle').val( response[0]['job_title'] );
                $('.ma_company').val( response[0]['company'] );
                $('.ma_location').val( response[0]['location'] );
                // $('.ma_highest_education_level').val( response[0]['highest_education_level'] );
                $('.ma_category').val( response[0]['category'] );
                // $('.ma_tags').val( response[0]['tags'] );
                $('.ma_weekly_price').val( response[0]['weekly_price'] );
                $('.ma_student_limit').val( response[0]['student_limit'] );
                $('.ma_bio').val( response[0]['bio'] );
                $('.ma_video_url').val( response[0]['video_url'] );
                $('.ma_phone_number').val( response[0]['phone_number'] );
                

                $('.ma_country_code').val( response[0]['country_code'] );
                $('.ma_coaching_exp').val( response[0]['coaching_exp'] );
                $('.ma_become_q1').val( response[0]['become_q1'] );
                $('.ma_become_q2').val( response[0]['become_q2'] );
                $('.ma_become_q3').val( response[0]['become_q3'] );
                $('.ma_become_q4').val( response[0]['become_q4'] );
                $('.ma_become_q5').val( response[0]['become_q5'] );
                $('.ma_become_q6').val( response[0]['become_q6'] );
                $('.ma_become_q7').val( response[0]['become_q7'] );
                $('.ma_become_q8').val( response[0]['become_q8'] );
                // $('.ma_become_q9').val( response[0]['become_q9'] );
                // $('.ma_become_q10').val( response[0]['become_q10'] );
                
            }
        }); 

 
        $('#viewapplicationModal').modal();
        return false;
    });

    $(document).on("click", ".viewenquiriesajax", function () {
         
        var enquiries_id = $(this).attr("enquiries_id");

        $.ajax({
            url: baseurl+"enquiries/get_enquiries",
            type:'POST',
            dataType: 'json',
            data: { enquiries_id: enquiries_id },
            success: function(response){
                
                $('.en_full_name').val(response[0]['full_name']);
                $('.en_email').val(response[0]['full_name']);
                $('.en_phone_number').val(response[0]['phone_number']);
                $('.en_seeking').val(response[0]['seeking']);
                $('.en_challengers').val(response[0]['challengers']);
                $('.en_achieve').val(response[0]['achieve']);
                $('.en_worked_before').val(response[0]['worked_before']);
                $('.en_coaching_format').val(response[0]['coaching_format']);
                $('.en_anything_else').val(response[0]['anything_else']);
                
            }
        }); 

 
        $('#viewenquiriesModal').modal();
        return false;
    });

    $(document).on("click", ".viewquizresultsajax", function () {
         
        var course_id = $(this).attr("course_id");
        var student_id = $(this).attr("user_id");
        
        $.ajax({
            url: baseurl+"studentcourses/getquizresults",
            type:'POST',
            dataType: 'json',
            data: { course_id:course_id,student_id:student_id, viewquizresultsajax:1 },
            success: function(response){
                
                $('.quiz-results-body').html(response);
                
            }
        }); 

 
        $('#viewquizModal').modal();
        return false;
    });

    $(document).on("click", ".viewcareerajax", function () {
         
        var mentee_id = $(this).attr("mentee_id");

        $(this).html('Viewing Career Profile..');

        $('.open_to_relocate').prop("checked", false);
        $('.working_remotely').prop("checked", false);
        $('.short_term').prop("checked", false);

        $.ajax({
            url: baseurl+"menteecareercenter/get_mentee_details",
            type:'POST',
            dataType: 'json',
            data: { mentee_id: mentee_id },
            success: function(response){
                
                $('.mcc_fullname_header').html( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                $('.mcc_date_applied').html( response[0]['date_applied_format'] );
                $('.mcc_profile_picture').attr("src", baseurl+'avatar/'+response[0]['ma_profile_picture'] );

                $('.mcc_search_status').val( response[0]['search_status'] ).trigger('change');
                $('.mcc_job_level').val( response[0]['job_level'] ).trigger('change');
                $('.mcc_job_title').val( response[0]['job_title'] ).trigger('change');
                $('.mcc_location').val( response[0]['country_name'] ).trigger('change');
                $('.mcc_city').val( response[0]['city_name'] ).trigger('change');

                $('.mcc_bio').val( response[0]['bio'] );
                $('.mcc_skill_set').val( response[0]['skill_set'] );
                $('.mcc_twitter_handle').val( response[0]['twitter_handle'] );
                $('.mcc_linkedin_url').val( response[0]['linkedin_url'] );
                $('.mcc_github_url').val( response[0]['github_url'] );

                $('.mcc_resume').html( response[0]['resume'] );
                $('.mcc_resume').attr('href', baseurl + 'data/mentee/' + response[0]['resume'] );
                $('.mcc_video').html( response[0]['video'] );
                $('.mcc_video').attr('href', baseurl + 'data/mentee/' + response[0]['video'] );
                
                if( response[0]['open_to_relocate'] == 'on' ){
                    $('.mcc_open_to_relocate').prop("checked", true);
                }

                if( response[0]['working_remotely'] == 'on' ){
                    $('.mcc_working_remotely').prop("checked", true);
                }

                if( response[0]['short_term'] == 'on' ){
                    $('.mcc_short_term').prop("checked", true);
                }

                $('.viewcareerajax').html('View Career Profile');
                $('#viewcareerprofileModal').modal();
            }
        }); 

        return false;
    });

    $(document).on("click", ".viewmenteeapplicationajax", function () {
         
        var applicationid = $(this).attr("applicationid");
        var foruser = $(this).attr("foruser");
        var norename = $(this).attr("norename");

        if( norename == 0 ){
            $(this).html('<i class="fas fa-eye"></i>&nbsp; Viewing Application..');
        }

        $('.ma_goals_activities').prop("checked", false);
        $('.ma_1_on_1_tasks').prop("checked", false);
        $('.ma_sample_projects').prop("checked", false);
        $('.ma_hands_on_support').prop("checked", false);

        $.ajax({
            url: baseurl+"management/get_mentee_application_details",
            type:'POST',
            dataType: 'json',
            data: { application_id: applicationid, foruser: foruser },
            success: function(response){
                
                $('.ma_fullname_header').html( response[0]['first_name'] + ' ' + response[0]['last_name'] );

                $('.ma_fullname').val( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                $('.ma_email').val( response[0]['email'] );
                $('.ma_phone_number').val( response[0]['phone_number'] );
                $('.ma_category').val( response[0]['category_name'] );
                
                $('.ma_date_applied').html( response[0]['date_applied_format'] );
                $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response[0]['ma_profile_picture'] );

                $('.ma_bio').val( response[0]['bio_from_apply'] );
                // $('.ma_get_from_mentor').val( response[0]['get_from_mentor'] );
                $('.ma_question_for_mentor').val( response[0]['question_for_mentor'] );
                $('.ma_talk_to_mentor').val( response[0]['talk_to_mentor'] );
                $('.ma_describe_your_situation').val( response[0]['describe_your_situation'] );
                $('.ma_goal_to_reach').val( response[0]['goal_to_reach'] );
                $('.ma_when_to_reach').val( response[0]['when_to_reach'] );
                $('.ma_review_video').attr( 'href', response[0]['video'] );
                
                if( norename == 0 ){
                    $('.viewmenteeapplicationajax').html('<i class="fas fa-eye"></i>&nbsp; View Application');
                }
                
                $('#viewmenteeapplicationModal').modal();
                
            }
        }); 


        return false;
    });


    $(document).on("click", ".menteeprofileajax", function () {
         
        var applicationid = $(this).attr("applicationid");
        var foruser = $(this).attr("foruser");

        $(this).html('Viewing Profile..');

        $.ajax({
            url: baseurl+"management/get_mentee_application_details",
            type:'POST',
            dataType: 'json',
            data: { application_id: applicationid, foruser: foruser },
            success: function(response){
                
                $('.ma_fullname_header').html( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                $('.ma_date_applied').html( response[0]['date_applied_format'] );
                $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response[0]['ma_profile_picture'] );
                $('.ma_job_title').html( response[0]['job_title'] );

                $('.ma_email').html( response[0]['email'] );
                $('.ma_company').html( response[0]['company'] );
                $('.ma_highest_education_level').html( response[0]['highest_education_level'] );
                $('.ma_location').html( response[0]['country_name'] );

                $('.ma_start_date').html( response[0]['date_approved_format'] );
                $('.ma_end_date').html( response[0]['date_expired_format'] );
                
                
                
                $('.menteeprofileajax').html('View Profile');
                $('#menteeprofileModal').modal();
                
            }
        }); 


        return false;
    });

    var chatstart = 0;
    var chatlimit = 12;

    var currsubtype = $('.first-active-chat-box').attr('subtype');
    var isfromcommunications = 0;
    var to_comm_id = 0;

    if( hc == 1 ){
        $('.writechatmessage').focus();
        var $textarea = $('.chat-messages-contents');

        if( $textarea.length > 0 ){
            $textarea.scrollTop($textarea[0].scrollHeight);
        }   

        $(document).on("click", ".chatmessageajax", function () {
         
            var remdup = 1;
            var applicationid = $(this).attr("applicationid");
            var mentorapplicationid = $(this).attr("mentor_application_id");
            var foruser = $(this).attr("foruser");
            var chatappid = $('.chatappid').val();

            $('.currmentorapplicationid').val(mentorapplicationid);
            
            
            if ($(this).attr('comminications') != undefined){
                isfromcommunications = 1;
                mentorapplicationid = 0;
                to_comm_id = $(this).attr('mentor_id');
                $('.tochatmessage').val( $(this).attr('mentee_id') );
                $('.fromchatmessage').val( $(this).attr('mentor_id') );
            }

            var subtypeval = 'prementorship';
            if( applicationid==0 ){
                subtypeval = '';
                currsubtype = '';
            }

            var from_id = 0;
            if( foruser == 'mentee' ){
                var from_id = $(this).attr("mentor_id");
            }
            else if( foruser == 'mentor' ){
                var from_id = $(this).attr("mentee_id");
            }


            $('.tochatmessage').val(from_id);
            $('.currdashtochat').val(from_id);
            $('#chatmessageModal').modal({backdrop: 'static', keyboard: false});
            $('.chat-messages-contents').html('');
            $('.chatappid').val(applicationid);

            if ($(this).attr('comminications') == undefined){
                $.ajax({
                    url: baseurl+"management/get_mentee_application_details",
                    type:'POST',
                    dataType: 'json',
                    data: { application_id: mentorapplicationid, foruser: foruser },
                    success: function(response){
                        
                        $('.ma_fullname_header').html( response[0]['first_name'] + ' ' + response[0]['last_name'] );
                        $('.ma_date_applied').html( response[0]['date_applied_format'] );
                        $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response[0]['ma_profile_picture'] );

                    }
                }); 
            }

            $('.ma_fullname_header').html('');
            if ($(this).attr('mentee_name') != undefined){
                $('.ma_fullname_header').html( $(this).attr('mentee_name'));
            }


            $("#chatmessageModal").on('shown.bs.modal', function(){

                if( remdup == 1 ){

                    $.ajax({
                        url: baseurl+"chat/?x=chatmessageajax",
                        type:'POST',
                        dataType: 'json',
                        data: { from_id: from_id, chatappid: applicationid, action: 'getchat', popupchat: 1, subtype: subtypeval, isfromcommunications: 1, to_comm_id: to_comm_id, chatstart: chatstart, chatlimit: chatlimit, mentor_application_id: mentorapplicationid},
                        success: function(response){

                            $('.currdashtochat').val(from_id);

                            $('.chat-messages-contents').append( response['conversations'] );

                            // if( $('.chat-messages-contents').length > 0 ){
                            //     $('.chat-messages-contents').scrollTop($('.chat-messages-contents')[0].scrollHeight);
                            // }

                            var scr = $('.chat-messages-contents')[0].scrollHeight;
                            $('.chat-messages-contents').animate({scrollTop: scr},500);
                           
                        }
                    }); 

                    $('.writechatmessage').focus();

                    remdup++;
                }
            });

            return false;

        });
    }


    $(document).on("change", ".locationajax", function () {

        var country_id = $(this).val();

        $('.citiescmb option').remove();
        // $('.citiescmb').val(null).trigger('change');

        $('.citiescmb').append($('<option>', { 
            value: 'Loading cities..',
            text : 'Loading cities..'
        }));

        $('.citiescmb').val('Loading cities..').trigger('change');

        $.ajax({
            url: baseurl+"profile/get_country_cities",
            type:'POST',
            dataType: 'json',
            data: { country_id: country_id },
            success: function(response){

                $('.citiescmb').append($('<option>', { 
                    value: '',
                    text : '-- City --'
                }));

                $.each(response, function (i, item) {
                    $('.citiescmb').append($('<option>', { 
                        value: item.id,
                        text : item.name 
                    }));
                });

                $(".citiescmb option[value='Loading cities..']").remove();
                $('.citiescmb').trigger('change');
                // $(".citiescmb").val($(".citiescmb option[value=''").val()).trigger('change');
                $('.citiescmb').select2("val", "");

                // $('.citiescmb').val('').trigger('change');
                // $('.citiescmb').val('').trigger('change');
                
            }
        }); 

        return false;

    });

     $(document).on("click", ".showmodal", function () {

        var modalname = $(this).attr('modalname');

        $('#'+modalname).modal();
        return false;

    });

    $(document).on("click", ".medeletememmodal", function () {

        var mentor_id = $(this).attr('mentor_id');
        var studentcourses = $(this).attr('studentcourses');
        
        var studentcoursesparam = '';
        if( studentcourses == 1 ){
            studentcoursesparam = '&studentcourses=1';    
        }

        $('.me-dmem-btn').attr('href', baseurl + 'userlist?dm=1&mid=' + mentor_id + studentcoursesparam );

        $('#deletemembershipModal').modal();
        return false;

    });
    
    $(document).on("click", ".removecoursemodal", function () {

        var r_student_id = $(this).attr('student_id');
        var r_course_id = $(this).attr('course_id');

        $('.me-remc-btn').attr('href', baseurl + 'studentcourses?rc=1&mid=' + r_student_id + '&course_id=' + r_course_id );

        $('#removefromcourseModal').modal();
        return false;

    });

    $(document).on("click", ".addtocoursemodal", function () {

        var atc_user_id = $(this).attr('atc_user_id');
        var studentcourses = $(this).attr('studentcourses');
        
         var studentcoursesparam = '';
        if( studentcourses == 1 ){
            studentcoursesparam = '&studentcourses=1';    
        }

        $('.atc-btn').attr('href', baseurl + 'userlist?atc=1&uid=' + atc_user_id + studentcoursesparam );
        $('.addcourse-select').prop('selectedIndex', 0);

        $('#addtocourseModal').modal();
        return false;

    });

    $(document).on("change", ".addcourse-select", function () {

        var atc_course_id = $(this).val();
        
        $('.atc-btn').attr('href', $('.atc-btn').attr('href') + '&courseid='+atc_course_id );

        // $('#addtocourseModal').modal();
        return false;

    });

    

     $(document).on("click", ".mecancelmemmodal", function () {

        var mentor_id = $(this).attr('mentor_id');

        $('.me-cmem-btn').attr('href', baseurl + 'userlist?ap=2&mid=' + mentor_id );

        $('#cancelmembershipModal').modal();
        return false;

    });

    $(document).on("click", ".sendremindermodal", function () {

        var mentor_id = $(this).attr('mentor_id');

        $('.me-sendnotif-btn').attr('href', baseurl + 'userlist?sr=sendreminder&mid=' + mentor_id );

        $('#sendreminderModal').modal();
        return false;

    });

    $(document).on("click", ".sendremindermodalcom", function () {

        var mentor_id = $(this).attr('mentor_id');

        $('.me-sendnotif-btn').attr('href', baseurl + 'communications?sr=sendreminder&mid=' + mentor_id );

        $('#sendreminderModal').modal();
        return false;

    });

    $(document).on("click", ".mecancelsession", function () {

        var mentor_session_id = $(this).attr('mentor_session_id');

        $('.me-cancelsession-btn').attr('href', baseurl + 'mentorsandsessions?mseshid=' + mentor_session_id );

        $('#cancelsessionModal').modal();
        return false;

    });


    $(document).on("click", ".meapprovemodal", function () {

        var href = $(this).attr('href');

        $('.me-ap-btn').attr('href', href );

        $('#approveModal').modal();
        return false;

    });

    var subhtmldef = $('.subscription-html-content').html();
    $(document).on("click", ".sendpaymentmodal", function () {

        var menteeidlink = $(this).attr('mentee_id');
        
        $('.subscription-html-content').html( subhtmldef.replaceAll('[menteeid]', menteeidlink) );

        $('#paymentmodal').modal();
        return false;

    });

    $(document).on("click", ".meunapprovemodal", function () {

        var href = $(this).attr('href');

        $('.me-ap-btn').attr('href', href );

        $('#unapproveModal').modal();
        return false;

    });

    $(document).on("click", ".merejectmodal", function () {

        var href = $(this).attr('href');

        $('.me-re-btn').attr('href', href );

        $('#rejectModal').modal();
        return false;

    });

    $(document).on("click", ".meeditmodal", function () {

        var review_id = $(this).attr('review_id');

        $('.review_id').val(review_id);

        $.ajax({
            url: baseurl+"userlist/getreview",
            type:'POST',
            dataType: 'json',
            data: { review_id: review_id },
            success: function(response){
                
                $('.review_name').val(response[0]['name']);
                $('.review_rating').val(response[0]['rating']);
                $('.review_review').val(response[0]['review']);
                $('.review_mentor_id').val(response[0]['mentor_id']);

                $('#editModal').modal();        
                
            }
        }); 

        return false;

    });

    $(document).on("click", ".viewsessionapplicationajax", function () {

        
        var mentor_session_id = $(this).attr("mentor_session_id");
        var session_id = $(this).attr("session_id");
        var mentor_id = $(this).attr("mentor_id");
        var date_applied = $(this).attr("date_applied");

        $(this).html('<i class="fas fa-eye"></i>&nbsp;  Loading Session..');

        $.ajax({
            url: baseurl+"adminsessions/get_session_details",
            type:'POST',
            dataType: 'json',
            data: { mentor_session_id: mentor_session_id },
            success: function(response){
                
                $('.ss_session_title').html( "Session '" + response[0]['session_name'] + "' Submission Form" );
                
                $('.session-name').val(response[0]['session_name']);

                
                if( response[0]['spot'] != null ){
                    $('.student_limit').val(response[0]['spot']);    
                }

                if( response[0]['time_type'] != null ){
                    $('.time-type').val(response[0]['time_type']);
                }

                if( response[0]['profile_picture'] !== null ){
                    $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response[0]['profile_picture'] );    
                }
                else{
                    $('.ma_profile_picture').attr("src", baseurl+'img/no-avatar.png' );       
                }

                $('.ms_fullname_header').html(response[0]['first_name']+' '+response[0]['last_name']);
                $('.ms_date_applied').html(date_applied);

                
                $('.aproximate-time').val(response[0]['aproximate_time']);
                $('.session-rate').val(response[0]['amount']);
                $('.session-message').val(response[0]['ms_message']);
                $('.session-description').val(response[0]['ms_description']);

                $('.session-id').val(response[0]['sessionid']);
                $('.mentor-session-id').val(response[0]['mentor_session_id']);

                $('.viewsessionapplicationajax').html('<i class="fas fa-eye"></i>&nbsp; View Session');
                $('#viewsessionapplicationModal').modal();
            }
        }); 

        return false;
    });

    
    $(document).on("click", ".setupsessionajax", function () {

        var session_id = $(this).attr("session_id");
        var session_name = $(this).attr("session_name");
        var session_rate = $(this).attr("session_rate");

        $(this).html('Loading Setup..');


        $.ajax({
            url: baseurl+"mentorsessions/get_session_details",
            type:'POST',
            dataType: 'json',
            data: { session_id: session_id, session_name: session_name, mentorsessionsetup: 1 },
            success: function(response){
                
                $('.ss_session_title').html( "Session '" + session_name + "' Submission Form" );
                
                $('.session-name').val(session_name);

                
                if( response[0]['spot'] != null ){
                    $('.student_limit').val(response[0]['spot']);    
                }

                if( response[0]['time_type'] != null ){
                    $('.time-type').val(response[0]['time_type']);
                }
                
                $('.aproximate-time').val(response[0]['aproximate_time']);
                $('.session-rate').val(session_rate);
                $('.session-message').val(response[0]['ms_message']);
                $('.session-description').val(response[0]['ms_description']);

                $('.session-id').val(session_id);
                $('.mentor-session-id').val(response[0]['mentor_session_id']);

                $('.setupsessionajax').html('Setup');
                $('#sessionsetupModal').modal();
            }
        }); 

        return false;
    });


    $(document).on("click", ".search-date-type-btn", function () {
        $('.search_date_type').val( $(this).html() );
    });


    var catchmntfile = '';
    var catchmntdata = '';
    var attachfile = '';

    var hsbscptn = 0;

    if( hc == 1){

        chatheartbeat('heartbeat');

        $(document).on("click", ".getchat", function () {
            
            var fromid = $(this).attr('fromid');
            var chatid = $(this).attr('chatid');
            var caseno = $(this).attr('caseno');
            var typeofchat = $(this).attr('typeofchat');
            var subtype = $(this).attr('subtype');
            var chatbookingid = $(this).attr('booking_id');
            currsubtype = subtype;

            if( typeofchat == 0 ){
                caseno = 0;
            }

            
            $('.getchat').removeClass('msgselected');
            $('.getchat').removeClass('hasnewbold');
            $('.viewprofileModalbtn').attr('user_id', fromid);
            $('.createactivityajax').attr('fromid', fromid);
            $('.createchallengeajax').attr('fromid', fromid);
            $('.fromcaseno').val(caseno);
            $('.chatbookingid').val(chatbookingid);

            if(fromid == 0){
                $('.a-chat-name-0').removeClass('btn-primary');
                $('.a-chat-name-0').removeClass('cm-btn-maroon');
                $('.a-chat-name-0').addClass('cm-btn-gray');
            }
            else{
                $('.a-chat-name-0').removeClass('btn-primary');
                $('.a-chat-name-0').addClass('cm-btn-gray');
            }

            $(this).addClass('msgselected');


            loadgetchat(fromid,caseno,subtype,chatid);

            return false;

        });


        $(document).on("click", ".sendchatmessage", function () {

            var toid = $('.tochatmessage').val();
            var fromid = $('.fromchatmessage').val();
            var writechatmessage = $('.writechatmessage').val();
            $('.writechatmessage').val('');
            var chatappid = $('.chatappid').val();
            // var $textarea = $('.chat-messages-contents');

            if( catchmntfile != '' ){

                $('.chatbox-attachment').append( '&nbsp; Uploading <img src="'+baseurl+'img/loader.gif"/>' );

             
                $.ajax({
                    url: baseurl+"dashboard/fileupload?x=1",
                    type:'POST',
                    dataType: 'json',
                    data: { name: catchmntfile, chatappid: chatappid, data: catchmntdata },
                    success: function(response){
                        $('.writechatmessage').append( response['serverFile'] );
                        $('.chatbox-attachment').html('&nbsp;');

                        if( writechatmessage != '' ){
                            //writechatmessage = writechatmessage + '<br/><img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">';

                            sendchatajax(fromid,toid,writechatmessage,chatappid);

                            if( response['filetype'] == 'image' ){
                                sendchatajax(fromid,toid,'<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '"><br/><div class="attachmentdlbtn"><a href="' + baseurl +'downloadattachment/' + response['serverFile'] + '"><i class="fa fa-download"></i></a></div>',chatappid);
                            }
                            else{
                                sendchatajax(fromid,toid,'<a href="' + baseurl +'data/attachment/' + response['serverFile'] + '">' + response['serverFile'] + '</a>',chatappid);
                            }

                        }
                        else{
                            //writechatmessage = writechatmessage + '<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">';

                            if( response['filetype'] == 'image' ){
                                sendchatajax(fromid,toid,'<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '"><br/><div class="attachmentdlbtn"><a href="' + baseurl +'downloadattachment/' + response['serverFile'] + '"><i class="fa fa-download"></i></a></div>',chatappid);
                            }
                            else{
                                sendchatajax(fromid,toid,'<a href="' + baseurl +'data/attachment/' + response['serverFile'] + '">' + response['serverFile'] + '</a>',chatappid);
                            }
                        }
                    }
                });
            }
            else{
                sendchatajax(fromid,toid,writechatmessage,chatappid);
            }

            return false;

        });

        function sendchatajax(fromid,toid,chatmessage,chatappid)
        {
            var sendcaseno = $('.fromcaseno').val();
            var chatbookingid = $('.chatbookingid').val();

            if( currsubtype == 'prementorship' ){
                sendcaseno = 0;
            }

            $.ajax({
                url: baseurl+"chat/send",
                type:'POST',
                dataType: 'json',
                data: { from_id: fromid, to_id: toid, message: chatmessage, chatappid: chatappid, caseno: sendcaseno, subtype: currsubtype, chatbookingid: chatbookingid },
                success: function(response){

                    // chatheartbeat('chatsend');
                    if( userid == fromid ){
                        $('.mentee-ap-stat-'+toid).html('Responded');
                        $('.mentee-ap-stat-'+toid).css('color','#1bd499');
                    }
                    else{
                        $('.mentee-ap-stat-'+toid).html('Awaiting Response');
                        $('.mentee-ap-stat-'+toid).removeAttr('style');
                    }


                    $('.chatbox-attachment').html('&nbsp;');
                    $('.writechatmessage').focus();
                    catchmntfile = '';
                    catchmntdata = '';
                    $textarea.scrollTop($textarea[0].scrollHeight);
                    window.scrollTo(0, 0);

                }
            }); 
        }

        $(document).on("click", ".sub-btn-proceed", function (event) {

            var subpayval = 0;
            var Form = document.getElementById('sub-form-payment');
            for(I = 0; I < Form.length; I++) {
                var fieldname = Form[I].getAttribute('name');
                var fieldvalue = Form[I].value;

                // alert(fieldname + ' : ' + fieldvalue);

                if( fieldvalue == '' && fieldname !== null ){
                    $('.' + fieldname).css('border-color', 'red');
                    subpayval++;
                }
            }


            if( !$('.iagreesub').prop('checked') ){
                $('.iagreebox').css('color', 'red');
                subpayval++;
            }

            if( subpayval == 0 ){
                $('.sub-checkout-ttl').html('Billing Info');
                $('.sub-billing-info').show();
                $('.sub-payment-info').hide();
            }
            else{
                $('.sub-checkout-ttl').html('<span style="color:red;">All Fields are required.</span>');
            }

            return false;
        });

        

        $(document).on("click", ".sub-btn-place-trial", function (event) {


            var subpayval = 0;
            var Form = document.getElementById('sub-form-billing');
            for(I = 0; I < Form.length; I++) {
                var fieldname = Form[I].getAttribute('name');
                var fieldvalue = Form[I].value;

                // alert(fieldname + ' : ' + fieldvalue);

                if( fieldvalue == '' && fieldname !== null ){
                    $('.' + fieldname).css('border-color', 'red');
                    subpayval++;
                }
            }


            $('.sub-btn-place-trial').attr('disabled','disabled');
            $('.sub-btn-place-trial').html('<i class="fas fa-lock"></i> &nbsp;&nbsp;Please wait..');

            
            if( subpayval == 0 ){

                $.ajax({
                    url: baseurl+"dashboard/addsubscription",
                    type:'POST',
                    dataType: 'json',
                    data: $("#sub-form-payment, #sub-form-billing").serialize(),
                    success: function(response){

                        $('.sub-btn-place-trial').removeAttr('disabled');
                        $('.sub-btn-place-trial').html('<i class="fas fa-lock"></i> &nbsp;&nbsp;Place Subscription');

                        console.log(response);
                        // alert(response['res'][0]['stripeResponse']['id']);
                        // if( response['status'] == 1 ){
                        

                        if( !!response['res'][0] ){
                             if( response['res'][0]['stripeResponse']['status'] == 'succeeded' ){
                                $('.sub-box-head-lbl').hide();
                                $('.sub-box-main').hide();
                                $('.sub-thank-you').show();

                                $('.chat-messages-inner').removeClass('chat-messages-contents');
                                $('.chat-box-class').removeClass('chat-write-box');

                                // window.location.replace(baseurl+'dashboard');
                            }
                            else{
                                $('.sub-payment-info').show();
                                $('.sub-billing-info').hide();
                                $('.sub-checkout-ttl').html('<span style="color:red;">Card is declined. Please check your card details.</span>');
                            }
                        }   
                        else{
                            $('.sub-payment-info').show();
                            $('.sub-billing-info').hide();
                            $('.sub-checkout-ttl').html('<span style="color:red;">Card is declined. Please check your card details.</span>');
                        }

                        // if( response['isrenew'] == 1 ){
                        //     window.location.replace(baseurl+'dashboard');
                        // }
                    }
                }); 
            }
            else{
                $('.sub-checkout-ttl').html('<span style="color:red;">All Fields are required.</span>');
                $('.sub-btn-place-trial').removeAttr('disabled');
                $('.sub-btn-place-trial').html('<i class="fas fa-lock"></i> &nbsp;&nbsp;Place Subscription');
            }

            return false;
        });

        
        $(document).on("click", ".sub-btn-start-chat", function (event) {

            var fromid = $('.currdashtochat').val();

            $('.chat-messages-inner').addClass('chat-messages-contents');
            $('.chat-box-class').addClass('chat-write-box');

            loadgetchat(fromid,0);

            return false;
        });

        // $('input[type=text]').on('keydown', function(e) {
        $(document).on("keydown", ".writechatmessage", function (e) {
            if (e.which == 13) {
                e.preventDefault();

                var toid = $('.tochatmessage').val();
                var fromid = $('.fromchatmessage').val();
                var writechatmessage = $('.writechatmessage').val();
                $('.writechatmessage').val('');
                var chatappid = $('.chatappid').val();
                // var $textarea = $('.chat-messages-contents');

                if( catchmntfile != '' ){

                    $('.chatbox-attachment').append( '&nbsp; Uploading <img src="'+baseurl+'img/loader.gif"/>' );

                    $.ajax({
                        url: baseurl+"dashboard/fileupload",
                        type:'POST',
                        dataType: 'json',
                        data: { name: catchmntfile, chatappid: chatappid, data: catchmntdata },
                        success: function(response){
                            $('.writechatmessage').append( response['serverFile'] );


                            if( writechatmessage != '' ){
                                //writechatmessage = writechatmessage + '<br/><img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">';

                                sendchatajax(fromid,toid,writechatmessage,chatappid);

                                if( response['filetype'] == 'image' ){
                                    sendchatajax(fromid,toid,'<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">',chatappid);
                                }
                                else{
                                    sendchatajax(fromid,toid,'<a href="' + baseurl +'data/attachment/' + response['serverFile'] + '">' + response['serverFile'] + '</a>',chatappid);
                                }
                            }
                            else{
                                //writechatmessage = writechatmessage + '<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">';

                                if( response['filetype'] == 'image' ){
                                    sendchatajax(fromid,toid,'<img class="imageattachment" src="' + baseurl +'data/attachment/' + response['serverFile'] + '">',chatappid);
                                }
                                else{
                                    sendchatajax(fromid,toid,'<a href="' + baseurl +'data/attachment/' + response['serverFile'] + '">' + response['serverFile'] + '</a>',chatappid);
                                }
                            }

                        }
                    });
                }
                else{
                    sendchatajax(fromid,toid,writechatmessage,chatappid);
                }

                return false;
            }
        });

        function loadgetchat(fromid,caseno,subtype,chatid)
        {
            // var fromid = $(this).attr('fromid');
            var chatappid = $('.chatappid').val();

            if( $('.dash-mid-box').attr('curr') == 'chats' ){
                $('.chat-messages-contents').html('');
            }
            
            $('.chat-name').removeClass('active-chat');
            $('.tochatmessage').val(fromid);
            $('.subscription_mentor_id').val(fromid);
            $('.currdashtochat').val(fromid);
            $('.sub-sum-box').html('<div class="sub-sum-box"><div class="def-box-main" style="margin-top: 0;"></div></div>');

            $('.prf-start-date').html( '' );
            $('.prf-end-date').html( '' );

            $('.dash-tasks-box').hide();

            if( window.screen.availWidth < 1024 ){
                $('.curr-chat-messages').click();
            }

            $('.chat-id-' + chatid).addClass('active-chat');

            $('.chat-messages-contents').html('<div class="load-more-msg-btn load-prev-chat-box-12"><img src="'+baseurl+'img/loader.gif"/></div>');
            
            $.ajax({
                url: baseurl+"chat/?x=getchat",
                type:'POST',
                dataType: 'json',
                data: { from_id: fromid, chatappid: chatappid, action: 'getchat', caseno: caseno, subtype: subtype },
                success: function(response){
                    

                    console.log(response);
                    
                    // alert(response['prf_name']);

                    // if( fromid == 0 ){
                    //     // alert(fromid);
                    //     // $('.sub-prof-box').hide();
                    //     if( response['caseno'] != $('.a-chat-name-0').attr('caseno') ){
                    //         $('.chat-messages-contents').append(response['']);   
                    //     }
                    //     else{
                    //         $('.chat-messages-contents').append( response['conversations'] );
                    //     }
                    // }
                    // else{
                    //     $('.chat-messages-contents').append( response['conversations'] );
                    // }

                    

                    $('.prev-chat-msg-' + fromid).attr('style', '');
                    $('.new-chat-circle-' + fromid).attr('style','background: transparent;')
                    $('.chat-id-' + chatid).attr('newfromcid','0');

                    if( response['hassubscription'] == 0 ){
                        // if( $('.dash-mid-box').attr('curr') == 'chats' ){
                            $('.chat-messages-contents').html( response['hassubscriptionhtml'] ); 
                            $('.dash-mid-box').attr('curr','subs');
                            $('.chat-messages-contents').attr('style','height: auto;');
                            $('.chat-write-box').hide();
                        // }
                        // alert($('.dash-right-box-stat').attr('curr'));
                        // if( $('.dash-right-box-stat').attr('curr') == 'prof' ){

                        if( response['chatresponsetype'] == 'mentee' ){

                            if( response['hassubsdetailshtml'] != '' ){
                                $('.sub-sum-box').html( response['hassubsdetailshtml'] );
                                $('.dash-right-box-stat').attr('curr','sums');
                                $('.sub-prof-box').hide();
                                $('.sub-sum-box').show();
                            }

                        }
                        else if( response['chatresponsetype'] == 'mentor' ){

                            $('.prf-pp').attr('src', response['prf_pp']);
                            $('.prf-name').html( response['prf_name'] );
                            $('.prf-job-title').html( response['prf_job_title'] );
                            $('.prf-start-date').html( response['prf_start_date'] );
                            $('.prf-end-date').html( response['prf_end_date'] );   

                            $('.s_tab_prf_start_date').html( response['s_tab_prf_start_date'] );
                            $('.s_tab_prf_end_date').html( response['s_tab_prf_end_date'] );
                            
                        }
                    }
                    else{
                        // if( $('.dash-mid-box').attr('curr') == 'subs' ){
                            $('.chat-messages-contents').html( response['hassubscriptionhtml'] ); 
                            // $('.dash-mid-box').html('<div class="chat-messages"><div class="chat-messages-inner chat-messages-contents"></div></div>');   
                            $('.dash-mid-box').attr('curr','chats');
                            $('.chat-messages-contents').removeAttr('style');   
                            // $('.chat-messages-contents').css('height','445px');
                            $('.chat-write-box').show();
                        // }

                        // if( $('.dash-right-box-stat').attr('curr') == 'sums' ){
                            $('.sub-sum-box').html('');
                            $('.dash-right-box-stat').attr('curr','prof');
                            $('.sub-sum-box').hide();

                            
                        // }

                        $('.prf-pp').attr('src', response['prf_pp']);
                        $('.prf-name').html( response['prf_name'] );
                        $('.prf-job-title').html( response['prf_job_title'] );
                        $('.prf-start-date').html( response['prf_start_date'] );
                        $('.prf-end-date').html( response['prf_end_date'] );
                        $('.dash-view-m-profile').attr('href', baseurl+'mentorprofile/'+response['prf_slug']);

                        $('.mentee-sub-details').html('');
                        if( response['prf_mentorship_type'] == 'Mentorship'){
                            $('.mentee-sub-details').html('<h4>'+response['prf_mentorship_type']+'</h4><div class="start-date"><span>End Date</span><span class="prf-start-date">'+response['prf_mentorship_sub']+'</span></div>');
                        }
                        else if( response['prf_mentorship_type'] == 'Session'){
                            $('.mentee-sub-details').html('<h4>'+response['prf_mentorship_type']+'</h4><div class="start-date"><span>Duration</span><span class="prf-start-date">'+response['prf_mentorship_sub']+'</span></div>');
                        }
                        

                        $('.s_tab_prf_start_date').html( response['s_tab_prf_start_date'] );
                        $('.s_tab_prf_end_date').html( response['s_tab_prf_end_date'] );

                        $('.from-name-' + fromid).removeClass('font-weight-700');

                        if( $textarea.length > 0 ){
                            $textarea.scrollTop($textarea[0].scrollHeight);
                        }
                        
                        if( fromid == 0 ){
                            $('.sub-blank-box').show();   
                            $('.sub-prof-box').hide(); 
                        }
                        else{
                            $('.sub-blank-box').hide();   
                            $('.sub-prof-box').show(); 
                        }   
                    }

                    // alert(subtype);
                    if( subtype == 'booking' ){
                        $('.dash-side-pills').hide();
                        $('.dash-side-dates').hide();

                        $('.viewprofilebtn').hide();
                        $('.endsessionbtn').show();

                        $('.prf-pp').attr('src', response['prfb_pp']);
                        $('.prf-name').html( response['prfb_name'] );
                        $('.dash-side-chatadmin').hide();

                        $('.dash-profile-box').show();
                        $('.dash-tasks-box').hide();
                        $('.dash-settings-box').hide();
                    }
                    else{
                        $('.dash-side-pills').show();
                        $('.dash-side-dates').show();

                        $('.viewprofilebtn').show();
                        $('.endsessionbtn').hide();
                        $('.dash-side-chatadmin').hide();

                        $('.dash-profile-box').show();
                        // $('.dash-tasks-box').show();
                        // $('.dash-settings-box').show();

                        $('.profile-tab').removeClass('active');
                        $('.first-profile-tab').addClass('active');
                    }

                    if( subtype == 'contactadmin' ){
                        $('.dash-side-chatadmin').show();
                    }


                    $('.activity-list').html(response['activitieshtml']);
                    $('.challenge-list').html(response['challengeshtml']);

                    $('.endsessionModalbtn').attr('user_id', fromid);


                    // $('.writechatmessage').focus();


                    var scr = $('.chat-messages-contents')[0].scrollHeight;
                    $('.chat-messages-contents').animate({scrollTop: scr},500);
                }
            }); 



            var first_chat_id = fromid;
            var first_chat_sub_type = subtype;

            // $('.chat-name-' + first_chat_id + '-' + first_chat_sub_type).removeClass('active-chat');
            $('.new-chat-circle-' + first_chat_id + '-' + first_chat_sub_type).css('background','transparent');
            $('.prev-chat-msg-' + first_chat_id + '-' + first_chat_sub_type).attr('style','');
            $('.from-name-' + first_chat_id + '-' + first_chat_sub_type).removeClass('font-weight-700');
        }

        function chatheartbeat(s)
        {
            var fromid = $('.currdashtochat').val();
            var chatappid = $('.chatappid').val();
            var fromcaseno = $('.fromcaseno').val();
            var currchatbookingid = $('.chatbookingid').val();
            // var postsubtype = $('.first-active-chat-box').attr('subtype');

            if( currsubtype == 'prementorship' ){
                fromcaseno = 0;
            }

            $.ajax({
                url: baseurl+"chat/",
                type:'POST',
                dataType: 'json',
                data: { from_id: fromid, chatappid: chatappid, action: s, caseno: fromcaseno, postsubtype: currsubtype, isfromcommunications: isfromcommunications, to_comm_id: to_comm_id },
                success: function(response){

                    // $('.chat-messages-contents').html('');
                    // console.log(response);


                    if( response['newchats'] != '' && s == 'heartbeat' ){
                        $('.prev-chat-msg-' + response['newchatsfrom']).html(response['conversations']);
                        $('.prev-chat-msg-' + response['newchatsfrom']).attr('style', 'font-weight:500;color:#000 !important;');
                        $('.new-chat-circle-' + response['newchatsfrom']).attr('style','background: #ffa500;');
                    }

                    if( response['has_end_session'] == 1 && currchatbookingid == response['end_mentee_booking_id'] && currchatbookingid > 0 ){
                        $('.chat-messages-contents').html('<div class="message-container message-left"><div class="chat-message-end-session"><p>This session has already ended by your mentor.</p></div></div>');
                    }

                    // if( response['conversations'] != '' && userid == response['fromid'] ){
                    if( response['conversations'] != '' ){
                        
                        $('.chat-messages-contents').append( response['conversations'] );

                        if( response['new_message'] != '' ){
                            $('.prev-chat-msg-' + fromid).html(response['new_message']);
                        }

                        if( $textarea.length > 0 ){
                            $textarea.scrollTop($textarea[0].scrollHeight);
                        }
                    }


                    if( response['new_message'] != '' ){
                        $('.mentee-ap-stat-'+response['new_from_id']).html('Awaiting Response');
                        $('.mentee-ap-stat-'+response['new_from_id']).removeAttr('style');
                    }
                    else{
                        $('.mentee-ap-stat-'+response['new_from_id']).html('Responded');
                        $('.mentee-ap-stat-'+response['new_from_id']).css('color','#1bd499');
                    }   

                    if( response['new_message'] != '' && roleid == 1 ){
                        refreshmessagetable();
                    }

                    if( response['chatresponsetype'] != 'admin' ){
                        if( response['hassubscription'] == 0 ){
                            if( $('.dash-mid-box').attr('curr') == 'chats' ){
                                $('.chat-messages-contents').html( response['hassubscriptionhtml'] ); 
                                $('.dash-mid-box').attr('curr','subs');
                                $('.chat-messages-contents').attr('style','height: auto;');
                                $('.chat-write-box').hide();
                            }
                        }
                        else{
                            if( $('.dash-mid-box').attr('curr') == 'subs' ){
                                $('.chat-messages-contents').html( response['hassubscriptionhtml'] ); 
                                // $('.dash-mid-box').html('<div class="chat-messages"><div class="chat-messages-inner chat-messages-contents"></div></div>');   
                                $('.dash-mid-box').attr('curr','chats');
                                $('.chat-messages-contents').removeAttr('style');   
                                $('.chat-write-box').show();
                            }
                        }

                        if( response['applicationstatus'] == 3 ){
                            $('.chat-messages-contents').html( response['hassubscriptionhtml'] ); 
                            $('.chat-write-box').hide();
                        }

                        if( response['hassubsdetailshtml'] != '' ){
                            $('.dash-right-box').html( response['hassubsdetailshtml'] );
                        }
                    }

                    if( response['new_from_id'] > 0 ){
                        var newfromcid = $('.chat-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).attr('newfromcid');
                        // console.log(response['new_message']);
                        // if( newfromcid != response['new_from_id'] ){
                            // $('.chat-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).addClass('active-chat');
                            $('.new-chat-circle-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).css('background','#ffa500');
                            $('.prev-chat-msg-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).attr('style','font-weight:500;color:#000 !important;');
                            $('.prev-chat-msg-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).html(response['new_message']);
                            $('.from-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).addClass('font-weight-700');
                            $('.from-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).html(response['new_first_name'] + ' ' + response['new_last_name'] + '<span>' + response['new_chat_date'] + '</span>');
                            $('.chat-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).attr('newfromcid', response['new_from_id']);
                            
                            if( response['inboxfromlist'] != '' ){
                                $('.a-chat-name-' + response['new_from_id'] + '-' + response['new_from_id_subtype']).remove();
                                $('.in-box').prepend( response['inboxfromlist'] );
                            }

                        // }

                    }

                    if( response['new_from_id'] == 0 && response['new_message'] != '' ){
                        $('.a-chat-name-0').removeClass('btn-primary');
                        $('.a-chat-name-0').removeClass('btn-gray');
                        $('.a-chat-name-0').addClass('cm-btn-maroon');
                    }

                    if( s == 'chatsend' ){
                        $('.chat-messages-contents').append( response['conversations'] );
                        if( $textarea.length > 0 ){
                            $textarea.scrollTop($textarea[0].scrollHeight);
                        }
                    }

                    // $('.a-chat-name-0').attr('caseno', response['caseno']);
                    if( fromid == 0 ){
                        if( response['admin_chat_status'] == 1 ){
                            $('.chat-messages-contents').html(''); 
                            $('.chat-messages-contents').html( response['hascaseclosed'] ); 
                            $('.a-chat-name-0').attr('caseno', response['caseno']);
                            $('.fromcaseno').val(response['caseno']);
                        }
                    }

                    if( response['newnotifications'] != '' ){
                        $('.newnotifications').after( response['newnotifications'] );
                        $('.notifcount').html( '<i class="fa fa-bell-o"></i><span>' + response['newnotificationscount'] + '</span>' );
                    }

                    

                }
            }); 



            // var first_chat_id = $('.firstgetchat-0').attr('chatid');
            // var first_chat_sub_type = $('.firstgetchat-0').attr('subtype');

            // $('.chat-name-' + first_chat_id + '-' + first_chat_sub_type).removeClass('active-chat');
            // $('.new-chat-circle-' + first_chat_id + '-' + first_chat_sub_type).css('background','');
            // $('.prev-chat-msg-' + first_chat_id + '-' + first_chat_sub_type).attr('style','');
            // $('.prev-chat-msg-' + first_chat_id + '-' + first_chat_sub_type).html('');
            // $('.from-name-' + first_chat_id + '-' + first_chat_sub_type).removeClass('font-weight-700');
            // $('.from-name-' + first_chat_id + '-' + first_chat_sub_type).html(response['new_first_name'] + ' ' + response['new_last_name'] + '<span>' + response['new_chat_date'] + '</span>');
            // $('.chat-name-' + first_chat_id + '-' + first_chat_sub_type).attr('newfromcid', first_chat_id);
       
        }

        function refreshmessagetable()
        {
            $.ajax({
                url: baseurl+"message/refreshmessagetable",
                type:'POST',
                dataType: 'json',
                data: {},
                success: function(response){

                    $('.messagebodyopen').html( response['tablebodyopen'] );
                    $('.messagebodyclose').html( response['tablebodyclose'] );

                    if( response['tablebodyopen'] != '' ){
                        $('.writechatmessagebox').addClass('writechatmessage');
                    }

                }
            });
        }


        setInterval(function() {
            
           chatheartbeat('heartbeat');

           return false; 

        }, 1200);

    }
    else{

        function notifbeat()
        {
            $.ajax({
                url: baseurl+"dashboard/getnotifications",
                type:'POST',
                dataType: 'json',
                data: {},
                success: function(response){

                    if( response['newnotifications'] != '' ){
                        $('.newnotifications').after( response['newnotifications'] );
                        $('.notifcount').html( '<i class="fa fa-bell-o"></i><span>' + response['newnotificationscount'] + '</span>' );
                    }

                }
            });
        }

        setInterval(function() {
            
           notifbeat();

           return false; 

        }, 1100);
    }

    
    $(document).on("change", ".priodrop", function (e) {

        var priodrop = $(this).val();
        var priofromid = $(this).attr('fromid');

        $.ajax({
            url: baseurl+"message/",
            type:'POST',
            dataType: 'json',
            data: { from_id: priofromid, priodrop: priodrop },
            success: function(response){
            }
        });

    });


    $(document).on("click", ".load-more-msg-btn", function (e) {

        var fromid = $('.currdashtochat').val();
        var chatappid = $('.chatappid').val();
        var fromcaseno = $('.fromcaseno').val();
        var currchatbookingid = $('.chatbookingid').val();
        // var postsubtype = $('.first-active-chat-box').attr('subtype');

        $(this).html('<img src="'+baseurl+'img/loader.gif"/>');
        var currbtn = $(this);

        if( currsubtype == 'prementorship' ){
            fromcaseno = 0;
        }

        chatstart = chatstart + 12;

        $.ajax({
            url: baseurl+"chat/?prevchat=1",
            type:'POST',
            dataType: 'json',
            data: { from_id: fromid, chatappid: chatappid, action: 'heartbeat', caseno: fromcaseno, postsubtype: currsubtype, isfromcommunications: 0, to_comm_id: 0, chatstart: chatstart, chatlimit: chatlimit },
            success: function(response){
                console.log(response);
                console.log('.load-prev-chat-box-' + chatstart);
                $('.load-prev-chat-box-' + chatstart).before( response['hassubscriptionhtml'] ); 
                currbtn.remove();
            }
        });

    });

    // $(".message-container").hover( 
    //     function(){
    //         var currchatid = $(this).attr('chatid');
    //         $('.unsendchat-'+currchatid).attr('style','display:block !important;');
    //     },
    //     function() {
    //         var currchatid = $(this).attr('chatid');
    //         $('.unsendchat-'+currchatid).attr('style','display:none !important;');
    //     }
    // );

   
    $(document).on("click", ".unsendchat", function (e) {
        if(confirm('Are you sure you want to remove this message?')){
            var currchatid = $(this).attr('chatid');

            $.ajax({
                url: baseurl+"chat/unsend",
                type:'POST',
                dataType: 'json',
                data: { chatid: currchatid },
                success: function(response){
                    
                    $('.message-' + currchatid).remove();
                }
            });

            return false;
        }
    });


    var taskcatchmntfile = '';
    var taskcatchmntdata = '';
    var taskattachfile = '';

    //$('.taskfileattachment').change(function(e) {
    $(document).on("change", ".taskfileattachment", function (e) {

        var taskfileid = $(this).attr('browse_id');
        var taskfileid_num = $(this).attr('task_id');
        // console.log(taskfileid);

        for (var i = 0; i < e.originalEvent.srcElement.files.length; i++) {

            var file = e.originalEvent.srcElement.files[i];
            
            // alert(file.size);
            // console.log(filex);

            if( file.size <= 50000000 ){
                // var img = document.createElement("img");
                var reader = new FileReader();
                reader.onload = function(readerEvt) {
                        
                    // Generate a random unique number
                    //var currentTimestamp = Math.floor(Math.random() * 10000000); // Adjust the range as needed
                    var currentTimestamp = new Date().getTime();
                    
                    taskcatchmntfile = userid+currentTimestamp + '_' + file.name;
                    // taskcatchmntfile = file.name;
                    taskcatchmntdata = reader.result;
                    taskattachfile = file;
                    
                    if( taskfileid == 'mtfu' ){

                        $('.m-task-choose-file-' + taskfileid_num).html( '<i class="fa fa-file"></i> &nbsp;' + file.name );
                        $('.m-r-attachment-' + taskfileid_num).html('<a href="#" class="task-r-a mt_15 taskremoveattachment" task_id="' + taskfileid_num + '" id="mtfu"><i class="fa fa-remove"></i> Remove Attachment</a>');
                        $('.m-task-file-submit-btn-' + taskfileid_num).show();
                    }
                    else{
                        $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;' + file.name );
                        $('.r-attachment').html('<a href="#" class="task-r-a mt_15 taskremoveattachment" id="tfu"><i class="fa fa-remove"></i> Remove Attachment</a>');
                    }

                    $('.fileattachmentupdate').val('');
                }
                reader.readAsDataURL(file, 'UTF-8');
            }
            else{
                taskcatchmntfile = '';
                taskcatchmntdata = '';
                taskattachfile = '';

                if( taskfileid == 'mtfu' ){
                    $('.m-task-choose-file-' + taskfileid_num).html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
                    $('.m-r-attachment-' + taskfileid_num).html('');
                    $('.m-task-file-submit-btn-' + taskfileid_num).hide();
                }
                else{
                    $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
                    $('.r-attachment').html('');
                }
            }
        }
    });

    $(document).on("click", ".taskremoveattachment", function (event) {

        var taskfileid = $(this).attr('id');
        var taskfileid_num = $(this).attr('task_id');

        taskcatchmntfile = '';
        taskcatchmntdata = '';

        if( taskfileid == 'mtfu' ){
            $('.m-task-choose-file-' + taskfileid_num).html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
            $('.m-r-attachment-' + taskfileid_num).html('');
            $('.m-task-file-submit-btn-' + taskfileid_num).hide();
        }
        else{
            $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
            $('.r-attachment').html('');
        }

        $('.fileattachmentupdate').val('removeattachment');

    });

    var comm_mentor_id = 0;
    $(document).on("click", ".taskcommajax", function (e) {
        if ($(this).attr('mentor_id') != undefined){
            comm_mentor_id = $(this).attr('mentor_id');
        }

        $.ajax({
            url: baseurl+"communications/getadmintasks",
            type:'POST',
            dataType: 'json',
            data: { mentee_id: $(this).attr('mentee_id'), mentor_id: comm_mentor_id },
            success: function(response){
                $('.task_dropdown').html(response['task_dropdown']);
                $('.curr_tasks_box').html(response['curr_tasks']);
            }
        });


        $('.createactivityajax').attr('fromid', $(this).attr('mentee_id'));
        $('.createactivityajax').attr('toid', $(this).attr('mentee_id'));
        $('.createactivityajax').attr('mentor_application_id', $(this).attr('mentor_application_id'));

        $('.createactivityajax2').attr('fromid', $(this).attr('mentee_id'));
        $('.createactivityajax2').attr('toid', $(this).attr('mentee_id'));
        $('.createactivityajax2').attr('mentor_application_id', $(this).attr('mentor_application_id'));
        return false;
    });

    $(document).on("click", ".createactivityajax", function (e) {
    
        var activity_id = $('.activity_id').val();
        // var activityfromid = $(this).attr('fromid');
        var activityfromid = $('.tochatmessage').val();
        var tasktitle = $('.tasktitle').val();
        var taskdescription = $('.taskdescription').val();
        var task_has_deadline = 0
        var task_day = $('.task_day').val();
        var task_month = $('.task_month').val();
        var task_year = $('.task_year').val();
        var hasattachment = '';
        var hasdeadline = '';
        var hasmenteeattachment = '';
        var fileattachmentupdate = $('.fileattachmentupdate').val();


        if ( $('input[name="task_has_deadline"]').is(':checked') ) {
            task_has_deadline = 1;
        }

        var allowupdate = 1;
        if( activity_id > 0 ){

            if( confirm('Are you sure you want to update this task?') ){
                allowupdate = 1;
                $('.createactivityajax').html('Updating Task');
            }
            else{
                allowupdate = 0;
            }
        }
        else{
            $('.createactivityajax').html('Creating Task');
        }


        if( allowupdate == 1 ){

            if( taskcatchmntfile != '' ){

                $('.task-choose-file').html( '<img src="'+baseurl+'img/loader.gif"/> &nbsp;Uploading' );

                $.ajax({
                    url: baseurl+"dashboard/fileupload",
                    type:'POST',
                    dataType: 'json',
                    data: { name: taskcatchmntfile, data: taskcatchmntdata },
                    success: function(response){

                    }
                });

                hasattachment = '<p class="f-attach mt_10"><a target="_blank" href="' + baseurl + 'data/attachment/' + taskcatchmntfile + '"><i class="fa fa-paperclip"></i> &nbsp;' + taskcatchmntfile + '</a></p>';
            }

            if( activity_id > 0 ){

                if( fileattachmentupdate != '' && fileattachmentupdate != 'removeattachment'){
                    hasattachment = '<p class="f-attach mt_10"><a target="_blank" href="' + baseurl + 'data/attachment/' + fileattachmentupdate + '"><i class="fa fa-paperclip"></i> &nbsp;' + fileattachmentupdate + '</a></p>';
                }

                $('.message-container-task-' + activity_id ).remove();
            }

            
            $.ajax({
                url: baseurl+"dashboard/createactivity",
                type:'POST',
                dataType: 'json',
                data: { attachmentname: taskcatchmntfile, comm_mentor_id: comm_mentor_id, mentee_id: activityfromid, tasktitle: tasktitle, taskdescription: taskdescription, task_day: task_day, task_month: task_month, task_year: task_year, task_has_deadline: task_has_deadline, activity_id: activity_id },
                success: function(response){

                    if ( $('input[name="task_has_deadline"]').is(':checked') ) {
                        hasdeadline = '<p>Due date: ' + response['deadline'] + '</p>';
                    }

                    if( response['mentee_attachment'] ){
                        hasmenteeattachment = '<br/><p>Mentee submission:</p><p class="f-attach mt_10"><a target="_blank" href="<?php echo base_url() ?>data/attachment/' + response['mentee_attachment'] + '"><i class="fa fa-paperclip"></i> &nbsp;' + response['mentee_attachment'] + '</a></p><br/><div class="text-center"><a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="'+ response['activity_id'] + '">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="'+ response['activity_id'] + '">Mark as complete</a></div>';
                    }

                    if( response['num_activity'] > 1 ){
                         // $('.activity-list').prepend('<li class="list-group-item acid-'+ response['activity_id'] + '">' + taskdescription + ' <i class="fa fa-remove removeactivityajax" acid="' + response['activity_id'] + '"></i></li>');

                        if( activity_id > 0 ){
                            $('.acid-' + activity_id).html('<div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div>');

                        }
                        else{
                           $('.activity-accordion').prepend('<div class="card acid-'+ response['activity_id'] + '"><div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div></div>');
                        }

                          
                    }
                    else{
                         $('.activity-list').html('<div id="accordion" class="activity-accordion"><div class="card acid-'+ response['activity_id'] + '"><div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div></div></div>');
                    }

                    $('.acid-no-activities').remove();
                    $('.tasktitle').val('');
                    $('.taskdescription').val('');
                    $('.createactivityajax').html('Create Task');

                    // $(".task_has_deadline").attr("checked", false);
                    // $('input[name="task_has_deadline"]').removeAttr('checked');
                    $('input[name="task_has_deadline"]').click();

                    $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
                    $('.r-attachment').html('');
                    $('#collapseOne-new-task').collapse('hide');

                    $('.task-box-notif').html('<div class="alert alert-success" role="alert" style="font-size: 13px;padding: 8px;">Task has been added.</div>');
                }
            });
        }

    });


    $(document).on("click", ".createactivityajax2", function (e) {
    
        var activity_id = $('.task_dropdown').val();
        // var activityfromid = $(this).attr('fromid');
        var activityfromid = $('.tochatmessage').val();
        var task_day = $('.task_day').val();
        var task_month = $('.task_month').val();
        var task_year = $('.task_year').val();
        var task_has_deadline = 0;
        var hasmenteeattachment = '';


        if ( $('input[name="task_has_deadline"]').is(':checked') ) {
            task_has_deadline = 1;
        }

        $.ajax({
            url: baseurl+"dashboard/createactivity",
            type:'POST',
            dataType: 'json',
            data: { comm_mentor_id: comm_mentor_id, mentee_id: activityfromid, activity_id: activity_id, admintask: 1, task_day: task_day, task_month: task_month, task_year: task_year, task_has_deadline: task_has_deadline },
            success: function(response){

                var taskdescription = response['taskdescription'];
                var hasattachment = response['hasattachment'];;

                if ( $('input[name="task_has_deadline"]').is(':checked') ) {
                    hasdeadline = '<p>Due date: ' + response['deadline'] + '</p>';
                }

                if( response['mentee_attachment'] ){
                    hasmenteeattachment = '<br/><p>Mentee submission:</p><p class="f-attach mt_10"><a target="_blank" href="<?php echo base_url() ?>data/attachment/' + response['mentee_attachment'] + '"><i class="fa fa-paperclip"></i> &nbsp;' + response['mentee_attachment'] + '</a></p><br/><div class="text-center"><a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="'+ response['activity_id'] + '">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="'+ response['activity_id'] + '">Mark as complete</a></div>';
                }

                if( response['num_activity'] > 1 ){
                     // $('.activity-list').prepend('<li class="list-group-item acid-'+ response['activity_id'] + '">' + taskdescription + ' <i class="fa fa-remove removeactivityajax" acid="' + response['activity_id'] + '"></i></li>');

                    if( activity_id > 0 ){
                        $('.acid-' + activity_id).html('<div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div>');

                    }
                    else{
                       $('.activity-accordion').prepend('<div class="card acid-'+ response['activity_id'] + '"><div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div></div>');
                    }

                      
                }
                else{
                     $('.activity-list').html('<div id="accordion" class="activity-accordion"><div class="card acid-'+ response['activity_id'] + '"><div class="card-header" id="headingOne"><h5 class="mb-0"><button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne-'+ response['activity_id'] + '" aria-expanded="false" aria-controls="collapseOne-'+ response['activity_id'] + '">'+ response['title'] + '</button></h5></div><div id="collapseOne-'+ response['activity_id'] + '" class="collapse" aria-labelledby="headingOne" data-parent="#accordion"><div class="card-body fs_12">' + hasdeadline + taskdescription + hasattachment + hasmenteeattachment + '<div class="task-edit-box-m"><a href="#" class="editactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-edit"></i></a><a href="#" class="removeactivityajax" acid="'+ response['activity_id'] + '"><i class="fa fa-remove"></i></a></div></div></div></div></div>');
                }

                $('.acid-no-activities').remove();
                $('.tasktitle').val('');
                $('.taskdescription').val('');
                $('.createactivityajax').html('Create Task');

                // $(".task_has_deadline").attr("checked", false);
                // $('input[name="task_has_deadline"]').removeAttr('checked');
                // $('input[name="task_has_deadline"]').click();

                $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
                $('.r-attachment').html('');
                $('#collapseOne-new-task').collapse('hide');

                $('.task-box-notif').html('<div class="alert alert-success" role="alert" style="font-size: 13px;padding: 8px;">Task has been added.</div>');
            }
        });

    });


    $(document).on("click", ".editactivityajax", function (e) {

        var acid = $(this).attr('acid');

        
        // $('input[name="task_has_deadline"]').attr('checked','checked');
        $('input[name="task_has_deadline"]').click();

        $.ajax({
            url: baseurl+"dashboard/getactivity",
            type:'POST',
            data: { acid: acid },
            dataType: 'json',
            success: function(response){

                $('.activity_id').val( acid );
                $('.tasktitle').val( response['title'] );
                $('.taskdescription').val( response['description'] );

                if( response['attachment'] != '' ){
                    $('.task-choose-file').html( '<i class="fa fa-file"></i> &nbsp;' + response['attachment'] );
                    $('.r-attachment').html('<a href="#" class="task-r-a mt_15 taskremoveattachment"><i class="fa fa-remove"></i> Remove Attachment</a>');
                    $('.fileattachmentupdate').val( response['attachment'] );
                }

                if( response['deadline'] != '0000-00-00 00:00:00' ){
                    
                    $('input[name="task_has_deadline"]').attr('checked','checked');

                    $('.deadline-tbl-task').show();
                    $('.task_day').val( response['d_day'] );
                    $('.task_month').val( response['d_month'] );
                    $('.task_year').val( response['d_year'] );
                }
                else{
                    // $('input[name="task_has_deadline"]').removeAttr('checked');
                    $('input[name="task_has_deadline"]').click();
                    $('.deadline-tbl-task').hide();
                }

            }
        });


        $('#collapseOne-new-task').collapse('show');
        $('.createactivityajax').html('Update Task');

        var scr = $('.sub-prof-box')[0].scrollHeight;
        $('.sub-prof-box').animate({scrollTop: scr},500);

    });

    $(document).on("click", ".removeactivityajax", function (e) {


        var activityfromid = $('.createactivityajax').attr('fromid');
        var acid = $(this).attr('acid');

        if( confirm('Are you sure you want to remove this activity?') ){

            $.ajax({
                url: baseurl+"dashboard/removeactivity",
                type:'POST',
                data: { mentee_id: activityfromid, acid: acid },
                dataType: 'json',
                success: function(response){

                    console.log(response);
                    // alert(acid);
                    $('.acid-' + acid ).remove();
                    $('.message-container-task-' + acid ).remove();

                    if( response['num_activity'] == 0 ){
                        $('.activity-list').html('<ul class="activity-list list-group"><li class="list-group-item acid-no-activities"><span style="margin:0;">No Activities created yet</span></li></ul>');
                    }

                }
            });
        }

    });


    $(document).on("click", ".m-task-file-submit-btn", function (e) {

        var curtaskid = $(this).attr('task_id');

        if( taskcatchmntfile != '' ){

            $('.m-task-choose-file-' + curtaskid).html( '<img src="'+baseurl+'img/loader.gif"/> &nbsp;Uploading' );

            $.ajax({
                url: baseurl+"dashboard/fileupload",
                type:'POST',
                dataType: 'json',
                data: { name: taskcatchmntfile, task_id: curtaskid, data: taskcatchmntdata },
                success: function(response){

                    // $('.m-ajax-file-submit-' + curtaskid).before('<br/><br/><p>Task submitted:</p><p class="f-attach mt_10"><a target="_blank" href="' + baseurl + 'data/attachment/' + taskcatchmntfile + '"><i class="fa fa-paperclip"></i> &nbsp;' + taskcatchmntfile + '</a></p><br/><a href="#" class="btn btn-success m-b-r-m btn-feedback btn-padding-task-chat">Waiting for feedback</a>');

                    // $('.m-r-attachment-' + curtaskid).hide();
                    // $('.m-task-file-submit-btn').hide();
                    // $('.m-task-choose-file-' + curtaskid).html( '<i class="fa fa-file"></i> &nbsp;Choose File' );
                    $('.btn-feedback-box').remove();

                    $('.m-submit-task-box-'+ curtaskid).html('<br/><p>Task submitted:</p><p class="f-attach mt_10"><a target="_blank" href="' + baseurl + 'data/attachment/' + taskcatchmntfile + '"><i class="fa fa-paperclip"></i> &nbsp;' + taskcatchmntfile + '</a></p><div class="m-r-attachment-' + curtaskid + ' mt_15"></div><label for="mtfu-' + curtaskid + '" class="btn btn-success m-task-choose-file m-task-choose-file-' + curtaskid + '" style="cursor: pointer;"><i class="fa fa-file"></i> &nbsp;Choose File</label><input type="file" class="taskfileattachment" name="taskfileattachment" id="mtfu-' + curtaskid + '" browse_id="mtfu" task_id="' + curtaskid + '" style="display: none;"><a href="#" class="btn btn-success s-def-btn m-task-file-submit-btn m-task-file-submit-btn-' + curtaskid + '" task_id="' + curtaskid + '">Submit</a><br/><br/><div class="btn-feedback-box"><a href="#" class="btn btn-success m-b-r-m btn-feedback btn-padding-task-chat">Waiting for feedback</a></div>');
                }
            });

        }

    });


    $(document).on("click", ".btn-task-update", function (e) {

        var acid = $(this).attr('acid');
        var status = $(this).attr('status');

        if( confirm('Are you sure you want to update this task?') ){
            $.ajax({
                url: baseurl+"dashboard/updateactivity",
                type:'POST',
                dataType: 'json',
                data: { acid: acid, status: status },
                success: function(response){

                    if( status == 1 ){
                        $('.btn-' + acid).addClass('task-complete');

                        $('.pre-completed-btns-' + acid).html('<a href="#" class="btn btn-success m-b-r-m btn-approved btn-padding-task-chat">Approved</a>');
                        $('.pre-completed-side-' + acid).html('<div class="text-center"><a href="#" class="btn btn-success m-b-r-m btn-mark-as-c">Completed</a></div>');
                    }
                    else{

                        $('#collapseOne-'+acid+'-chat .card-body').prepend('<div class="alert alert-success" role="alert" style="font-size: 13px;padding: 8px;">Task has been set to redo.</div>');

                        $('.btn-' + acid).removeClass('task-complete');

                        $('.btn-completed-' + acid).remove();

                        $('.pre-completed-btns-' + acid).html('<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="' + acid + '">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="' + acid + '">Mark as complete</a>');
                        $('.pre-completed-side-' + acid).html('<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-redo" status="2" acid="' + acid + '">Redo</a>&nbsp;<a href="#" class="btn btn-success m-b-r-m btn-task-update btn-comp" status="1" acid="' + acid + '">Mark as complete</a>');
                    }
                    // $('.task-edit-box-m').hide();
                  
                }
            });
        }

    });

    $(document).on("click", ".createchallengeajax", function (e) {
    

        var challengefromid = $(this).attr('fromid');
        var challengedescription = $('.challengedescription').val();

        $.ajax({
            url: baseurl+"dashboard/createchallenge",
            type:'POST',
            dataType: 'json',
            data: { mentee_id: challengefromid, challengedescription: challengedescription },
            success: function(response){

                // console.log(response);

                $('.challenge-list').prepend('<li class="list-group-item acid-'+ response['challenge_id'] + '">' + challengedescription + ' <i class="fa fa-remove removechallengeajax" acid="' + response['challenge_id'] + '"></i></li>');
                $('.acid-no-challenges').remove();
                $('.challengedescription').val('');

            }
        });

    });

    $(document).on("click", ".removechallengeajax", function (e) {
    
        var challengefromid = $('.createchallengeajax').attr('fromid');
        var acid = $(this).attr('acid');

        $.ajax({
            url: baseurl+"dashboard/removechallenge",
            type:'POST',
            dataType: 'json',
            data: { mentee_id: challengefromid, acid: acid },
            success: function(response){

                // console.log(response);

                $('.acid-' + acid ).remove();

                if( response['num_challenge'] == 0 ){
                    $('.challenge-list').prepend('<li class="list-group-item acid-no-challenge"><span style="margin:0;">No Challenges created yet</span></li>');
                }

            }
        });

    });

    $(document).on("click", ".viewprofileModalbtn", function(e) {

        var profileid = $(this).attr('user_id');
        $('.profile-modal-ul').html('');
        $('.profile-modal-social').html('');

        $.ajax({
            url: baseurl+"profile/userprofile",
            type:'POST',
            dataType: 'json',
            data: { profileid: profileid },
            success: function(response){
                
                console.log(response);
                $('.ma_fullname_header').html( response['profiledata'][0]['first_name'] + ' ' + response['profiledata'][0]['last_name'] );
                $('.ma_date_applied').html( response['profiledata'][0]['date_applied_format'] );

                if( response['profiledata'][0]['profile_picture'] !== null ){
                    $('.ma_profile_picture').attr("src", baseurl+'avatar/'+response['profiledata'][0]['profile_picture'] );    
                }
                else{
                    $('.ma_profile_picture').attr("src", baseurl+'img/no-avatar.png' );       
                }
                
                $('.ma_job_title').html( response['profiledata'][0]['job_title'] );
                $('.ma_bio').html( response['profiledata'][0]['bio'] );
                $('.ma-tags').html( response['profiledata'][0]['taglabels'] );
                $('.task-tags-1').html( response['profiledata'][0]['skilllabels'] );

                if( response['profiledata'][0]['country_name'] != null ){
                    $('.profile-modal-ul').prepend( '<li class="ma-location">' + response['profiledata'][0]['country_name'] + '</li>' );    
                }

                if( response['profiledata'][0]['linkedin_url'] != null ){
                    $('.profile-modal-ul').prepend( '<li class="ma-linkedin"><a href="' + response['profiledata'][0]['linkedin_url'] + '" target="_blank"><div class="verified-badge-with-title"><i class="fa fa-check"></i> View linkedin</div></a></li>' );  
                }

                if( response['profiledata'][0]['github_url'] !== null ){
                    $('.profile-modal-social').prepend( '<li><a href="' + response['profiledata'][0]['github_url'] + '" target="_blank" title="Github" data-tippy-placement="top"><i class="fa fa-github"></i></a></li>' );  
                }

                if( response['profiledata'][0]['twitter_handle'] != null ){
                    $('.profile-modal-social').prepend( '<li><a href="' + response['profiledata'][0]['twitter_handle'] + '" target="_blank" title="Twitter" data-tippy-placement="top"><i class="fa fa-twitter"></i></a></li>' ); 
                }
                

               
                
                $('#viewprofileModal').modal();
                
            }
        }); 

        return false;
    });


    $(document).on("click", ".endsessionModalbtn", function(e) {

        var menteeid = $(this).attr('user_id');

        $('.end-session-btn').attr('href', baseurl + 'dashboard/?meid='+menteeid+'&t=endsession');
        $('#endsessionModal').modal();

    });

    $(document).on("click", ".sendchatnotificationModalbtn", function(e) {

        var menteeid = $(this).attr('user_id');

        $('.send-notification-btn').attr('href', baseurl + 'dashboard/?meid='+menteeid+'&t=sendnotification');
        $('#sendchatnotificationModal').modal();

    });

    $(document).on("click", ".closecasebtn", function(e) {

        var caseno = $('.fromcaseno').val();

        $('#closecaseModal').modal();
        $('.close-case-btn').attr('href', baseurl + 'message/closecase/' + caseno);

        
        return false;

    });

    $(document).on("click", ".message-inbox-btn", function () {

        $('#message-inbox').show();
        $('#message-sent').hide();
        $('.closecasebtn').show();

        $('.fromcaseno').val( $(this).attr('openfirstcaseno') );
        loadgetchat( $('.tochatmessageopened').val(), $(this).attr('openfirstcaseno') );

        return false;

    });

    

    $(document).on("click", ".message-sent-btn", function () {
        

        $('#message-sent').show();
        $('#message-inbox').hide();
        $('.closecasebtn').hide();

        $('.fromcaseno').val( $(this).attr('closefirstcaseno') );
        loadgetchat( $('.tochatmessageclosed').val(), $(this).attr('closefirstcaseno'), 'contactadmin' );

        return false;

    });

    $(document).on("click", ".imageattachment", function () {

        var imgsrc = $(this).attr('src');

        $('.imageattachmentcontent').attr('src',imgsrc);
        $('#imageattachmentModal').modal();

    });

    $(document).on("click", ".savementorcalendar", function () {
        
       
        $.ajax({
            url: baseurl+"calendarsessions/savecalendar",
            type:'POST',
            dataType: 'json',
            data: $(".mentorschedform").serialize(),
            success: function(response){

                // console.log(response);
                $(location).attr('href', baseurl+'calendarsessions');

            }
        });

        return false;

    });

    $(document).on("click", ".durationtype", function () {
        
        if( $(this).val() == 'customhrs' ){
            $('.customhrs').show();
            $('.fixhrs').hide();
        }
        else{
            $('.customhrs').hide();
            $('.fixhrs').show();
        }

    });

     $(document).on("click", ".calbookbtn", function () {

        var timestamp = $(this).attr('timestamp');

        $(location).attr('href', baseurl + 'calendarsessions/?c='+timestamp);

        return false;

    });

     $(document).on("click", ".calbookbtndash", function () {

        var calhref = $(this).attr('calhref');

        $(location).attr('href', calhref);

        return false;

    });

    $(document).on("click", ".daycheckbox", function () {
      if($(this).prop("checked") == true) {
        $('.'+$(this).attr('name')+'_start_box').removeAttr('readonly');
        $('.'+$(this).attr('name')+'_end_box').removeAttr('readonly');
        $('.'+$(this).attr('name')+'_tr').removeClass('tr-notsched');
      }
      else if($(this).prop("checked") == false) {
        $('.'+$(this).attr('name')+'_start_box').attr('readonly','readonly');
        $('.'+$(this).attr('name')+'_end_box').attr('readonly','readonly');
        $('.'+$(this).attr('name')+'_tr').addClass('tr-notsched');
      }
    });

    $(document).on("click", ".bookthis", function () {

        var session_name = $(this).attr('session_name');
        var session_rate = $(this).attr('session_rate');
        var bookingdate = $(this).attr('t');
        var bookingtime = $(this).html();
        var bookingtimezone = $('.cal-timezone').val();
        // var bookingtimezone = 'Europe/London';

        var sessionid = $(this).attr('session_id');
        var mentorid = $(this).attr('mentor_id');

        // $('.bookthistime').removeAttr('style');
        $(this).parent().attr('style','background-color:#6a3fdc;');
        $(this).attr('style','color:#fff !important;');

        // $('.m-session-name').html(session_name);
        // $('.m-time-booking').html(bookingdate);
        // $('.m-time').html(bookingtime);
        // $('.m-time-zone').html(bookingtimezone);


        $('.booking-details-'+sessionid).remove();
        $('.bookingcart').append('<div class="booking-details booking-details-'+sessionid+'" bookingstatus="1" style="display: block;"><p class="m-session-name">'+session_name+'</p><p class="m-time-booking">'+bookingdate+'</p><p class="m-time">'+bookingtime+'</p><p class="m-time-zone">'+bookingtimezone+'</p></div>');

        $('.m-session-name').val(session_name);
        $('.m-time-booking').val(bookingdate);
        $('.m-time').val(bookingtime);
        $('.m-time-zone').val(bookingtimezone);

        return false;

    });


    var mentordays = [];
    var mentortime = [];
    var bookedtime = [];
    //ss-edit-btn
    $(document).on("click", ".ss-edit-btn", function () {

        var mentee_booking_id = $(this).attr('mentee_booking_id');
        var mentee_name = $(this).attr('mentee_name');
        var mentor_name = $(this).attr('mentor_name');
        var session_name = $(this).attr('session_name');
        var booking_date = $(this).attr('booking_date');
        var booking_time = $(this).attr('booking_time');
        var time = $(this).attr('time');
        var time_type = $(this).attr('time_type');
        var slot_mentor_id = $(this).attr('mentor_id');
        // var booked_time = $(this).attr('booked_time');
       


        $('.m-mentee-booking-id').val(mentee_booking_id);
        $('.slot_mentor_id').val(slot_mentor_id);
        $('.m-mentee-name').val(mentee_name);
        $('.m-mentor-name').val(mentor_name);
        $('.m-session-name').val(session_name);
        $('.resched_date').val('');
        $('.resched_time').val('');
        $('.m-time').val(time);
        $('.m-time-type').val(time_type);

        // $('#editslotModal').modal();

        mentordays = $(this).attr('mentor_days').split(",");
        mentordays = mentordays.map(Number);

        mentortime = $(this).attr('mentor_time').split(",");
        bookedtime = $(this).attr('booked_time').split(",");

        $('#resched_date').datepicker('destroy').datepicker({
            startDate: "today",
            beforeShowDay: function(day) {
                var day = day.getDay();
                if (mentordays.indexOf(day) == -1) {
                     return false;
                } else {
                    return true;
                }
            }
        });

        return false;
        
    });

    for (i = 0; i <= 23; i++) {
        $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", true);
    }

    $('#resched_date').datepicker({
        startDate: "today",
        beforeShowDay: function(day) {
            var day = day.getDay();
            if (mentordays.indexOf(day) == -1) {
                return false;
            } else {
                return true;
            }

            var today = new Date();
            var selDate = Date.parse(day);
            if(selDate < today) {
                return false;
            }
        }
    }).on("changeDate", function (e) {
        // console.log(e.date);

        var mdy = mentortime[e.date.getDay()];
        mdy = mdy.split("-");

        // var bt = bookedtime[e.date.getDay()];
        // bt = bt.split("-");

        for (i = 0; i <= 23; i++) {
            $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", true);
        }

        var slot_mentor_id = $('.slot_mentor_id').val();
        $('.resched_time').html('');

        $.ajax({
            url: baseurl+"bookedsessions/checkmentoravailabledates",
            type:'POST',
            dataType: 'json',
            data: { mentor_id: slot_mentor_id, book_date: e.date },
            success: function(response){

                // $.each(response, function (i, notif) {
                //     // alert(i);
                //     $('.resched_time').html('<option>'+notif+'</option>');
                // });

                var avtimes = response.split(",");
                $.each(avtimes, function (i, time) {
                    $('.resched_time').append('<option value="'+time+'">'+time+'</option>');
                });

                // var i;
                // for (i = mdy[0]; i <= mdy[1]; i++) {

                //     if (avtimes.indexOf(i) == -1) {
                //         $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", false);
                //     } else {
                //         $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", true);
                //     }
                  
                // } 
                
            }
        }); 

        // $(".resched_time option[value='05:00']").attr("disabled", true);
        // console.log(mentortime[e.date.getDay()]);
    });


    // $(document).on("click", ".resched_time", function (e) {
    //     // console.log(e.date.getDay());
    //     var mdy = mentortime[e.date.getDay()];
    //     mdy = mdy.split("-");

    //     for (i = 0; i <= 23; i++) {
    //         $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", true);
    //     }

    //     var i;
    //     for (i = mdy[0]; i <= mdy[1]; i++) {

    //       $(".resched_time option[value='"+('0' + i).slice(-2)+":00']").attr("disabled", false);
    //     } 

    // });




    $(document).on("click", ".bookingreschedbtn", function () {

        $('.reschedform').submit();

        return false;

    });

    

    $(document).on("click", ".addnewsessionbtn", function () {

        $('.c-session-id').val(0);
        $('.c-session-name').val('');
        $('.c-session-amount').val('');
        $('.c-session-description').val('');
        $('#addnewsession').modal();

    });

    $(document).on("click", ".ajaxsessionedit", function () {

        $('.c-session-id').val($(this).attr('session_id'));
        $('.c-session-name').val($(this).attr('session_name'));
        $('.c-session-amount').val($(this).attr('session_amount'));
        $('.c-session-approx').val($(this).attr('session_approx'));
        $('.c-session-description').val($(this).attr('session_description'));
        $('#addnewsession').modal();

    });

    $(document).on("click", ".ajaxsessiondelete", function () {

        $('.session-delete-btn').attr('href', baseurl+'managesessions/delete/'+$(this).attr('session_id'));
        $('#deletesessionModal').modal();

    });


    $(document).on("click", ".deletepurchasehitorybtn", function () {

        $('.dp-order-id').html('Order ID: ' + $(this).attr('order-id') );
        $('.d-ph-btn').attr('href', baseurl+'purchasecenter/delete/'+$(this).attr('order-id'));
        $('#deletePurchaseModal').modal();

    });

     $(document).on("click", ".viewmentormenteebtn", function () {

        var menteestatus = $(this).attr('status');
        var mentorid = $(this).attr('mentor_id');

        $.ajax({
            url: baseurl+"mentorshipcenter/viewmentormentees",
            type:'POST',
            dataType: 'json',
            data: { mentor_id: mentorid, mentee_status: menteestatus },
            success: function(response){

               $('.viewmenteecontent').html(response);
            }
        }); 


        $('#viewmenteesModal').modal();

        return false;

    });

    $(document).on("click", ".updatepaypalemailbtn", function () {
        $('#updatepaypalemailModal').modal();
    });

    $(document).on("click", ".mentor-card-clear-btn", function () {
       $(this).closest('form').find("input[type=text], textarea").val("");
    });

    $(document).on("click", ".tutorialViewbtn", function () {
    
        var t_title = $(this).attr('title');
        var t_code = $(this).attr('videocode');
        var tutorial_id = $(this).attr('tutorial_id');

        if( t_title != '' && t_code != ''){
            $('.tutorial-view-title').html(t_title);
            $('.tutorial-view-body').html('<object class="tutorialvideofile" data="https://www.youtube.com/embed/' + t_code + '" style="width: 100%;height:400px;"></object>');

           $('#tutorialModal').modal('hide');
           $('#tutorialViewModal').modal();
        }

        $('.tbtns-prv').attr('title', '');
        $('.tbtns-prv').attr('videocode', '');

        $('.tbtns-nxt').attr('title', '');
        $('.tbtns-nxt').attr('videocode', '');

        $.ajax({
            url: baseurl+"dashboard/gettutorial",
            type:'POST',
            dataType: 'json',
            data: {tutorial_id:tutorial_id},
            success: function(response){

                // alert(response['prv_title']);
                if( response['prv_title'] != '' && response['prv_videocode'] != '' ){
                    // $('.tbtns-prv').html('&nbsp;Back&nbsp;' + response['prv_tutorial_id']);
                    $('.tbtns-prv').attr('tutorial_id', response['prv_tutorial_id']);
                    $('.tbtns-prv').attr('title', response['prv_title']);
                    $('.tbtns-prv').attr('videocode', response['prv_videocode']);
                }
                

                if( response['nxt_title'] != '' && response['nxt_videocode'] != '' ){
                    // $('.tbtns-nxt').html('&nbsp;Next&nbsp;' + response['nxt_tutorial_id']);
                    $('.tbtns-nxt').attr('tutorial_id', response['nxt_tutorial_id']);
                    $('.tbtns-nxt').attr('title', response['nxt_title']);
                    $('.tbtns-nxt').attr('videocode', response['nxt_videocode']);
                }
            }
        }); 


        // var prvbtn = $(this).attr('back');
        // var nxtbtn = $(this).attr('next');

        // if( prvbtn != '' ){
        //     prvbtn = prvbtn.split('|');
        //     $('.tbtns-prv').attr('title', prvbtn[0]);
        //     $('.tbtns-prv').attr('videocode', prvbtn[1]);
        // }

        // if( nxtbtn != '' ){
        //     nxtbtn = nxtbtn.split('|');
        //     $('.tbtns-nxt').attr('title', nxtbtn[0]);
        //     $('.tbtns-nxt').attr('videocode', nxtbtn[1]);
        // }

    }); 

    $(document).on("click", ".resignmentor-btn", function () {

        var resign_mentor_id = $(this).attr('mentor_id');

        $('.resignmentor-btn').html('Resigning, Please wait..');

        $.ajax({
            url: baseurl+"resign/resignmentor",
            type:'POST',
            dataType: 'json',
            data: {resign_mentor_id:resign_mentor_id},
            success: function(response){

                if( response['status'] == 1 ){
                    window.location.replace(baseurl+'logout?resign=1');
                    // alert('success');
                }
                else{
                    alert(response['msg']);
                    $('.resignmentor-btn').html('Yes, Resign');
                    $('#resignModal').modal('toggle');
                }
               
            }
        }); 
            
    });

    $("#tutorialViewModal").on('hide.bs.modal', function(){
        $(".tutorialvideofile").attr('data', '');
    });


    $('input[name="task_has_deadline"]').on('click', function(){
        if ( $(this).is(':checked') ) {
            $('.deadline-tbl-task').show();
        }
        else{
            $('.deadline-tbl-task').hide();
        }
    });

    $('.start-select-time').on('change', function(){

        var selid = $(this).attr('selid');
        var currtime = $(this).val();

        var timenum = currtime.split(':')[0];

        for (var i = timenum; i >= 0; i--) {
            
            var valnum = ('0' + i).slice(-2);
            // $("." + selid + "_end_box option[value='" + valnum + ":00']").attr('disabled', 'disabled');    
            $("." + selid + "_end_box option[value='" + valnum + ":00']").remove();
        }
    }); 

    $('.rate-option').on('click', function(){
        var ratechecktitle = $(this).attr('title');

        if ( $(this).is(':checked') ) {
            $('.'+ratechecktitle).removeAttr('readonly');
            $('.'+ratechecktitle).attr('style','width:100%;');
        }
        else{
            $('.'+ratechecktitle).attr('readonly','readonly');
            $('.'+ratechecktitle).attr('style','width:100%;opacity:0.4;');
            $('.'+ratechecktitle).val('0.00');
        }
    });

    $(".session_check").change(function() {
        var session_list_id = $(this).attr('session_list_id');
        if(this.checked) {
            $('.ischeck-'+session_list_id).val(1);
        }
        else{
            $('.ischeck-'+session_list_id).val(0);
        }
    });

    var sessionnumadded = 0
    $('.add-session-coach').click(function(){

        sessionnumadded++;

        var sessionboxhtml = '<div class="col-md-4 session-new-box-'+sessionnumadded+'"><div style="margin-bottom:20px;"><div class="input-group mb-3"><div class="input-group-prepend" style="width:35px;"><div class="input-group-text" style="height:34px;width:34px;"><input type="checkbox" name="session_check" class="session_check" session_list_id="" value="1" checked></div></div><input type="hidden" name="session_list_id[]" value="0"><input type="hidden" name="ischeck[]" value="1"><input type="text" placeholder="Session title" name="session_title[]" class="form-control" value=""></div><div class="frm-lbl">Set your preferred rate</div><input type="text" name="session_rate[]" class="session_rate" placeholder="Session Rate" min="0" onkeypress="return isNumberKeyLimit(event)" style="width: 100%;" value=""><div class="mentorship-package-box-profile"><div class="frm-lbl">Session description</div><textarea name="session_description[]" style="width: 100%;margin-bottom:10px;height:180px;"></textarea><div class="frm-lbl">Duration details</div><input type="text" name="session_duration[]" class="session_duration" placeholder="Session duration" style="width: 100%;margin-bottom:5px;" value=""></div></div><a href="#" class="remove-session-box" sessionboxnum="'+sessionnumadded+'">remove</a><br/><hr/><br/></div>';

        $('.new-session-box').before(sessionboxhtml);
        
    });

    
    $(document).on("click", ".remove-session-box", function () {
        // alert($('.remove-session-box').attr('sessionboxnum'));
        $('.session-new-box-'+$(this).attr('sessionboxnum')).remove();

        return false;
    });

    $('.closeme-modal').on('click', function(){
        
        var modalid = $(this).attr('idname');

        $('#'+modalid).modal('hide');

        return false;

    });

    if( roleid != '1' && currentpage == 'dashprofile' ){
        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:3,
            searchResultLimit:99,
            renderChoiceLimit:99
        });     
    }

    $(document).on("click", ".remove-l-avatar", function () {

        if( confirm('Are you sure you want to remove image?') ){
            var mnum = $(this).attr('m');
            $('.mentor_avatar_h'+mnum).val('');
            $('.mentor-avatar'+mnum).html('');
        }

        return false;
    });

    $(document).on("click", ".send-contact-btn", function () {

        var contact_title = $('.contact_title').val();
        var contact_email = $('.contact_email').val();
        var contact_message = $('.contact_message').val();
        var contact_role_type = $('.contact_role_type').val();

        $.ajax({
            url: baseurl+"dashboard/contactadmin",
            type:'POST',
            dataType: 'json',
            data: {contact_title:contact_title,contact_email:contact_email,contact_message:contact_message,contact_role_type:contact_role_type},
            success: function(response){

                $('.task-box-notif').html('<div class="alert alert-success" role="alert" style="font-size: 13px;padding: 8px;">Your message has been sent.</div>');
               
            }
        }); 

        return false;

    });

    $(document).on("click", ".add-faq-box", function () {

        $('.faq-box-b').before('<div><hr/><input type="text" name="course_faq[]" class="mb-2" placeholder="" value=""><textarea name="course_answer[]" style="height:90px;" id=""></textarea><p class="mt-2"><a href="#" class="remove-faq-box"><span class="badge badge-danger">- Remove Syllabus</span></a></p></div>');

        return false;

    });
    
    $(document).on("click", ".remove-faq-box", function (e) {
    //$('#syllabus-container').on('click', '.remove-faq-box', function(e) {
        e.preventDefault(); // Prevent the default action (e.g., navigating to #)
        $(this).closest('div').remove(); // Remove the closest div container
    });
    
    
    

    $(document).on("click", ".add-req-box", function () {

        $('.req-box-b').before('<div><hr/><input type="text" class="mb-2" name="requirements[]" placeholder="" value=""><textarea name="requirements_content[]" style="height:90px;" id=""></textarea><p class="mt-2"><a href="#" class="remove-req-box"><span class="badge badge-danger">- Remove Requirements</span></a></p></div>');

        return false;

    });
    
    $(document).on("click", ".remove-req-box", function (e) {
    //$('#syllabus-container').on('click', '.remove-faq-box', function(e) {
        e.preventDefault(); // Prevent the default action (e.g., navigating to #)
        $(this).closest('div').remove(); // Remove the closest div container
    });
    
    

    $(document).on("click", ".add-out-box", function () {

        $('.out-box-b').before('<div><hr/><input type="text" class="mb-2" name="outcomes[]" placeholder="" value=""><textarea name="outcomes_content[]" style="height:90px;" id=""></textarea><p class="mt-2"><a href="#" class="remove-out-box"><span class="badge badge-danger">- Remove Outcomes</span></a></p></div>');

        return false;

    });
    
    $(document).on("click", ".remove-out-box", function (e) {
    //$('#syllabus-container').on('click', '.remove-faq-box', function(e) {
        e.preventDefault(); // Prevent the default action (e.g., navigating to #)
        $(this).closest('div').remove(); // Remove the closest div container
    });
    
    

    var choicecount = 1;
    $(document).on("click", ".add-choice-box", function () {

        choicecount++;
        $('.choices-box').before('<div class="row"><div class="col-md-10"><div class="frm-block mb-1"><input type="text" name="choices[]" class="mb-3 choice" choice="'+choicecount+'" placeholder="" value=""></div></div><div class="col-md-2 d-flex align-items-center"><div class="form-check form-check-inline mb-4" style="margin-right: 30px;"><input class="form-check-input checkbox-choice-'+choicecount+'" type="checkbox" name="answer[]" value="1"><label class="form-check-label" for="mentorradio">Answer</label></div>  </div></div>');

        return false;

    });
    
    
    //add more question on quiz ----------
    var curnumquestion = 1;
    $(document).on("click", ".add-question-box", function () {

        curnumquestion++;
        
        $('.questions-box').before('<div><div class="frm-block mb-1"><div class="frm-lbl">Question *</div><input type="text" name="question[]" class="mb-3" placeholder="" value=""></div><div class="frm-lbl">Choices</div><table><tr><td style="width:50%;"><div class="row"><div class="col-md-8"><div class="frm-block mb-1"><input type="text" name="choices'+curnumquestion+'[]" class="mb-3 choice" choice="1" q="'+curnumquestion+'" placeholder="" value=""></div></div><div class="col-md-4 d-flex align-items-center"><div class="form-check form-check-inline mb-4" style="margin-right: 30px;"><input class="form-check-input checkbox-choice-1-q'+curnumquestion+'" type="checkbox" name="answer'+curnumquestion+'[]" value=""><label class="form-check-label" for="mentorradio">Answer</label></div></div></div></td><td style="width:50%;"><div class="row"><div class="col-md-8"><div class="frm-block mb-1"><input type="text" name="choices'+curnumquestion+'[]" class="mb-3 choice" choice="2" q="'+curnumquestion+'" placeholder="" value=""></div></div><div class="col-md-4 d-flex align-items-center"><div class="form-check form-check-inline mb-4" style="margin-right: 30px;"><input class="form-check-input checkbox-choice-2-q'+curnumquestion+'" type="checkbox" name="answer'+curnumquestion+'[]" value=""><label class="form-check-label" for="mentorradio">Answer</label></div></div></div></td></tr><tr><td style="width:50%;"><div class="row"><div class="col-md-8"><div class="frm-block mb-1"><input type="text" name="choices'+curnumquestion+'[]" class="mb-3 choice" choice="3" q="'+curnumquestion+'" placeholder="" value=""></div></div><div class="col-md-4 d-flex align-items-center"><div class="form-check form-check-inline mb-4" style="margin-right: 30px;"><input class="form-check-input checkbox-choice-3-q'+curnumquestion+'" type="checkbox" name="answer'+curnumquestion+'[]" value=""><label class="form-check-label" for="mentorradio">Answer</label></div></div></div></td><td style="width:50%;"><div class="row"><div class="col-md-8"><div class="frm-block mb-1"><input type="text" name="choices'+curnumquestion+'[]" class="mb-3 choice" choice="4" q="'+curnumquestion+'" placeholder="" value=""></div></div><div class="col-md-4 d-flex align-items-center"><div class="form-check form-check-inline mb-4" style="margin-right: 30px;"><input class="form-check-input checkbox-choice-4-q'+curnumquestion+'" type="checkbox" name="answer'+curnumquestion+'[]" value=""><label class="form-check-label" for="mentorradio">Answer</label></div></div></div></td></tr></table><p class="mt-2"><a href="#" class="remove-question-box"><span class="badge badge-danger">- Remove Question</span></a></p><hr/></div>');

        return false;

    });
    
    
    $(document).on("click", ".remove-question-box", function (e) {
        e.preventDefault(); // Prevent the default action (e.g., navigating to #)
        $(this).closest('div').remove(); // Remove the closest div container
    });
    //end add more question on quiz ----------
    
    $(document).on("click", ".edit-module-quiz", function (e) {
       var module_id = $(this).attr('module_id');
       
       $.ajax({
            url: baseurl+"managequizes/get_quiz_by_module",
            type:'POST',
            dataType: 'json',
            data: {module_id:module_id},
            success: function(response){
                // console.log(response);
                // console.log(response.quiz_title);
                curnumquestion = response.quiz_count;
                $('.quiz-title').val(response.quiz_title);
                $('.initial-module-questions').html(response.quizes_html);
                $('#createquizModal').modal('show');
            }
        }); 

        return false;
       
    });
    
    $(document).on("click", ".edit-module-lesson", function (e) {
       var lesson_id = $(this).attr('lesson_id');
       
       $.ajax({
            url: baseurl+"managelessons/get_lesson",
            type:'POST',
            dataType: 'json',
            data: {lesson_id:lesson_id},
            success: function(response){
               
                $('.lesson_id').val( response[0]['lesson_id'] );
                $('.lesson_title').val( response[0]['lesson_title'] );
                // $('.form_script_editor').html( response[0]['description'] );
                
                $('.form_script_editor').code(response[0]['description']);
                
                $('.articulatecode').html('<div class="frm-lbl">Copy Articulate Iframe Code</div><code>'+response[0]['articulate'].replace('<','&lt;').replace('>','&gt;')+'</code>');
                
                $('.attachment').val( response[0]['attachment'] );
                $('.type').val( response[0]['type'] );
                
                $('#createlessonModal').modal('show');
            }
        }); 

        return false;
       
    });
    
    

    $(document).on('keyup', '.choice', function() {
        var choice = $(this).attr('choice');
        var wq = $(this).attr('q');
        
        $('.checkbox-choice-'+choice+'-q'+wq).val( $(this).val() );
        // $(this).closest('.row').find('.answer-checkbox').val(inputValue);
    });

    var currentIndex = lessonscount;
    var currlsn = 1;
    
    
    $(document).on('click', '.module-item', function() {
        var itemid = $(this).attr('itemid');
        var itemtype = $(this).attr('itemtype');
        var progpercent = $(this).attr('progpercent');
        var islast = $(this).attr('islast');
        var cur_course_id = $(this).attr('course_id');
        var currmodulenum = $(this).attr('module');
        var cmi = $(this).attr('c');

        $('.module-item-box').removeClass('active');
        $(this).find('.module-item-box').addClass('active text-dark');
        

        $.ajax({
            url: baseurl+"coursecontent/getmoduleitem",
            type:'POST',
            dataType: 'json',
            data: {itemid:itemid,itemtype:itemtype, progpercent:progpercent, islast:islast, course_id:cur_course_id, currmodulenum:currmodulenum},
            success: function(response){
                $('.module-content').html(response);
                // $('.item-box-'+itemid).addClass('active');
                
                console.log( cmi + '/' + totalitems);
                if( cmi <= totalitems ){
                    console.log('.module-item-count-'+(cmi));
                    $('.module-item-count-'+cmi).removeClass('text-gray');
                    $('.module-item-count-'+cmi).addClass('text-dark module-item');
                    // $('.accordion-b-'+(cmi)).click();
                }
                
                currlsn++;
            }
        }); 

        return false;
    });

   
    var cardCount = modulescount;
    var selector = '';
    for (var i = 1; i <= cardCount; i++) {
        if (i > 1) {
            selector += ', '; // Add a comma separator for multiple selectors
        }
        selector += '.card-b-' + i + ' a';
    }

    
    // Now use the dynamically built selector to select all child elements
    var $children = $(selector);
    

    // Function to click on the current item
    function clickCurrentItem() {
        var $currentItem = $children.eq(currentIndex);
        var $currentCard = $currentItem.closest('.collapse');

        // If the current card is not open, open it
        if (!$currentCard.hasClass('show')) {
            $currentCard.collapse('show');
        }

        // Click the current item
        $currentItem.click();

        // $children.eq(currentIndex).addClass('module-item');
        // $children.eq(currentIndex).click();
    }

    // Next button click event
    $(document).on('click', '#course-next-btn', function() {
        // Increment index and reset if it exceeds the number of items
        currentIndex = (currentIndex + 1) % $children.length;
        clickCurrentItem();
        // return false;
    });

    // Previous button click event
    $(document).on('click', '#course-prev-btn', function() {
        // Decrement index and reset if it goes below zero
        currentIndex = (currentIndex - 1 + $children.length) % $children.length;
        clickCurrentItem();
        // return false;
    });

    //----- Initial click on the first item -----
    // clickCurrentItem();
    var $currentItem = $children.eq(0);
    var $currentCard = $currentItem.closest('.collapse');

    // If the current card is not open, open it
    if (!$currentCard.hasClass('show')) {
        $currentCard.collapse('show');
    }

    // Click the current item
    $currentItem.click();
    //----- end Initial click on the first item -----


    $(document).on('click', '.re-do-quiz', function() {
        $('#viewquizModal').modal('hide');
        $('.quiz-module-item-0').click();
        currentIndex = lessonscount;
    });

    //quiz submit
    $(document).on('click', '.submit-quiz-answer', function() {
        var formid = $(this).attr('formid');
        var islast = $(this).attr('islast');
        var student_id = $(this).attr('student_id');
        var cur_course_id = $(this).attr('course_id');
     
        var answerval = [];
        $('.answerval:checked').each(function() {
            answerval.push($(this).val());
        });
        console.log(answerval);
        
        if (answerval.length === 0) {
            console.error('Validation Error: No values selected. Please select at least one option.');
            $('.exam-notif').html('<div class="alert alert-danger" role="alert">No answer selected. Please select at least one answer.</div>');
            // You can add additional code here to handle the error, such as displaying a message to the user
        } else {
            $('.submit-quiz-answer').html('SUBMITTING...');

            // Send the data via AJAX
            $.ajax({
                type: 'POST',
                url: baseurl+'coursecontent/submitanswer', // Replace with your server URL
                dataType: 'json',
                data: {quizid:formid,answerval:answerval},
                success: function(response) {
                    // Handle success
                    // console.log('Success:', response);
                    $('.submit-quiz-answer').html('SUBMITTED!');
                    console.log(islast);
                    if(islast==1){
                        //show quiz results
                        
                        $.ajax({
                            url: baseurl+"studentcourses/getquizresults",
                            type:'POST',
                            dataType: 'json',
                            data: { course_id:cur_course_id,student_id:student_id },
                            success: function(response){
                                
                                $('.quiz-results-body').html(response);
                                
                            }
                        }); 
                
                 
                        $('#viewquizModal').modal();
                        return false;
                        
                    }
                    else{
                        currentIndex = (currentIndex + 1) % $children.length;
                        clickCurrentItem();                    
                    }
    
                },
                error: function(error) {
                    // Handle error
                    console.log('Error:', error);
                }
            });
        }
        
        
        
    });

    $(document).on('click', '.generatePDF', function() {
        generatePDF();
        
        return false;
    });
    
    
});

async function generatePDF() {
    const { jsPDF } = window.jspdf;
    const content = document.getElementById('mycertificate');

    // Check if html2canvas is loaded correctly
    if (typeof html2canvas !== 'function') {
        console.error('html2canvas is not loaded or not a function.');
        return;
    }

    try {
        // Use html2canvas to capture the content as an image
        const canvas = await html2canvas(content, { scale: 1 });
        const imgData = canvas.toDataURL('image/png');
        
        // Convert pixel dimensions to millimeters

        // Create a new PDF document with specified dimensions
        const pdf = new jsPDF({
            orientation: 'landscape',
            unit: 'mm',
            format: [210, 152]
        });

        // Add image to PDF
        pdf.addImage(imgData, 'PNG', 0, 3, 210, 0); // Adjust dimensions as needed

        // Save the PDF
        pdf.save('QCP-Certificate-of-Completion.pdf');
    } catch (error) {
        console.error('Error generating PDF:', error);
    }
}


// Trigger PDF generation and download when the page loads
// window.onload = generatePDF;



function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
}

function isNumberKey(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode

   if (charCode == 46)
   {
       var inputValue = $("#inputfield").val()
       if (inputValue.indexOf('.') < 1)
       {
           return true;
       }
       return false;
   }
   if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
   {
       return false;
   }
   return true;
}

function isNumberKeyLimit(evt)
{
   var charCode = (evt.which) ? evt.which : event.keyCode

   if (charCode == 46)
   {
       var inputValue = $("#inputfield").val()
       if (inputValue.indexOf('.') < 1)
       {
           return true;
       }
       return false;
   }
   if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
   {
       return false;
   }

   console.log(evt);

   return true;
}


$(document).on("click", ".admin-post-review", function () {

    var review_mentor_id = $('.review_mentor_id').val();
    var review_name = $('.review_name').val();
    var review_rating = $('.review_rating').val();
    var review_review = $('.review_review').val();
    var review_id = $('.review_id').val();



    $('.admin-post-review').val('Posting, Please wait..');

    $.ajax({
        url: baseurl+"userlist/addreview",
        type:'POST',
        dataType: 'json',
        data: {mentor_id:review_mentor_id,name:review_name,rating:review_rating,review:review_review,mentee_id:0,review_id:review_id},
        success: function(response){

            $('.review_notif_msg').html('<div class="alert alert-success" role="alert">Review has been added</div>');
            $('.admin-post-review').val('Post Review');

            $('.review_name').val('');
            $('.review_rating').val('');
            $('.review_review').val('');

            if(review_id>0){
                $('#editModal').modal();     
                window.location.replace(baseurl+'reviews');   
            }
           
        }
    }); 
        
});
