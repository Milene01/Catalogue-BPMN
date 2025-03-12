<?php

namespace App\Http\Controllers;

use App\Category;
use App\Conflicts;
use App\Construct;
use App\Image;
use App\Publication;
use App\Repository\CategoryRepository;
use App\Repository\PublicationRepository;
use App\Tag;
use App\TextField;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class PublicationController extends Controller
{

    private $publicationRepository;
    private $categoryRepository;

    public function __construct(PublicationRepository $publicationRepository,CategoryRepository $categoryRepository)
    {
        $this->publicationRepository = $publicationRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function view($id)
    {
        $publication = $this->publicationRepository->findById($id);
        return view('publication.view',[
            'publication'=>$publication,
            'categories'=>$this->categoryRepository->listWithoutImageOrderByName(),
            'images'=>$this->categoryRepository->listOnlyImageOrderByName()
        ]);
    }

    public function treeView($id)
    {
        $publication = $this->publicationRepository->findById($id);
        return view('publication.treeview',[
            'publication'=>$publication,
            'categories'=>$this->categoryRepository->listWithoutImageOrderByName(),
            'images'=>$this->categoryRepository->listOnlyImageOrderByName()
        ]);
    }

    public function showConstruct($constructId)
    {
        $construct = Construct::findOrFail($constructId);

        $layout = (URL::previous() == url("publication/treeview/$construct->publications_id")) ? 'apptree' : 'app';
        return view("publication.item.showconstruct",[
            'construct' => $construct,
            'layout' => $layout,
            'publication'=>$construct->publication()->first(),
        ]);
    }

    public function showConflict($conflictId)
    {
        $conflict = Conflicts::findOrFail($conflictId);

        return view("publication.item.showconflict",[
            'conflict' => $conflict,
        ]);
    }
    

}
