@extends('layouts.app')
@section('title', 'Home')

@section('content')
    <h1 class="text-5xl text-center pt-24">Subir archivos</h1>
    <a href="{{route('user.files.index')}}" class="font-bold  py-3 px-4 rounded-md bg-red-500 hover:bg-red-600">{{_('Mis archivos')}}</a>
    <a href="{{route('login.index')}}" class="font-bold  py-3 px-4 rounded-md bg-red-500 hover:bg-red-600">{{_('Subir Archivos')}}</a>

    <form action="{{route('users.files.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="files[]" multiple required>
        <button type="submit" class="mt-4 btn btn-primary float-rigth">subir</button>
    </form>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@endsection
