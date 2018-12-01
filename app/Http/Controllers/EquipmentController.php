<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\EquipmentCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = Equipment::where('deleted',0)->orderBy('id','DESC')->get();
        return view('admin.equipment.index' , compact('equipments') , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EquipmentCategory::all();
        return view('admin.equipment.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|max:100|string',
            'model' => 'required|string',
            'serial' => 'string|unique:equipment',
            'inventory_no' => 'string|max:100|unique:equipment',
            'purchase_date' => 'date',
            'category' => 'integer|exists:equipment_categories,id',
            'status' => 'integer'
        ]);


        $eq = new Equipment();
        $eq->name = $request->name;
        $eq->model = $request->model;
        $eq->serial = $request->serial;
        $eq->inventory_no = $request->inventory_no;
        $eq->purchase_date = $request->purchase_date;
        $eq->category = $request->category;
        $eq->status = $request->status;

        $eq->save();

        Session::flash('success' , 'Equipment has been added.');

        return redirect()->route('equipment.index');


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
        //
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
    }

    public function assign_form($id){
        return "Hello $id";
    }

    public function assign(Request $request, $id){
        //
    }


}
