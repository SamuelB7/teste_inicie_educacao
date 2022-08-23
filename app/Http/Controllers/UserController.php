<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function index() {

        $client = new Client();

        $apiUrl = env('API_URL');

        $apiToken = env('API_TOKEN');

        $response = $client->request(
            'GET', 
            "$apiUrl/users",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $users = json_decode($response->getBody());

        return view('users.index', compact('users'));
    }

    public function show($id) {
        $client = new Client();

        $apiUrl = env('API_URL');

        $apiToken = env('API_TOKEN');

        $response = $client->request(
            'GET', 
            "$apiUrl/users/$id",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $userDetails = json_decode($response->getBody());

        $response = $client->request(
            'GET', 
            "$apiUrl/users/$id/posts",
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer $apiToken",
                ]
            ]
        );

        $userPosts = json_decode($response->getBody());

        return view('users.show', compact('userDetails', 'userPosts'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(Request $request) {
        $validate = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'gender' => 'required',
                'status' => 'required'
            ], 
            [
                'required' => 'Esse campo é obrigatório'
            ]
        );

        try {

            $client = new Client();

            $apiUrl = env('API_URL');

            $apiToken = env('API_TOKEN');
            //return response()->json($request);
            $postData = [
                'name' => $request['name'],
                'email' => $request['email'],
                'gender' => $request['gender'],
                'status' => $request['status']
            ];

            $post = json_decode(
                $client->request(
                    'POST',
                    "$apiUrl/users",
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => "Bearer $apiToken"
                        ],
                        'json' => $postData
                    ]
                )->getBody()->getContents(), true
            );

            return redirect('/users')->with('success', 'Usuário criado com sucesso!');
        } catch( Throwable $e) {
            return redirect('/users')->with('error', 'Falha ao salvar usuário');
        }
    }
}
