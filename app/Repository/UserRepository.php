<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 04/05/16
 * Time: 12:19
 */

namespace App\Repository;

use App\User;

class UserRepository
{

    public function listAll()
    {
        return User::all();
    }

    public function listPaginate()
    {
        return User::orderBy('name')->paginate(50);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function check(\Laravel\Socialite\Contracts\User $oAuthUser,$provider)
    {
        $user = User::where('social_id','=',$oAuthUser->getId())->orWhere('email','=',$oAuthUser->getEmail())->first();
        if(!$user){
            $user = new User([
                'rule'=>'user',
            ]);
        }
        $user->name = $oAuthUser->getName();
        $user->social_id = $oAuthUser->getId();
        $user->provider = $provider;
        $user->email = $oAuthUser->getEmail();
        $user->avatar = $oAuthUser->getAvatar();
        $user->save();
        return $user;
    }


    /**
     * List of Admin members ordered by name
     * @return mixed
     */
    public function listAdmin()
    {
        return User::where('rule','=','admin')->orderBy('name')->get();
    }

    /**
     * List of team members ordered by name
     * @return mixed
     */
    public function listTeamMember()
    {
        return User::where('rule','=','team')->orderBy('name')->get();
    }

}