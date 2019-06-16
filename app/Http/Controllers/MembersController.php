<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Utils;
use App\Member;
use App\User;
use App\Constants\Status;
use App\Constants\UserRole;

class MembersController extends AppController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function login(Request $request) {
        
        if($request->isMethod('post')) {
            
            $validator = [];
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            
            $messages = [
                'email.required' => trans('validation.required', ['attribute' => 'E-mail']),
                'email.email' => trans('validation.email'),
                'password.required' => trans('validation.required', ['attribute' => 'Mật khẩu']),
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if(!$validator->fails()) {
                $credential = [
                    'email' => $request->email, 
                    'password' => $request->password
                ];
                
                if (Auth::guard()->attempt($credential)) {
                    if(Auth::user()->status == Status::UNACTIVE) {
                        return redirect(route('account_unactive'));
                    }
                    return redirect('/');
                } else {
                    return redirect(route('account_login'))->with('error', trans('auth.failed'));
                }
            }
        }
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.login')]
        ];
        
        $this->setSEO(['title' => trans('shop.login')]);
        
        return view('shop.login', $this->output);
    }
    
    public function register(Request $request) {
        $result = [];
        if($request->ajax()) {
            $validator = [];
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'conf_password' => 'required|same:password',
            ];
            
            if($request->getSession()->has('captcha')) {
                $rules['captcha'] = 'required|captcha';
            }
            
            $messages = [
                'name.required' => trans('validation.required', ['attribute' => 'Họ tên']),
                'email.required' => trans('validation.required', ['attribute' => 'E-mail']),
                'email.email' => trans('validation.email'),
                'email.unique' => trans('validation.unique', ['attribute' => 'E-mail']),
                'password.required' => trans('validation.required', ['attribute' => 'Mật khẩu']),
                'conf_password.required' => trans('validation.required', ['attribute' => 'Xác nhận mật khẩu']),
                'conf_password.same' => trans('validation.same', ['attribute' => 'Mật khẩu', 'other' => 'Xác nhận mật khẩu']),
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            $errors = [];
            
            if(!$validator->fails()) {
                
                $token = str_random(8);
                
                $member = new User();
                $member->name = Utils::cnvNull($request->name, '');
                $member->email = Utils::cnvNull($request->email, '');
                $member->password = bcrypt($request->password);
                $member->phone = Utils::cnvNull($request->phone, '');
                $member->address = Utils::cnvNull($request->address, '');
                $member->role_id = UserRole::MEMBERS;
                $member->status = Status::UNACTIVE;
                $member->created_at = date('Y-m-d H:i:s');
                $member->updated_at = date('Y-m-d H:i:s');
                $member->active_token = $token;
                
                $config = [
                    'from' => $this->output['config']['mail_from'],
                    'from_name' => $this->output['config']['mail_name'],
                    'subject' => '[' . $this->output['config']['web_name'] . '] '  . trans('shop.mail_subject.register'),
                    'msg' => [
                        'name' => $request->name,
                        'url' => route('account_active', ['token' => $token])
                    ],
                    'to'       => $request->email,
                    'template' => 'shop.emails.active_register'
                ];
                
                $message = Utils::sendMail($config);
                if(Utils::blank($message)) {
                    if($member->save()) {
                        $result['#register_success'] = trans('messages.REG_SUCCESS', ['email' => $request->email]);
                        $result['#captcha_img'] = captcha_img('flat');
                    }
                } else {
                    \Log::error($message);
                    $result['#register_error'] = trans('messages.ERROR');
                }
            }
            else {
                $errors = $validator->errors();
                $result['#register_error'] = $this->createErrorList($errors->toArray());
            }
            return response()->json($result);
        }
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.register')]
        ];
        
        $this->setSEO(['title' => trans('shop.register')]);
        
        return view('shop.register', $this->output);
    }
    
    public function profile(Request $request) {
        
        $result = [];
        if($request->ajax()) {
            $validator = [];
            $rules = [
                'name' => 'required',
            ];
            
            if($request->getSession()->has('captcha')) {
                $rules['captcha'] = 'required|captcha';
            }
            
            $messages = [
                'name.required' => trans('validation.required', ['attribute' => 'Họ tên']),
            ];
            
            if(!Utils::blank($request->password)) {
                $rules['conf_password'] = 'required|same:password';
                $messages['conf_password.required'] = trans('validation.required', ['attribute' => 'Xác nhận mật khẩu']);
                $messages['conf_password.same'] = trans('validation.same', ['attribute' => 'Mật khẩu', 'other' => 'Xác nhận mật khẩu']);
            }
            
            $validator = Validator::make($request->all(), $rules, $messages);
            $errors = [];
            
            if(!$validator->fails()) {
                
                $token = bcrypt(str_random(8));
                
                $member = User::find(Auth::id());
                $member->name = Utils::cnvNull($request->name, '');
                if(!Utils::blank($request->password)) {
                    $member->password = bcrypt($request->password);
                }
                $member->address = Utils::cnvNull($request->address, '');
                $member->phone = Utils::cnvNull($request->phone, '');
                $member->updated_at = date('Y-m-d H:i:s');
                
                if($member->save()) {
                    $result['#update_profile_success'] = trans('messages.UPDATE_SUCCESS');
                    $result['#captcha_img'] = captcha_img('flat');
                }
            }
            else {
                $errors = $validator->errors();
                $result['#update_profile_error'] = $this->createErrorList($errors->toArray());
            }
            return response()->json($result);
        }
        
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.profile_txt')]
        ];
        
        $this->setSEO(['title' => trans('shop.profile_txt')]);
        
        return view('shop.profile', $this->output);
    }
    
    public function active(Request $request) {
        if(!Utils::blank($request->token)) {
            $user = User::where('active_token', $request->token)->where('status', Status::UNACTIVE)->first();
            
            if($user) {
                $user->status = Status::ACTIVE;
                $user->active_token = '';
                
                if($user->save()) {
                    $this->output['breadcrumbs'] = [
                        ['link' => '#', 'text' => trans('shop.active_account')]
                    ];
                    return view('shop.active_account', $this->output);
                }
            }
        }
        
        return abort(404);
    }
    
    public function unactive(Request $request) {
        $this->output['breadcrumbs'] = [
            ['link' => '#', 'text' => trans('shop.unactive_account')]
        ];
        return view('shop.unactive_account', $this->output);
    }
    
    public function recover(Request $request) {
        if($request->isMethod('post')) {
            
            $validator = [];
            $rules = [
                'recover_email' => 'required|email',
            ];
            
            $messages = [
                'recover_email.required' => trans('validation.required', ['attribute' => 'E-mail']),
                'recover_email.email' => trans('validation.email'),
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
            
            if(!$validator->fails()) {
                $newPassword = str_random(8);
                
                $user = User::where('email', $request->recover_email)->first();
                if($user) {
                    $user->password = bcrypt($newPassword);
                    
                    $config = [
                        'from' => $this->output['config']['mail_from'],
                        'from_name' => $this->output['config']['mail_name'],
                        'subject' => '[' . $this->output['config']['web_name'] . '] ' . trans('shop.mail_subject.reset_password'),
                        'msg' => [
                            'name' => $user->name,
                            'newPassword' => $newPassword
                        ],
                        'to'       => $user->email,
                        'template' => 'shop.emails.reset_password'
                    ];
                    
                    $message = Utils::sendMail($config);
                    if(Utils::blank($message)) {
                        if($user->save()) {
                            return redirect(route('account_login'))->with('success', trans('messages.RESET_PASSWORD_SUCCESS', ['email' => $user->email]));
                        }
                    } else {
                        \Log::error($message);
                    }
                }
            } else {
                return redirect(route('account_login'))->with('error', trans('messages.ERROR'));
            }
        }
    }
    
    public function logout(Request $request) {
        Auth::guard()->logout();
        
        return redirect('/');
    }
    
    public function checkCaptcha(Request $request) {
        $result = [
            'code' => 200,
            'data' => ''
        ];
        
        $captcha = $request->captcha;
        
        $rules = [
            'captcha' => 'required|captcha'
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()) {
            $result['data'] = trans('validation.captcha');
        }
        
        return response()->json($result);
    }
    
    
    public function refreshCaptcha() {
        $captcha = captcha_img('flat');
        return response()->json(['#captcha_img' => $captcha]);
    }
}
