<?php

namespace App\Providers;

use Microsoft\Graph\Graph;
use App\Models\OfficeMail;
use Illuminate\Support\Facades\File;

class OfficeEmailProvider
{
    private $data;
    private $path;
    public function __construct()
    {
        $this->path = storage_path('_office.json');
        $gettoken = "";
        $this->refreshToken();
      
    }


    private function expired()
    {
        return ($this->data->expires_on - time()) < 60;
    }

    public function send( $mail)
    {
        if ($this->expired()) {
            $this->refreshToken();
            $this->send($mail);
        }else{    
            try {
                //code...
                //echo time().": "."sending mail to : ".$mail->emails .PHP_EOL;
                $graph = new Graph();
                $graph->setAccessToken($this->data->access_token);
                $mailBody = array(
                    "Message" => array(
                        "subject" => $mail->subject,
                        "body" => array(
                            "contentType" => "html",
                            "content" => $mail->mail
                        ),
                        // "toRecipients" => $recipients
                        "toRecipients" => json_decode($mail->emails)
                    )
                );
                dd($mailBody);
        
                $graph->createRequest("POST", "/users/".env('MAIL_FROM_ADDRESS')."/sendMail")
                    ->attachBody($mailBody)
                    ->execute();
                //echo time().": "."mail sent to : ".$mail->emails .PHP_EOL;

                return true;
            } catch (\Throwable $th) {
                return false;
                // echo time().": "."mail not sent to : ".$mail->emails .PHP_EOL;
                // echo time().": "."reason : ".$th->getMessage().PHP_EOL;

            }
        }
    }

    public function sendUrgent( $mail)
    {
        
        if ($this->expired()) {
            $this->refreshToken();
            $this->sendUrgent($mail);
        }else{    
            try {
                OfficeMail::where('id', $mail->id)->update(['pulled' => 1]);
                
                // echo time().": "."sending mail to : ".$mail->emails .PHP_EOL;
                $graph = new Graph();
                $graph->setAccessToken($this->data->access_token);
                $mailBody = array(
                    "Message" => array(
                        "subject" => $mail->subject,
                        "body" => array(
                            "contentType" => "html",
                            "content" => $mail->mail
                        ),
                       
                        "toRecipients" => json_decode($mail->emails)
                    )
                );
               
                dd($mailBody);
                $graph->createRequest("POST", "/users/info@puse.edu.np/sendMail")
                    ->attachBody($mailBody)
                    ->execute();
                // echo time().": "."mail sent to : ".$mail->emails .PHP_EOL;
                OfficeMail::where('id', $mail->id)->update(['sent' => 1]);

                return true;
            } catch (\Throwable $th) {
                return false;
                // echo time().": "."mail not sent to : ".$mail->emails .PHP_EOL;
                // echo time().": "."reason : ".$th->getMessage().PHP_EOL;

            }
        }
    }

    public function sendRaw($name,$email,$message,$subject)
    {
        if ($this->expired()) {
            $this->refreshToken();
            $this->sendRaw($name,$email,$message,$subject);
        }else{    
            $mail=new OfficeMail();
            $mail->subject=$subject;
            $mail->mail=$message;
            $mail->emails=json_encode([
                [
                    'emailAddress' => [
                        'name' => $name,
                        'address' => env('mockofficeemail',false)?"cms@puse.edu.np":$data[0],
                    ]
                ]
            ]);
            try {
                
                // echo time().": "."sending mail to : ".$mail->emails .PHP_EOL;
                $graph = new Graph();
                $graph->setAccessToken($this->data->access_token);
                $mailBody = array(
                    "Message" => array(
                        "subject" => $mail->subject,
                        "body" => array(
                            "contentType" => "html",
                            "content" => $mail->mail
                        ),
                       
                        "toRecipients" => json_decode($mail->emails)
                    )
                );
               
                dd($mailBody);
                $graph->createRequest("POST", "/users/info@puse.edu.np/sendMail")
                    ->attachBody($mailBody)
                    ->execute();
                // echo time().": "."mail sent to : ".$mail->emails .PHP_EOL;
                $mail->sent=1;
                $mail->pulled=1;
                $mail->save();

                return true;
            } catch (\Throwable $th) {
                $mail->sent=0;
                $mail->pulled=0;
                $mail->save();
                return false;
                // echo time().": "."mail not sent to : ".$mail->emails .PHP_EOL;
                // echo time().": "."reason : ".$th->getMessage().PHP_EOL;

            }
        }
    }

    public function refreshToken()
    {
        $ok=false;
        if (File::exists($this->path)) {
            try {
                $this->data = json_decode(file_get_contents($this->path));
                if (!$this->expired()) {
                    // echo time().": ". "using old token". PHP_EOL;
                    $ok=true;
                }

            } catch (\Throwable $th) {
                throw $th;
            }
        } 
        if(!$ok){
            //echo time().": "."refeshing token". PHP_EOL;

            $guzzle = new \GuzzleHttp\Client();
            $url = 'https://login.microsoftonline.com/'.env('tenent_id','').'/oauth2/token?api-version=1.0';
            $this->data = json_decode($guzzle->post($url, [
                'form_params' => [
                    'client_id' => env('client_id'),
                    'client_secret' =>env('client_secret'),
                    'resource' => 'https://graph.microsoft.com/',
                    'grant_type' => 'client_credentials',
                ],
            ])->getBody()->getContents());
            file_put_contents($this->path, json_encode($this->data));
        }
    }
}
