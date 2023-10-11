<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Invitation;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Mail\InvitationEmail;
use Twilio\Rest\Client;
class GroupInvitationController extends Controller
{
    public function invite(Request $request, $groupId, $email)
{
   
// $userdata = User::where('email', $email)->first();
//   $user_id=$userdata['id'];
    $random = Str::random(40);
            
    // Save the token in the user's remember_token field
    $userId = auth()->user()->id;

    $details = Invitation::create([
                'group_id' => $groupId,
                'user_id' =>$userId,
                'email' => $email,
                'token' => $random ,
            ]);

    // Generate the verification URL
    $domain = URL::to('/');
    $url = $domain . '/Invitation-Acccepted/' . $random;

    // Prepare data for the email
    $data = [
        'url' => $url,
        'email' => $email,
        'title' => 'Group Invitation',
        'message' => 'Please click here to accept and Joint group',
    ];
Mail::to('sardarnawaz122@gmail.com')->send(new InvitationEmail($data));
    


    return response()->json(['success' => true, 'msg' => ' Group Invitation is sent successfully']);
}  
 
    




    public function acceptInvitation($token)
    {
     // Find the Invitation record by token
        $invitation = Invitation::where('token', $token)->first();
        $email = $invitation['email'];
        $user = User::where('email', $email)->first();
        // $user_id=$invitation['user_id'];
if($user){
        if (!$invitation) {
            return response()->json(['error' => 'Invitation not found'], 404);
        }

         

        $tasks = Task::where('group_id', $invitation->group_id)->get();
$groups=Invitation::where('group_id', $invitation->group)->get()->all();
        return response()->json(['tasks' => $tasks],);
       
    }
else{
return redirect('https://play.google.com/store/apps/details?id=com.webstore&hl=en&gl=US&pli=1');
}
    
    
}

// whatsapp channel
public function sendWhatsAppMessage(Request $request, $groupId, $email)
    {
 
 
        $random = Str::random(40);

        $userId = auth()->user()->id;
    
        $details = Invitation::create([
            'group_id' => $groupId,
            'user_id' => $userId,
            'email' => $email,
            'token' => $random,
        ]);
    
        // Generate the verification URL
        $domain = URL::to('/');
        $url = $domain . '/Invitation-Acccepted/' . $random;
        $message = 'Click here to accept the invitation: ' . $url;


        // Prepare data for the email
    
        $sid = "AC7cae3c19e6305cc077e6c89556f8bb81";
        $token = "42ca72cf2be9e23792db5682f6d624eb";
        $twilio = new Client($sid, $token);
    
        $data = [
            'url' =>  $message,
            // 'email' => $email,
            'title' => 'Group Invitation',
            'message' => 'Please click here to accept and Joint group',
        ];
    
        $json = json_encode( $message);
    
        $message = $twilio->messages
            ->create("whatsapp:+923145184047", // to
                array(
                    "from" => "whatsapp:+14155238886",
                    "body" => $json,
                )
            );
    
        return response()->json(['id'=> $details, 'msg'=> "Invitation has been sent successfully to end user whatsapp number"]);
    }
}
