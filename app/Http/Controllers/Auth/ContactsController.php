<?php

namespace App\Http\Controllers\Auth;

use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Contact;
use App\Constants\ContactStatus;

class ContactsController extends AppController
{
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
        return $this->doSearch($request, new Contact());
    }
    
    /**
     * create
     * @param Request $request
     */
    public function edit(Request $request) {
        
        $request->flash();
        
        $validator = [];
        
        $data = Contact::find($request->id);
        
        if($request->isMethod('post')) {
            
            
            $validator = Validator::make($request->all(), [
                'reply_content' => 'required',
            ]);
            
            if (!$validator->fails()) {
                
                $filename = '';
                $data->reply_content = Utils::cnvNull($request->reply_content, '');
                $data->status        = ContactStatus::REPLIED_CONTACT;
                $data->updated_at    = date('Y-m-d H:i:s');
                
                // Config mail
                $config = [
                    'from' => $this->config['config']['mail_from'],
                    'from_name' => $this->config['config']['mail_name'],
                    'subject' => '[Reply to: '.$data->email . ']' . $data->subject,
                    'msg' => [
                        'name' => $data->name,
                        'content' => $data->reply_content,
                        'config' => $this->config['config']
                    ],
                    'to' => $data->email,
                    'template' => 'auth.emails.reply'
                ];
                
                $message = Utils::sendMail($config);
                if(Utils::blank($message)) {
                    if($data->save()) {
                        return redirect(route('auth_contacts'))->with('success', trans('messages.UPDATE_SUCCESS'));
                    }
                } else {
                    \Log::error($message);
                    return redirect(route('auth_contacts'))->with('error', trans('messages.SEND_MAIL_ERROR'));
                }
            } else {
                return redirect(route('auth_contacts'))->with('error', trans('messages.ERROR'));
            }
        }
        
        $this->output['data'] = $data;
        return view('auth.form', $this->output);
    }
    
    public function remove(Request $request) {
        $result = ['code' => 404];
        $ids = $request->ids;
        if(Contact::destroy($ids)) {
            $result['code'] = 200;
            return response()->json($result);
        }
    }
}
