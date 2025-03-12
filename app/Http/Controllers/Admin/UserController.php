<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        if(Gate::denies('rule','admin')) return abort(403);
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        return view('admin.user.list',[
            'users'=>$this->userRepository->listPaginate()
        ]);
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        return view('admin.user.form',[
            'user'=>$user
        ]);
    }
    
    public function save(Request $request)
    {
        $user = $this->userRepository->findById($request->input('id'));
        //$user->rule = 'team';
        try {
            $user->save();
        } catch (QueryException $e) {
            return redirect('/admin/user')->with('error',"Error: $e");
        }
        return redirect('/admin/user')->with('status',"User {$user->name} saved!");
    }

}
