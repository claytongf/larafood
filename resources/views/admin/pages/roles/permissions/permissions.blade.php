@extends('adminlte::page')

@section('title', "Permissões da Role {$role->name}")

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">DashBoard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index')}}">Perfis</a></li>
    <li class="breadcrumb-item active">Permissões</a></li>
</ol>
<h1>Permissões da Role {{$role->name}} <a href="{{ route('roles.permissions.available', $role->id)}}" class="btn btn-dark"><i class="fas fa-plus"></i> ADD NOVA PERMISSÃO</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th style="width: 180px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ route('roles.permissions.detach', [$role->id, $permission->id]) }}" class="btn btn-danger"><i class="fas fa-lock-open"></i> Desvincular</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}                
            @else
                {!! $permissions->links() !!}
            @endif
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop