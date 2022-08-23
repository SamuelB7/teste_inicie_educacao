@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">

        <x-adminlte-card title="Bem vindo!" theme="dark" icon="">
            <div class="card-body">
                <p>Esse é o meu teste para o processo seletivo da INICIE Educação, espero que goste!</p>
                <p>Esse sistema foi criado utilizando Laravel 9 juntamente com o AdminLTE para a criação das views.</p>
                <p>Utilize o menu a esquerda para navegar entre as páginas.</p>
                <p>Para <strong>criar</strong> um <strong>post</strong> para um usuário específico, vá nos detalhes do usuário e acesse a opção 'Criar novo post'.</p>
                <p>Para <strong>visualizar</strong> um <strong>post</strong> de um usuário específico, vá nos detalhes do usuário e acesse a opção 'Posts do usuário'.</p>
                <p>Para <strong>visualizar</strong> os <strong>comentários</strong> de um post, vá nos detalhes do post.</p>
                <p>Para <strong>adicionar</strong> um <strong>comentário</strong> em um post, vá nos detalhes do post, preencha o formulário e clique em 'Adicionar'.</p>
                <p>Para <strong>deletar</strong> um <strong>comentário</strong> de um post, vá nos detalhes do post e clique no botão 'Deletar comentário'.</p>
            </div>
        </x-adminlte-card>
            
    </div>
@stop

@section('css')
    
@stop

@section('js')
    
@stop