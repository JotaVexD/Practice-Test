<?php

namespace App\Http\Controllers;

use App\Models\Produto;

use Mail;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $produtos = Produto::all();
        // return view('produtos.index', compact('produtos'));
        $data = Produto::latest()->get();
        return response()->json([ProdutoResource::collection($data), 'Produtos buscados.']);
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
        $validator = $this->validateProduct();
        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        }else{
            /**
             * Creating new product
             */
            $produto = $this->newProduct($request);
            $produto->save();
            
            /**
             * Store values for mail
             */
            $data = [
                'nome' => $request->get('nome'),
                'valor' => $request->get('valor'),
            ];

            /**
             * Sending mail
             */
            $this->sendMail($data);

            return response()->json(['Produto criado com sucesso.', new ProdutoResource($produto)]);
        }

        return $response;
        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if (is_null($produto)) {
            return response()->json('Produto não encontrado', 404); 
        }
        return response()->json([new ProdutoResource($produto)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
            $produto = Produto::find($id);
            $produto->nome =  $request->get('nome');
            $produto->valor = $request->get('valor');
            $produto->loja_id = $request->get('loja_id');
            $produto->ativo = $request->get('ativo');
            $produto->save();

            return response()->json(['Produto alterado com sucesso.', new ProdutoResource($produto)]);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();
        
        return response()->json('Produto deletado com sucesso.');
        // return redirect('/produtos')->with('success', 'Produto apagado!');
    }

    public function validateProduct(){
        return Validator::make(request()->all(), [
            'nome'=>'required|min:3|max:60',
            'valor'=>'required|min:2|max:6',
            'loja_id'=>'required',
            'ativo'=>'required'
        ]);
    }

    public function newProduct($request){
        return new Produto([
            'nome' => $request->get('nome'),
            'valor' => $request->get('valor'),
            'loja_id' => $request->get('loja_id'),
            'ativo' => $request->get('ativo'),
        ]);
    }
    public function sendMail($data){
        Mail::send('emails.send', $data, function ($message) {
            $message->from('empresa@email.com', 'Empresa');
            $message->to('user@email.com', 'User');
            $message->subject("Novo produto adicionado");
            $message->priority(3);
        });
        return;
    }

    
}
