<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Factura extends Model
{
    use HasFactory;

    protected $connection = 'DB_CONNECTION_GIFT';
    protected $table = 'Factura';
    protected $primaryKey = 'idFactura';
    public $timestamps = false;

    public static function insertarFactura($correlativo, $fechaCompra, $nrcProveedor, $subTotal, $montoTotal, $giftCards, $usuarioReg, $fechaReg, $eliminado)
    {
        return DB::transaction(function () use ($correlativo, $fechaCompra, $nrcProveedor, $subTotal, $montoTotal, $giftCards, $usuarioReg, $fechaReg, $eliminado) {
            // Crear una conexión PDO para la base de datos correcta
            $pdo = DB::connection('DB_CONNECTION_GIFT')->getPdo();

            // Crear la tabla temporal
            $pdo->exec('CREATE TABLE #tempGiftCards (idGiftCard INT, cantidad INT, descripcion NVARCHAR(MAX))');

            // Insertar las gift cards en la tabla temporal
            foreach ($giftCards as $card) {
                $insertGiftCard = $pdo->prepare('INSERT INTO #tempGiftCards (idGiftCard, cantidad, descripcion) VALUES (?, ?, ?)');
                $insertGiftCard->execute([$card['idGiftCard'], $card['cantidad'], $card['descripcion']]);
            }

            // Preparar la llamada al procedimiento almacenado
            $stmt = $pdo->prepare('
                DECLARE @GiftCards GiftCardTableType; 

                -- Insertar en la variable de tipo tabla
                INSERT INTO @GiftCards (idGiftCard, cantidad, descripcion) 
                SELECT idGiftCard, cantidad, descripcion FROM #tempGiftCards;

                -- Llamar al procedimiento almacenado
                EXEC dbo.sp_InsertarFactura 
                    @Correlativo = ?, 
                    @FechaCompra = ?, 
                    @NRC_Proveedor = ?, 
                    @SubTotal = ?, 
                    @MontoTotal = ?, 
                    @GiftCards = @GiftCards,
                    @UsuarioReg = ?,
                    @FechaReg = ?,
                    @Eliminado = ?
            ');

            // Ejecutar el procedimiento
            return $stmt->execute([$correlativo, $fechaCompra, $nrcProveedor, $subTotal, $montoTotal, $usuarioReg, $fechaReg, $eliminado]);
        });
    }

    public function factura_detalles()
    {
        return $this->hasMany(DetFactura::class, 'idFactura', 'idFactura');
    }

}
