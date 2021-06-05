<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "Erro" => "Formato de email inválido"
            ]);
        }

        $emailExists = User::where("email", $request->email)->first();

        if ($emailExists) {
            return response()->json([
                "Erro" => "Email já existente"
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $token = $user->createToken("user_token")->plainTextToken;

        return response()->json([
            "sucess" => true,
            "user_token" => $token,
            "user_id" => $user->id
        ]);
    }

    public function Login(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return response()->json([
                "Erro" => "Formato email inválido"
            ]);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'Erro' => 'Dados inválido'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken("user_token")->plainTextToken;


        return response()->json([
            "sucess" => true,
            "user_token" => $token,
            "user_id" => $user->id
        ]);
    }


    public function getTodos(User $user)
    {
        return response()->json([
            "todos" => $user->todos()
                ->orderBy("name", "DESC")
                ->get(["id", "name", "done"])
        ]);
    }

    public function add(Request $request, User $user)
    {
        $todo = new Todo();
        $todo->name = $request->name;
        $user->todos()->save($todo);

        return response()->json([
            "sucess" => true
        ]);
    }
}
