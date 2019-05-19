<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

use yajra\Datatables\Datatables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'religion' => 'required',
        ]);
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'religion' => $request['religion'],
        ];
        return Contact::create($data);
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
        $contact = Contact::find($id);
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $contact = Contact::find($id);
        return $contact;
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
        //
        $contact = Contact::find($id);
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->religion = $request->religion;
        $contact->update();
        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Contact::destroy($id);
    }
    public function all()
    {
        //
        $contact = Contact::all();
        //return $contacts;
        return Datatables::of($contact)
            ->addColumn('action', function ($contact) {

                return '<a onclick="showData(' . $contact->id . ')" class="btn btn-sm btn-primary">Show</a>' . ' ' .
                    '<a onclick="editData(' . $contact->id . ')" class="btn btn-sm btn-warning">Edit</a>' . ' ' .
                    '<a onclick="deleteData(' . $contact->id . ')" class="btn btn-sm btn-danger">Delete</a>';
            })->make(true);
    }
}
