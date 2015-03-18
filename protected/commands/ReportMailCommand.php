<?php
class ReportMailCommand extends SimbConsoleCommand 
{            
	public function run($args)
    {
        set_time_limit(600);    // 10 minute timeout
        
        echo "Sending ReportMail: .... <br>\n";

        define("EMAIL_ADMINS_ONLY", false);
        define("SEND_ALL", false);
        
        foreach(Grower::model()->findAll() as $key=>$grower) {
            $do_report = SEND_ALL;
            if(!SEND_ALL) {
                print "Grower Reporting Frequency: " . $grower->reporting . "\n";
                switch($grower->reporting){
            	    case 'daily':
             	        $do_report = true;
            		    break;
            	    case 'monthly':
            		    if((int)date('d') == 1){
            			    $do_report = true;
            		    }
            		    break;
            	    case 'weekly':
            		    if(date('D') == $grower->weekly_interval){ // check day on weekly 
            			    $do_report = true;
            		    }
            		    break;
                }
            }
            
            if($do_report && count($grower->getBlock())) {
  		        /* HTTP request failed! HTTP/1.1 406 Not Acceptable fixed*/
  		        $curl_handle=curl_init();
                curl_setopt($curl_handle, CURLOPT_URL,'http://growfruit.fgv.com.au/report/pdf/'.$grower->id.'/'.date("Y"));
                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                $html = curl_exec($curl_handle);
                curl_close($curl_handle);

            	$pdf = Yii::app()->ePdf->mpdf('', 'A4', 9, '', 10, 10, 10, 10, 5, 5);
            	$pdf->WriteHTML($html);
            	$pdf_as_string = $pdf->Output('','S'); // $pdf is a TCPDF instance
                
            	// Get basic info for sending email
            	$arrParams = array(
            			'{name}'=>$grower->name ,
            			'{interval}'=>$grower->reporting,
            			'{signature}'=>Yii::app()->params['emailSignature'],
            	);
            	
                // Send email
            	$mail = new Message();
                
                if(EMAIL_ADMINS_ONLY) {
                    $ccEmails = Yii::app()->params['ccEmail'];
                    if (!empty($ccEmails)){
                        if (is_array($ccEmails)){
                            foreach($ccEmails as $e){
                                if(filter_var($e, FILTER_VALIDATE_EMAIL)) {
                                    $mail->recipient_email[] = $e;
                                }
                            }
                        }
                        elseif(filter_var($ccEmails, FILTER_VALIDATE_EMAIL)) {
                            $mail->recipient_email[] = $ccEmails;
                        }
                    }                    
                } else {
                    // Email the grower(s)
                    $recipients = explode(',',$grower->email);
                    
                    foreach($recipients as $recipient){
                        if(filter_var(trim($recipient), FILTER_VALIDATE_EMAIL)){ // Validating email addresses
                            $mail->recipient_email[] = trim($recipient);
                        }
                    }
                    
                    // CC the admins
                    $ccEmails = Yii::app()->params['ccEmail'];
                    if (!empty($ccEmails)){
                        if (is_array($ccEmails)){
                            foreach($ccEmails as $e){
                                if(filter_var($e, FILTER_VALIDATE_EMAIL)) {
                                    $mail->recipient_email[] = $e;
                                }
                            }
                        }
                        elseif(filter_var($ccEmails, FILTER_VALIDATE_EMAIL)) {
                            $mail->recipient_email[] = $ccEmails;
                        }
                    }                    
                }
                
                foreach($mail->recipient_email as $e) {
                    print "Emailing " . $e . "<br>";
                }
                
			    $mail->subject = Yii::t('app','[Spray Report] '.$grower->name.' '.date('Y-M-d'));
			    $mail->sender_name = Yii::t('app', 'FGV Report');
			    $mail->sender_email = Yii::app()->params['noreplyEmail'];
			    $attachment = array('content'=>$pdf_as_string,'name'=>strtolower(str_replace(' ','-',$grower->name).'-'.$grower->reporting.'-'.date('Y-M-d').'.pdf'),'encoding' => 'base64','type'=>'application/pdf') ; 
			    $mail->attachment = $attachment;
			    $mail->sendGrowerReport($arrParams);
			    echo $grower->name. " report has been sent \n";
            }
            
        }
   		
    }
}