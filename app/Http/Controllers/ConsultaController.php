<?php

namespace App\Http\Controllers;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};

class ConsultaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function getClientRuc($ruc)
    {
        $cs = new Ruc(new ContextClient(), new RucParser(new HtmlParser()));

        $company = $cs->get($ruc);

        if (!$company) {
            $company  = [];
            $company['process'] = false;
        } else {
            $company->process = true;
        }

        return response()->json($company);
    }


    public function getClientDni($dni)
    {

        $cs = new Dni(new ContextClient(), new DniParser());

        $person = $cs->get($dni);

        if (!$person) {
            $response = [];
            $response['process'] = false;
        } else {
            $person->process = true;
        }

        $response = $person ; 

        return response()->json($response);
    }

}
