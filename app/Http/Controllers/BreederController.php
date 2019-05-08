<?php

namespace App\Http\Controllers;

use App\Plantss;

/**
 * Class BreederController
 * @package App\Http\Controllers
 */
class BreederController extends Controller
{
    /**
     * Get all plants by the requested breeder, redirecting to an error if that breeder is not found.
     *
     * @param string $breederSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listPlants(string $breederSlug) {
        $plants = Plantss::where('breeder_slug', $breederSlug)
            ->orderBy('name', 'asc')->get();

        if ($plants->count() < 1) {
            return view('error', ['category' => 'Breeder Request', 'request' => $breederSlug]);
        }

        $humanFriendlyBreederName = $plants->first()->breeder;

        return view('plants-list', ['plants' => $plants, 'category' => $humanFriendlyBreederName, 'title' => 'Daylilies by ' . $humanFriendlyBreederName]);
    }
}
