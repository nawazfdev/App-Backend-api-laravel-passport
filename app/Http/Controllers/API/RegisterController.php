<?php
    
namespace App\Http\Controllers\API;
use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Mail\EmailTesting;


class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)->first();

if ($user) {
    return response()->json(['success' => false, 'msg' => 'User already exists']);
}

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $user = User::where('email', $request->email)->first();
    
        if ($user) {
            $random = Str::random(40);
                    
            // Save the token in the user's remember_token field
            $user->remember_token = $random;
            $user->save();
    
            // Generate the verification URL
            $domain = URL::to('/');
            $url = $domain . '/email-verified/' . $random;
    
            // Prepare data for the email
            $data = [
                'url' => $url,
                'email' => $request->email,
                'title' => 'Email Verification',
                'message' => 'Please click to verify your email address',
            ];
    Mail::to('sardarnawaz122@gmail.com')->send(new EmailTesting($data));
        // return $this->sendResponse($success, 'Check your mail to conform password');
        return response()->json(['success' => true, 'msg' => 'Email verification sent']);

        } else {
            return response()->json(['success' => false, 'msg' => 'User not found']);
        }
    }
    

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */ 
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // Check if the user has verified their email
            if (!$user->hasVerifiedEmail()) {
                // Send a new verification email
                $this->sendVerify($user->email);
    
                return $this->sendError('Unverified', ['error' => 'Email not verified. A new verification email has been sent. Please check your email and verify your account.']);
            }
    
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;
    
            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized']);
        }
    }
    public function sendVerify($email) {
        $user = User::where('email', $email)->first();
    
        if ($user) {
            $random = Str::random(40);
                    
            // Save the token in the user's remember_token field
            $user->remember_token = $random;
            $user->save();
    
            // Generate the verification URL
            $domain = URL::to('/');
            $url = $domain . '/email-verified/' . $random;
    
            // Prepare data for the email
            $data = [
                'url' => $url,
                'email' => $email,
                'title' => 'Email Verification',
                'message' => 'Please click to verify your email address',
            ];
    Mail::to('sardarnawaz122@gmail.com')->send(new EmailTesting($data));
           

    
            return response()->json(['success' => true, 'msg' => 'Email verification sent']);
        } else {
            return response()->json(['success' => false, 'msg' => 'User not found']);
        }
    }
  

public function emailverificaton($token){

$user=User::where('remember_token',$token)->get();
if(count($user)>0){


    $datetime=Carbon::now()->format('Y-m-d H:i:s');
    $user=User::find($user[0]['id']);
    // $user->remember_token='';
    $user->email_verified_at=$datetime;
    $user->save();
    // return response()->json(["msg" => "Email Verified Successfully"]);
    return view('Email_Verified');

    
}
else{


    // hrer we need to load 404 view page
    // return view('404');
    dd('something is wrong');
}
}




}