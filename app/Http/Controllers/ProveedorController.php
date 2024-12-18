<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth;
use App\Models\Adminbd;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProveedorController extends Controller
{
    public function index()
    {
        $usuario = User::find(auth()->id());
        return view('giftcards.proveedores', compact('usuario')); 
    }

    public function getproveedor()
    {
        $proveedores = Proveedor::on('DB_CONNECTION_GIFT')->get();
        return response()->json($proveedores);
    }


}
