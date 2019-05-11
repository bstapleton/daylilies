<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PlantRequest as StoreRequest;
use App\Http\Requests\PlantRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class PlantCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PlantCrudController extends CrudController
{
    /**
     * Sets up the CRUD form for a Plant.
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Plant');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/plant');
        $this->crud->setEntityNameStrings('plant', 'plants');

        $this->crud->setColumns([
            'name',
            'category_id' => [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Category',
                'entity' => 'category',
                'attribute' => 'name',
                'model' => 'App\Models\Category'
            ],
            'breeder_id' => [
                'name' => 'breeder_id',
                'type' => 'select',
                'label' => 'Breeder/hybridiser',
                'entity' => 'breeder',
                'attribute' => 'full_name',
                'model' => 'App\Models\Breeder'
            ],
            'year_bred' => [
                'name' => 'year_bred',
                'label' => 'Registration year'
            ],
            'height' => [
                'name' => 'height',
                'label' => 'Height (inches)'
            ],
            'flower_size' => [
                'name' => 'flower_size',
                'label' => 'Flower (inches)'
            ],
            'season' => [
                'name' => 'seasons',
                'type' => 'select_multiple',
                'label' => 'Bloom season(s)',
                'entity' => 'seasons',
                'attribute' => 'name',
                'model' => 'App\Models\Season'
            ],
            'price' => [
                'name' => 'price',
                'label' => 'Price (£)'
            ],
            'in_stock' => [
                'name' => 'in_stock',
                'label' => 'In stock'
            ],
            'quantity_in_stock' => [
                'name' => 'quantity_in_stock',
                'label' => 'Available to purchase'
            ]
        ]);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Plant name',
            'allows_null' => false,
            'tab' => 'Basic info'
        ]);

        $this->crud->addField([
            'name' => 'category_id',
            'type' => 'select2',
            'label' => 'Category',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => "App\Models\Category",
            'allows_null' => false,
            'tab' => 'Basic info'
        ]);

        $this->crud->addField([
            'name' => 'breeder_id',
            'type' => 'select2',
            'label' => 'Breeder/hybridiser',
            'entity' => 'breeder',
            'attribute' => 'full_name',
            'model' => "App\Models\Breeder",
            'tab' => 'Basic info'
        ]);

        $this->crud->addField([
            'name' => 'year_bred',
            'type' => 'number',
            'label' => 'Registration year',
            'tab' => 'Basic info'
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description',
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'height',
            'type' => 'number',
            'label' => 'Scape height',
            'attributes' => ['step' => 'any'],
            'suffix' => 'inches',
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'flower_size',
            'type' => 'number',
            'label' => 'Bloom size',
            'attributes' => ['step' => 'any'],
            'suffix' => 'inches',
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'genome_id',
            'type' => 'radio',
            'label' => 'Ploidy',
            'options' => [
                1 => 'Diploid',
                2 => 'Tetraploid'
            ],
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'foliage_id',
            'type' => 'radio',
            'label' => 'Foliage',
            'options' => [
                1 => 'Evergreen',
                2 => 'Semi-evergreen',
                3 => 'Dormant'
            ],
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'seasons',
            'type' => 'select2_multiple',
            'label' => 'Flowering season(s)',
            'entity' => 'seasons',
            'attribute' => 'name',
            'model' => "App\Models\Season",
            'pivot' => true,
            'tab' => 'Plant details'
        ]);

        $this->crud->addField([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Price',
            'attributes' => ['step' => 'any'],
            'prefix' => '£',
            'allows_null' => false,
            'tab' => 'Stock control'
        ]);

        $this->crud->addField([
            'name' => 'in_stock',
            'type' => 'radio',
            'label' => 'Stock availability',
            'options' => [
                0 => 'Out of stock',
                1 => 'In stock'
            ],
            'hint' => 'Marking the plant out of stock just means it is no longer for sale on the website, and does not impact actual stock levels below.',
            'allows_null' => false,
            'tab' => 'Stock control'
        ]);

        $this->crud->addField([
            'name' => 'quantity_in_stock',
            'type' => 'number',
            'label' => 'Quantity in stock',
            'allows_null' => false,
            'tab' => 'Stock control'
        ]);

        // add asterisk for fields that are required in PlantRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    /**
     * Takes a plant name an sanitises it to make it browser and SEO friendly for a URL route.
     *
     * @param $name string plant name to sanitise.
     * @return string slugified plant name
     */
    protected function slugify($name)
    {
        $slug = strtolower($name);
        $slug = preg_replace("/[^a-z0-9_\s-]/", "", $slug);
        $slug = preg_replace("/[\s-]+/", " ", $slug);
        $slug = preg_replace("/[\s_]/", "-", $slug);
        return $slug;
    }

    /**
     * Create the Plant record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $request->request->set('slug', $this->slugify($request->request->get('name')));
        $request->request->set('year_added', date('Y'));
        $redirect_location = parent::storeCrud($request);

        return $redirect_location;
    }

    /**
     * Update the Plant record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $request->request->set('slug', $this->slugify($request->request->get('name')));
        $redirect_location = parent::updateCrud($request);

        return $redirect_location;
    }
}
