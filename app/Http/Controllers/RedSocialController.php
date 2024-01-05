<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RedSocial;

class RedSocialController extends Controller
{
    public function destroy(Request $request, RedSocial $redSocial)
    {
        $empresaId = $request->query('empresaId');

        if (!$redSocial) {
            return response()->json(['error' => 'Red social no encontrada'], 404);
        }

        try {
            $redSocial->nombre_tabla = 'Redes sociales';
            $redSocial->user_deleted_id = auth()->user()->id;
            $redSocial->save();

            $redSocial->delete();

            return response()->json(['success' => true, 'message' => '¡Red social eliminada con éxito!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Error al eliminar la red social']);
        }
    }
}
