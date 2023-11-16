<?php

namespace App\Http\Controllers\ClientController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Helpers\Response;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $clients = Client::whereNull('deleted_at')->orderBy('nome')->get();

            return Response::Api(true, 'sucess', 200, $clients);
        } catch (\Exception $e) {
            return Response::Api(true, $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $client = Client::whereNull('deleted_at')->orderBy('nome')->find($id);

            if (!$client) return Response::Api(false, 'Cliente não encontrado', 404);

            return Response::Api(true, 'sucesso', 200, $client);
        } catch (\Exception $e) {
            return Response::Api(false, $e->getMessage(), 500);
        }
    }

    public function store(StoreClientRequest $request)
    {
        try {
            $data = $request->validated();

            $data['cpf'] = $this->formatCPF($data['cpf']);
            $data['dataNascimento'] = Carbon::parse($data['dataNascimento'])->format('Y-m-d');

            $data = $request->validated();

            $createdClient = Client::create($data);

            return Response::Api(true, 'Criado com sucesso', 200, $createdClient);
        } catch (\Exception $e) {
            return Response::Api(true, $e->getMessage(), 500);
        }
    }


    public function update(UpdateClientRequest $request, $id)
    {
        try {
            $client = Client::find($id);

            if (!$client) return Response::Api(false, 'Cliente não encontrado', 404);

            $data = $request->validated();

            if ($request->filled('cpf') && $data['cpf'] !== $client->cpf) {
                $existingClient = Client::where('cpf', $this->formatCPF($data['cpf']))->first();

                if ($existingClient) return Response::Api(false, 'CPF já está em uso por outro cliente', 422);
            }

            $client->update($data);

            return Response::Api(true, 'Cliente atualizado com sucesso', 200, $client);
        } catch (\Exception $e) {
            return Response::Api(true, $e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $client = Client::find($id);

            if (!$client) return Response::Api(false, 'Cliente não encontrado', 404);

            $client->delete();

            return Response::Api(true, 'Cliente removido com sucesso', 200);
        } catch (\Exception $e) {
            return Response::Api(true, $e->getMessage(), 500);
        }
    }

    private function formatCPF($cpf)
    {
        // Removendo caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Formatando o CPF para "000.000.000-00"
        return vsprintf('%s%s%s.%s%s%s.%s%s%s-%s%s', str_split($cpf));
    }
}
