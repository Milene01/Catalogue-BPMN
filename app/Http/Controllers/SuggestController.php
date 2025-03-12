<?php

namespace App\Http\Controllers;

use App\Publication;
use App\Suggest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class SuggestController extends Controller
{

    public function index()
    {
        return view('publication.suggest');
    }

    public function suggestUpdate($id)
    {
        return view('publication.suggestupdate',[
            'publication'=>Publication::findOrFail($id)
        ]);
    }

    public function suggestUpdateSave(Request $request,$id)
    {
        $captcha = $request->input('g-recaptcha-response');
        $key = env('GOOGLE_RECAPTCHA_SECRET_KEY');
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$key&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $obj = json_decode($response);
        $publication = Publication::findOrFail($id);
        if($obj->success == true) {
            $suggest = $request->input('suggest');
            $user = User::where('rule','=','admin')->first();
            Mail::send(
                'mail.suggestupdate',
                ['publication'=>$publication,
                'suggest'=>$suggest,
                'email'=>$request->input('email')],
                function($m) use ($user,$request) {
                    $m->from($request->input('email'),'Catalog Manager');
                    $m->to($user->email,$user->name)->subject('New Update suggests');
                }
            );
        }
        $view = (env('CATALOG_PRESENTATION') == 'tree') ? 'treeview' : 'view';
        return redirect("/publication/$view/$publication->id")->with('status',"Ok, thanks for your suggest!");
    }

    public function submitPaper(Request $request) {
        $captcha = $request->input('g-recaptcha-response');
        $key = env('GOOGLE_RECAPTCHA_SECRET_KEY');
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$key&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $obj = json_decode($response);
        if($obj->success == true)
        {
            $user = User::where('rule','=','admin')->first();
            $pub = new Publication([
                'title'=>$request->input('title'),
                'url'=>$request->input('url')
            ]);
            $pub->save();
           Mail::send(
                'mail.suggest',
                ['title'=>$request->input('title'),
                    'url'=>$request->input('url'),
                    'email'=>$request->input('email')],
                function($m) use ($user,$request) {
                    $m->from($request->input('email'),'Catalog Manager');
                    $m->to($user->email,$user->name)->subject('New Paper suggests');
                }
            );

        }
        return redirect('/suggest')->with('status',"Ok, thanks for your suggest!");
    }

}
