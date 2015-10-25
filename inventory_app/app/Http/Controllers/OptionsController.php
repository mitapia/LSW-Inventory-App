<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OptionsController extends Controller
{
    /**
     * Responds to requests to GET /department, /category, or /vendor
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex($option)
    {
        switch ($option) {
            case 'department':
                $query = App\Department::all();
                break;
            
            case 'category':
                $query = App\Category::all();
                break;

            case 'vendor':
                $query = App\Vendor::all();
                break;

            default:
                return view('errors.503');
                break;
        }

        return view('settings.options_index', [ 
        	'entry' => $query, 
        	'page' => $option 
        ]);
    }

    /**
     * Responds to requests to POST /department, /category, or /vendor
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @param  string  $option
     * @return Response
     */
    public function postStore(Request $request, $option)
    {
    	switch ($option) {
            case 'department':
            	// Validate the request...
                $this->validate($request, [
			        'id' => 'required|unique:department,id|integer|min:1',
			        'name' => 'required|unique:department,name|string|max:30',
			    ]);

                $option = new App\Department;
                break;
            
            case 'category':
            	// Validate the request...
                $this->validate($request, [
			        'id' => 'required|unique:category,id|integer|min:1',
			        'name' => 'required|unique:category,name|string|max:31',
			    ]);

                $option = new App\Category;
                break;

            case 'vendor':
            	// Validate the request...
                $this->validate($request, [
			        'id' => 'required|unique:vendor,id|integer|min:1',
			        'name' => 'required|unique:vendor,name|string|max:41',
			    ]);

                $option = new App\Vendor;
                break;

            default:
                return view('errors.503');
                break;
        }

        $option->id = $request->id;
        $option->name = $request->name;

        $option->save();
        return back();
    }

    /**
     * Responds to requests to POST /department, /category, or /vendor
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  string  $option
     * @return Response
     */
    public function postDestroy($option, $id)
    {
    	switch ($option) {
            case 'department':
                App\Department::destroy($id);
                break;
            
            case 'category':
            	App\Category::destroy($id);
                break;

            case 'vendor':
            	App\Vendor::destroy($id);
                break;

            default:
                return view('errors.503');
                break;
        }
        return back();
    }
}
