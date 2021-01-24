<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Classroom;
use Carbon\Carbon;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   // Get data from DB


        $classrooms = Classroom::all();
        //dd($classrooms);
        $classrooms = Classroom::paginate(4);
/* 
        $dt = Carbon::now()->locale('it_IT');
        dump($dt->locale());
        dump($dt->isoFormat('dddd DD/MM/YYYY')); */.

        return view('classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);

        $request->validate([
            'name' => 'required|unique:classrooms|max:10',
            'description' => 'required'
        ]);

        $classroom = new Classroom();
       /*  $classroom->name = $data['name'];
        $classroom->description = $data['description']; */
        $classroom->fill($data);

        $saved = $classroom->save();
        //dd($saved);

        if($saved){
            return redirect()->route('classrooms.show', $classroom->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        /* $classroom = Classroom::find($id); */
        //dd($classrooms);

        return view('classrooms.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $classroom = Classroom::find($id);
        return view('classrooms.edit', compact('classroom'));
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
        $data = $request->all();

        $classroom = Classroom::find($id);

        $request->validate([
            'name' => [
                'required',
                Rule::unique('classrooms')->ignore($id),
                'max:10'
            ],
            'description' => 'required'
        ]);

        $update =  $classroom->update($data);

        if ($update) {
            return redirect()->route('classrooms.show', $id);
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
        $classroom = Classroom::find($id);
        $ref = $classroom->name;

        /* dd($classroom); */
         
        $deleted = $classroom->delete();
          
        
        
        if ($deleted){
            return redirect()->route('classrooms.index')->with('deleted', $ref);
        }
    }
}
