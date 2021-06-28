<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ServiceCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviceCates = ServiceCategory::paginate(4);
        return view('admin.serviceCategory.index', compact('serviceCates'));
        //$serviceCate = ServiceCategory::paginate(4);
        //return response()->json($serviceCate, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.serviceCategory.create');
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
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $serviceCate = new ServiceCategory();
        $serviceCate->category_name = $request->category_name;
        $serviceCate->category_description = $request->category_description;
        if ($request->status)
        {
            $serviceCate->status = 'enable';
        } else {
            $serviceCate->status = 'disable';
        }
        $serviceCate->save();

        return Redirect::to('/service-category')->with('successMsg', 'Service Categories Saved Successfully ):');
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
        $serviceCate = ServiceCategory::findOrFail($id);
        return view('admin.serviceCategory.edit', compact('serviceCate'));
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
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $serviceCate = ServiceCategory::findOrFail($id);
        $serviceCate->category_name = $request->category_name;
        $serviceCate->category_description = $request->category_description;
        if ($request->status)
        {
            $serviceCate->status = 'enable';
        } else {
            $serviceCate->status = 'disable';
        }
        $serviceCate->save();

        return Redirect::to('/service-category')->with('successMsg', 'Service Categories Updated Successfully ):');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceCate = ServiceCategory::findOrFail($id);
        $serviceCate->delete();
        return Redirect::to('/service-category')->with('successMsg', 'Service Categories Deleted Successfully):');
    }

    public function unactive_service_category($id)
    {
        $unactive_category = ServiceCategory::findOrFail($id);
        $unactive_category->update(['status' => 'disable']);
        return Redirect::to('/service-category')->with('successMsg', 'Service Category Un-activated Successfully ):');
    }

    public function active_service_category($id)
    {
        $active_category = ServiceCategory::findOrFail($id);
        $active_category->update(['status' => 'enable']);
        return Redirect::to('/service-category')->with('successMsg', 'Service Category Activated Successfully ):');
    }

    public function search($category_name)
    {
        $search = ServiceCategory::where("category_name", "like", "%" . $category_name . "%")
                    ->get();
        return $search;
    }

}
