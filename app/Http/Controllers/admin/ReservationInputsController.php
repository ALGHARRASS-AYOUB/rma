<?php

namespace App\Http\Controllers\admin;

use App\Models\Table;
use App\Rules\DateRule;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ReservationStoreRequest;

class ReservationInputsController extends Controller
{
    public function verifyDate(Request $request){

        $res_date=$request->res_date;
        $rule=[
            'res_date'=>[new DateRule],
        ];
            $meal=['breakfast','lunch','dinner'];
            $date_validator=validator($request->all(),$rule);
            if($date_validator->fails()){
                return response()->json(['status'=>false,'errors'=>$date_validator->errors()]);
            } else{

                $res=null;
                $reservation_founded = Reservation::where('res_date',$res_date)->first();
                         if($reservation_founded){
                            // $meal=array_diff($meal,[$reservation_founded->meal]);
                            $res= response()->json(array("exists" => true,"meal"=>$meal));
                    }else{
                              $res= response()->json(array("exists" => false,"meal"=>$meal));
                         }
            return $res;

            }
    }

    public function verifyMeal(Request $request){
        $res_date=$request->res_date;
        $meal=$request->meal;
        $status="avaliable";
        $rule=[
            'res_date'=>['required',new DateRule],
            'meal'=>'required',
        ];
        $tables=Table::where('status',$status)->get();
        $tables_reserved=[];
        $date_validator=validator($request->all(),$rule);
            if($date_validator->fails()){
                return response()->json(['status'=>false,'errors'=>$date_validator->errors()]);
            } else{

                $res=null;

                $reservations_founded = Reservation::where('res_date',$res_date)->where('meal',$meal)->get();
                    if($reservations_founded){
                                foreach ($reservations_founded as $reservation_founded) {
                                    array_push($tables_reserved,$reservation_founded->table_id);
                                }
                                $tables=Table::whereNotIn('id',$tables_reserved)->where('status',$status)->get();
                            $res= response()->json(array("exists" => true,"tables"=>$tables));
                    }else{
                              $res= response()->json(array("exists" => false,"tables"=>$tables));
                         }
                return $res;

                }
    }

}

