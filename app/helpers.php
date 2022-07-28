<?php
use App\User;
use App\Leave;
use App\EmployeeDetails;

if(! function_exists('WelcomeMail')){

  function WelcomeMail($user)
  {
  
          
    $to_name =$user['name'];
    $to_email =$user['email'];
    $data = array('user'=>$user);
  
    Mail::send('welcome_mail', $data, function($message) use ($to_name, $to_email) {
    $message->to($to_email, $to_name)->subject('Welcome mail');
    $message->from('pramodbit254@gmail.com','Best Hawk');
    });
  }
  }
  if(! function_exists('LeaveMail')){

    function LeaveMail($user)
    {
    
      $sendto;
      $moreUsers;  
      $from_name =$user['name'];
      $from_email =$user['email'];
      $leavedetails=Leave::with('leavetype')->where('emp_id',$user['id'])->orderBy('id','DESC')->first();

      $data = array('user'=>$user,'leavedetails'=>$leavedetails);
      $department=EmployeeDetails::where('emp_id',$user['id'])->first();
      if($department['department']==3){
        $sendto='rohitt@besthawk.com';
        $moreUsers=array('nikita@besthawk.com','vaidehi@besthawk.com');
      }else{
        $sendto='nikita@besthawk.com';
        $moreUsers=array('vaidehi@besthawk.com');
      }

      
      // dd($data);
      // $moreUsers=array('nikita@besthawk.com');
      Mail::send('leave_mail', $data, function($message) use ($sendto,$from_name, $from_email,$moreUsers,$leavedetails) {
      $message->to($sendto)->subject($leavedetails['leavetype']['name']);
      $message->cc($moreUsers);
      $message->from($from_email,$from_name);
      });
      $title=$user['name'].' Applied For the Leave';
      sendLoginNotification($user,$title);
    }
    }

    if(! function_exists('sendLoginNotification')){

      function sendLoginNotification($user,$title)
      {
      
              
        $url='https://fcm.googleapis.com/fcm/send';
        $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
          
        $SERVER_API_KEY ='AAAA7MRnEiQ:APA91bGKhmneJd6KOut7t2pFQxQubAWVglh5tYEE81TL2KI8Va3SPlftjWt5G4UmkKLoI8H4PsfkLmVx8fPu_eFMxgwrgALnXC4xn72t_-HQmqQiIpih1CWWPyFPFjFd2GUn_LevGPzw';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" =>$title,
                "body" =>$user->name,
                "image"=>url('public/profile/'.$user->profile_image), 
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
               
        $response = curl_exec($ch);
  
        curl_close($ch);

        // FCM response
        return $response;   
      }
      }
      if(! function_exists('sendEventNotification')){

        function sendEventNotification($value)
        {
        
                
          $url='https://fcm.googleapis.com/fcm/send';
          $firebaseToken = User::whereNotNull('fcm_token')->pluck('fcm_token')->all();
            
          $SERVER_API_KEY ='AAAA7MRnEiQ:APA91bGKhmneJd6KOut7t2pFQxQubAWVglh5tYEE81TL2KI8Va3SPlftjWt5G4UmkKLoI8H4PsfkLmVx8fPu_eFMxgwrgALnXC4xn72t_-HQmqQiIpih1CWWPyFPFjFd2GUn_LevGPzw';
    
          $data = [
              "registration_ids" => $firebaseToken,
              "notification" => [
                  "title" =>$value['title'],
                  "body" =>$value['title'],  
              ]
          ];
          $dataString = json_encode($data);
      
          $headers = [
              'Authorization: key=' . $SERVER_API_KEY,
              'Content-Type: application/json',
          ];
      
          $ch = curl_init();
        
          curl_setopt($ch, CURLOPT_URL,$url);
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                 
          $response = curl_exec($ch);
    
          curl_close($ch);
  
          // FCM response
          return $response;   
        }
        }

 if(! function_exists('AssetsEmail')){

          function AssetsEmail($user,$last_data,$employee_details)
          {
            $from_name =$user['name'];
            $from_email =$user['email'];
      
            $data = array('user'=>$user,'last_data'=>$last_data,'employee_details'=>$employee_details);
      
            $moreUsers=array('pramod@besthawk.com');
            Mail::send('assets_email', $data, function($message) use ($from_name, $from_email,$moreUsers) {
            $message->to('nikita@besthawk.com')->subject('System Allotment');
            $message->cc($moreUsers);
            $message->from($from_email,$from_name);
            });
          }
          }

  if(! function_exists('getIndianCurrency')){
function getIndianCurrency(float $number)
{
$decimal = round($number - ($no = floor($number)), 2) * 100;
$hundred = null;
$digits_length = strlen($no);
$i = 0;
$str = array();
$words = array(
   0 => '', 1 => 'one', 2 => 'two',
   3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
   7 => 'seven', 8 => 'eight', 9 => 'nine',
   10 => 'ten', 11 => 'eleven', 12 => 'twelve',
   13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
   16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
   19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
   40 => 'forty', 50 => 'fifty', 60 => 'sixty',
   70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
);
$digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
while ($i < $digits_length) {
   $divider = ($i == 2) ? 10 : 100;
   $number = floor($no % $divider);
   $no = floor($no / $divider);
   $i += $divider == 10 ? 1 : 2;
   if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
      $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
   } else $str[] = null;
}
$Rupees = implode('', array_reverse($str));
$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}
    }

if(! function_exists('LoginLogs')){

function LoginLogs($user)
{

  $c_ip= App\LoginLogModel::get_ip();
  $c_browser= App\LoginLogModel::get_browser();
  $c_os= App\LoginLogModel::get_os();
  $c_device= App\LoginLogModel::get_device(); 

  $loginlog= new App\LoginLogModel;
  $loginlog->emp_id=$user['id'];
  $loginlog->mobile=$user['mobile'];
  $loginlog->location=$user['location'];
  $loginlog->email=$user['email'];
  $loginlog->ip_address= $c_ip;
  $loginlog->c_browser= $c_browser;
  $loginlog->c_os= $c_os;
  $loginlog->c_device= $c_device;
  $loginlog->save();
}
}



if(! function_exists('ClockInOut')){

  function ClockInOut($user)
  {
  
    $c_ip= App\LoginLogModel::get_ip();
    $c_browser= App\LoginLogModel::get_browser();
    $c_os= App\LoginLogModel::get_os();
    $c_device= App\LoginLogModel::get_device(); 
  
    $loginlog= new App\ClockInOut;
    $loginlog->emp_id=$user['id'];
    $loginlog->mobile=$user['mobile'];
    $loginlog->location=$user['location'];
    $loginlog->email=$user['email'];
    $loginlog->ip_address= $c_ip;
    $loginlog->c_browser= $c_browser;
    $loginlog->c_os= $c_os;
    $loginlog->c_device= $c_device;
    $loginlog->save();
  }
  }