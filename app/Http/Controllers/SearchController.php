<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class SearchController
 * @package App\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     * Defautl view for the search controller.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('plants-list');
    }

    /**
     * Runs a search with fuzzy matching based on plant name.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $plants=DB::table('plants')->where('name','LIKE','%'.$request->search."%")->take(10)->orderBy('name')->get();

            if($plants)
            {
                foreach ($plants as $key => $plant) {
                    // TODO: load this through a partial view to keep the business logic clean
                    $output.='<li class="c-search-list__item">'.
                        '<a href="/plants/view/' . $plant->slug . '" class="c-search-list__link h-flex"><span class="c-search-list__name">'.$plant->name.'</span>'.
                        '<span class="c-search-list__price">&pound;'.$plant->price.'</span></a>'.
                        '</li>';
                }

                return Response($output);
            }
        }
    }
}
