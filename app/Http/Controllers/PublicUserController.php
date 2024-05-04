<?php

namespace App\Http\Controllers;

use App\Models\PublicUser;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class PublicUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'required|numeric',
            'password' => 'required|string',
            'user_district' => 'required',
            'user_city' => 'required|string',
            'user_school' => 'required|string',
            'user_category' => 'required',
        ]);

        $checkEmail = DB::table('public_users')->where('email', $request->email)->first();
        if ($checkEmail) {
            return redirect()->back()->with('message', 'You have already registered with this email');
        }

        $checkPhone = DB::table('public_users')->where('mobile_number', $request->mobile_number)->first();
        if ($checkPhone) {
            return redirect()->back()->with('message', 'Mobile Number already exists in the system');
        }

        $password = Hash::make($request->password);
        $publicUser = new PublicUser();
        $publicUser->name = $request->input('name');
        $publicUser->email = $request->input('email');
        $publicUser->mobile_number = $request->input('mobile_number');
        $publicUser->password = $password;
        $publicUser->user_district = $request->input('user_district');
        $publicUser->user_city = $request->input('user_city');
        $publicUser->user_school = $request->input('user_school');
        $publicUser->subject = $request->input('subject');
        $publicUser->status = 0;
        $publicUser->user_catagory = $request->input('user_category');

        $username = $request->input('name');
        $email = $request->input('email');
        $mobile_number = $request->input('mobile_number');

        $data = [
            'username' => $username,
            'email' => $email,
            'mobile_number' => $mobile_number,
        ];

        Mail::send('frontend.emailtemplate.newuser', $data, function ($message) use ($data) {
            $message->to(env('MAIL_USERNAME'));
            $message->from(env('MAIL_USERNAME'));
            $message->subject('New User has been registered');
        });

        $otpCode = mt_rand(1000, 9999);

        $publicUser->otp_code = $otpCode;
        $publicUser->save();

        $phoneNumber = $request->input('mobile_number');

        // Send the OTP code via SMS
        $api_key = '2649711E8A413C';
        $contacts = $phoneNumber;
        $from = 'SmsBit';
        $sms_text = urlencode('Your OTP Code is ' . $otpCode);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://samayasms.com.np/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=XXXXXX&routeid=XXXXXX&type=text&contacts=" . $contacts . "&senderid=" . $from . "&msg=" . $sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
        $request->session()->put('sessionUserPassword', $password);
        $request->session()->put('otp_code', $otpCode);
        $request->session()->put('phone_number', $phoneNumber);

        return redirect('/otpcode')->with('message', 'Please check your device for the OTP Code');
    }

    /**
     * Display the specified resource.
     */
    public function show(PublicUser $publicUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublicUser $publicUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PublicUser $publicUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PublicUser $publicUser)
    {
        //
    }
    public function login(Request $request)
    {
        $request->validate([
            'useremail' => 'required|email',
            'userpassword' => 'required',
        ]);

        $email = $request->useremail;
        $password = $request->userpassword;

        $user = PublicUser::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                $request->session()->put('sessionUserId', $user->id);

                $request->session()->save();

                $redirectUrl = $request->session()->pull('redirectUrl', '/');

                return redirect($redirectUrl);
            } else {
                return redirect()->back()->withErrors(['userpassword' => 'Password is incorrect.']);
            }
        } else {
            return redirect()->back()->withErrors(['useremail' => 'Email is incorrect or does not exist.']);
        }
    }

    public function forgetPassword(Request $request)
    {
        $email = $request->input('email');
        $user = PublicUser::where('email', $email)->first();

        if (!$user) {
            return redirect('/forgetpassword')->with('message', 'This email is not registered yet!');
        }

        $request->session()->put('sessionUserEmail', $user->email);
        $request->session()->save();

        $data = [
            'url' => url('/changepassword'),
            'email' => $email,
        ];

        Mail::send('frontend.emailtemplate.forgetpassword', $data, function ($message) use ($data) {
            $message->to($data['email']);
            $message->from(env('MAIL_USERNAME'));
            $message->subject('Password Reset Link form Allied Publication');
        });

        return redirect('/forgetpassword')->with('message', 'Please check your email for password reset instructions.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = PublicUser::where('email', session()->get('sessionUserEmail'))->first();
        if (!$user) {
            return redirect()->back()->with('success', 'User not found');
        }

        if (Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('success', 'Old password cannot be your new password');
        }

        $user->password = Hash::make($request->password);
        $user->save();
        $request->session()->put('sessionUserPassword', $user->password);

        return redirect('/login')->with('success', 'Your password has been changed successfully');
    }
    public function getPublicUserDetails(Request $request)
    {
        if (session()->has('sessionUserId')) {
            $userId = session()->get('sessionUserId');
            $user = \DB::table('public_users')
                ->select('*')
                ->where('id', $userId)

                ->first();

            if ($user) {
                $id = $user->id;

                $publicUsersDetails = \DB::table('public_users')

                    ->select('*')
                    ->where('id', $id)

                    ->first();

                $districts = \DB::table('user_districts')->get();
                $roles = \DB::table('user_roles')->get();

                return view('frontend.userdashboard.dashboard', compact('publicUsersDetails', 'districts', 'roles'))->with('status', 'Successful!');
            } else {
                return redirect('/login')->withErrors(['msg' => 'User not found. Please login or register.']);
            }
        }
    }

    public function acceptuser()
    {
        $acceptUser = DB::table('public_users')
            ->select('*')
            ->where('public_users.status', 0)
            ->get();

        $acceptUserData = DB::table('public_users')
            ->select('*')
            ->where('public_users.status', 1)->get();

        return view('backend.acceptuser', compact('acceptUser', 'acceptUserData'));
    }

    public function updateUser(Request $request, $id)
    {
        $acceptUser = PublicUser::findOrFail($id);
        $acceptUser->status = 1;
        $acceptUser->save();

        return redirect('/acceptuser')->with('message', 'User has been accepted successfully');
    }
    public function deleteUser(Request $request, $id)
    {
        $user = PublicUser::findOrFail($id);
        $user->delete();
        return redirect('/acceptuser')->with('message', 'User has been deleted successfully');
    }
    public function updateBasicInformation(Request $request, $id)
    {
      
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'user_school' =>'required',
            'user_city' =>'required',
        ]);

        $name = $validatedData['name'];
        $email = $validatedData['email'];
        $mobile_number = $validatedData['mobile_number'];
        $address = $validatedData['address'];
        $user_district = $validatedData['district'];
        $user_category = $validatedData['role'];
        $user_school = $validatedData['user_school'];
        $user_city = $validatedData['user_city'];

       

        $user = \DB::table('public_users')
        ->where('id', $id)
        ->where(function ($query) {
            $query->where('email_verified', 0)
                  ->orWhereNull('email_verified');
        })
        ->first();
    
    if ($user) {
         // Generate OTP code
         $otpCode = mt_rand(1000, 9999);
        \DB::table('public_users')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'address' => $address,
            'user_district' => $user_district,
            'user_catagory' => $user_category,
            'user_school' => $user_school,
            'user_city' => $user_city,
            'otp_code' => $otpCode,
            'status' => 0,
        ]);
    
        // Send the OTP code via SMS
        $api_key = '2649711E8A413C';
        $contacts = $mobile_number;
        $from = 'SmsBit';
        $sms_text = urlencode('Your OTP Code is ' . $otpCode);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://samayasms.com.np/smsapi/index.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "key=" . $api_key . "&campaign=XXXXXX&routeid=XXXXXX&type=text&contacts=" . $contacts . "&senderid=" . $from . "&msg=" . $sms_text);
        $response = curl_exec($ch);
        curl_close($ch);
        echo $response;
    
        $request->session()->put('otp_code', $otpCode);
    
        return redirect('/otpcode')->with('message', 'Please check your device for the OTP Code');
    } else {
        // Update user's information without sending OTP
        \DB::table('public_users')->where('id', $id)->update([
            'name' => $name,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'address' => $address,
            'user_district' => $user_district,
            'user_catagory' => $user_category,
            'user_city' => $user_city,
            'user_school' => $user_school,
            
        ]);
        
        return redirect()->back()->with('message', 'Data has been updated successfully');
    }
    

    }

    public function updateUserpassword(Request $request, $id)
    {

        {
            $request->validate([
                'password' => 'required|min:6',

            ]);

            $user = PublicUser::where('id', $request->id)->first();
            if (!$user) {
                return redirect()->back()->with('message', 'User not found');
            }
            if (Hash::check($request->password, $user->password)) {
                return redirect()->back()->with('message', 'Your old password cannot be new password');
            }
            $user->password = Hash::make($request->password);
            $request->session()->put('sessionUserPassword', $user->password);
            $user->save();
            return redirect()->back()->with('message', 'Password has been changed successfully');
        }
    }
    public function verfiyUserOTP(Request $request, PublicUser $publicUser)
    {
        $otp_code = $request->input('otp_code_1') . $request->input('otp_code_2') . $request->input('otp_code_3') . $request->input('otp_code_4');

        $user = PublicUser::where('id', session()->get('sessionUserId'))
            ->where('otp_code', $otp_code)
            ->first();
        if (!$user) {
            return redirect()->back()->with('message', 'You have entered the invalid OTP Code');
        }
        $request->session()->put('sessionUserId', $user->id);
        $user->email_verified = 1;
        $user->save();
        return redirect('/')->with('message', 'Your account has been verified sucesfully');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $existingUser = PublicUser::where('email', $user->email)->first();

        if ($existingUser) {
            $request->session()->put('sessionUserId', $existingUser->id);
            $request->session()->save();

            $redirectUrl = $request->session()->pull('redirectUrl', '/');

            return redirect($redirectUrl)->with('message', 'Logged in successfully!');
        } else {
            $newUser = PublicUser::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt('google@123'),
                'email_verified' => 0,
            ]);

            $request->session()->put('sessionUserId', $newUser->id);

            $request->session()->save();

            $redirectUrl = $request->session()->pull('redirectUrl', '/userdashboard');

            return redirect($redirectUrl)->with('message', 'Please fill all the details for the verification process');
        }
    }

}