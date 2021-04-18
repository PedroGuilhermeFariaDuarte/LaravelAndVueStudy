<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Drive;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function create(Request $request)
    {
        try {
            $dataDriver = $request->input();

            $newDriver = Drive::create($dataDriver);

            return response()->json([
                "message" => $newDriver->name . " foi criado com sucesso",
                "data"    => $newDriver,
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
            $allDrivers = Drive::all()->load(["team"]);

            if ($allDrivers->count() <= 0 || $allDrivers === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            return response()->json([
                "message" => "Todo os pilotos foram encontrados",
                "data"    => $allDrivers,
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

    public function show(Request $request, $driver_id)
    {
        try {
            $myDriver = Drive::find($driver_id);

            if ($myDriver === null) {
                return response()->json([
                    "message" => "Nenhum dado foi encontrado",
                    "code"    => "404",
                ], 404);
            }

            $myDriver->team;

            return response()->json([
                "message" => $myDriver->name . " encontrado com sucesso",
                "data"    => $myDriver,
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

    public function update(Request $request, $drive_id)
    {
        try {
            $updateDataDriver = $request->input();
            $actualDriver     = Drive::find($drive_id);

            $updatedDriver = Drive::where([
                ["id", "=", $drive_id],
            ]
            )
                ->update($updateDataDriver);

            if (!$updatedDriver) {
                return response()->json([
                    "message" => "Não foi possivel atualizar os dados de " . $actualDriver->name,
                    "data"    => $updateDataDriver,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualDriver->name . " atualizado com sucesso",
                "data"    => $updateDataDriver,
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

    public function delete(Request $request, $driver_id)
    {
        try {

            $actualDriver = Drive::find($driver_id);

            $deletedDriver = Drive::where([
                ["id", "=", $driver_id],
            ])
                ->delete();

            if (!$deletedDriver) {
                return response()->json([
                    "message" => "Não foi possivel deletar o " . $actualDriver->name,
                    "code"    => "500",
                ], 500);
            }

            return response()->json([
                "message" => $actualDriver->name . " deletado com sucesso",
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
