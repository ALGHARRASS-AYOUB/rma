<?php

namespace App\Http\Controllers\admin;

use App\Models\Table;

use App\Rules\DateRule;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReservationStoreRequest;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations=Reservation::all();
        return view('admin.reservations.index',compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $min_date=Carbon::today();

        // $tables=Table::all();
        // return view('admin.reservations.create',compact('tables'));
        return view('admin.reservations.create',compact('min_date'));
    }

    /**
     * Store a newly created resource in storage.
     *   @param  \Illuminate\Validation\Validator  $validator
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReservationStoreRequest $request)
    {
        $n=0;
        if(!empty($request->table && $request->guests_number)){
            $t_guests_number=Table::where('id',$request->table)->get('guests_number');
            $n=$t_guests_number[0]['guests_number'];
            $guests_number_valid=$n >= $request->guests_number?? false;

        }
    $rules=[
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required','email'],
            'tel_number'=>['required'],
            'res_date'=>['required','date', new DateRule],
            'guests_number'=>['required'],
            'table'=>'required',
            'meal'=>'required',
    ];

        $validator=validator($request->all(),$rules);


        // $validated=$request->validated();
        if($validator->fails()){

            return response()->json(['status'=>false,'error'=>$validator->errors()->toArray()]);
        }
            elseif(!$guests_number_valid){
                return response()->json(['status'=>'not','guests_number_valid'=>false,'guests_number_error'=>'the number of guests must respect the allowded number for each table,please either pick an appropriete table or change the number of your guests','nt'=>$n]);
            }
        else{

            $reservation=Reservation::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'tel_number'=>$request->tel_number,
            'res_date'=>$request->res_date,
            'meal'=>$request->meal,
            'table_id'=>$request->table,
            'guests_number'=>$request->guests_number,
        ]);
        to_route('admin.reservations.index')->with('success','reservation has been created successfully');

        $view=$this->index();
        return response()->json(['status'=>true,'msg'=>'registerd successfully','html_view'=>$view->render()]);
    }




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
    public function edit(Reservation $reservation)
    {
        $min_date=Carbon::today();
        return view('admin.reservations.edit',compact('reservation','min_date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReservationStoreRequest $request,Reservation $reservation)
    {
        $n=0;
        if(!empty($request->table && $request->guests_number)){
            $t_guests_number=Table::where('id',$request->table)->get('guests_number');
            $n=$t_guests_number[0]['guests_number'];
            $guests_number_valid=$n >= $request->guests_number?? false;

        }
    $rules=[
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required','email'],
            'tel_number'=>['required'],
            'res_date'=>['required','date', new DateRule],
            'guests_number'=>['required'],
            'table'=>'required',
            'meal'=>'required',
    ];
        $validator=validator($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['status'=>false,'error'=>$validator->errors()->toArray()]);
        }
        elseif(!$guests_number_valid){
                return response()->json(['status'=>'not','guests_number_valid'=>false,'guests_number_error'=>'the number of guests must respect the allowded number for each table,please either pick an appropriete table or change the number of your guests','nt'=>$n]);
        }
        else{
            $reservation->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'tel_number'=>$request->tel_number,
            'res_date'=>$request->res_date,
            'meal'=>$request->meal,
            'table_id'=>$request->table,
            'guests_number'=>$request->guests_number,
        ]);
        to_route('admin.reservations.index')->with('success','reservation has been updated successfully');

        $view=$this->index();
        return response()->json(['status'=>true,'msg'=>'updated successfully','html_view'=>$view->render()]);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return to_route('admin.reservations.index')->with('danger','reservation has been deleted successfully');
    }


}
