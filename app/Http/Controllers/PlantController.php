<?php

namespace App\Http\Controllers;

use App\Plant;

/**
 * Class PlantController
 * @package App\Http\Controllers
 */
class PlantController extends Controller
{
    /**
     * Get all plants available on the website.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $plants = Plant::all();

        return view('plants-list', ['plants' => $plants, 'category' => 'All daylilies']);
    }

    public function view(string $slug) {
        $plant = Plant::where('slug', $slug)
            ->first();

        return view('plant-view', ['plant' => $plant, 'title' => $plant->name]);
    }

    /**
     * Get all plants that hve been added tot he website in the current or previous year.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listNew() {
        $currentYear = date('Y');

        $thisYear = Plant::where('year_added', $currentYear)
            ->orderBy('name', 'asc')
            ->get();

        $lastYear = Plant::where('year_added', $currentYear - 1)
            ->orderBy('name', 'asc')
            ->get();

        return view('plants-new', ['thisYear' => $thisYear, 'lastYear' => $lastYear]);
    }

    /**
     * Get all plants for the requested category. Redirect to an error page if the request is invalid.
     *
     * @param string $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listCategory(string $category) {
        $plants = Plant::where('type', $category)
            ->orderBy('name', 'asc')
            ->paginate(20);

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Category Request', 'request' => $category]);
        }

        foreach ($plants as $plant) {
            $plant->genome = $this->getPloidy($plant->genome);
            $plant->foliage = $this->getFoliage($plant->foliage);
        }

        return view('plants-list', ['plants' => $plants, 'category' => ucfirst($category) . ' daylilies', 'title' => ucfirst($category) . ' daylilies']);
    }

    /**
     * Get all plants for the requested genome. Redirect to an error if not a valid genome tag.
     *
     * @param string $genome
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listGenome(string $genome) {
        if ($genome != 'diploid' && $genome != 'tetraploid') {
            return view('error', ['category' => 'Genome Request', 'request' => $genome]);
        }

        $plants = Plant::where('genome', substr($genome,0,1))
            ->orderBy('name', 'asc')
            ->paginate(100);

        return view('plants-list', ['plants' => $plants, 'category' => ucfirst($genome).' daylilies', 'title' => ucfirst($genome) . ' daylilies']);
    }

    /**
     * Get all plants for the requested foliage type. Redirect to an error if not a valid foliage tag.
     *
     * @param string $foliage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listFoliage(string $foliage) {
        $plants = Plant::where('foliage', strtolower(substr($foliage, 0, 1)))
            ->orderBy('name', 'asc')
            ->paginate(20);

        if ($plants->count() < 1 || ($foliage != 'evergreen' && $foliage != 'semi-evergreen' && $foliage != 'dormant')) {
            return view('error', ['category' => 'Foliage Request', 'request' => $foliage]);
        }

        return view('plants-list', ['plants' => $plants, 'category' => 'Daylilies with ' . $foliage . ' foliage', 'title' => ucfirst($foliage) . ' daylilies']);
    }

    /**
     * Get all plants for the requested season. Redirect to an error if not a valid season tag.
     *
     * @param string $season
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listSeason(string $season) {
        switch ($season) {
            case 'early':
                $request = 'e';
                break;
            case 'early-to-mid':
                $request = 'e,m';
                break;
            case 'mid':
                $request = 'm';
                break;
            case 'mid-to-late':
                $request = 'm,l';
                break;
            case 'late':
                $request = 'l';
                break;
            default:
                $request = null;
                break;
        }

        if ($request == null) {
            return view('error', ['category' => 'Season Request', 'request' => $season]);
        }

        $plants = Plant::where('season', $request)
            ->orderBy('name', 'asc')
            ->get();

        return view('plants-list', ['plants' => $plants, 'category' => 'Daylilies that flower ' . $season . ' season', 'title' => ucfirst($season) . ' season daylilies']);
    }

    /**
     * @param $f string The foliage type.
     * @return string The human-friendly representation of the foliage type for the plant.
     */
    private function getFoliage($f)
    {
        switch ($f) {
            case 'e':
                return 'Evergreen';
            case 's':
                return 'Semi-evergreen';
            case 'd':
                return 'Dormant';
            default:
                return 'Unknown';
        }
    }

    /**
     * @param $p string The ploidy type.
     * @return string The human-friendly representation of the ploidy type for the plant.
     */
    private function getPloidy($p)
    {
        return $p == 'd' ? 'Diploid' : 'Tetraploid';
    }
}
