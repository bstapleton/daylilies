<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\BreederRequest as StoreRequest;
use App\Http\Requests\BreederRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class BreederCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class BreederCrudController extends CrudController
{
    /**
     * Sets up the CRUD form for a Breeder.
     */
    public function setup()
    {
        $this->crud->setModel('App\Models\Breeder');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/breeder');
        $this->crud->setEntityNameStrings('breeder', 'breeders');

        $this->crud->setColumns([
            'full_name' => ['name' => 'full_name', 'label' => 'Full name'],
            'biography'
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'URL slug',
            'hint' => 'e.g. brown-e-w takes the slug and standardises the formatting for the full name. It also makes it so you can see all plants by a specific person.',
            'allows_null' => false
        ]);

        $this->crud->addField([
            'name' => 'biography',
            'type' => 'textarea',
            'label' => 'Biography (optional)'
        ]);

        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    /**
     * Parses an exploded slug string into a specific standard for displaying a full name.
     *
     * @param $nameArray array from the slug of the breeder name.
     * @return string the full name standardised to the format Surname, X.X.
     */
    protected function handleInitials($nameArray) {
        $fullName = ucwords($nameArray[0]);

        if (count($nameArray) > 1) {
            for ($i = 0; $i < count($nameArray); $i++) {
                if ($i == 0) {
                    $fullName .= ', ';
                } else {
                    $fullName .= strtoupper($nameArray[$i]) . '.';
                }
            }
        }

        return $fullName;
    }

    /**
     * Creates the Breeder record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $slugParts = explode('-', $request->request->get('slug'));
        $request->request->set('surname', ucwords($slugParts[0]));
        $request->request->set('full_name', $this->handleInitials($slugParts));
        $redirect_location = parent::storeCrud($request);

        return $redirect_location;
    }

    /**
     * Updates an existing Breeder record.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        $slugParts = explode('-', $request->request->get('slug'));
        $request->request->set('surname', ucwords($slugParts[0]));
        $request->request->set('full_name', $this->handleInitials($slugParts));
        $redirect_location = parent::updateCrud($request);

        return $redirect_location;
    }
}
