<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Servicio;
use App\Models\Sintoma;
use App\Models\Sugerencia;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::truncate();
        Subcategoria::truncate();
        Servicio::truncate();
        Sintoma::truncate();
        Sugerencia::truncate();

        $cat1 = Categoria::create(['nombre' => 'TECNOLOGÍAS DE INFORMACIÓN']);

        $sub1 = Subcategoria::create(['categoria_id' => $cat1->id, 'nombre' => 'SERVICIOS TIENDAS']);

        $s = Servicio::create(['subcategoria_id' => $sub1->id, 'nombre' => 'Terminal Bancaria']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'FALLA GENERAL DE EQUIPO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'ASESORIAS Y REQUERIMIENTOS GENERALES']);

        $s = Servicio::create(['subcategoria_id' => $sub1->id, 'nombre' => 'INTEGRACIONES']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DOWN - SIN SERVICIO SE OBSERVAN APAGADAS']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'ASESORIAS Y REQUERIMIENTOS GENERALES']);

        $s = Servicio::create(['subcategoria_id' => $sub1->id, 'nombre' => 'WANSOFT']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DOWN - SIN SERVICIO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DEGRADACION IMPORTANTE DEL SERVICIO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'FALLA GENERAL EN LA OPERACION DEL SERVICIO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'ASESORIAS Y REQUERIMIENTOS GENERALES']);


        $sub2 = Subcategoria::create(['categoria_id' => $cat1->id, 'nombre' => 'SOPORTE TECNICO TI']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Audio Alitas TV']);

        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Audio Android TV']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Audio Falla General']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Audio Sky']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Correo sucursales']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'IMPRESORA ADMINISTRATIVA']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'IMPRESORA PUNTO DE VENTA']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PC- PUNTO DE VENTA']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - DISCOS DUROS']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - MEMORIA']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - MONITOR GERENCIAL']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - MONITOR KDS']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - MOUSE']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - TECLADO BUMPBAR']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'PERIFERICOS - TECLADO PC ADMINISTRATIVO']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'SISTEMA CCTV']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'SOFTWARE MICROSOFT OFFICE']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'SOFTWARE TEAMVIEWER']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Switch de video']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'TELEVISIONES - PANTALLAS']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Video Alitas TV']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Video Android TV']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Video Falla General ']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'Video SKY ']);
        $s = Servicio::create(['subcategoria_id' => $sub2->id, 'nombre' => 'VIDEOPROYECTOR']);




        $sub3 = Subcategoria::create(['categoria_id' => $cat1->id, 'nombre' => 'TELECOMUNICACIONES']);

        $s = Servicio::create(['subcategoria_id' => $sub3->id, 'nombre' => 'Internet']);

        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DOWN - SIN SERVICIO']);
        Sugerencia::create(['sintoma_id' => $sin->id, 'nombre' => 'Verificar modems encendidos y verificar meraki encendido']);

        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DEGRADACION IMPORTANTE DEL SERVICIO']);
        Sugerencia::create(['sintoma_id' => $sin->id, 'nombre' => 'Verificar modem encendido']);

        $s = Servicio::create(['subcategoria_id' => $sub3->id, 'nombre' => 'LINEAS TELEFONICAS']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DOWN - SIN SERVICIO']);
        Sugerencia::create(['sintoma_id' => $sin->id, 'nombre' => 'Verificar cable de red y conexion a energia']);

        $s = Servicio::create(['subcategoria_id' => $sub3->id, 'nombre' => 'RED WIFI INVITADOS']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DOWN - SIN SERVICIO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'DEGRADACION IMPORTANTE DEL SERVICIO']);
        $sin = Sintoma::create(['servicio_id' => $s->id, 'nombre' => 'FALLA GENERAL EN LA OPERACION DEL SERVICIO']);


        Categoria::create(['nombre' => 'CATEGORÍA TEST UNO']);
        Categoria::create(['nombre' => 'CATEGORÍA TEST DOS']);
    }
}
