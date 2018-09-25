<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($term=null) 

    {
       if($term !=null){
           $tasks['data'] = Todo::where('name','like','%'.$term.'%')->get();
           return request()->json(200,$tasks);
       }


        return $this->_getRecord();
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
    public function store(TodoRequest $request)
    {
         $task = Todo::create($request->all());

         if($task){
            return $this->_getRecord();
         }

         else{
            
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $task)
    {
        return request()->json(200,$task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, Todo $task)
    {
       $task->name = $request->name;
       if($task->save()){
        return $this->_getRecord();
       }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $task)
    {
        if( $task->delete() )
        return $this->_getRecord();
        else
        return response()->json(425); 
    }

    private function _getRecord(){
        $tasks = Todo::orderBy('created_at','desc')->paginate(5);
            return request()->json(200,$tasks );
    }
}
