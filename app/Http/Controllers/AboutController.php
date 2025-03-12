<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Gate;


class AboutController extends Controller
{

    private $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('about',[
            'admins'=>$this->userRepository->listAdmin(),
            'teamMembers'=>$this->userRepository->listTeamMember()
        ]);
    }
}
