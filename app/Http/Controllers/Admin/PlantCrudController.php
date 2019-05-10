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
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Plant');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/plant');
        $this->crud->setEntityNameStrings('plant', 'plants');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->setColumns([
            'slug',
            'name',
            'category_id',
            'year_added',
            'breeder_id',
            'year_bred',
            'height',
            'flower_size',
            'genome',
            'foliage',
            'season',
            'description',
            'in_stock',
            'quantity_in_stock'
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'URL slug'
        ]);

        $this->crud->addField([
            'name' => 'category_id',
            'type' => 'select',
            'label' => 'Category',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => "App\Models\Category"
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description'
        ]);

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
//
//        // add asterisk for fields that are required in PlantRequest
//        $this->crud->setRequiredFields(StoreRequest::class, 'create');
//        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
