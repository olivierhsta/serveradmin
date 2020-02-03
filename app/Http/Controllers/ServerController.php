<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Server::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ip' => 'required|ip',
        ]);
        $server = new Server;
        $server->name = $request->name;
        $server->ip = $request->ip;
        $server->status = 1;
        $server->save();
        return $server;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Server $server)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'ip' => 'required|ip',
        ]);
        $server->name = $request->name;
        $server->ip = $request->ip;
        $server->save();
        return $server;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        $server->forceDelete();
    }
}
