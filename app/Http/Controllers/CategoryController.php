<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Carbon\Carbon;
use Session;
session_start();

class CategoryController extends Controller
{
    public function admin_index()
    {
        return view('admin.category.create');
    }

    public function index()
    {
        $dataC = Category::paginate(4);
        return response()->json($dataC, 200);

    }

    public function all_category()
    {
        $categories = Category::paginate(4);
        // $all_category_info = DB::table('category')->paginate(5); //->get();
        return view('admin.category.index', compact('categories'));
    }

    public function category_by_id($category_id)
    {
        $category_by_id = Category::findOrFail($category_id);
        return response()->json($category_by_id, 200);

    }

    public function save_category(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'category_description' => 'required',
        ]);

        $data = new Category();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        if(isset($request->status))
        {
            $data->status = 'enable';
        } else {
            $data->status = 'disable';
        }

        $data->save();
        return redirect('all-category')->with('successMsg', 'Category Saved Successfully ):');
    }

    public function edit_category($category_id)
    {
        $category_info = Category::findOrFail($category_id);
        return view('admin.category.edit', compact('category_info'));
    }

    public function update_category(Request $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->category_name = $request->category_name;
        $category->category_description = $request->category_description;
        //$category->updated_at = $request->updated_at;
        $category->updated_at     = Carbon::now();
        $category->save();
        return Redirect::to('/all-category')->with('successMsg', 'Category Updated Successfully ):');
    }

    public function delete_category($category_id)
    {
        $deleteC = Category::findOrFail($category_id);
        $deleteC->delete();
        return Redirect::to('/all-category')->with('successMsg', 'Category Deleted Successfully ):');
    }

    public function unactive_category($category_id)
    {
        $unactive_category = Category::findOrFail($category_id);
        $unactive_category->update(['status' => 'disable']);
        return Redirect::to('/all-category')->with('successMsg', 'Category Un-activated Successfully ):');
    }

    public function active_category($category_id)
    {
        $active_category = Category::findOrFail($category_id);
        $active_category->update(['status' => 'enable']);
        return Redirect::to('/all-category')->with('successMsg', 'Category Activated Successfully ):');
    }

    public function search($category_name)
    {
        $search = Category::where("category_name", "like", "%" . $category_name . "%")
                    ->get();
        return $search;
    }

}
