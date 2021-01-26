<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    /**
    * Retrieve user list.
    *
    * @param  Request  $request
    * @return Response
    */
    public function userList(Request $request){
        
        
            $columns = array(
                0 => 'id',
            );

            $totalData = User::with('userType')->get()->count();

            $totalFiltered = $totalData;

            $limit = $request->length;
            $start = $request->start;
            $order = $columns[$request->orderColumn];
            $dir = $request->orderDirectory;

            if(empty($request->search)){

            $users = User::with('userType')->offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();

            }else{

            $search = $request->search; 

            $users =  User::with('userType')->where('id','LIKE',"%{$search}%")
                        ->orWhere('first_name', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->get();

            $totalFiltered = User::with('userType')->where('id','LIKE',"%{$search}%")
                        ->orWhere('first_name', 'LIKE',"%{$search}%")
                        ->get()
                        ->count();
            }

            $data = array();

            if(!empty($users)){

                foreach ($users as $users){

                    $nestedData['id'] = $users->id;
                    $nestedData['name'] = $users->first_name.' '.$users->last_name;
                    $nestedData['user_type'] = $users->userType->description;
                    $data[] = $nestedData;

                }
            
            }

            $json_data = array(
                "draw"            => intval($request->draw),  
                "recordsTotal"    => intval($totalData),  
                "recordsFiltered" => intval($totalFiltered), 
                "data"            => $data   
                );
    
            return response()->json($json_data); 

    }
    
}
