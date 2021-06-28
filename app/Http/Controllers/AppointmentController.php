<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = DB::table('appointments')
                    ->join('services', 'appointments.service_id', '=', 'services.id')
                    ->select('appointments.*', 'services.service_name', 'services.duration', 'services.fee')
                    //->oldest()
                    ->latest()
                    //->paginate(3);
                    ->get();
        //return view('admin.appointment.index', compact('appointments'));
        return response()->json($appointments, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::pluck('service_name', 'id');
        return view('appointment.create', compact('services'));
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
            'firstName' => 'required',
            'lastName' => 'required',
            'date' => 'required',
            'time' => 'required',
            'gender' => 'required',
            'email' => 'required | email',
            'phone' => 'required | numeric',
            'message' => 'required',
        ]);

        $appointment = new Appointment();
        $appointment->service_id = $request->service_name;
        $appointment->firstName = $request->firstName;
        $appointment->lastName = $request->lastName;
        $appointment->date = Carbon::now();
        $appointment->time = $request->time;
        $appointment->gender = $request->gender;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->message = $request->message;
        if ($request->status)
        {
            $appointment->status = 'enable';
        } else {
            $appointment->status = 'disable';
        }

        $appointment->save();
        return Redirect::back()->with('successMsg', 'You Have Successfully Booked An Appointment !!!');

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
        $service = Service::all();
        $appointment = Appointment::all();
        return view('admin.appointment.edit', compact('service', 'appointment'));
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
            'firstName' => 'required',
            'lastName' => 'required',
            'date' => 'required',
            'gender' => 'required',
            'email' => 'required | email',
            'phone' => 'required | phone',
            'message' => 'required',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->service_id = $request->service_name;
        $appointment->firstName = $request->firstName;
        $appointment->date = Carbon::now();
        $appointment->gender = $request->gender;
        $appointment->email = $request->email;
        $appointment->phone = $request->phone;
        $appointment->message = $request->message;
        if ($request->status)
        {
            $appointment->status = 'enable';
        } else {
            $appointment->status = 'disable';
        }

        $appointment->save();
        return Redirect::to('')->with('successMsg', 'Your Appointment Have Been Successfully Updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return Redirect::to('')->with('successMsg', 'Appointment Was Successfully Deleted !!!');
    }
}
