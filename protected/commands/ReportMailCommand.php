<?php

class ReportMailCommand extends SimbConsoleCommand{
            
			public function run($args)
            {
            	echo "Fetching ReportMail: .... \n";
            	
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
            			// sent email
            			$pdf = Yii::app()->ePdf->HTML2PDF();
            			$pdf->WriteHTML(file_get_contents('http://fruitgrowersvictory.simb/report/grower/'.$grower->id));
            			$pdf_as_string = $pdf->Output('', 'S'); // $pdf is a TCPDF instance
            			// Get basic info for sending email
            			$arrParams = array(
            					
            			);
            			$mail = new Message();
			    		$mail->recipient_email = explode(',',$grower->email);
			    		$mail->subject = Yii::t('app','Spray Report '.date('Y-M-d'));
			    		$mail->sender_name = Yii::t('app', 'FGV Report');
			    		$mail->sender_email = Yii::app()->params['noreplyEmail'];
			    		$attachment = array('content'=>$pdf_as_string,'name'=>'Spray Report '.date('Y-M-d'),'type'=>'application/pdf') ; 
			    		$mail->attachment = $attachment;
			    		$mail->sendGrowerReport($arrParams);
			    		echo $grower->email." Sent ReportMail";
            		}
            		
            	}
   				
            }
  }