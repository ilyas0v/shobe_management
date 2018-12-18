<?php

namespace App\Http\Controllers;

use App\Equipment;
use App\EquipmentCategory;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment_categories = EquipmentCategory::all();
        $array = [];
        foreach($equipment_categories as $ec){
            $array[$ec->name] = [];
            $equipments = Equipment::where('category',$ec->id)->get();
            foreach($equipments as $equipment){
                $array[$ec->name][] = $equipment;
            }
        }

        return view('admin.report.index',compact('array'));
    }


    public function download(){
        $equipment_categories = EquipmentCategory::all();
        $array = [];
        foreach($equipment_categories as $ec){
            $array[$ec->name] = [];
            $equipments = Equipment::where('category',$ec->id)->get();
            foreach($equipments as $equipment){
                $array[$ec->name][] = $equipment;
            }
        }
        $data = ['array' => $array];
        $pdf = PDF::loadView('admin.pdf.report', $data);
        return $pdf->download('reports.pdf');
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
}
