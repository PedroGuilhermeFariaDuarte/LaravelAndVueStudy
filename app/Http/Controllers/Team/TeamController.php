<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function create(Request $request)
    {
        try {
            $dataTeam = $request->input();

            $newTeam = Team::create($dataTeam);

            return response()->json([
                "message" => $newTeam->name . " foi criado com sucesso",
                "data"    => $newTeam,
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
            $allTeams = Team::all()->load(["user", "driver"]);

            if ($allTeams->count() <= 0 || $allTeams === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            return response()->json([
                "message" => "Todo as equipes foram encontrados",
                "data"    => $allTeams,
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

    public function show(Request $request, $team_id)
    {
        try {
            $myTeam = Team::find($team_id);

            if ($myTeam === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            $myTeam->user;
            $myTeam->driver;

            return response()->json([
                "message" => $myTeam->name . " encontrado com sucesso",
                "data"    => $myTeam,
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

    public function update(Request $request, $user_id, $team_id)
    {
        try {
            $updateDataTeam = $request->input();
            $actualTeam     = Team::find($team_id);

            $updatedTeam = Team::where([
                ["id", "=", $team_id],
                ['user_id', "=", $user_id]]
            )
                ->update($updateDataTeam);

            if (!$updatedTeam) {
                return response()->json([
                    "message" => "Não foi possivel atualizar os dados de " . $actualTeam->name,
                    "data"    => $updateDataTeam,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualTeam->name . " atualizado com sucesso",
                "data"    => $updateDataTeam,
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

    public function delete(Request $request, $user_id, $team_id)
    {
        try {

            $actualTeam = Team::find($team_id);

            $deletedTeam = Team::where([
                ["id", "=", $team_id],
                ["user_id", "=", $user_id],
            ])
                ->delete();

            if (!$deletedTeam) {
                return response()->json([
                    "message" => "Não foi possivel deletar o " . $actualTeam->name,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualTeam->name . " deletado com sucesso",
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
