<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

use App\Models\Appointment;

class AdminController extends Controller
{
    public function addview()
    {

        return view('admin.add_doctor');

    }

    public function upload(Request $request)
    {
        $doctor = new doctor;
        
        $image = $request->file;

        $imagename = time().'.'.$image->getClientoriginalExtension();

        $request->file->move('doctorimage', $imagename);

        $doctor->image = $imagename;

        $doctor->name = $request->name;

        $doctor->phone = $request->number;

        $doctor->room = $request->room;

        $doctor->speciality = $request->speciality;

        $doctor->save();

        return redirect()->back()->with('message','Doctor added successfully');



    }

    public function showAppointment()
    {

        $data = appointment::all();

        return view('admin.show_appointment',compact('data'));



    }

    public function approved($id)
    {
        $data = appointment::find($id);

        $data->status = 'Approved';

        $data->save();

        return redirect()->back();


    }
    
    public function canceled($id)
    {
        $data = appointment::find($id);

        $data->status = 'Canceled';

        $data->save();

        return redirect()->back();


    }

    public function showDoctor()
    {
        $data = doctor::all();


        return view('admin.show_doctor',compact('data'));

    }

    public function deleteDoctor($id)
    {
        $data = doctor::find($id);

        $data->delete();

        return redirect()->back();

    }
    
    public function updateDoctor($id)
    {
        $data = doctor::find($id);

        return view('admin.update_doctor',compact('data'));
    }

    public function editDoctor(Request $request, $id)
    {
       $doctor = doctor::find($id);

       $doctor->name = $request->name;

       $doctor->phone = $request->phone;

       $doctor->speciality = $request->speciality;

       $doctor->room = $request->room; 

       $image = $request->file;

        if($image)
        {

        $imagename = time().'.'.$image->getClientOriginalExtension();

        $request->file->move('doctorimage',$imagename);

        $doctor->image = $imagename;
        
        }

       $doctor->save();

       return  redirect()->back()->with('message','Doctor details updated successfully');

    }


}
