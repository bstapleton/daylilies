<?php

namespace App\Http\Controllers;

use App\Plant;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Input;

/**
 * Class PlantController
 * @package App\Http\Controllers
 */
class PlantController extends BaseController
{
    /**
     * Get all plants available on the website.
     *
     * @return Factory|View
     */
    public function index() {
        $plants = Plant::paginate(self::GRID_RESULTS);

        return view('plants-grid', ['plants' => $plants, 'category' => 'All daylilies']);
    }

    /**
     * View an individual plant.
     *
     * @param string $slug
     * @return Factory|View
     */
    public function view(string $slug) {
        $plant = Plant::where('slug', $slug)
            ->first();

        if ($plant == null)
        {
            return view('error', ['message' => 'Couldn\'t find the details for a plant with that name, sorry.']);
        }

        $plant->heightInCm = $this->convertInchesToCentimetres($plant->height);
        $plant->flowerInCm = $this->convertInchesToCentimetres($plant->flower_size);

        $metaDescription = $plant->description;

        return view('plant-view', ['plant' => $plant, 'title' => $plant->name, 'metaDescription' => $metaDescription]);
    }

    /**
     * Get all plants that have been added to the website in the current or previous year.
     *
     * @return Factory|View
     */
    public function listNew() {
        $category = Input::get('category');

        $plants = Plant::where('year_added', '>', date('Y') - 1)
            ->orderBy('name', 'asc')
            ->orderBy('year_added', 'desc')
            ->paginate(self::GRID_RESULTS);

        if ($category)
        {
            $plants = Plant::where('year_added', '>', date('Y') - 1)
                ->whereHas('category', function($query) use ($category) {
                    $query->whereSlug($category);
                })
                ->orderBy('name', 'asc')
                ->get();
        }

        foreach ($plants as $plant)
        {
            $plant->thumbnail = $this->getThumbnailFromSlug($plant->slug);
        }

        return view('plants-grid', [
            'plants' => $plants,
            'isCategoryView' => false,
            'isNewPlantsGrid' => true,
            'pageHeading' => 'Newest daylilies in the website catalogue',
            'title' => 'Newest additions',
            'metaDescription' => 'Latest daylily additions to the website catalogue across all categories.',
            'thisYearIcon' => $this->getThisYearIcon(),
            'lastYearIcon' => $this->getLastYearIcon(),
            'outOfStockIcon' => $this->getOutOfStockIcon()
        ]);
    }

    /**
     * Get all plants for the requested category. Redirect to an error page if the request is invalid.
     *
     * @param string $category
     * @return Factory|View
     */
    public function listCategory(string $category) {
        $paginationCount = request('display') == 'grid' ? self::GRID_RESULTS : self::LIST_RESULTS;

        $plants = Plant::whereHas('category', function($query) use ($category) {
            $query->whereSlug($category);
        })->orderBy('name')->paginate($paginationCount);

        if ($plants->count() < 1)
        {
            return view('error', ['category' => 'Category Request', 'request' => $category]);
        }

        foreach ($plants as $plant)
        {
            $this->parsePlantData($plant);
        }

        $view = request('display') == 'grid' ? 'plants-grid' : 'plants-list';

        return view($view, [
            'plants' => $plants,
            'pageNumberGrid' => $this->getPageNumber(Input::get('page'), false),
            'pageNumberList' => $this->getPageNumber(Input::get('page'), true),
            'isCategoryView' => true,
            'title' => $plants->first()->category()->first()->name . ' daylilies',
            'metaDescription' => $plants->first()->category()->first()->meta_description,
            'thisYearIcon' => $this->getThisYearIcon(),
            'lastYearIcon' => $this->getLastYearIcon(),
            'outOfStockIcon' => $this->getOutOfStockIcon()
        ]);
    }

    /**
     * Get all plants for the requested foliage type. Redirect to an error if not a valid foliage tag.
     *
     * @param string $foliage
     * @return Factory|View
     */
    public function listFoliage(string $foliage) {
        $plants = Plant::whereHas('foliage', function($query) use ($foliage) {
            $query->whereName(ucfirst($foliage));
        })->orderBy('name', 'asc')->paginate(self::LIST_RESULTS);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Foliage Request', 'request' => $foliage]);
        }

        foreach ($plants as $plant) {
            $plant->thumbnail = $this->getThumbnailFromSlug($plant->slug);
        }

        return view('plants-list', [
            'plants' => $plants,
            'pageNumberGrid' => $this->getPageNumber(Input::get('page'), false),
            'pageNumberList' => $this->getPageNumber(Input::get('page'), true),
            'isCategoryView' => false,
            'pageHeading' => 'Daylilies with ' . $foliage . ' foliage',
            'title' => ucfirst($foliage) . ' daylilies',
            'metaDescription' => 'Daylilies with ' . $foliage . ' foliage',
            'thisYearIcon' => $this->getThisYearIcon(),
            'lastYearIcon' => $this->getLastYearIcon(),
            'outOfStockIcon' => $this->getOutOfStockIcon()
        ]);
    }

    /**
     * Get all plants for the requested season. Redirect to an error if not a valid season tag.
     *
     * @param string $season
     * @return Factory|View
     */
    public function listSeason(string $season) {
        $plants = Plant::whereHas('seasons', function($query) use ($season) {
            $query->whereName(ucfirst(str_replace('-', ' ', $season)));
        })->orderBy('name', 'asc')->paginate(self::LIST_RESULTS);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Season Request', 'request' => $season]);
        }

        foreach ($plants as $plant) {
            $plant->thumbnail = $this->getThumbnailFromSlug($plant->slug);
        }

        return view('plants-list', [
            'plants' => $plants,
            'pageNumberGrid' => $this->getPageNumber(Input::get('page'), false),
            'pageNumberList' => $this->getPageNumber(Input::get('page'), true),
            'isCategoryView' => false,
            'pageHeading' => 'Daylilies that flower ' . str_replace('-', ' ', $season),
            'title' => ucfirst(str_replace('-', ' ', $season)) . ' daylilies',
            'metaDescription' => 'Daylilies that flower ' . str_replace('-', ' ', $season),
            'thisYearIcon' => $this->getThisYearIcon(),
            'lastYearIcon' => $this->getLastYearIcon(),
            'outOfStockIcon' => $this->getOutOfStockIcon()
        ]);
    }
}
