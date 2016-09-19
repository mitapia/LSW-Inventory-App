<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SelectController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $vendor_id
     * @return Response
     */
    public function size($vendor_id)
    {
        $matries = App\Size_Matrix::where('vendor_id', $id)->get();

        return $matries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($option)
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

        return view('display', [ 'entry' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
