<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $publishers = Publisher::all();

        return view('admin.publisher', compact('publishers'));
    }
    public function api()
    {
       $publishers = publisher::all();
       $datatables = datatables()->of($publishers)->addIndexColumn();

       return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        /**$this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required|string|regex:/^08[0-9]{9}$/',
            'address' => 'required|string',
        ]);*/
        $this->validate($request,[
            'name'  =>  ['required'],
            'email'  =>  ['required'],
            'phone_number'  =>  ['required'],
            'address'  =>  ['required'],
        ]);

        Publisher::create($request->all());

        return redirect('publishers');

    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publisher');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {

        $publisher->name = $request->input('name');
        $publisher->email = $request->input('email');
        $publisher->phone_number = $request->input('phone_number');
        $publisher->address = $request->input('address');
        $publisher->save();
        return redirect('publishers');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
    }
}