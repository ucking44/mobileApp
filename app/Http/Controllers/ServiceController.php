<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return response()->json($services, 200);
        //return view('admin.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'service_name' => 'required',
            'fee' => 'required | numeric',
            'duration' => 'required',
        ]);

        $service = new Service();
        $service->service_name = $request->service_name;
        $service->fee = $request->fee;
        $service->duration = $request->duration;
       
        if ($request->status)
        {
            $service->status = 'enable';
        } else {
            $service->status = 'disable';
        }

        $service->save();
        return Redirect::to('/service')->with('successMsg', 'Service Saved Successfully ):');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'service_name' => 'required',
            'fee' => 'required | numeric',
            'duration' => 'required',
        ]);

        $service = Service::findOrFail($id);
        $service->service_name = $request->service_name;
        $service->fee = $request->fee;
        $service->duration = $request->duration;
        
        if ($request->status)
        {
            $service->status = 'enable';
        } else {
            $service->status = 'disable';
        }

        $service->save();
        return Redirect::to('/service')->with('successMsg', 'Service Updated Successfully ):');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return Redirect::to('/service')->with('successMsg', 'Service Deleted Successfully ):');
    }

    public function unactive_service($id)
    {
        $unactive_service = Service::findOrFail($id);
        $unactive_service->update(['status' => 'disable']);
        return Redirect::to('/service')->with('successMsg', 'Service Un-activated Successfully ):');
    }

    public function active_service($id)
    {
        $active_service = Service::findOrFail($id);
        $active_service->update(['status' => 'enable']);
        return Redirect::to('/service')->with('successMsg', 'Service Activated Successfully ):');
    }

    // public function search($category_name)
    // {
    //     $search = ServiceCategory::where("category_name", "like", "%" . $category_name . "%")
    //                 ->get();
    //     return $search;
    // }

}
