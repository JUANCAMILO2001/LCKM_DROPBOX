
@extends('layouts.app')
@section('title', 'Mis Archivos')

@section('content')
    <a href="{{route('user.files.index')}}" class="font-bold  py-3 px-4 rounded-md bg-red-500 hover:bg-red-600">{{_('Mis archivos')}}</a>
    <a href="{{route('login.index')}}" class="font-bold  py-3 px-4 rounded-md bg-red-500 hover:bg-red-600">{{_('Subir Archivos')}}</a>

    <h1 class="text-5xl text-center pt-24">Mis Archivos</h1>

    <div class="table-responsive">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre del Archivo</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
            @foreach($files as $file)
                <tr>
                    <th scope="row">{{$file->id}}</th>
                    <td>{{$file->name}}</td>
                    <td>
                        <a href="{{route('user.files.show', $file->id)}}" class="btn btn-sm btn-outline-secondary"> ver</a>
                    </td>
                    <td>
                        <form action="{{route('user.files.destroy', $file->id)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                        </form>


                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
