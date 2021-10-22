<?php

namespace App\Http\Controllers\Voyager;

use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;
use Illuminate\Http\Request;

class VoyagerProfileController extends BaseVoyagerBaseController
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:20'],
            'contact_phone_number' => ['required', 'string', 'max:25'],
            'birth_date' => ['required', 'date'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'education_id' => ['required'],
            'marital_status_id' => ['required'],
            'have_children' => ['required','boolean'],
            'photos'=>['required']
        ]);
    }
}
