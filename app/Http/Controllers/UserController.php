<?php
    namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function listarVendedores()
    {
        // Pega todos os usuários com perfil "vendedor"
        $vendedores = User::where('perfil', 'vendedor')->orderBy('name')->get();

        return view('partials.vendedores', compact('vendedores'))->render();
    }
}
?>