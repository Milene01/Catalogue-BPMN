<?php
/**
 * Created by PhpStorm.
 * User: tiago
 * Date: 06/05/16
 * Time: 13:43
 */

namespace App\Repository;


use App\Publication;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class PublicationRepository
{


    public function findById($id)
    {
        return Publication::findOrFail($id);
    }


    public function listAccepted()
    {
        return Publication::where('approved','=',true)->orderBy('title')->paginate(10);
    }

    public function listAcceptedLikeAuthorOrTitle($queryUser,$filterUser)
    {
        $publications = Publication::where('approved','=',true)
            ->where(function($query){
                $queryUser = Request::input('q');
                $query->where('title','like',"%$queryUser%")
                ->orWhere('authors','like',"%$queryUser%");
            })
            ;
        if($filterUser) {
            $publications->where(function($query) {
                $filterUser = Request::input('f');
                $list = DB::table('publications_tags')->select('publication_id')->where('tag_id','=',$filterUser)->get();
                $ar = [];
                foreach ($list as $l){
                    $ar[] = $l->publication_id;
                }
                $query->whereIn('id',$ar);
            });
        }

        return $publications->orderBy('title')->paginate(10);
    }

    public function listRejected()
    {
        return Publication::where('approved','=',false)->orderBy('title')->paginate(30);
    }

    public function listWaitingReview()
    {
        return Publication::whereNull('approved')->orderBy('title')->paginate(30);
    }

}