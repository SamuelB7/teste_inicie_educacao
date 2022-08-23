@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <a href="{{ Route('users.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left mr-2"></i>Voltar</a>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                
            </div>
            <div class="col text-right">
                
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
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{$message}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <x-adminlte-card title="{{ $userDetails->name }}" theme="dark" icon="fas fa-fw  fa-user">
                    <div class="card-header">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#details">Detalhes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#posts">Posts de {{ $userDetails->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#newpost">Criar novo post</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="details">
                                <div class="row">
                                    <div class="col">
                                        <label class="mr-2">ID:</label>
                                        <p>{{$userDetails->id}}</p>

                                        <label class="mr-2">Nome:</label>
                                        <p>{{$userDetails->name}}</p>

                                        <label class="mr-2">Email:</label>
                                        <p>{{$userDetails->email}}</p>
                                    </div>
                                    <div class="col">
                                        <label class="mr-2">Gênero:</label>
                                        <p>{{$userDetails->gender}}</p>

                                        <label class="mr-2">Status:</label>
                                        <p>{{$userDetails->status}}</p>
                                    </div>
                                </div>
                                {{--<div class="d-flex">
                                    <a href="{{ Route('users.edit', $userDetails->id) }}" class="btn btn-sm btn-warning mr-2">Edit</a>
                                    <form action="{{ Route('users.destroy', $userDetails->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button onclick=" return confirm('Are you sure?')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>--}}
                            </div>
                            <div class="tab-pane" id="posts">
                                <table class='table table-striped'>
                                    <thead classe='h5'>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Ação</th>
                                    </thead>
                                    <tbody id="users">
                                        @foreach ($userPosts as $posts)
                                            <tr>
                                                <td>{{ $posts->id }}</td>
                                                <td>{{ $posts->title }}</td>
                                                <td>
                                                    <a href="{{ Route('posts.show', $posts->id) }}" class="btn btn-primary btn-sm">
                                                        Detalhes
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="newpost">
                                <x-adminlte-card title="Novo post" theme="dark" icon="fas fa-fw fa-book">
                                    <form action="{{ Route('posts.store') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="user_id" value="{{ $userDetails->id }}">

                                        <div class="form-group">
                                            <label for="">Título</label>
                                            <input class="form-control" type="text" name="title" required>
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Conteúdo</label>
                                            <textarea class="form-control" name="body" id="" cols="30" rows="10" required>

                                            </textarea>
                                            @error('body')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="col text-right mt-3">
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-save"></i> Salvar
                                            </button>
                                        </div>
                                    </form>

                                </x-adminlte-card>
                            </div>
                        </div>
                    </div>
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
