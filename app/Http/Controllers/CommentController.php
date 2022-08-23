<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
    public function store(Request $request) {
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'body' => 'required',
            ], 
            [
                'required' => 'Esse campo é obrigatório'
            ]
        );

        try {
            $client = new Client();

            $apiUrl = env('API_URL');

            $apiToken = env('API_TOKEN');
            
            $post_id = $request['post_id'];
            $postData = [
                'post_id' => $request['post_id'],
                'name' => $request['name'],
                'email' => $request['email'],
                'body' => $request['body'],
            ];

            $post = json_decode(
                $client->request(
                    'POST',
                    "$apiUrl/posts/$post_id/comments",
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer $apiToken"
                        ],
                        'json' => $postData
                    ]
                )->getBody()->getContents(), true
            );

            return redirect("/posts/$post_id")->with('success', 'Comentário criado com sucesso!');
        } catch( Throwable $e) {
            return redirect("/posts/$post_id")->with('error', 'Falha ao criar comentário, tente novamente');
        }
    }

    public function destroy(Request $request, $id) {
        try {
            $client = new Client();

            $apiUrl = env('API_URL');

            $apiToken = env('API_TOKEN');
            
            $post_id = $request['post_id'];

            $post = json_decode(
                $client->delete(
                    "$apiUrl/comments/$id",
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer $apiToken"
                        ]
                    ]
                )->getBody()->getContents(), true
            );

            return redirect("/posts/$post_id")->with('success', 'Comentário deletado com sucesso!');
        } catch( Throwable $e) {
            return redirect("/posts/$post_id")->with('error', 'Falha ao deletar comentário, tente novamente');
        }
    }
}
