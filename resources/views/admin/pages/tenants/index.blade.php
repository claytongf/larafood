{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">DashBoard</a></li>
    <li class="breadcrumb-item active">Empresas</a></li>
</ol>
<h1>Empresas <a href="{{ route('tenants.create')}}" class="btn btn-dark"><i class="fas fa-plus"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('tenants.search') }}" method="GET" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome:" class="form-control" value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="100">Imagem</th>
                        <th>Nome</th>
                        <th style="width: 280px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td><img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->name }}"  style="max-width: 150px;"></td>
                            <td>{{ $tenant->name }}</td>
                        <td>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">Editar</a>
                            <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">Ver</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}                
            @else
                {!! $tenants->links() !!}
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop