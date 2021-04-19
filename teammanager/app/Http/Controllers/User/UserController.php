<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        try {

            // $request->validate([
            //     "username"    => ["required", "max:15"],
            //     "email"       => ["required", "email:rfc"],
            //     "admin"       => ["required", "boolean"],
            //     "owner"       => ["required", "boolean"],
            //     "level_admin" => ["required", "numeric"],
            // ]);

            $dataUser = $request->input();

            $newUser = User::create($dataUser);

            return response()->json([
                "message" => $newUser->username . " foi criado com sucesso",
                "data"    => $newUser,
                "code"    => "200",
            ]);
        } catch (\Exception$exception) {
            return response()->json([
                "message"    => "Houve um erro fatal, tente novamente",
                "rawMessage" => $exception->getMessage(),
                "code"       => "500",
            ], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $allUsers = User::all()->load(["team", "team.driver"]);

            if ($allUsers->count() <= 0 || $allUsers === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            return response()->json([
                "message" => "Todo os usuarios foram encontrados",
                "data"    => $allUsers,
                "code"    => "200",
            ]);
        } catch (\Exception$exception) {
            return response()->json([
                "message"    => "Houve um erro fatal, tente novamente",
                "rawMessage" => $exception->getMessage(),
                "code"       => "500",
            ], 500);
        }
    }

    public function show(Request $request, $user_id)
    {
        try {
            $myUsers = User::find($user_id);

            if ($myUsers === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            $myUsers->team;
            $myUsers->team->driver;

            return response()->json([
                "message" => $myUsers->username . " encontrado com sucesso",
                "data"    => $myUsers,
                "code"    => "200",
            ]);
        } catch (\Exception$exception) {
            return response()->json([
                "message"    => "Houve um erro fatal, tente novamente",
                "rawMessage" => $exception->getMessage(),
                "code"       => "500",
            ], 500);
        }

    }

    public function update(Request $request, $user_id)
    {
        try {
            $updateDataUser = $request->input();

            $actualUser = User::find($user_id);

            $updatedUser = User::where("id", $user_id)
                ->update($updateDataUser);

            if (!$updatedUser) {
                return response()->json([
                    "message" => "Não foi possivel atualizar os dados de " . $actualUser->username,
                    "data"    => $updateDataUser,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualUser->username . " atualizado com sucesso",
                "data"    => $updateDataUser,
                "code"    => "200",
            ], 200);
        } catch (\Exception$exception) {
            return response()->json([
                "message"    => "Houve um erro fatal, tente novamente",
                "rawMessage" => $exception->getMessage(),
                "code"       => "500",
            ], 500);
        }
    }

    public function delete(Request $request, $user_id)
    {
        try {

            $actualUser = User::find($user_id);

            $deletedUser = User::where("id", $user_id)
                ->delete();

            if (!$deletedUser) {
                return response()->json([
                    "message" => "Não foi possivel deletar o " . $actualUser->username,
                    "data"    => $updateDataUser,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualUser->username . " deletado com sucesso",
                "code"    => "200",
            ]);
        } catch (\Exception$exception) {
            return response()->json([
                "message"    => "Houve um erro fatal, tente novamente",
                "rawMessage" => $exception->getMessage(),
                "code"       => "500",
            ], 500);
        }

    }
}
