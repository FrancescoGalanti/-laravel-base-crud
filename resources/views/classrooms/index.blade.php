@extends('layouts.main')
@section('content')
   <div class="container mb-5">
       <h1>OUR CLASSROOMS</h1>
       @if (session('deleted'))
        <div class="alert alert-danger">
            {{session('deleted')}} deleted!
        </div>
            
        @endif
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
                          <a class="btn btn-primary" href="{{route('classrooms.edit', $classroom->id)}}">
                             Edit
                          </a>
                       </td>
                       <td class="text-center" width="100">
                         <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Delete">
                         </form>
                       </td>
                   </tr>
               @endforeach
          </tbody>
       </table>
   </div>
@endsection