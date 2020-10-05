<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request('q') != null){
            // Va rechercher les tasks avec un nom correspondant a la requete q
            // Accepte les caractères avant et après la requete q ('%')
            // $tasks['data'] est là pour pouvoir boucler sur la data puisqu'on utilise une pagination (???)
            $tasks['data'] = Task::where('name', 'like', '%' . request('q') . '%')->get();
            return response()->json($tasks);
        }else{
            return $this->refresh();
        }

        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);

        return response()->json($tasks);
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
        $task = Task::create($request->all());

        // Si Task est défini, on actualise la liste des taches
        if($task){
            return $this->refresh();
        };
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
        $task = Task::find($id);

        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $task = Task::find($id);
        // Le name de la Task est défini comme étant le name de la requete
        $task->name = request('name');
        $task->save();

        // Si Task est défini, on actualise la liste des taches
        if($task){
            return $this->refresh();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if($task->delete()){
            return $this->refresh();
        }else{
            return response()->json(['error' => 'Delete method has failed.'], 425);
        }
    }

    private function refresh(){

        $tasks = Task::orderBy('created_at', 'DESC')->paginate(3);
        return response()->json($tasks);
    }
}
