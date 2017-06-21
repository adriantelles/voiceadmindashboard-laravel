<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;

use Config;
use DB;

class IdiomController extends BasicController
{
    /*
     |--------------------------------------------------------------------------
     | HomeController Controller
     |--------------------------------------------------------------------------
     |
     | This controller handles authenticating users for the application and
     | redirecting them to your home screen. The controller uses a trait
     | to conveniently provide its functionality to your applications.
     |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }
    
    public function index(){

        $interdict_idiom = DB::table('t_interdict_idiom')->first();
        if($interdict_idiom!=null)
            $content=$interdict_idiom->content;
        else
            $content="";
        return view('idiom_manage.index',['menu_index'=>9,'content'=>$content]);
    }

    public function save_interdict_idiom(){
        
        $content=$_POST['idiom_str'];

        $interdict_idiom = DB::table('t_interdict_idiom')->first();
        if($interdict_idiom==null){
            $result=DB::table('t_interdict_idiom')->insert(
                ['content' => $content,'updated_at'=>null, 'created_at' => date('Y-m-d H:i:s')]
            );
            if($result){
                return view('idiom_manage.select_idiom',['content'=>$content]);
            }
            else
                return config('constants.FAIL');
        }
        else{
            $no=$interdict_idiom->no;
            $content_str=$interdict_idiom->content.','.$content;

            $result=DB::table('t_interdict_idiom')
                ->where('no', $no)
                ->update(['content' => $content_str,'updated_at'=>date('Y-m-d H:i:s')]);

            if($result){
                return view('idiom_manage.select_idiom',['content'=>$content_str]);
            }
            else
                return config('constants.FAIL');
        }

    }

    public function del_selected_idiom(){
        $content=$_POST['idiom_str'];
        $interdict_idiom = DB::table('t_interdict_idiom')->first();
        if($interdict_idiom==null){
            $result=DB::table('t_interdict_idiom')->insert(
                ['content' => $content,'updated_at'=>null, 'created_at' => date('Y-m-d H:i:s')]
            );
            if($result){
                return view('idiom_manage.select_idiom',['content'=>$content]);
            }
            else
                return config('constants.FAIL');
        }
        else{
            $no=$interdict_idiom->no;

            $result=DB::table('t_interdict_idiom')
                ->where('no', $no)
                ->update(['content' => $content,'updated_at'=>date('Y-m-d H:i:s')]);

            if($result){
                return view('idiom_manage.select_idiom',['content'=>$content]);
            }
            else
                return config('constants.FAIL');
        }
    }
}
