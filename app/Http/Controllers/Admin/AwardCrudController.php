<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AwardRequest as StoreRequest;
use App\Http\Requests\AwardRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class AwardCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AwardCrudController extends CrudController
{
    /**
     * Sets up the CRUD form for an Award.
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Award');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/award');
        $this->crud->setEntityNameStrings('award', 'awards');

        $this->crud->setColumns([
            'name',
            'description'
        ]);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'allows_null' => false
        ]);

        $this->crud->addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description of the award (optional)'
        ]);

        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    /**
     * Creates the Award record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);

        return $redirect_location;
    }

    /**
     * Updates an existing Award record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);

        return $redirect_location;
    }
}
