@extends('adminlte::page')

@section('title', "Perfis da Permissão {$permission->name}")

@section('content_header')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">DashBoard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.index')}}">Perfis</a></li>
    <li class="breadcrumb-item active">Perfis</a></li>
</ol>
<h1>Perfis da Permissão {{$permission->name}}</h1>
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{ $profile->name }}</td>
                        <td>
                            <a href="{{ route('profiles.permissions.detach', [$permission->id, $profile->id]) }}" class="btn btn-danger"><i class="fas fa-lock-open"></i> Desvincular</a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}                
            @else
                {!! $profiles->links() !!}
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