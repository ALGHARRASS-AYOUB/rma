<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Table;
use App\Rules\DateRule;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationStoreRequest;
use Carbon\Carbon;

class FrontendReservationController extends Controller
{
    public function stepOne(){
        $min_date=Carbon::today();
        return view('reservations.step-one',compact('min_date'));

    }

        public function store(Request $request)
    {
        $n=0;
        if(!empty($request->table && $request->guests_number)){
            $t_guests_number=Table::where('id',$request->table)->get('guests_number');
            $n=$t_guests_number[0]['guests_number'];
            $guests_number_valid=$n >= $request->guests_number?? false;

        }
        // $guests_number_valid= false;
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
        // $view=to_route('reservations.index')->with('success','reservation has been created successfully');
        // $view=redirect('/');
        return response()->json(['status'=>true,'msg'=>'registerd successfully']);
    }




    }


}
