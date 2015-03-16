<?php

class ReportMailCommand extends SimbConsoleCommand{
            
			public function run($args)
            {
            	echo "Sending ReportMail: .... \n";
            	
            	foreach(Grower::model()->findAll() as $key=>$grower){
            		$do_report = false;
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
            		if($do_report && count($grower->getBlock())){
            			$pdf = Yii::app()->ePdf->mpdf('', 'A4', 9, '', 10, 10, 10, 10, 5, 5);
            			$pdf->WriteHTML(file_get_contents('http://fgv.wearebuilding.net/report/pdf/'.$grower->id.'/'.date("Y", time())));
            			$pdf_as_string = $pdf->Output('','S'); // $pdf is a TCPDF instance
            			// Get basic info for sending email
            			$arrParams = array(
            					'{name}'=>$grower->name ,
            					'{interval}'=>$grower->reporting,
            					'{signature}'=>Yii::app()->params['emailSignature'],
            			);
            			// Sent email
            			$mail = new Message();
			    		// Add cc email 
            			$recipients = explode(',',$grower->email);
            			foreach($recipients as $recipient){
            				if(filter_var($recipient, FILTER_VALIDATE_EMAIL)){ // Validating email addresses
            					$mail->recipient_email[] = $recipient;
            				}
            			}
			    		$ccEmails = Yii::app()->params['ccEmail'];
                        if (!empty($ccEmails)){
                            if (is_array($ccEmails)){
                                foreach($ccEmails as $e){
                                    if(filter_var($e, FILTER_VALIDATE_EMAIL))
                                        $mail->recipient_email[] = $e;
                                }
                            }
                            elseif(filter_var($ccEmails, FILTER_VALIDATE_EMAIL))
                                $mail->recipient_email[] = $ccEmails;
                        }
			    		$mail->subject = Yii::t('app','[Spray Report] '.$grower->name.' '.date('Y-M-d'));
			    		$mail->sender_name = Yii::t('app', 'FGV Report');
			    		$mail->sender_email = Yii::app()->params['noreplyEmail'];
			    		$attachment = array('content'=>$pdf_as_string,'name'=>strtolower(str_replace(' ','-',$grower->name).'-'.$grower->reporting.'-'.date('Y-M-d').'.pdf'),'encoding' => 'base64','type'=>'application/pdf') ; 
			    		$mail->attachment = $attachment;
			    		$mail->sendGrowerReport($arrParams);
			    		echo $grower->email." has been sent \n";
            		}
            	}
            }
  }