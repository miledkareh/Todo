<?php

namespace App\Http\Controllers;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class StatusesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    public function getAllStatus(){
        try 
        {
        
        return response()->json(Status::all());
        }catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'tasks', 
                       'action' => 'get', 
                       'result' => 'failed'
            ], 409);
        }
     }


     public function addStatus(Request $request)
     {
         $this->validate($request, [
             'Name' => 'required|string'
         ]);
 
         $status= new Status;
         $status->Name= $request->input('Name');
         $status->save();
         return response()->json($status);
     }

     public function updateStatus(Request $request, $id)
     {
         $this->validate($request, [
             'Name' => 'required|string'
         ]);
 
         $status= Status::find($id);
         $status->Name= $request->input('Name');
        
         $status->save();
         return response()->json($status);
     }

     public function deleteStatus($id){
        Status::findOrFail($id)->delete();
        return 'Deleted Successfully';
     }
}
