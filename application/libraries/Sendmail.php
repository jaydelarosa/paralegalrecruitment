<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sendmail {

    function send( $email = '', $subject = '', $msg = '', $file_attachment_url = '' ) 
	{
        $CI =& get_instance();

        // $CI->load->library('email');            

        $response = array();
    	

        //------------------------------------ USER MAIL ----------------------------------
        $CI->load->library('email');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://mail.privateemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'info@paralegalrecruitment.com';
        $config['smtp_pass'] = 'Nokia3100!';

        $config['mailtype'] = 'html';
        $config['newline']  = "\r\n";
        $config['crlf'] = "\r\n";
        $CI->email->initialize($config);

        $CI->email->from('info@paralegalrecruitment.com', 'Paralegal Recruitment');
        $CI->email->to($email);
        $CI->email->subject($subject);
        $CI->email->message('<div style="background-color:#f6f6f6;padding:40px 0;">

                    <div style="width:600px;margin:30px auto;padding: 30px;color:#333333;font-family:\'Montserrat\',Helvetica,Arial,sans-serif;font-size:14px;background-color:#fff;">

                        <div style="text-align:center;margin:30px 0;"><img src="'.base_url().'img/logo-dark.png" style="width:190px;"></div>

                        <hr/ style="color:#6FB7F9;">
                        <br/>
                        
                        '.$msg.'

                        <br/><br/>
                    </div>
                    <br/>
                    <div style="text-align:center;color:#747678;font-size:12px;">Copyright © '.date('Y').' Paralegal Recruitment</div>

                    <br/><br/><br/>

                </div>
        ');

        if( $file_attachment_url != '' ){
            $CI->email->attach($file_attachment_url);
        }   

        if( $CI->email->send() )
        {
            $response = 1;
        }
        else
        {
            $response = 0;
        }
        //---------------------------------END MAIL ----------------------------------

        return $response;
    }

    function sendraw( $email = '', $subject = '', $content = '' ) 
    {
        $CI =& get_instance();

        // $CI->load->library('email');            

        $response = array();
        

        //------------------------------------ USER MAIL ----------------------------------
        $CI->load->library('email');

        $config['mailtype'] = 'html';
        $config['newline']  = "\r\n";
        $config['crlf'] = "\r\n";
        $CI->email->initialize($config);

        $CI->email->from('no-reply@paralegalrecruitment.com', 'Paralegal Recruitment');
        $CI->email->to($email);
        $CI->email->subject($subject);
        $CI->email->message($content);

        if( $CI->email->send() )
        {
            $response = 1;
        }
        else
        {
            $response = 0;
        }
        //---------------------------------END MAIL ----------------------------------

        return $response;
    }

   
}