<?php

namespace App\Http\Controllers;
use App\Models\Adminbd;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index()
    {
        $usuario = User::find(auth()->id());
        return view('giftcards.giftcards', compact('usuario'));
    }

    public function viewTipo(){
        $usuario = User::find(auth()->id());
        return view('giftcards.tipos', compact('usuario'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $id = $user->name; 
 
        $usuario = Adminbd::where('codigoEmp', $id)->first();
        $nombreUsuario = $usuario ? $usuario->usuario : null;

        $request->validate([
            'valor' => 'required|numeric|min:0',
        ]);

        $giftCard = new GiftCard;
        $giftCard->valor = $request->input('valor');
        $giftCard->cantidad = 0;
        $giftCard -> usuarioReg = $nombreUsuario;
        $giftCard -> fechaReg = now();
        $giftCard->save();

        return response()->json(['message' => 'Gift Card agregado exitosamente.'], 200);
    }
    public function getGiftCards(){
        $giftCard = GiftCard::on('DB_CONNECTION_GIFT')
        ->where('eliminado', '!=', 1) 
        ->orderBy('valor', 'asc')
        ->get();
        return response()->json($giftCard);
    }

    public function eliminarGiftCard($idGift)
    {
        $giftCard = GiftCard::find($idGift);

        if (!$giftCard) {
            return response()->json(['message' => 'GiftCard no encontrada'], 404);
        }

        // Cambiar el estado de eliminado a 1
        $giftCard->eliminado = 1;
        $giftCard->save();

        return response()->json(['message' => 'GiftCard eliminada exitosamente'], 200);
    }

}
