<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class CommentController extends Controller
{
    public function store(Request $request) {
        try {
            //return response()->json($request);
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
            //return response()->json($e->getMessage());
            return redirect("/posts/$post_id")->with('error', 'Falha ao criar comentário, tente novamente');
        }
    }
}
