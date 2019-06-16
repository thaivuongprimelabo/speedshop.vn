<?php

namespace App\Http\Controllers\Auth;

use App\Banner;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannersController extends AppController
{
    
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Banner());
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
                
                $select_type = Utils::cnvNull($request->select_type, 'use_image');
                $data = new Banner();
                if($select_type == 'use_image') {
                    $filename = '';
                    $key = 'upload_banner';
                    $demension = $this->config['config'][$key . '_image_size'];
                    Utils::resizeImage($key, $request->$key, $demension, $filename);
                    $data->link           = Utils::cnvNull($request->link, '');
                    $data->banner         = $filename;
                } else {
                    $data->youtube_id    = Utils::cnvNull($request->youtube_embed_url, '');
                }
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->select_type    = Utils::cnvNull($request->select_type, 'use_image');
                $data->created_at     = date('Y-m-d H:i:s');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_banners_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_create'))->with('error', trans('messages.ERROR'));
            }
        }
        
        return view('auth.form', $this->output);
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Banner::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $select_type = Utils::cnvNull($request->select_type, 'use_image');
                if($select_type == 'use_image') {
                    $filename = $data->banner;
                    $filename_hidden = $request->banner_hidden;
                    if(Utils::blank($filename_hidden)) {
                        $filename = null;
                    }
                    
                    $key = 'upload_banner';
                    $demension = $this->config['config'][$key . '_image_size'];
                    Utils::resizeImage($key, $request->$key, $demension, $filename);
                    $data->link           = Utils::cnvNull($request->link, '');
                    $data->banner         = $filename;
                    $data->youtube_id    = '';
                } else {
                    $data->youtube_id    = Utils::cnvNull($request->youtube_embed_url, '');
                    $data->link           = '';
                    $data->banner         = '';
                }
                
                $data->description    = Utils::cnvNull($request->description, '');
                $data->status         = Utils::cnvNull($request->status, 0);
                $data->select_type    = Utils::cnvNull($request->select_type, 'use_image');
                $data->updated_at     = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
            } else {
                return redirect(route('auth_banners_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        $data = Banner::whereIn('id', $ids)->get();
        foreach($data as $dt) {
            Utils::removeFile($dt->banner);
        }
        if(Banner::destroy($ids)) {
            $result['code'] = 200;
            return response()->json($result);
        }
    }
}
