<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Manufacture;
use Carbon\Carbon;
use Session;
session_start();

class ManufactureController extends Controller
{
    public function all_manufacture()
    {
        $all_manufacture_info = DB::table('manufactures')->paginate(5); //->get();
        return view('admin.manufacture.index', compact('all_manufacture_info'));
    }

    public function manufacture_create()
    {
        return view('admin.manufacture.create');
    }

    public function index()
    {
        $dataM = Manufacture::paginate(4);
        return response()->json($dataM, 200);
    }

    public function show($manufacture_id)
    {
        $show_manufacture = Manufacture::findOrFail($manufacture_id);
        return view('admin.product.show', compact('show_manufacture'));

    }

    public function manufacture_by_id($manufacture_id)
    {
        $manufacture_by_id = Manufacture::findOrFail($manufacture_id);
        return response()->json($manufacture_by_id, 200);

    }

    public function save_manufacture(Request $request)
    {
        $data = new Manufacture();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        //$data['created_at']     = Carbon::now();
        if(isset($request->status))
        {
            $data->status = 'enable';
        } else {
            $data->status = 'disable';
        }

        $data->save();
        return Redirect::to('/all-manufacture')->with('successMsg', 'Brand Saved Successfully ):');
    }

    public function edit_manufacture($manufacture_id)
    {
        $manufacture_info = Manufacture::findOrFail($manufacture_id);
        return view('admin.manufacture.edit', compact('manufacture_info'));
    }

    public function update_manufacture(Request $request, $manufacture_id)
    {
        $manufacture = Manufacture::findOrFail($manufacture_id);
        $manufacture['manufacture_name'] = $request->manufacture_name;
        $manufacture['manufacture_description'] = $request->manufacture_description;
        $manufacture->updated_at     = Carbon::now();
        $manufacture->save();
        return Redirect::to('/all-manufacture')->with('successMsg', 'Brand Updated Successfully ):');
    }

    public function delete_manufacture($manufacture_id)
    {
        $deleteM = Manufacture::findOrFail($manufacture_id);
        $deleteM->delete();
        //Session::get('message', 'Manufacture Deleted successfully !!');
        return Redirect::to('/all-manufacture')->with('successMsg', 'Brand Deleted Successfully ):');
    }

    public function unactive_manufacture($manufacture_id)
    {
        $unactive_manufacture = Manufacture::findOrFail($manufacture_id);
        $unactive_manufacture->update(['status' => 'disable']);
        return Redirect::to('/all-manufacture')->with('successMsg', 'Brand Un-activated Successfully ):');
    }

    public function active_manufacture($manufacture_id)
    {
        $active_manufacture = Manufacture::findOrFail($manufacture_id);
        $active_manufacture->update(['status' => 'enable']);
        return Redirect::to('/all-manufacture')->with('successMsg', 'Brand Activated Successfully ):');
    }

    public function search($manufacture_name)
    {
        $search = Manufacture::where("manufacture_name", "like", "%" . $manufacture_name . "%")
                    ->get();
        return $search;
    }

}

