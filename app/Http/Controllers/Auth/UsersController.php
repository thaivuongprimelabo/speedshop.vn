<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Helpers\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Constants\UserRole;

class UsersController extends AppController
{
    
    public $rules = [];
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->middleware('auth');
        
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new User());
        
    }
    
    /**
     * create
     * @param Request $request
     */
    public function create(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $filename = '';
                $key = 'upload_avatar';
                $demension = $this->config['config'][$key . '_image_size'];
                Utils::resizeImage($key, $request->$key, $demension, $filename);
                
                $data = new User();
                $data->name         = Utils::cnvNull($request->name, '');
                $data->email        = Utils::cnvNull($request->email, '');
                $data->password     = Hash::make(Utils::cnvNull($request->password, ''));
                $data->avatar       = $filename;
                $data->role_id      = Utils::cnvNull($request->role_id, 1);
                $data->status       = Utils::cnvNull($request->status, 0);
                $data->created_at   = date('Y-m-d H:i:s');
                $data->updated_at   = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_users_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_users_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.form', $this->output)->withErrors($validator);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = User::find($request->id);
        
        if(Auth::user()->role_id == UserRole::MOD && ($data->role_id == UserRole::SUPER_ADMIN || $data->role_id == UserRole::ADMIN)) {
            return redirect(route('auth_users'));
        }
        
        if(Auth::user()->role_id == UserRole::ADMIN && ($data->role_id == UserRole::SUPER_ADMIN)) {
            return redirect(route('auth_users'));
        }
        
        if($request->isMethod('post')) {
            
            $this->rules['password'] = '';
            $this->rules['conf_password'] = '';
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $data = User::find($request->id);
                
                $filename = $data->avatar;
                $filename_hidden = $request->avatar_hidden;
                if(Utils::blank($filename_hidden)) {
                    $filename = null;
                }
                $key = 'upload_avatar';
                $demension = $this->config['config'][$key . '_image_size'];
                Utils::resizeImage($key, $request->$key, $demension, $filename);
                
                $data->name         = Utils::cnvNull($request->name, '');
                if(!Utils::blank($request->password)) {
                    $data->password = bcrypt($request->password);
                }
                $data->avatar       = $filename;
                $data->role_id      = Utils::cnvNull($request->role_id, 1);
                $data->status       = Utils::cnvNull($request->status, 0);
                $data->updated_at   = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_users_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_users_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function profile(Request $request) {
        
        $data = User::find(Auth::id());
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            
            if (!$validator->fails()) {
                
                $filename = $data->avatar;
                $filename_hidden = $request->avatar_hidden;
                if(Utils::blank($filename_hidden)) {
                    $filename = null;
                }
                $key = 'upload_avatar';
                $demension = $this->config['config'][$key . '_image_size'];
                Utils::resizeImage($key, $request->$key, $demension, $filename);
                
                $data->name         = Utils::cnvNull($request->name, '');
                if(!Utils::blank($request->password)) {
                    $data->password = Hash::make($request->password, '');
                }
                $data->avatar       = $filename;
                $data->updated_at   = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_profile'))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_profile'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        $data = User::whereIn('id', $ids)->get();
        foreach($data as $dt) {
            Utils::removeFile($dt->avatar);
        }
        if(User::destroy($ids)) {
            $result['code'] = 200;
            return response()->json($result);
        }
    }
}
