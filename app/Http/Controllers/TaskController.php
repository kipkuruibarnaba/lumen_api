<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return DB::table('tasks')->paginate(15);
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
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'status' => 'required',
            // 'due_date' => 'required',
            'due_date' => 'required|date|after:today'
        ]);
        $alltask= Task::all();
        foreach($alltask as $task){

        if($task->title==$request->title){
            return response()->json([
                'status'=>200,
                'Not saved'=>'A title similar to '.$request->title.' already exist'
            ]); 
        }
    }

        $Task = new Task();
        $Task->title=$request->title;
        $Task->description=$request->description;
        $Task->status=$request->status;
        // $Task->status='Pending';
        $Task->due_date=$request->due_date;
        $Task->save();

        return response()->json([
            'status'=>200,
            'message'=>'Task Added Successfully'
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Task::find($id)){
            $Task = Task::find($id);;
            return $Task;
        }else{
            return response()->json([
                'Task with id '.$id =>'Not available to be retrieved'
            ]);   
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
       if(Task::find($id)){
        $Task = Task::find($id);
        $Task->title=$request->title;
        $Task->description=$request->description;
        $Task->status=$request->status;
        $Task->due_date=$request->due_date;
        $Task->save();
        return response()->json([
            'message'=>'Task Updated Successfully'
        ]); 
    }else{
        return response()->json([
            'Task with id '.$id =>'Not available to be updated'
        ]);   
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        if(Task::find($id)){
            Task::destroy($id);
            return response()->json([
                'task '.$id=>'Deleted Successfully'
               ]); 
        } else {
            return response()->json([
                'task '.$id=>'Not not found'
               ]); 
        }
    }

    public function showbytitle(Request $request )
    {
        
        $task = DB::table('tasks')->where('title', $request->title)->get();
        if(empty($task)|| $task->isEmpty()){
            return response()->json([
                'Task with title '.$request->title =>'Not Found'
            ]);      
        }
         return $task;
    }
    public function filterstatdate(Request $request )
    {
        $status = $request->get('status');
        $dateFrom = $request->get('from_date');
        $dateTo = $request->get('to_date');
        $data ='';
        $data = Task::where("status", $status)
        ->whereBetween("due_date", [Carbon::parse($dateFrom . " 00:00:00"), Carbon::parse($dateTo . " 23:59:59")])
        ->orderByDesc("created_at")
        ->get();

        return $data;
    }
}
