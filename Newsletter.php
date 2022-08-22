<?php

    $apiKey = '9f4596726989510210b26d1fe9707a7f-us10';
    $listId = '7cd01bdc13';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $email = validate_input($_POST['email']);
        if($email)
        {
            //Create mailchimp API url
            $memberId = md5(strtolower($email));
            $dataCenter = substr($apiKey,strpos($apiKey,'-')+1);
             $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listId . '/members/' . $memberId;

            //Member info
            $data = array(
                'email_address'=>$email,
                'status' => 'subscribed',
                );
            $jsonString = json_encode($data);

            // send a HTTP POST request with curl
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonString);
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
          
            //Collecting the status
            switch ($httpCode) {
                case 200:
                    $success = 'Successfuly Subscribed';
                    break;
                case 214:
                    $success = 'Already Subscribed';
                    break;
                default:
                    $success = 'Oops, please try again.[msg_code='.$httpCode.']';
                    break;
            }
        }
            
         header('Location: '. $_POST['location']."?success=".$success."#main_section");
        
         
    }

function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }