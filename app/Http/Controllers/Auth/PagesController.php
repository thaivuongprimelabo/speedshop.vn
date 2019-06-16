<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Page;
use App\Constants\Common;
use App\Helpers\Utils;
use App\Post;

class PagesController extends AppController
{
    public $rules = [];
    
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->rules = [];
    }
    
    public function index(Request $request) {
        return view('auth.index', $this->search($request));
    }
    
    /**
     * search
     * @param Request $request
     */
    public function search(Request $request) {
        return $this->doSearch($request, new Page());
    }
    
    /**
     * edit
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Page::find($request->id);
        
        if($request->isMethod('post')) {
            
            $validator = Validator::make($request->all(), $this->rules);
            
            if (!$validator->fails()) {
                
                $data->content = Utils::cnvNull($request->content, '');
                $data->updated_at = date('Y-m-d H:i:s');
                if($data->save()) {
                    return redirect(route('auth_pages_edit', ['id' => $request->id]))->with('success', trans('messages.UPDATE_SUCCESS'));
                }
                
            } else {
                return redirect(route('auth_pages_edit', ['id' => $request->id]))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
}
