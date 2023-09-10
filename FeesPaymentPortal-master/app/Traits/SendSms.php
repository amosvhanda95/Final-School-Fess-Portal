<?php

namespace App\Traits;

trait SendSms
{
    public function sendSms($message , $phoneNumber)
    {


        $data = array('from' => 'POSB FEES PAYMENT',
            'to' => '. $phoneNumber .',
            'text' => 'You received a new Payment'
        );
        $data_string = json_encode($data);

        $ch = curl_init('http://api.messaging-service.com/sms/1/text/single');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Basic: WlNFMzpac2VAMjAxNQ==',
                'Authorization: Basic WlNFMzpac2VAMjAxNQ==',
                'Content-Type: application/json'
            )
        );



        //send the sms through
        try{
            $result = curl_exec($ch);
            $sent = true;

        }catch(Exception $e){
            $sent = false;
            $logMessage = ''.getDateToday().' '. $mobile.' with Email '. $email. ' : Could not receive the OTP :'.$otp.'  for an Email Activation Link. \r\n';
            dd($e->getMessage());
        }
    }


}
