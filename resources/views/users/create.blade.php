@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex align-items-center">
        <a href="{{ Route('users.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left mr-2"></i>Voltar</a>
    </div>
@stop


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <x-adminlte-card title="Cadastrar Usuário" theme="dark" icon="fas fa-fw  fa-user">
                    <form action="{{ Route('users.store') }}" method="post">
                        @csrf

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
                            <label for="">Gênero</label>
                            <select class="form-control" name="gender" required>
                                <option value="male">Masculino</option>
                                <option value="female">Feminino</option>
                            </select>
                            @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="active">Ativo</option>
                                <option value="inactive">Inativo</option>
                            </select>
                            @error('status')
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

@stop
