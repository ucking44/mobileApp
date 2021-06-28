<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Slider;
use Illuminate\Support\Carbon;
use Session;
session_start();

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::simplePaginate(4);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function save_slider(Request $request)
    {
        $data = array();
        $data['status'] = $request->status;
        $data['created_at'] = Carbon::now(); //->toDateString();
        $data['updated_at'] = Carbon::now(); //->toDateString();
        //toDateTimeString

        $image = $request->file('slider_image');
        if ($image) {
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'slider/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path, $image_full_name);
            if ($success) {
                $data['slider_image'] = $image_url;

                DB::table('sliders')->insert($data);
                Session::put('message', 'Slider Added Successfully!!');
                return Redirect::to('/sliders');
            }
        }
        $data['slider_image'] = '';

            DB::table('sliders')->insert($data);
                Session::put('message', 'Slider Added Successfully Without Image!!');
                return Redirect::to('/sliders');
    }

    // public function all_slider()
    // {
    //     $all_slider = DB::table('slider')->get();
    //     return view('admin.slider.index', compact('all_slider'));
    // }

    public function delete_slider($id)
    {
        DB::table('sliders')
            ->where('id', $id)
            ->delete();

        Session::get('message', 'Slider Deleted successfully !!');
        return Redirect::to('/sliders');
    }

    public function unactive_slider($id)
    {
        DB::table('sliders')
            ->where('id', $id)
            ->update(['status' => 0 ]);
        Session::put('message', 'Slider Unactivated successfully !!');
        return Redirect::to('/sliders');
    }

    public function active_slider($id)
    {
        DB::table('sliders')
            ->where('id', $id)
            ->update(['status' => 1 ]);
        Session::put('message', 'Slider Activated successfully !!');
        return Redirect::to('/sliders');
    }

}

