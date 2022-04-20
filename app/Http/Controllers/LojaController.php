<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Loja;
use Illuminate\Http\Request;
use App\Http\Resources\LojaResource;
use Illuminate\Support\Facades\Validator;



class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Loja::latest()->get();
        return response()->json([LojaResource::collection($data), 'Lojas Buscadas.']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = array('response' => '', 'success'=>false);
        /**
         * Validating rules
         */
        $validator = $this->validateLoja();
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            /**
             * Creating new product
             */
            $loja = $this->newLoja($request);
            $loja->save();
            
            /**
             * Store values for mail
             */
            $data = [
                'nome' => $request->get('nome'),
                'email' => $request->get('email'),
            ];

            return response()->json(['Loja criada com sucesso', new LojaResource($loja)]);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loja  $loja
     * @return \Illuminate\Http\Response
     */
    public function show(Loja $loja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loja  $loja
     * @return \Illuminate\Http\Response
     */
    public function edit(Loja $loja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loja  $loja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = array('response' => '', 'success'=>false);
         /**
         * Validating rules
         */
        $validator = $this->validateProduct();
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{

            /**
             * Updating values and saving
             */
            $loja = Loja::find($id);
            $loja->nome =  $request->get('nome');
            $loja->email = $request->get('email');
            $loja->save();

            return response()->json(['Loja atualizada com sucesso.', new LojaResource($loja)]);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loja  $loja
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loja = Loja::find($id);
        $loja->delete();
        
        return response()->json('Loja apagada com sucesso');
    }

    public function validateLoja(){
        return Validator::make(request()->all(), [
            'nome'=>'required|min:3|max:40',
            'email'=>'required|email|unique:lojas,email',
        ]);
    }

    public function newLoja($request){
        return new Loja([
            'nome' => $request->get('nome'),
            'email' => $request->get('email'),
        ]);
    }
}
