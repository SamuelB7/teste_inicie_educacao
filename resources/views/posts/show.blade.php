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
                        <h5>Comentários</h5>
                        <div class="d-flex flex-column">
                            @foreach($comments as $comment)
                                <strong>{{$comment->name}}: </strong> {{$comment->body}}
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    <form action="{{ Route('comments.store') }}" method="post">
                        @csrf

                        <h5>Adicionar novo comentário</h5>
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
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Comentário</label>
                            <textarea class="form-control" name="body" cols="30" rows="2"></textarea>
                            @error('name')
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
