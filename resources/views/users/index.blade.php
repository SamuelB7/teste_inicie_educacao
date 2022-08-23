@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Usuários</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col text-right">
                <a href="{{ Route('users.create') }}" class='btn btn-primary'>
                    <i class='fas fa-plus'></i>
                    Adicionar
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-4">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <x-adminlte-card title="Tabela de usuários" theme="dark" icon="fas fa-fw fa-users">

                    <table class='table table-striped'>
                        <thead classe='h5'>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Gênero</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="users">
                            @foreach ($users as $user)
                                <tr id="user-{{$user->id}}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->gender }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td>
                                        <a href="{{ Route('users.show', $user->id) }}" class="btn btn-primary btn-sm">
                                            Detalhes
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    
                </x-adminlte-card>
            </div>
        </div>
    </div>


@stop

@section('css')

@stop

@section('js')

    @if ($message = Session::get('success'))
        <script>
            toastr.success("{{ $message }}")
        </script>
    @endif

@stop
