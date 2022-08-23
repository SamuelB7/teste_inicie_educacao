@extends('adminlte::page')

@section('title', 'Post')

@section('content_header')
<a href="{{ Route('posts.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left mr-2"></i>Lista de posts</a>
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
                <x-adminlte-card title="{{ $post->title }}" theme="dark" icon="fas fa-fw fa-book">
                    <p>{{ $post->body }}</p>
                    <hr>
                    <div>
                        <h6>Comentários:</h6>
                        @if(sizeof($comments) == 0)
                            <p>Nenhum comentário adicionado ainda</p>
                        @else
                            <table class='table table-striped'>
                                <thead classe='h5'>
                                    <th>Nome</th>
                                    <th>Conteúdo</th>
                                    <th>Ações</th>
                                </thead>
                                <tbody id="users">
                                    @foreach($comments as $comment)
                                        <tr>
                                            <td>{{ $comment->name }}</td>
                                            <td>{{ $comment->body }}</td>
                                            <td>
                                                <form action="{{ Route('comments.destroy', $comment->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Você tem certeza?')">Deletar comentário</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        @endif
                        
                    </div>
                    <hr>
                    <form action="{{ Route('comments.store') }}" method="post">
                        @csrf

                        <h6>Adicionar novo comentário</h6>
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <label for="">Nome</label>
                            <input class="form-control" type="text" name="name" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" name="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Comentário</label>
                            <textarea class="form-control" name="body" cols="30" rows="2"></textarea required>
                            @error('body')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col text-right mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Adicionar
                            </button>
                        </div>
                    </form>
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
