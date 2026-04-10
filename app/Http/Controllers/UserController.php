<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $breadcrumb = "Utilisateur";
        $users = User::all();

        return view('account.index',compact('users','breadcrumb'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $breadcrumb = "Ajouter un utilisateur";

        return view('account.create',compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
        
       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => 'actif',
            'firstLogin' => false,
        ]);
        
      //  dd($user);
        return redirect()->route('account.index')->with('message','utilisateur enregistré avec succès');
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
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->first();
        $breadcrumb = "Modifier un utilisateur";

        return view('account.edit',compact('breadcrumb','user'));
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
            'nom' => 'required',
            'email' => 'required',
            'role' => 'required',
            'status' => 'required',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function resetPassword(Request $request, $id){

        $user = User::where('id',$id)->first();
        if (is_null($user))
            return redirect()->route('account.index')->with('error','impossible de trouver l\'utilisateur veuillez actualiser et recommencer');

        $user->update([
          'password' => null,
          'firstLogin' => false,
        ]);

        return redirect()->route('account.index')->with('message','mot de passe renitialisé');
    }
}
