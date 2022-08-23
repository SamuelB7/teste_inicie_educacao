<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class PostController extends Controller
{
    public function index() {
        $client = new Client();

        $apiUrl = env('API_URL');

        $apiToken = env('API_TOKEN');

        $response = $client->request(
            'GET', 
            "$apiUrl/posts",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $posts = json_decode($response->getBody());

        return view('posts.index', compact('posts'));
    }

    public function show($id) {
        $client = new Client();

        $apiUrl = env('API_URL');

        $apiToken = env('API_TOKEN');

        $response = $client->request(
            'GET', 
            "$apiUrl/posts/$id",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $post = json_decode($response->getBody());

        $response = $client->request(
            'GET', 
            "$apiUrl/posts/$id/comments",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $comments = json_decode($response->getBody());
        
        return view('posts.show', compact('post', 'comments'));
    }


    public function store(Request $request) {
        try {

            $client = new Client();

            $apiUrl = env('API_URL');

            $apiToken = env('API_TOKEN');
            
            $user_id = $request['user_id'];
            $postData = [
                'user_id' => $request['user_id'],
                'title' => $request['title'],
                'body' => $request['body'],
            ];

            $post = json_decode(
                $client->request(
                    'POST',
                    "$apiUrl/users/$user_id/posts",
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer $apiToken"
                        ],
                        'json' => $postData
                    ]
                )->getBody()->getContents(), true
            );

            return redirect("/users/$user_id")->with('success', 'Post criado com sucesso!');
        } catch( Throwable $e) {
            //return response()->json($e->getMessage());
            return redirect("/users/$user_id")->with('error', 'Falha ao criar post, tente novamente');
        }
    }
}
