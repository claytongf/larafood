
@extends('adminlte::page')

@section('title', "Editar Mesa: {$table->name}")

@section('content_header')
    <h1>Editar Mesa: {{$table->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tables.update', $table->id)}}" class="form" method="POST">
                @csrf
                @method('PUT')
                @include('admin.pages.tables._partials.form')
            </form>
        </div>
    </div>
@endsection