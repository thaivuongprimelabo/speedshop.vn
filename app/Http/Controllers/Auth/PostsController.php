<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostsController extends AppController
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
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Post());
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
                $key = 'upload_photo';
                $demension = $this->config['config'][$key . '_image_size'];
                Utils::doUploadSimple($request, $key, $filename);
                
                $data = new Post();
                $data->name              = Utils::cnvNull($request->name, '');
                $data->name_url          = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->description       = Utils::cnvNull($request->description, 0);
                $data->content           = Utils::cnvNull($request->content, '');
                $data->photo             = $filename;
                $data->published_at      = Utils::cnvNull($request->published_at, '');
                $data->published_time_at = Utils::cnvNull($request->published_time_at, '');
                $data->post_group_id      = Utils::cnvNull($request->post_group_id, 0);
                $data->status            = Utils::cnvNull($request->status, 0);
                $data->seo_keywords      = Utils::cnvNull($request->seo_keywords, '');
                $data->seo_description   = Utils::cnvNull($request->seo_description, $request->description);
                $data->created_at        = date('Y-m-d H:i:s');
                $data->updated_at        = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_posts_create'))->with('success', trans('messages.CREATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_create'))->with('error', trans('messages.ERROR'));
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
        
        $data = Post::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                $filename = $data->photo;
                $filename_hidden = $request->photo_hidden;
                if(Utils::blank($filename_hidden)) {
                    $filename = null;
                }
                
                $key = 'upload_photo';
                Utils::doUploadSimple($request, $key, $filename);
                
                $published_at = date('Ymd', strtotime($request->input('published_at', date('Ymd'))));
                $published_time_at = date('Hi', strtotime($request->input('published_time_at', date('H:i'))));
                
                $data->name                 = Utils::cnvNull($request->name, '');
                $data->name_url             = Utils::createNameUrl(Utils::cnvNull($request->name, ''));
                $data->description          = Utils::cnvNull($request->description, 0);
                $data->content              = Utils::cnvNull($request->content, '');
                $data->photo                = $filename;
                $data->published_at         = $published_at;
                $data->published_time_at    = $published_time_at;
                $data->status               = Utils::cnvNull($request->status, 0);
                $data->post_group_id      = Utils::cnvNull($request->post_group_id, 0);
                $data->seo_keywords      = Utils::cnvNull($request->seo_keywords, '');
                $data->seo_description   = Utils::cnvNull($request->seo_description, $request->description);
                $data->updated_at           = date('Y-m-d H:i:s');
                
                if($data->save()) {
                    return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_posts_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        $data = Post::whereIn('id', $ids)->get();
        foreach($data as $dt) {
            Utils::removeFile($dt->photo);
        }
        if(Post::destroy($ids)) {
            $result['code'] = 200;
            return response()->json($result);
        }
    }
}
