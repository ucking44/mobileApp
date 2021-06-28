<?php

namespace App\Http\Controllers;

use App\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AboutUsController extends Controller
{
    public function aboutUs()
    {
        $aboutUs = AboutUs::simplePaginate(3);
        return view('admin.aboutUs.index', compact('aboutUs'));
    }

    public function createAboutUs()
    {
        return view('admin.aboutUs.create');
    }

    public function saveAboutUs(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'years_of_experience' => 'required',
            'email' => 'required | email',
            'company' => 'required',
            'website' => 'required | url',
        ]);

        $aboutUs = new AboutUs();
        $aboutUs->name = $request->name;
        $aboutUs->years_of_experience = $request->years_of_experience;
        $aboutUs->email = $request->email;
        $aboutUs->company = $request->company;
        $aboutUs->website = $request->website;
        if ($request->status)
        {
            $aboutUs->status = 'enable';
        } else {
            $aboutUs->status = 'disable';
        }
        $aboutUs->save();

        return Redirect::to('/aboutus')->with('successMsg', 'About Us Page Created Successfully !!!');

    }

    public function editAboutUs($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.aboutUs.edit', compact('aboutUs'));
    }

    public function updateAboutUs(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'years_of_experience' => 'required',
            'email' => 'required | email',
            'company' => 'required',
            'website' => 'required | url',
        ]);

        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->name = $request->name;
        $aboutUs->years_of_experience = $request->years_of_experience;
        $aboutUs->email = $request->email;
        $aboutUs->company = $request->company;
        $aboutUs->website = $request->website;
        if ($request->status)
        {
            $aboutUs->status = 'enable';
        } else {
            $aboutUs->status = 'disable';
        }
        $aboutUs->save();

        return Redirect::to('/aboutus')->with('successMsg', 'About Us Page Updated Successfully !!!');

    }

    public function deleteAboutUs($id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();
        return Redirect::to('/aboutus')->with('successMsg', 'About Us Page Deleted Successfully !!!');
    }

    public function unactive_aboutUs($id)
    {
        $unactive_aboutUs = AboutUs::findOrFail($id);
        $unactive_aboutUs->update(['status' => 'disable']);
        return Redirect::to('/aboutus')->with('successMsg', 'About Us Un-activated Successfully ):');
    }

    public function active_aboutUs($id)
    {
        $active_aboutUs = AboutUs::findOrFail($id);
        $active_aboutUs->update(['status' => 'enable']);
        return Redirect::to('/aboutus')->with('successMsg', 'About Us Activated Successfully ):');
    }

}

// 'name',
//         'email',
//         'company',
//         'website',
