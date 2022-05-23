<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $users = DB::table('users')
        ->where('name', 'like', "%$search%")
        ->paginate(1);

        return inertia('amanda.index.ListUserPage', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // sleep(2);
        return inertia('amanda.create.CreateUserPage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);

      try{

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

            return Redirect::route('users.index')->with('success', 'Registro cadastrado com sucesso!');

        }catch(Exception $ex){
            return Redirect::route('users.index')->with('error', 'Não foi possível cadastrar o registro.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return inertia('amanda.edit.EditUserPage', [
            'user' => $user
        ]);
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

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5']
        ]);
        //dd($request);

      try{

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return Redirect::route('users.index')->with('success', 'Registro atualizado com sucesso!');

        }catch(Exception $ex){
            return Redirect::route('users.index')->with('error', 'Não foi possível atualizar o registro.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            return Redirect::route('users.index')->with('success', 'Registro deletado com sucesso!');

        }catch(Exception $ex){
            return Redirect::route('users.index')->with('error', 'Não foi possível deletar o registro.');
        }
    }


    public function nameGenerator()
    {
        return inertia('amanda.NameGeneratorPage');
    }
}
