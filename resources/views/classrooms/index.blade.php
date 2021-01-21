@extends('layouts.main')
@section('content')
   <div class="container mb-5">
       <h1>OUR CLASSROOMS</h1>
       
       <table class="table table-striped mt-5">
          <thead>
              <tr>
                 <th>ID</th>
                 <th>Name</th>
                 <th></th>
                 <th></th>
                 <th></th>
              </tr>
          </thead>
          <tbody>
               @foreach($classrooms as $classroom)
                   <tr>
                       <td>{{$classroom->id}}</td>
                       <td>{{$classroom->name}}</td>
                       <td class="text-center" width="100">
                          <a class="btn btn-success" href="{{route('classrooms.show', $classroom->id)}}">
                             Show
                          </a>
                       </td>
                       <td class="text-center" width="100">
                          <a class="btn btn-primary" href="{{route('classrooms.show', $classroom->id)}}">
                             Edit
                          </a>
                       </td>
                       <td class="text-center" width="100">
                          <a class="btn btn-danger" href="{{route('classrooms.show', $classroom->id)}}">
                             Delete
                          </a>
                       </td>
                   </tr>
               @endforeach
          </tbody>
       </table>
   </div>
@endsection