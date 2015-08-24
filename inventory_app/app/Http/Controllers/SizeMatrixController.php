<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SizeMatrixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $matices = App\Size_Matrix::all();
        return view ('size_matrix.index', ['matices' => $matices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $vendors = App\Vendor::all();
        return view('size_matrix.create', ['vendors' => $vendors, 'sizes' => '1', 'departments'=>'3']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Dump all data into $data
        $data = $request->all();

        // verify at last one vendor was set
        $this->validate($request, [
            'vendor' => 'required',
        ]);

        // verify vendor id exists and qty values are positive numbers
        for ($i=0; $i < (count($data['vendor'])); $i++) { 
            $this->validate($request, [
                'vendor.'.$i  =>  'required|numeric|exists:vendor,id',
            ]);
        }
        for ($i=0; $i < (count($data['table']) - 1); $i++) { 
            $this->validate($request, [
                // vefify name was set and is below size limit
                'table.'.$i.'.name'     =>  'required|max:30',
            ]);
            for ($n=0; $n <= 13; $n++) { 
                $this->validate($request, [
                'table.'.$i.'.'.$n.'_K' =>  'numeric',
                ]);
            }
            for ($n=0; $n <= 14; $n += 0.5) { 
                $name = str_replace('.', '_', strval($i));

                $this->validate($request, [
                'table.'.$i.'.'.$name   =>  'numeric',
                ]);
            }
        }
        
        // loop through vendors selected
        foreach ($data['vendor'] as $vendor_id) {
            // loop through rows entered in table
            for ($r=0; $r < (count($data['table']) - 1); $r++) { 
                //return json_encode($data['table'][$r]);
                $matrix = new App\Size_Matrix;

                $matrix->name       = $data['table'][$r]['name'];
                $matrix->vendor_id  = $vendor_id;
                
                for ($i=0; $i <= 13; $i++) { 
                    $qty = $data['table'][$r][$i.'_K'];
                    $matrix->{$i.'_K'} = (empty($qty)) ? '0' : $qty;
                }
                for ($i=0; $i <= 14; $i += 0.5) { 
                    $name = str_replace('.', '_', strval($i)) . '_A';
                    $qty = $data['table'][$r][$name];
                    $matrix->{$name} = (empty($qty)) ? '0' : $qty;
                }
                //return json_encode('iside for');
                $matrix->save();
            }
        }
            

        // will not actually store simply return data to be viewd by console
        return json_encode(array('status' => 'success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $matrices = App\Size_Matrix::where('vendor_id', $id)->get();

        return $matrices;
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
