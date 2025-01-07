<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        if (!auth('sanctum')->check()) {
            return response()->json([
                "message" => "Unauthorized action."
            ], 401);
        }

        $todos = Todo::where("user_id", auth('sanctum')->id())->get();
        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        $data = $request->validated();

        $user = $request->user();

        $todo = $user->todos()->create($data);

        return response()->json([
            "message" => "Todo successfully created!",
            "todo" => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Todo $todo)
    {
        if (!auth('sanctum')->check()) {
            return response()->json([
                "message" => "Unauthenticated."
            ], 401);
        }

        if (!auth('sanctum')->user()->can('own', $todo)) {
            return response()->json([
                "message" => "Unauthorized action.",
            ], 401);
        }

        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {

        if (!auth('sanctum')->user()->can('own', $todo)) {
            return response()->json([
                "message" => "Unauthorized action.",
            ], 401);
        }

        $data = $request->validated();
        $todo->update($data);

        return response()->json([
            "message" => "Todo successfully updated!",
            "todo" => $todo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        if (!auth('sanctum')->user()->can('own', $todo)) {
            return response()->json([
                "message" => "Unauthorized action.",
            ], 401);
        }

        $todo->delete();

        return response()->json([
            'message' => 'The post has been deleted'
        ]);
    }

}
