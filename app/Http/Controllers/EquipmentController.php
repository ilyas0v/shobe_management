<?php

namespace App\Http\Controllers;

use App\Act;
use App\Employee;
use App\Equipment;
use App\EquipmentCategory;
use App\Feature;
use App\Room;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;
use Validator;
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
        $rooms = Room::all();
        return view('admin.equipment.create' , compact('categories','rooms'));
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
            'status' => 'integer',
            'price' => 'integer|required',
            'equipment_type' => 'integer',
            'room_id' => 'integer|exists:rooms,id'
        ]);

        $eq = new Equipment();
        $eq->name = $request->name;
        $eq->model = $request->model;
        $eq->serial = $request->serial;
        $eq->inventory_no = $request->inventory_no;
        $eq->purchase_date = $request->purchase_date;
        $eq->category = $request->category;
        $eq->status = $request->status;
        $eq->price = $request->price;
        $eq->room_id = $request->room_id;
        $eq->save();

        $keys = $request->feature_name;
        $values = $request->feature_value;

        for($i=0;$i<count($keys);$i++){
            $f = new Feature();
            $f->key = $keys[$i];
            $f->value = $values[$i];
            $f->equipment_id = $eq->id;
            $f->save();
        }


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
        $equipment = Equipment::find($id);
        return view('admin.equipment.details',compact('equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = EquipmentCategory::all();
        $equipment = Equipment::find($id);
        return view('admin.equipment.edit',compact('categories','equipment'));
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
        //var_dump($request->feature_id);exit;
        $this->validate($request , [
            'name' => 'required|max:100|string',
            'model' => 'required|string',
            'serial' => 'string',
            'inventory_no' => 'string|max:100',
            'purchase_date' => 'date',
            'category' => 'integer|exists:equipment_categories,id',
            'status' => 'integer',
            'price' => 'integer|required',
            'equipment_type' => 'integer'
        ]);

        $eq = Equipment::find($id);
        $eq->name = $request->input('name');
        $eq->model = $request->input('model');
        $eq->serial = $request->input('serial');
        $eq->inventory_no = $request->input('inventory_no');
        $eq->purchase_date = $request->input('purchase_date');
        $eq->category = $request->input('category');
        $eq->status = $request->input('status');
        $eq->price = $request->input('price');
        $eq->save();

        $old_keys = $request->input('feature_name_old');
        $old_values = $request->input('feature_value_old');
        $old_feature_ids = $request->input('feature_id_old'); // [1,2];  [1,2,3,4]

        $all_features_from_db = Feature::where('equipment_id' , $id)->get();

        if($old_feature_ids){
            for($i=0;$i<count($all_features_from_db);$i++){
                $feature_id_from_db = $all_features_from_db[$i]->id;
                if(!in_array($feature_id_from_db , $old_feature_ids)){
                    $feature = Feature::find($feature_id_from_db);
                    $feature->delete();
                }
            }
        }else{
            $e = Equipment::find($id);
            $e->features()->delete();
        }

        if($old_keys){
            for($i=0;$i<count($old_keys);$i++){
                $f = Feature::find($old_feature_ids[$i]);
                $f->key = $old_keys[$i];
                $f->value = $old_values[$i];
                $f->save();
            }
        }

        $new_feature_keys = $request->input('feature_name_new');
        $new_feature_values = $request->input('feature_value_new');

        if($new_feature_keys){
            for($i=0;$i<count($new_feature_keys);$i++){
                $f = new Feature();
                $f->key = $new_feature_keys[$i];
                $f->value = $new_feature_values[$i];
                $f->equipment_id = $id;
                $f->save();
            }
        }


        Session::flash('Equipment has been changed');

        return redirect()->route('equipment.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        $equipment->features()->delete();
        $equipment->delete();

        Session::flash('success' , 'Equipment has been deleted');

        return redirect()->route('equipment.index');
    }

    public function assign_form($id){
        $equipment = Equipment::find($id);
        $employees = Employee::where('deleted',0)->get();
        return view('admin.equipment.assign',compact('equipment'),compact('employees'));
    }

    public function assign(Request $request, $id){
        try{
           $employee = $request->employee;
           $emp_id = explode('@',$employee)[0];
           $data = ['emp_id' => $emp_id , 'act_no' => $request->act_no , 'file' => $request->file,'date'=>$request->date];
            $validator = Validator::make($data, [
                'emp_id' => 'integer|exists:employees,id',
                //'file' => 'max:10000|mimes:jpg,pdf,doc,docx',
                'date' => 'date',
                'act_no' => 'max:100'
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            }

            $act = new Act();
            $act->employee_id = $emp_id;
            $act->equipment_id = $id;
            $act->date = $data['date'];
            $act->act_no = $data['act_no'];

            if($request->hasFile('file')){
                $file = $request->file('file')[0];
                $destinationPath = 'act_files';
                $file_name = time().".".$file->getClientOriginalExtension();
                $file->move($destinationPath,$file_name);
                $act->file = $destinationPath."/".$file_name;
            }else{
                $act->file = "";
            }

            $act->save();

            Session::flash('success' , 'You assigned equipment succesfully..');

            return redirect()->route('equipment.index'  );

        }catch(Exception $e){
            return back();
        }
    }


    public function getFeatureFields($cat_id){
        $equipment = Equipment::where('category' , $cat_id)->get()->last();
        if(!$equipment) return null;
        $features = $equipment->features()->get()->toArray();
        return ($features);
    }


}
