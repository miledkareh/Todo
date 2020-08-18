<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Task;
use App\Category;
use Illuminate\Support\Facades\Auth;
class TasksController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('Tasks.index')->with('tasks', Task::All()->where('user_id',Auth::user()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    // get all tasks for a scpecific user 

     public function getTasks(Request $request){
        try 
        {
         $user_id=$request->input('id');
        return response()->json(DB::table('tasks')
        ->leftJoin('categories', 'tasks.category_id', 'categories.id')
        ->leftJoin('statuses', 'tasks.status_id', 'statuses.id')
        ->select('tasks.*', 'categories.Name as categoryName', 'statuses.Name as statusName')
        ->where('tasks.user_id',$user_id)
        ->where('tasks.deleted_at',null)
        ->get());
        }catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'tasks', 
                       'action' => 'get', 
                       'result' => 'failed'
            ], 409);
        }
     }

     //get all task for a scpecific user by date
     public function getTasksByDate(Request $request){

        try 
        {
         $date=$request->input('date');
         $category=$request->input('category');
         $status=$request->input('status');
         $id=$request->input('id');
    
        $match=array(
            ['user_id', $id]
        );
       
       if($date!='')
       array_push($match,['Dat',$date]);
       if($category!=0)
       array_push($match,['category_id',$category]);
       if($status!=0)
       array_push($match,['status_id',$status]);
    
       $query=DB::table('tasks')
       ->leftJoin('categories', 'tasks.category_id', 'categories.id')
       ->leftJoin('statuses', 'tasks.status_id', 'statuses.id')
       ->select('tasks.*', 'categories.Name as categoryName', 'statuses.Name as statusName')
       ->where('tasks.user_id',$id)
       ->where('tasks.deleted_at',null)
       ->where($match)
       ->get();
       return response()->json($query);
        } 
        catch (\Exception $e) 
        {
         
           return response()->json( [
                      'entity' => 'tasks', 
                      'action' => 'getByDate', 
                      'result' => 'failed'
           ], 409);
       } 
    }

    public function getTasksByMonth(Request $request){

        try 
        {
         $month=$request->input('month');
         $year=$request->input('year');
         $category=$request->input('category');
         $status=$request->input('status');
         $id=$request->input('id');
         
         $match=array(
            ['tasks.user_id', $id]
        );
       

       if($category!=0)
       array_push($match,['category_id',$category]);
       if($status!=0)
       array_push($match,['status_id',$status]);
    
       $query=DB::table('tasks')
       ->leftJoin('categories', 'tasks.category_id', 'categories.id')
       ->leftJoin('statuses', 'tasks.status_id', 'statuses.id')
       ->select('tasks.*', 'categories.Name as categoryName', 'statuses.Name as statusName')
       ->where('tasks.deleted_at',null)
       ->where($match)
       ->whereMonth('Dat', $month)
       ->whereYear('Dat',$year)
       ->get();
       return response()->json($query);
        } 
        catch (\Exception $e) 
        {
        
           return response()->json( [
                      'entity' => 'tasks', 
                      'action' => 'getByMonth', 
                      'result' => 'failed'
           ], 409);
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
        return response()->json(Tasks::all());
    }

  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTask(Request $request, $id)
    {
        $this->validate($request, [
            'Name' => 'required|string'
        ]);

        $task= Task::find($id);
        $task->Name= $request->input('Name');
        $task->Description= $request->input('Description');
        $task->Dat= $request->input('Dat');
        $task->category_id= $request->input('Category');
        $task->status_id= $request->input('Status');
       
        $task->save();
        return response()->json($task);
    }

    public function addTask(Request $request)
    {
        $this->validate($request, [
            'Name' => 'required|string'
        ]);

        $task= new Task;
        $task->Name= $request->input('Name');
        $task->Description= $request->input('Description');
        $task->Dat= $request->input('Dat');
        $task->category_id= $request->input('Category');
        $task->status_id= $request->input('Status');
        $task->user_id= $request->input('user_id');
        $task->save();
        return response()->json($task);
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
