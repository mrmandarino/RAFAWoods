<?php

namespace App\Http\Controllers;

use App\Models\Clavo;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Ejecutivo;
use App\Models\Imagen;
use App\Models\Inventario;
use App\Models\Localizacion;
use App\Models\Madera;
use App\Models\Mueble;
use App\Models\Plancha_construccion;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Techumbre;
use App\Models\Telefono_proveedor;
use App\Models\Tornillo;
use App\Models\User;
use App\Models\Trabajador;
use App\Models\Transporte;
use App\Models\Venta_proveedor;
use CreateComprasTable;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function index($tabla){;

        if ($tabla=='usuarios') {
            $datos = DB::table('users')->get();

        }elseif ($tabla=='clientes') {
            $datos=DB::table('clientes')->get();

        }elseif ($tabla=='trabajadores') {
            $datos=DB::table('trabajadors')->get();

        }elseif ($tabla=='madera_proveedores') {
            $datos=DB::table('venta_proveedors')->get();

        }elseif ($tabla=='transportes') {
            $datos=DB::table('transportes')->get();

        }elseif ($tabla=='tornillos') {
            $datos=DB::table('tornillos')->get();

        }elseif ($tabla=='telefono_proveedores') {
            $datos=DB::table('telefono_proveedors')->get();

        }elseif ($tabla=='techumbres') {
            $datos=DB::table('techumbres')->get();

        }elseif ($tabla=='proveedores') {
            $datos=DB::table('proveedors')->get();

        }elseif ($tabla=='productos') {
            $datos=DB::table('productos')->get();

        }elseif ($tabla=='planchas_construccion') {
            $datos=DB::table('plancha_construccions')->get();

        }elseif ($tabla=='muebles') {
            $datos=DB::table('muebles')->get();

        }elseif ($tabla=='maderas') {
            $datos=DB::table('maderas')->get();

        }elseif ($tabla=='sucursal_producto') {
            $datos=DB::table('localizacions')->get();

        }elseif ($tabla=='inventarios') {
            $datos=DB::table('inventarios')->get();

        }elseif ($tabla=='fotos') {
            $datos=DB::table('imagens')->get();

        }elseif ($tabla=='ejecutivos') {
            $datos=DB::table('ejecutivos')->get();

        }elseif ($tabla=='compras') {
            $datos=DB::table('compras')->get();

        }elseif ($tabla=='clavos') {
            $datos=DB::table('clavos')->get();

        }
        
        return view('admin.visualizar_especifico',compact('datos','tabla'));
        
    }

    public function crear($tabla)
    {
        return view('admin.crear_fila',compact('tabla'));
    }

    public function guardar(Request $request,$tabla)
    {
        if ($tabla=='usuarios') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:users'],
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'tipo_usuario' => ['required','integer'],
                'telefono' => ['digits:8', 'integer', 'nullable'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $nuevo_dato = new User();
            $nuevo_dato->rut = $rut_normalizado;
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->apellido = $request->get('apellido');
            $nuevo_dato->password = bcrypt($request->get('password'));
            $nuevo_dato->correo = $request->get('correo');
            $nuevo_dato->tipo_usuario = $request->get('tipo_usuario');
            $nuevo_dato->save();

            if($nuevo_dato->tipo_usuario == User::trabajador) {
                $nuevo_trabajador = new Trabajador();
                $nuevo_trabajador->usuario_rut = $nuevo_dato->rut;
                $nuevo_trabajador->tipo_trabajador = $request->get('tipo_trabajador');
                $nuevo_trabajador->sucursal_id = $request->get('sucursal_id');
                $nuevo_trabajador->save();
                
            }elseif($nuevo_dato->tipo_usuario == User::cliente) {
                $nuevo_cliente = new Cliente();
                $nuevo_cliente->usuario_rut =  $nuevo_dato->rut;
                if($request->get('telefono') != null){
                    $nuevo_cliente->telefono = '+569'.$request->get('telefono');
                }
                $nuevo_cliente->save();        
            }
            $datos=DB::table('users')->get();
    
            

        }elseif ($tabla=='clientes') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:users'],
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'telefono' => ['digits:8', 'integer', 'nullable'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $nuevo_dato = new User();
            $nuevo_dato->rut = $rut_normalizado;
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->apellido = $request->get('apellido');
            $nuevo_dato->password = bcrypt($request->get('password'));
            $nuevo_dato->correo = $request->get('correo');;
            $nuevo_dato->save();

            $nuevo_cliente = new Cliente();
            $nuevo_cliente->usuario_rut =  $nuevo_dato->rut;
            if($request->get('telefono') != null){
                $nuevo_cliente->telefono = '+569'.$request->get('telefono');
            }
            $nuevo_cliente->save();

            $datos=DB::table('clientes')->get();

        }elseif ($tabla=='trabajadores') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:users'],
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'tipo_trabajador' => ['required'],
                'sucursal_id' => ['required'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $nuevo_dato = new User();
            $nuevo_dato->rut = $rut_normalizado;
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->apellido = $request->get('apellido');
            $nuevo_dato->password = bcrypt($request->get('password'));
            $nuevo_dato->correo = $request->get('correo');
            $nuevo_dato->tipo_usuario = User::trabajador;
            $nuevo_dato->save();

            $nuevo_trabajador = new Trabajador();
            $nuevo_trabajador->usuario_rut = $nuevo_dato->rut;
            $nuevo_trabajador->tipo_trabajador = $request->get('tipo_trabajador');
            $nuevo_trabajador->sucursal_id = $request->get('sucursal_id');
            $nuevo_trabajador->save();

            $datos=DB::table('trabajadors')->get();

        }elseif ($tabla=='madera_proveedores') { 
            $request->validate([
                'proveedor_rut' => ['required'],
                'nivel_calidad' => ['required'],
                'madera_id' => ['required'],
            ]);
            $nuevo_dato = new Venta_proveedor();
            $nuevo_dato->nivel_calidad = $request->get('nivel_calidad');
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->madera_id = $request->get('madera_id');
            $nuevo_dato->save();

            $datos=DB::table('venta_proveedors')->get();

        }elseif ($tabla=='transportes') {
            $request->validate([
                'nombre_transportista' => ['required', 'string', 'max:255'],
                'apellido_transportista' => ['required','string','max:255'],
                'tipo_vehiculo' => ['required', 'string', 'max:255'],
                'valor_viaje' => ['required', 'integer', 'gte:0'],
                'proveedor_rut' => ['required'],
            ]);
            $nuevo_dato = new Transporte();
            $nuevo_dato->nombre_transportista = $request->get('nombre_transportista') . ' ' . $request->get('apellido_transportista');
            $nuevo_dato->tipo_vehiculo = $request->get('tipo_vehiculo');
            $nuevo_dato->valor_viaje = $request->get('valor_viaje');
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->save();

            $datos=DB::table('transportes')->get();

        }elseif ($tabla=='tornillos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'cabeza' => ['required', 'numeric', 'gt:0'],
                'tipo_rosca' => ['required'],
                'separacion_rosca' => ['required','numeric', 'gt:0'],
                'punta' => ['required', 'string', 'max:255'],
                'rosca_parcial' => ['required', 'numeric', 'gte:0'],
                'vastago' => ['required', 'numeric', 'gt:0'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Tornillo'; //hm
            $nuevo_dato->save();

            $nuevo_tornillo = new Tornillo();
            $nuevo_tornillo->producto_id = $nuevo_dato->id;
            $nuevo_tornillo->cabeza = $request->get('cabeza');
            $nuevo_tornillo->tipo_rosca = $request->get('tipo_rosca');
            $nuevo_tornillo->separacion_rosca = $request->get('separacion_rosca');
            $nuevo_tornillo->punta = $request->get('punta');
            $nuevo_tornillo->rosca_parcial = $request->get('rosca_parcial');
            $nuevo_tornillo->vastago = $request->get('vastago');
            $nuevo_tornillo->save(); 

            $datos=DB::table('tornillos')->get();

        }elseif ($tabla=='telefono_proveedores') {
            $request->validate([
                'proveedor_rut' => ['required'],
                'telefono' => ['digits:8', 'integer', 'unique:telefono_proveedors'],
            ]);
            $nuevo_dato = new Telefono_proveedor();
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->telefono = '+569'.$request->get('telefono');
            $nuevo_dato->save();

            $datos=DB::table('telefono_proveedors')->get();

        }elseif ($tabla=='techumbres') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'material' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required', 'numeric', 'gt:0'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Techumbre'; 
            $nuevo_dato->save();

            $nuevo_techumbre = new Techumbre();
            $nuevo_techumbre->producto_id = $nuevo_dato->id;
            $nuevo_techumbre->material = $request->get('material');
            $nuevo_techumbre->alto = $request->get('alto');
            $nuevo_techumbre->ancho = $request->get('ancho');
            $nuevo_techumbre->largo = $request->get('largo');
            $nuevo_techumbre->save();

            $datos=DB::table('techumbres')->get();

        }elseif ($tabla=='proveedores') {;
            $request->validate([
                'rut' => ['required','cl_rut','unique:proveedors'],
                'nombre' => ['required', 'string', 'max:255'],
                'razon_social' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:proveedors'],
                'ubicacion' => ['required','string','max:255'],
            ]);
            $nuevo_dato = new Proveedor();
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $nuevo_dato->rut = $rut_normalizado;
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->razon_social = $request->get('razon_social');
            $nuevo_dato->correo = $request->get('correo');
            $nuevo_dato->ubicacion = $request->get('ubicacion');
            $nuevo_dato->save();

            $datos=DB::table('proveedors')->get();

        }elseif ($tabla=='productos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'familia' => ['required','string','min:2'],
            ]);
            if($request->get('familia') == 'Tornillo') {
                $request->validate([
                    'cabeza' => ['required', 'numeric', 'gt:0'],
                    'tipo_rosca' => ['required'],
                    'separacion_rosca' => ['required','numeric', 'gt:0'],
                    'punta' => ['required', 'string', 'max:255'],
                    'rosca_parcial' => ['required', 'numeric', 'gte:0'],
                    'vastago' => ['required', 'numeric', 'gt:0'],
                ]);
            }elseif($request->get('familia') == 'Plancha_construccion') {
                $request->validate([
                    'material' => ['required','string','max:255'],
                    'alto' => ['required', 'numeric', 'gt:0'],
                    'ancho' => ['required','numeric', 'gt:0'],
                    'largo' => ['required', 'numeric', 'gt:0'],
                ]);
            }elseif($request->get('familia') == 'Techumbre') {
                $request->validate([
                    'material' => ['required','string','max:255'],
                    'alto' => ['required', 'numeric', 'gt:0'],
                    'ancho' => ['required','numeric', 'gt:0'],
                    'largo' => ['required', 'numeric', 'gt:0'],
                ]);
            }elseif($request->get('familia') == 'Mueble') {
                $request->validate([
                    'material' => ['required','string','max:255'],
                    'acabado' => ['required','string','max:255'],
                    'alto' => ['required', 'numeric', 'gt:0'],
                    'ancho' => ['required','numeric', 'gt:0'],
                    'largo' => ['required', 'numeric', 'gt:0'],
                ]);
            }elseif($request->get('familia') == 'Madera') {
                $request->validate([
                    'alto' => ['required', 'numeric', 'gt:0'],
                    'ancho' => ['required','numeric', 'gt:0'],
                    'largo' => ['required', 'numeric', 'gt:0'],
                    'tipo_madera' => ['required','string','max:255'],
                    'tratamiento' => ['required','string','max:255'],
                ]);
            }elseif($request->get('familia') == 'Clavo') {
                $request->validate([
                    'material' => ['required','string','max:255'],
                    'cabeza' => ['required','numeric', 'gt:0'],
                    'punta' => ['required','string','max:255'],
                    'longitud' => ['required', 'numeric', 'gt:0'],
                ]);
            }
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = $request->get('familia');
            $nuevo_dato->save();
            
            if($nuevo_dato->familia == 'Tornillo') {
                $nuevo_tornillo = new Tornillo();
                $nuevo_tornillo->producto_id = $nuevo_dato->id;
                $nuevo_tornillo->cabeza = $request->get('cabeza');
                $nuevo_tornillo->tipo_rosca = $request->get('tipo_rosca');
                $nuevo_tornillo->separacion_rosca = $request->get('separacion_rosca');;
                $nuevo_tornillo->punta = $request->get('punta');
                $nuevo_tornillo->rosca_parcial = $request->get('rosca_parcial');
                $nuevo_tornillo->vastago = $request->get('vastago');
                $nuevo_tornillo->save();    

            }elseif($nuevo_dato->familia == 'Plancha_construccion') {
                $nueva_plancha = new Plancha_construccion();
                $nueva_plancha->producto_id = $nuevo_dato->id;
                $nueva_plancha->material = $request->get('material');
                $nueva_plancha->alto = $request->get('alto');
                $nueva_plancha->ancho = $request->get('ancho');
                $nueva_plancha->largo = $request->get('largo');
                $nueva_plancha->save();     

            }elseif($nuevo_dato->familia == 'Techumbre') {
                $nuevo_techumbre = new Techumbre();
                $nuevo_techumbre->producto_id = $nuevo_dato->id;
                $nuevo_techumbre->material = $request->get('material');
                $nuevo_techumbre->alto = $request->get('alto');
                $nuevo_techumbre->ancho = $request->get('ancho');
                $nuevo_techumbre->largo = $request->get('largo');
                $nuevo_techumbre->save();      

            }elseif($nuevo_dato->familia == 'Mueble') {
                $nuevo_mueble = new Mueble();
                $nuevo_mueble->producto_id = $nuevo_dato->id;
                $nuevo_mueble->material = $request->get('material');
                $nuevo_mueble->acabado = $request->get('acabado');
                $nuevo_mueble->alto = $request->get('alto');
                $nuevo_mueble->ancho = $request->get('ancho');
                $nuevo_mueble->largo = $request->get('largo');
                $nuevo_mueble->save();  

            }elseif($nuevo_dato->familia == 'Madera') {
                $nueva_madera = new Madera();
                $nueva_madera->producto_id = $nuevo_dato->id;
                $nueva_madera->alto = $request->get('alto');
                $nueva_madera->ancho = $request->get('ancho');
                $nueva_madera->largo = $request->get('largo');
                $nueva_madera->tipo_madera = $request->get('tipo_madera');
                $nueva_madera->tratamiento = $request->get('tratamiento');
                $nueva_madera->save();   

            }elseif($nuevo_dato->familia == 'Clavo') {
                $nuevo_clavo = new Clavo();
                $nuevo_clavo->producto_id = $nuevo_dato->id;
                $nuevo_clavo->material = $request->get('material');
                $nuevo_clavo->cabeza = $request->get('cabeza');
                $nuevo_clavo->punta = $request->get('punta');
                $nuevo_clavo->longitud = $request->get('longitud');
                $nuevo_clavo->save();  
            }

            
            $datos=DB::table('productos')->get();

        }elseif ($tabla=='planchas_construccion') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'material' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Plancha_construccion'; //hm
            $nuevo_dato->save();

            $nueva_plancha = new Plancha_construccion();
            $nueva_plancha->producto_id = $nuevo_dato->id;
            $nueva_plancha->material = $request->get('material');
            $nueva_plancha->alto = $request->get('alto');
            $nueva_plancha->ancho = $request->get('ancho');
            $nueva_plancha->largo = $request->get('largo');
            $nueva_plancha->save();

            $datos=DB::table('plancha_construccions')->get();

        }elseif ($tabla=='muebles') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'material' => ['required','string','max:255'],
                'acabado' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required', 'numeric', 'gt:0'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Mueble'; //hm
            $nuevo_dato->save();

            $nuevo_mueble = new Mueble();
            $nuevo_mueble->producto_id = $nuevo_dato->id;
            $nuevo_mueble->material = $request->get('material');
            $nuevo_mueble->acabado = $request->get('acabado');
            $nuevo_mueble->alto = $request->get('alto');
            $nuevo_mueble->ancho = $request->get('ancho');
            $nuevo_mueble->largo = $request->get('largo');
            $nuevo_mueble->save();

            $datos=DB::table('muebles')->get();

        }elseif ($tabla=='maderas') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'tipo_madera' => ['required','string','max:255'],
                'tratamiento' => ['required','string','max:255'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Madera'; //hm
            $nuevo_dato->save();

            $nueva_madera = new Madera();
            $nueva_madera->producto_id = $nuevo_dato->id;
            $nueva_madera->alto = $request->get('alto');
            $nueva_madera->ancho = $request->get('ancho');
            $nueva_madera->largo = $request->get('largo');
            $nueva_madera->tipo_madera = $request->get('tipo_madera');
            $nueva_madera->tratamiento = $request->get('tratamiento');
            $nueva_madera->save();

            $datos=DB::table('maderas')->get();

        }elseif ($tabla=='sucursal_producto') { 
            $request->validate([
                'sucursal_id' => ['required'],
                'producto_id' => ['required'],
                'stock' => ['required', 'integer', 'gte:0'],
                'precio_compra' => ['required','integer', 'gte:0'],
            ]);
            $nuevo_dato = new Localizacion();
            $nuevo_dato->sucursal_id = $request->get('sucursal_id');
            $nuevo_dato->producto_id = $request->get('producto_id');
            $nuevo_dato->stock = $request->get('stock');
            $nuevo_dato->precio_compra = $request->get('precio_compra');
            $nuevo_dato->save();

            $datos=DB::table('localizacions')->get();

        }elseif ($tabla=='inventarios') {
            $request->validate([
                'direccion_sucursal' => ['required', 'string', 'max:255', 'unique:inventarios'],
            ]);
            $nuevo_dato = new Inventario();
            $nuevo_dato->direccion_sucursal = $request->get('direccion_sucursal');
            $nuevo_dato->save();

            $datos=DB::table('inventarios')->get();

        }elseif ($tabla=='fotos') { //dudas
            $request->validate([
                'url' => ['required','string','max:255'],
                'imagenable_id' => ['required', 'integer'],
                'imanegable_tipo' => ['required','string','max:255'],
            ]);
            $nuevo_dato = new Imagen();
            $nuevo_dato->url = $request->get('url');
            $nuevo_dato->imagenable_id = $request->get('imagenable_id');
            $nuevo_dato->imagenable_tipo = $request->get('imagenable_tipo');
            $nuevo_dato->save();

            $datos=DB::table('imagens')->get();

        }elseif ($tabla=='ejecutivos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:ejecutivos'],
                'telefono' => ['required','digits:8', 'integer', 'unique:ejecutivos'],
                'proveedor_rut' => ['required'],
            ]);
            $nuevo_dato = new Ejecutivo();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->apellido = $request->get('apellido');
            $nuevo_dato->correo = $request->get('correo');
            $nuevo_dato->telefono = '+569'.$request->get('telefono');
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->save();

            $datos=DB::table('ejecutivos')->get();

        }elseif ($tabla=='compras') { 
            $request->validate([
                'cantidad' => ['required', 'integer', 'gte:1'],
                'rut' => ['required'],
                'producto_id' => ['required'],
            ]);
            $nuevo_dato = new Compra();
            $nuevo_dato->cantidad = $request->get('cantidad');
            $nuevo_dato->cliente_rut = $request->get('rut');
            $nuevo_dato->producto_id = $request->get('producto_id');
            $nuevo_dato->save();

            $datos=DB::table('compras')->get();

        }elseif ($tabla=='clavos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'material' => ['required','string','max:255'],
                'cabeza' => ['required','numeric', 'gt:0'],
                'punta' => ['required','string','max:255'],
                'longitud' => ['required', 'numeric', 'gt:0'],
            ]);
            $nuevo_dato = new Producto();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->descripcion = $request->get('descripcion');
            $nuevo_dato->familia = 'Clavo'; 
            $nuevo_dato->save();

            $nuevo_clavo = new Clavo();
            $nuevo_clavo->producto_id = $nuevo_dato->id;
            $nuevo_clavo->material = $request->get('material');
            $nuevo_clavo->cabeza = $request->get('cabeza');
            $nuevo_clavo->punta = $request->get('punta');
            $nuevo_clavo->longitud = $request->get('longitud');
            $nuevo_clavo->save();

            $datos=DB::table('clavos')->get();

        }
        
        return view('admin.visualizar_especifico',compact('datos','tabla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tabla,$key)
    {
        if ($tabla=='usuarios') {
            $dato=User::find($key);
        }elseif ($tabla=='clientes') {
            $dato=Cliente::find($key);
        }elseif ($tabla=='trabajadores') {
            $dato=Trabajador::find($key);
        }elseif ($tabla=='madera_proveedores') {
            $dato=Venta_proveedor::find($key);
        }elseif ($tabla=='transportes') {
            $dato=Transporte::find($key);
        }elseif ($tabla=='tornillos') {  
            $dato=Tornillo::find($key);
        }elseif ($tabla=='telefono_proveedores') { //ojo
            $dato=Telefono_proveedor::find($key);
        }elseif ($tabla=='techumbres') {
            $dato=Techumbre::find($key);
        }elseif ($tabla=='proveedores') {
            $dato=Proveedor::find($key);
        }elseif ($tabla=='productos') {
            $dato=Producto::find($key);
        }elseif ($tabla=='planchas_construccion'){
            $dato=Plancha_construccion::find($key);
        }elseif ($tabla=='muebles') {
            $dato=Mueble::find($key);
        }elseif ($tabla=='maderas') {
            $dato=Madera::find($key);
        }elseif ($tabla=='sucursal_producto') { //ojo
            $dato=Localizacion::find($key);
        }elseif ($tabla=='inventarios') {
            $dato=Inventario::find($key);
        }elseif ($tabla=='fotos') {
            $dato=Imagen::find($key);
        }elseif ($tabla=='ejecutivos') {
            $dato=Ejecutivo::find($key);
        }elseif ($tabla=='compras') {
            $dato=Compra::find($key);
        }elseif ($tabla=='clavos') {
            $dato=Clavo::find($key);
        }

        return view('admin.editar_fila',compact('dato','tabla','key'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$tabla,$key)
    {
        
        if ($tabla=='usuarios') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'tipo_usuario' => ['required','integer'],
                'estado' => ['required'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            if ($key != $rut_normalizado){
                $request->validate([
                    'rut' => ['required','cl_rut','unique:users'],
                ]);

            };
            $actualizar=User::find($key);
            if ($actualizar->correo != $request->get('correo')){
                $request->validate([
                    'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ]);
            }
            if ($actualizar->tipo_usuario != $request->get('tipo_usuario')){
                if ($actualizar->tipo_usuario == User::trabajador){ //si era trabajador...
                    $eliminar_trabajador=Trabajador::find($key);
                    $eliminar_trabajador->delete();
                }elseif ($actualizar->tipo_usuario == User::cliente) { //si era cliente...
                    $eliminar_cliente=Cliente::find($key);
                    $eliminar_cliente->delete();
                }
            } 
            $tipo_usuario_anterior=$actualizar->tipo_usuario;

            $actualizar->rut =  $rut_normalizado;
            $actualizar->nombre = $request->get('nombre');
            $actualizar->apellido = $request->get('apellido');
            $actualizar->correo = $request->get('correo');
            $actualizar->tipo_usuario = $request->get('tipo_usuario');
            $actualizar->estado = $request->get('estado');
            $actualizar->save();

            if($actualizar->tipo_usuario == User::trabajador && $tipo_usuario_anterior==User::trabajador) { // Si fue y ahora es trabajador
                $actualizar_trabajador = Trabajador::find($actualizar->rut);
                $actualizar_trabajador->tipo_trabajador = $request->get('tipo_trabajador');
                $actualizar_trabajador->sucursal_id = $request->get('sucursal_id');
                $actualizar_trabajador->save();   

            }elseif($actualizar->tipo_usuario == User::cliente && $tipo_usuario_anterior==User::cliente) { // Si fue y ahora es cliente
                $actualizar_cliente = Cliente::find($actualizar->rut);
                if($request->get('telefono') != null){
                    $actualizar_cliente->telefono = '+569'.$request->get('telefono');
                }else{ 
                    $actualizar_cliente->telefono = $request->get('telefono');
                }
                $actualizar_cliente->save();        
            }elseif($actualizar->tipo_usuario == User::trabajador && $tipo_usuario_anterior!=User::trabajador) { // Si fue cliente y ahora es trabajador.
                $nuevo_trabajador = new Trabajador();
                $nuevo_trabajador->usuario_rut = $actualizar->rut;
                $nuevo_trabajador->tipo_trabajador = $request->get('tipo_trabajador');
                $nuevo_trabajador->sucursal_id = $request->get('sucursal_id');
                $nuevo_trabajador->save();
                
            }elseif($actualizar->tipo_usuario == User::cliente && $tipo_usuario_anterior!=User::cliente) { // Si fue trabajador y ahora es cliente.
                $nuevo_cliente = new Cliente();
                $nuevo_cliente->usuario_rut =  $actualizar->rut;
                if($request->get('telefono') != null){
                    $nuevo_cliente->telefono = '+569'.$request->get('telefono');
                }
                $nuevo_cliente->save();        
            }

            $datos=DB::table('users')->get();
        }elseif ($tabla=='clientes') {
            $request->validate([
                'telefono' => ['digits:8', 'integer', 'nullable'],
            ]);
            $actualizar=Cliente::find($key);
            if($request->get('telefono') != null){
                $actualizar->telefono = '+569'.$request->get('telefono');
            }
            $actualizar->save();
            $datos=DB::table('clientes')->get();
        }elseif ($tabla=='trabajadores') {
            $request->validate([
                'tipo_trabajador' => ['required'],
                'sucursal_id' => ['required'],
            ]);

            $actualizar=Trabajador::find($key);
            $actualizar->tipo_trabajador = $request->get('tipo_trabajador');
            $actualizar->sucursal_id = $request->get('sucursal_id');
            $actualizar->save();
            $datos=DB::table('trabajadors')->get();
        }elseif ($tabla=='madera_proveedores') {
            $request->validate([
                'proveedor_rut' => ['required'],
                'nivel_calidad' => ['required'],
                'madera_id' => ['required'],
            ]);
            $actualizar=Venta_proveedor::find($key);
            $actualizar->nivel_calidad = $request->get('nivel_calidad');
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->madera_id = $request->get('madera_id');
            $actualizar->save();
            $datos=DB::table('venta_proveedors')->get();
        }elseif ($tabla=='transportes') {
            $request->validate([
                'nombre_transportista' => ['required', 'string', 'max:255'],
                'apellido_transportista' => ['required','string','max:255'],
                'tipo_vehiculo' => ['required', 'string', 'max:255'],
                'valor_viaje' => ['required', 'integer', 'gte:0'],
                'proveedor_rut' => ['required'],
            ]);
            $actualizar=Transporte::find($key);
            $actualizar->nombre_transportista = $request->get('nombre_transportista') .' '. $request->get('apellido_transportista');
            $actualizar->tipo_vehiculo= $request->get('tipo_vehiculo');
            $actualizar->valor_viaje = $request->get('valor_viaje');
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->save();
            $datos=DB::table('transportes')->get();
        }elseif ($tabla=='tornillos') {  
            $request->validate([
                'cabeza' => ['required', 'numeric', 'gt:0'],
                'tipo_rosca' => ['required'],
                'separacion_rosca' => ['required','numeric', 'gt:0'],
                'punta' => ['required', 'string', 'max:255'],
                'rosca_parcial' => ['required', 'numeric', 'gte:0'],
                'vastago' => ['required', 'numeric', 'gt:0'],
            ]);
            $actualizar=Tornillo::find($key);
            $actualizar->cabeza = $request->get('cabeza');
            $actualizar->tipo_rosca = $request->get('tipo_rosca');
            $actualizar->separacion_rosca = $request->get('separacion_rosca');
            $actualizar->punta = $request->get('punta');
            $actualizar->rosca_parcial = $request->get('rosca_parcial');
            $actualizar->vastago = $request->get('vastago');
            $actualizar->save();
            $datos=DB::table('tornillos')->get();
        }elseif ($tabla=='telefono_proveedores') {
            //Ojo con lo de las 2 llaves 
            $request->validate([
                'proveedor_rut' => ['required'],
                'telefono' => ['digits:8', 'integer', 'unique:telefono_proveedors'],
            ]);
            $actualizar=Telefono_proveedor::find($key);
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->telefono = $request->get('telefono');
            $actualizar->save();
            $datos=DB::table('telefono_proveedors')->get();
        }elseif ($tabla=='techumbres') {
            $request->validate([
                'material' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required', 'numeric', 'gt:0'],
            ]);
            $actualizar=Techumbre::find($key);
            $actualizar->material = $request->get('material');
            $actualizar->alto = $request->get('alto');
            $actualizar->ancho = $request->get('ancho');
            $actualizar->largo = $request->get('largo');
            $actualizar->save();
            $datos=DB::table('techumbres')->get();
        }elseif ($tabla=='proveedores') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'razon_social' => ['required','string','max:255'],
                'ubicacion' => ['required','string','max:255'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            if ($key != $rut_normalizado){
                $request->validate([
                    'rut' => ['required','cl_rut','unique:proveedors'],
                ]);

            };
            $actualizar=Proveedor::find($key);
            if ($actualizar->correo != $request->get('correo')){
                $request->validate([
                    'correo' => ['required', 'string', 'email', 'max:255', 'unique:proveedors'],
                ]);
            }
            $actualizar->rut = $rut_normalizado;
            $actualizar->nombre = $request->get('nombre');
            $actualizar->razon_social = $request->get('razon_social');
            $actualizar->correo = $request->get('correo');
            $actualizar->ubicacion = $request->get('ubicacion');
            $actualizar->save();
            $datos=DB::table('proveedors')->get();
        }elseif ($tabla=='productos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'descripcion' => ['required','string','max:255'],
                'nivel_demanda' => ['required'],
                'familia' => ['required','string','min:2'],
            ]);
            
            $actualizar=Producto::find($key);
            $familia_anterior=$actualizar->familia;
            $actualizar->nombre = $request->get('nombre');
            $actualizar->descripcion = $request->get('descripcion');
            $actualizar->nivel_demanda = $request->get('nivel_demanda');
            $actualizar->familia = $request->get('familia');
           

            if($familia_anterior == $actualizar->familia){ //si la familia se conservó durante la edición
                if($actualizar->familia == "Tornillo"){
                    $request->validate([
                        'cabeza' => ['required', 'numeric', 'gt:0'],
                        'tipo_rosca' => ['required'],
                        'separacion_rosca' => ['required','numeric', 'gt:0'],
                        'punta' => ['required', 'string', 'max:255'],
                        'rosca_parcial' => ['required', 'numeric', 'gte:0'],
                        'vastago' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $tornillo=Tornillo::find($key);
                    $tornillo->cabeza=$request->cabeza;
                    $tornillo->tipo_rosca=$request->tipo_rosca;
                    $tornillo->separacion_rosca=$request->separacion_rosca;
                    $tornillo->punta=$request->punta;
                    $tornillo->rosca_parcial=$request->rosca_parcial;
                    $tornillo->vastago=$request->vastago;
                    $tornillo->save();

                }elseif($actualizar->familia == "Plancha_construccion"){
                    $request->validate([
                        'material_plancha' => ['required','string','max:255'],
                        'alto_plancha' => ['required', 'numeric', 'gt:0'],
                        'ancho_plancha' => ['required','numeric', 'gt:0'],
                        'largo_plancha' => ['required','numeric', 'gt:0'],
                    ]);
                    $plancha=Plancha_construccion::find($key);
                    $plancha->material=$request->material_plancha;
                    $plancha->alto=$request->alto_plancha;
                    $plancha->ancho=$request->ancho_plancha;
                    $plancha->largo=$request->largo_plancha;
                    $plancha->save();

                }elseif($actualizar->familia == "Techumbre"){
                    $request->validate([
                        'material_techumbre' => ['required','string','max:255'],
                        'alto_techumbre' => ['required', 'numeric', 'gt:0'],
                        'ancho_techumbre' => ['required','numeric', 'gt:0'],
                        'largo_techumbre' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $techumbre=Techumbre::find($key);
                    $techumbre->material=$request->material_techumbre;
                    $techumbre->alto=$request->alto_techumbre;
                    $techumbre->ancho=$request->ancho_techumbre;
                    $techumbre->largo=$request->largo_techumbre;
                    $techumbre->save();

                }elseif($actualizar->familia == "Mueble"){
                    $request->validate([
                        'material_mueble' => ['required','string','max:255'],
                        'acabado_mueble' => ['required','string','max:255'],
                        'alto_mueble' => ['required', 'numeric', 'gt:0'],
                        'ancho_mueble' => ['required','numeric', 'gt:0'],
                        'largo_mueble' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $mueble=Mueble::find($key);
                    $mueble->material=$request->material_mueble;
                    $mueble->acabado=$request->acabado_mueble;
                    $mueble->alto=$request->alto_mueble;
                    $mueble->ancho=$request->ancho_mueble;
                    $mueble->largo=$request->largo_mueble;
                    $mueble->save();

                }elseif($actualizar->familia == "Madera"){
                    $request->validate([
                        'alto_madera' => ['required', 'numeric', 'gt:0'],
                        'ancho_madera' => ['required','numeric', 'gt:0'],
                        'largo_madera' => ['required','numeric', 'gt:0'],
                        'tipo_madera' => ['required','string','max:255'],
                        'tratamiento' => ['required','string','max:255'],
                    ]);
                    $madera=Madera::find($key);
                    $madera->alto=$request->alto_madera;
                    $madera->ancho=$request->ancho_madera;
                    $madera->largo=$request->largo_madera;
                    $madera->tipo_madera=$request->tipo_madera;
                    $madera->tratamiento=$request->tratamiento;
                    $madera->save();

                }elseif($actualizar->familia == "Clavo"){
                    $request->validate([
                        'material_clavo' => ['required','string','max:255'],
                        'cabeza_clavo' => ['required','numeric', 'gt:0'],
                        'punta_clavo' => ['required','string','max:255'],
                        'longitud_clavo' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $clavo=Clavo::find($key);
                    $clavo->material=$request->material_clavo;
                    $clavo->cabeza=$request->cabeza_clavo;
                    $clavo->punta=$request->punta_clavo;
                    $clavo->longitud=$request->longitud_clavo;
                    $clavo->save();
                }
            }else{ //si la familia cambió

                if($actualizar->familia == "Tornillo"){
                    $request->validate([
                        'cabeza' => ['required', 'numeric', 'gt:0'],
                        'tipo_rosca' => ['required'],
                        'separacion_rosca' => ['required','numeric', 'gt:0'],
                        'punta' => ['required', 'string', 'max:255'],
                        'rosca_parcial' => ['required', 'numeric', 'gte:0'],
                        'vastago' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $nuevo_tornillo = new Tornillo();
                    $nuevo_tornillo->producto_id = $actualizar->id;
                    $nuevo_tornillo->cabeza = $request->get('cabeza');
                    $nuevo_tornillo->tipo_rosca = $request->get('tipo_rosca');
                    $nuevo_tornillo->separacion_rosca = $request->get('separacion_rosca');
                    $nuevo_tornillo->punta = $request->get('punta');
                    $nuevo_tornillo->rosca_parcial = $request->get('rosca_parcial');
                    $nuevo_tornillo->vastago = $request->get('vastago');
                    $nuevo_tornillo->save(); 

                }elseif($actualizar->familia == "Plancha_construccion"){
                    $request->validate([
                        'material_plancha' => ['required','string','max:255'],
                        'alto_plancha' => ['required', 'numeric', 'gt:0'],
                        'ancho_plancha' => ['required','numeric', 'gt:0'],
                        'largo_plancha' => ['required','numeric', 'gt:0'],
                    ]);
                    $nueva_plancha = new Plancha_construccion();
                    $nueva_plancha->producto_id = $actualizar->id;
                    $nueva_plancha->material = $request->get('material_plancha');
                    $nueva_plancha->alto = $request->get('alto_plancha');
                    $nueva_plancha->ancho = $request->get('ancho_plancha');
                    $nueva_plancha->largo = $request->get('largo_plancha');
                    $nueva_plancha->save();

                }elseif($actualizar->familia == "Techumbre"){
                    $request->validate([
                        'material_techumbre' => ['required','string','max:255'],
                        'alto_techumbre' => ['required', 'numeric', 'gt:0'],
                        'ancho_techumbre' => ['required','numeric', 'gt:0'],
                        'largo_techumbre' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $nuevo_techumbre = new Techumbre();
                    $nuevo_techumbre->producto_id = $actualizar->id;
                    $nuevo_techumbre->material = $request->get('material_techumbre');
                    $nuevo_techumbre->alto = $request->get('alto_techumbre');
                    $nuevo_techumbre->ancho = $request->get('ancho_techumbre');
                    $nuevo_techumbre->largo = $request->get('largo_techumbre');
                    $nuevo_techumbre->save();

                }elseif($actualizar->familia == "Mueble"){
                    $request->validate([
                        'material_mueble' => ['required','string','max:255'],
                        'acabado_mueble' => ['required','string','max:255'],
                        'alto_mueble' => ['required', 'numeric', 'gt:0'],
                        'ancho_mueble' => ['required','numeric', 'gt:0'],
                        'largo_mueble' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $nuevo_mueble = new Mueble();
                    $nuevo_mueble->producto_id = $actualizar->id;
                    $nuevo_mueble->material = $request->get('material_mueble');
                    $nuevo_mueble->acabado = $request->get('acabado_mueble');
                    $nuevo_mueble->alto = $request->get('alto_mueble');
                    $nuevo_mueble->ancho = $request->get('ancho_mueble');
                    $nuevo_mueble->largo = $request->get('largo_mueble');
                    $nuevo_mueble->save();

                }elseif($actualizar->familia == "Madera"){
                    $request->validate([
                        'alto_madera' => ['required', 'numeric', 'gt:0'],
                        'ancho_madera' => ['required','numeric', 'gt:0'],
                        'largo_madera' => ['required','numeric', 'gt:0'],
                        'tipo_madera' => ['required','string','max:255'],
                        'tratamiento' => ['required','string','max:255'],
                    ]);
                    $nueva_madera = new Madera();
                    $nueva_madera->producto_id = $actualizar->id;
                    $nueva_madera->alto = $request->get('alto_madera');
                    $nueva_madera->ancho = $request->get('ancho_madera');
                    $nueva_madera->largo = $request->get('largo_madera');
                    $nueva_madera->tipo_madera = $request->get('tipo_madera');
                    $nueva_madera->tratamiento = $request->get('tratamiento');
                    $nueva_madera->save();

                }elseif($actualizar->familia == "Clavo"){
                    $request->validate([
                        'material_clavo' => ['required','string','max:255'],
                        'cabeza_clavo' => ['required','numeric', 'gt:0'],
                        'punta_clavo' => ['required','string','max:255'],
                        'longitud_clavo' => ['required', 'numeric', 'gt:0'],
                    ]);
                    $nuevo_clavo = new Clavo();
                    $nuevo_clavo->producto_id = $actualizar->id;
                    $nuevo_clavo->material = $request->get('material_clavo');
                    $nuevo_clavo->cabeza = $request->get('cabeza_clavo');
                    $nuevo_clavo->punta = $request->get('punta_clavo');
                    $nuevo_clavo->longitud = $request->get('longitud_clavo');
                    $nuevo_clavo->save();
                }

                //Eliminación del producto de la tabla "familia" correspondiente anterior
                if($familia_anterior == "Tornillo"){
                    $borrar=Tornillo::find($key);
                    $borrar->delete();
                }elseif($familia_anterior == "Plancha_construccion"){
                    $borrar=Plancha_construccion::find($key);
                    $borrar->delete();
                }elseif($familia_anterior == "Techumbre"){
                    $borrar=Techumbre::find($key);
                    $borrar->delete();
                }elseif($familia_anterior == "Mueble"){
                    $borrar=Mueble::find($key);
                    $borrar->delete();
                }elseif($familia_anterior == "Madera"){
                    $borrar=Madera::find($key);
                    $borrar->delete();
                }elseif($familia_anterior == "Clavo"){
                    $borrar=Clavo::find($key);
                    $borrar->delete();
                }             
            }
            $actualizar->save();
            $datos=DB::table('productos')->get();
        
        }elseif ($tabla=='planchas_construccion'){
            $request->validate([
                'material' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
            ]);
            $actualizar=Plancha_construccion::find($key);
            $actualizar->material = $request->get('material');
            $actualizar->alto = $request->get('alto');
            $actualizar->ancho = $request->get('ancho');
            $actualizar->largo = $request->get('largo');
            $actualizar->save();
            $datos=DB::table('plancha_construccions')->get();
        }elseif ($tabla=='muebles') {
            $request->validate([
                'material' => ['required','string','max:255'],
                'acabado' => ['required','string','max:255'],
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required', 'numeric', 'gt:0'],
            ]);
            $actualizar=Mueble::find($key);
            $actualizar->material = $request->get('material');
            $actualizar->acabado = $request->get('acabado');
            $actualizar->alto = $request->get('alto');
            $actualizar->ancho = $request->get('ancho');
            $actualizar->largo = $request->get('largo');
            $actualizar->save();
            $datos=DB::table('muebles')->get();
        }elseif ($tabla=='maderas') {
            $request->validate([
                'alto' => ['required', 'numeric', 'gt:0'],
                'ancho' => ['required','numeric', 'gt:0'],
                'largo' => ['required','numeric', 'gt:0'],
                'tipo_madera' => ['required','string','max:255'],
                'tratamiento' => ['required','string','max:255'],
            ]);
            $actualizar=Madera::find($key);
            $actualizar->alto = $request->get('alto');
            $actualizar->ancho = $request->get('ancho');
            $actualizar->largo = $request->get('largo');
            $actualizar->tipo_madera = $request->get('tipo_madera');
            $actualizar->tratamiento = $request->get('tratamiento');
            $actualizar->save();
            $datos=DB::table('maderas')->get();
        }elseif ($tabla=='sucursal_producto') {
            // ojo, doble clave primaria
            $request->validate([
                'sucursal_id' => ['required'],
                'producto_id' => ['required'],
                'stock' => ['required', 'integer', 'gte:0'],
                'precio_compra' => ['required','integer', 'gte:0'],
            ]);
            $actualizar=Localizacion::find($key);
            $actualizar->sucursal_id = $request->get('sucursal_id');
            $actualizar->producto_id = $request->get('producto_id');
            $actualizar->stock = $request->get('stock');
            $actualizar->precio_compra = $request->get('precio_compra');
            $actualizar->save();
            $datos=DB::table('localizacions')->get();
        }elseif ($tabla=='inventarios') {
            $request->validate([
                'direccion_sucursal' => ['required', 'string', 'max:255', 'unique:inventarios'],
            ]);
            $actualizar=Inventario::find($key);
            $actualizar->direccion_sucursal = $request->get('direccion_sucursal');
            $actualizar->save();
            $datos=DB::table('inventarios')->get();
        }elseif ($tabla=='fotos') {
            $request->validate([
                'url' => ['required','string','max:255'],
                'imagenable_id' => ['required', 'integer'],
                'imanegable_tipo' => ['required','string','max:255'],
            ]);
            $actualizar=Imagen::find($key);
            $actualizar->url = $request->get('url');
            $actualizar->imagenable_id = $request->get('imagenable_id');
            $actualizar->imagenable_tipo = $request->get('imagenable_tipo');
            $actualizar->save();
            $datos=DB::table('imagens')->get();
        }elseif ($tabla=='ejecutivos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:ejecutivos'],
                'telefono' => ['required','digits:8', 'integer', 'unique:ejecutivos'],
                'proveedor_rut' => ['required'],
            ]);
            $actualizar=Ejecutivo::find($key);
            $actualizar->nombre = $request->get('nombre');
            $actualizar->apellido = $request->get('apellido');
            $actualizar->correo = $request->get('correo');
            $actualizar->telefono= $request->get('telefono');
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->save();
            $datos=DB::table('ejecutivos')->get();
        }elseif ($tabla=='compras') {
            $request->validate([
                'cantidad' => ['required', 'integer', 'gte:1'],
                'rut' => ['required'],
                'producto_id' => ['required'],
            ]);
            $actualizar=Compra::find($key);
            $actualizar->cantidad = $request->get('cantidad');
            $actualizar->cliente_rut = $request->get('rut');
            $actualizar->producto_id = $request->get('producto_id');
            $actualizar->save();
            $datos=DB::table('compras')->get();
        }elseif ($tabla=='clavos') {
            $request->validate([
                'material' => ['required','string','max:255'],
                'cabeza' => ['required','numeric', 'gt:0'],
                'punta' => ['required','string','max:255'],
                'longitud' => ['required', 'numeric', 'gt:0'],
            ]);
            $actualizar=Clavo::find($key);
            $actualizar->material = $request->get('material');
            $actualizar->cabeza = $request->get('cabeza');
            $actualizar->punta= $request->get('punta');
            $actualizar->longitud = $request->get('longitud');
            $actualizar->save();
            $datos=DB::table('clavos')->get();
        }
        
        return redirect()->route('admin_visualizar_especifico', ['datos' => $datos, 'tabla' => $tabla])->with('Se ha actualizado la fila correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($tabla,$key)
    {
        if ($tabla=='usuarios') {
            $dato=User::find($key);
            $dato->delete();
            $datos=DB::table('users')->get();
        }elseif ($tabla=='clientes') {
            $dato=User::find($key);
            $dato->delete();
            $datos=DB::table('clientes')->get();
        }elseif ($tabla=='trabajadores') {
            $dato=User::find($key);
            $dato->delete();
            $datos=DB::table('trabajadors')->get();
        }elseif ($tabla=='madera_proveedores') {
            $dato=Venta_proveedor::find($key);
            $dato->delete();
            $datos=DB::table('venta_proveedors')->get();
        }elseif ($tabla=='transportes') {
            $dato=Transporte::find($key);
            $dato->delete();
            $datos=DB::table('transportes')->get();
        }elseif ($tabla=='tornillos') {  
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('tornillos')->get();
        }elseif ($tabla=='telefono_proveedores') { //ojo
            $dato=Telefono_proveedor::find($key);
            $dato->delete();
            $datos=DB::table('telefono_proveedors')->get();
        }elseif ($tabla=='techumbres') {
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('techumbres')->get();
        }elseif ($tabla=='proveedores') {
            $dato=Proveedor::find($key);
            $dato->delete();
            $datos=DB::table('proveedors')->get();
        }elseif ($tabla=='productos') {
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('productos')->get();
        }elseif ($tabla=='planchas_construccion'){
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('plancha_construccions')->get();
        }elseif ($tabla=='muebles') {
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('muebles')->get();
        }elseif ($tabla=='maderas') {
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('maderas')->get();
        }elseif ($tabla=='sucursal_producto') { //ojo
            $dato=Localizacion::find($key);
            $dato->delete();
            $datos=DB::table('localizacions')->get();
        }elseif ($tabla=='inventarios') {
            $dato=Inventario::find($key);
            $dato->delete();
            $datos=DB::table('inventarios')->get();
        }elseif ($tabla=='fotos') {
            $dato=Imagen::find($key);
            $dato->delete();
            $datos=DB::table('imagens')->get();
        }elseif ($tabla=='ejecutivos') {
            $dato=Ejecutivo::find($key);
            $dato->delete();
            $datos=DB::table('ejecutivos')->get();
        }elseif ($tabla=='compras') {
            $dato=Compra::find($key);
            $dato->delete();
            $datos=DB::table('compras')->get();
        }elseif ($tabla=='clavos') {
            $dato=Producto::find($key);
            $dato->delete();
            $datos=DB::table('clavos')->get();
        }
        
        return redirect()->route('admin_visualizar_especifico', ['datos' => $datos, 'tabla' => $tabla])->with('Se ha eliminado la fila correctamente.');
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.crear_usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_usuario(Request $request)
    {
        $request->validate([
            'rut' => ['required','cl_rut','unique:users'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required','string','max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8', 'max:16',Rules\Password::defaults()],
            'tipo_trabajador' => ['required'],
        ]);

        $rut_normalizado = Rut::parse($request->rut)->normalize();
        User::create([
            'rut' => $rut_normalizado,
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo_usuario' => 2,
        ]);
        
        
        Trabajador::create([
            'usuario_rut' => $rut_normalizado,
            'tipo_trabajador' => $request->tipo_trabajador,
            'sucursal_id' => 1,
        ]);

        return view('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select()
    {
        return view('admin.visualizar_datos');
    }

    public function show($tabla)
    {
        if ($tabla=='usuarios') {
            $datos = DB::table('users')->get();

        }elseif ($tabla=='clientes') {
            $datos=DB::table('clientes')->get();

        }elseif ($tabla=='trabajadores') {
            $datos=DB::table('trabajadors')->get();

        }elseif ($tabla=='madera_proveedores') {
            $datos=DB::table('venta_proveedors')->get();

        }elseif ($tabla=='transportes') {
            $datos=DB::table('transportes')->get();

        }elseif ($tabla=='tornillos') {
            $datos=DB::table('tornillos')->get();

        }elseif ($tabla=='telefono_proveedores') {
            $datos=DB::table('telefono_proveedors')->get();

        }elseif ($tabla=='techumbres') {
            $datos=DB::table('techumbres')->get();

        }elseif ($tabla=='proveedores') {
            $datos=DB::table('proveedors')->get();

        }elseif ($tabla=='productos') {
            $datos=DB::table('productos')->get();

        }elseif ($tabla=='planchas_construccion') {
            $datos=DB::table('plancha_construccions')->get();

        }elseif ($tabla=='muebles') {
            $datos=DB::table('muebles')->get();

        }elseif ($tabla=='maderas') {
            $datos=DB::table('maderas')->get();

        }elseif ($tabla=='sucursal_producto') {
            $datos=DB::table('localizacions')->get();

        }elseif ($tabla=='inventarios') {
            $datos=DB::table('inventarios')->get();

        }elseif ($tabla=='fotos') {
            $datos=DB::table('imagens')->get();

        }elseif ($tabla=='ejecutivos') {
            $datos=DB::table('ejecutivos')->get();

        }elseif ($tabla=='compras') {
            $datos=DB::table('compras')->get();

        }elseif ($tabla=='clavos') {
            $datos=DB::table('clavos')->get();

        }
        
        return view('admin.visualizar_especifico',compact('datos','tabla'));

    }
    
}
