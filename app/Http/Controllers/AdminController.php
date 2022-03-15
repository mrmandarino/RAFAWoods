<?php

namespace App\Http\Controllers;

use App\Models\Clavo;
use App\Models\Cliente;
use App\Models\Detalle_venta;
use App\Models\Venta;
use App\Models\Detalle_compra;
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
use App\Models\Orden_compra;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\each;

class AdminController extends Controller
{
    public function menu(){
        return view('admin.menu_bd');
    }

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

        }elseif ($tabla=='orden_compras') {
            $datos=DB::table('orden_compras')->get();

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

        }elseif ($tabla=='detalle_ventas') {
            $datos=DB::table('detalle_ventas')->get();

        }elseif ($tabla=='clavos') {
            $datos=DB::table('clavos')->get();

        }elseif ($tabla=='detalle_compras') {
            $datos=DB::table('detalle_compras')->get();

        }elseif ($tabla=='ventas') {
            $datos=DB::table('ventas')->get();

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
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $comprobacion = User::find($rut_normalizado);
            if ($comprobacion != null){ 
                $request->validate([
                    'duplicado' => ['integer'],
                ]);
            }
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'tipo_usuario' => ['required','integer'],
                'telefono' => ['nullable'],
            ]);
            
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
                    $nuevo_cliente->telefono = $request->get('telefono');
                }
                $nuevo_cliente->save();        
            }
            $datos=DB::table('users')->get();
    
            

        }elseif ($tabla=='clientes') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:users'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $comprobacion = User::find($rut_normalizado);
            if ($comprobacion != null){ 
                $request->validate([
                    'duplicado' => ['integer'],
                ]);
            }
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'telefono' => ['nullable'],
            ]);
            
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
                $nuevo_cliente->telefono = $request->get('telefono');
            }
            $nuevo_cliente->save();

            $datos=DB::table('clientes')->get();

        }elseif ($tabla=='trabajadores') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:users'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $comprobacion = User::find($rut_normalizado);
            if ($comprobacion != null){ 
                $request->validate([
                    'duplicado' => ['integer'],
                ]);
            }
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                'tipo_trabajador' => ['required'],
                'sucursal_id' => ['required'],
            ]);
           
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

        }elseif ($tabla=='orden_compras') { 
            $request->validate([
                'proveedor_rut' => ['required'],
                'sucursal_id' => ['required'],
            ]);
        
            $nuevo_dato = new Orden_Compra();
            $nuevo_dato->sucursal_id = $request->get('sucursal_id');
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->total_oocc = 0;
            
            $nuevo_dato->save();

            $datos=DB::table('orden_compras')->get();

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
                'telefono' => ['required', 'string', 'unique:telefono_proveedors'],
            ]);
            $nuevo_dato = new Telefono_proveedor();
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->telefono = $request->get('telefono');
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

        }elseif ($tabla=='proveedores') {
            $request->validate([
                'rut' => ['required','cl_rut','unique:proveedors'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            $comprobacion = Proveedor::find($rut_normalizado);
            if ($comprobacion != null){ 
                $request->validate([
                    'duplicado' => ['integer'],
                ]);
            }
            $request->validate([
                'razon_social' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:proveedors'],
                'ubicacion' => ['required','string','max:255'],
            ]);
            
            $nuevo_dato = new Proveedor();
            $nuevo_dato->rut = $rut_normalizado;
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
                'alto' => ['required', 'integer', 'gt:0'],
                'ancho' => ['required','integer', 'gt:0'],
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
                'producto_id' => ['required'],
            ]);
            $existe_producto=Producto::find($request->get('producto_id'));
            if($existe_producto == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            $request->validate([
                'sucursal_id' => ['required'],
                'stock' => ['required', 'integer', 'gte:1'],
                'precio_compra' => ['required','integer', 'gte:0'],
            ]);
            $existencia=DB::table('localizacions')->where('sucursal_id',$request->get('sucursal_id'))->where('producto_id',$request->get('producto_id'))->first();
            if($existencia != null){ 
                $request->validate([
                    'sucursal_id' => ['unique:localizacions'],
                    'producto_id' => ['unique:localizacions'],
                ]);
            }
            $precio_venta_bruto=$request->get('precio_compra')/0.85;
            $resto=$precio_venta_bruto%100;
            $precio_venta= $precio_venta_bruto - $resto;
            
            DB::insert('insert into localizacions (sucursal_id, producto_id, stock, precio_compra, precio_venta, created_at, updated_at) values (?, ?, ?, ?, ?, ?,?)', [$request->get('sucursal_id'),$request->get('producto_id'),$request->get('stock'),$request->get('precio_compra'),round($precio_venta),date("Y-m-d H:i:s"),date("Y-m-d H:i:s")]);
            $datos=DB::table('localizacions')->get();

        }elseif ($tabla=='inventarios') {
            $request->validate([
                'direccion_sucursal' => ['required', 'string', 'max:255', 'unique:inventarios'],
            ]);
            $nuevo_dato = new Inventario();
            $nuevo_dato->direccion_sucursal = $request->get('direccion_sucursal');
            $nuevo_dato->save();

            $datos=DB::table('inventarios')->get();

        }elseif ($tabla=='fotos') { 
            $request->validate([
                'imagenable_id' => ['required', 'integer'],
            ]);
            $existe_producto=Producto::find($request->get('imagenable_id'));
            if($existe_producto == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            $request->validate([
                'url' => ['required','image','max:4096'],
                // 'imanegable_tipo' => ['required','string','max:255'],
            ]);
            $existe_url=Imagen::where('url',"images/".$request->file('url')->getClientOriginalName())->first();
            if($existe_url != null){ 
                $request->validate([
                    'existe_imagen' => ['integer'],
                ]);
            }

            $guardarImagen=$request->file('url');
            $guardarImagen->move('images', $guardarImagen->getClientOriginalName());
            
            $nuevo_dato = new Imagen();
            $nuevo_dato->url = "images/".$guardarImagen->getClientOriginalName();
            $nuevo_dato->imagenable_id = $request->get('imagenable_id');
            // $nuevo_dato->imagenable_tipo = $request->get('imagenable_tipo');
            $nuevo_dato->imagenable_tipo = 'App\Models\Producto';
            $nuevo_dato->save();

            $datos=DB::table('imagens')->get();

        }elseif ($tabla=='ejecutivos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255', 'unique:ejecutivos'],
                'telefono' => ['required','unique:ejecutivos'],
                'proveedor_rut' => ['required'],
            ]);
            $nuevo_dato = new Ejecutivo();
            $nuevo_dato->nombre = $request->get('nombre');
            $nuevo_dato->apellido = $request->get('apellido');
            $nuevo_dato->correo = $request->get('correo');
            $nuevo_dato->telefono = $request->get('telefono');
            $nuevo_dato->proveedor_rut = $request->get('proveedor_rut');
            $nuevo_dato->save();

            $datos=DB::table('ejecutivos')->get();

        }elseif ($tabla=='detalle_ventas') { 
            $request->validate([
                'producto_id' => ['required'],
            ]);
            $existe_producto=Producto::find($request->get('producto_id'));
            if($existe_producto == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            $request->validate([
                'cantidad' => ['required', 'integer', 'gte:1'],
                'venta_id' => ['required'],
            ]);
            $existencia=DB::table('detalle_ventas')->where('venta_id',$request->get('venta_id'))->where('producto_id',$request->get('producto_id'))->first();
            if($existencia != null){ 
                $request->validate([
                    'venta_id' => ['unique:detalle_ventas'],
                    'producto_id' => ['unique:detalle_ventas'],
                ]);
            }

            $Venta=Venta::find($request->get('venta_id'));
            $sucursal=$Venta->sucursal_id;
            $inventario=DB::table('localizacions')->where('producto_id',$request->get('producto_id'))->where('sucursal_id',$sucursal);
            $stock_antiguo=$inventario->value('stock');
            if($stock_antiguo < $request->get('cantidad')){ 
                $request->validate([
                    'supera_stock' => ['integer'],
                ]);
            }

            $nuevo_dato = new Detalle_venta();
            $nuevo_dato->cantidad = $request->get('cantidad');
            $nuevo_dato->producto_id = $request->get('producto_id');
            $nuevo_dato->venta_id = $request->get('venta_id');
            $precio=$inventario->value('precio_venta');
            $precio_compra=$inventario->value('precio_compra');
            $valor_total=$precio * $nuevo_dato->cantidad;
            $nuevo_dato->total_producto=$valor_total;
            $nuevo_dato->save();
            
            //Actualizando stock en tabla localizacions
            $stock_nuevo=$stock_antiguo - $nuevo_dato->cantidad;
            $inventario->update(['stock' => $stock_nuevo]);    
         
            //Actualizando tabla de ventas
            $valor_anterior=$Venta->total_venta;
            $valor_nuevo=$valor_total + $valor_anterior;
            $utilidad_anterior=$Venta->utilidad_bruta;
            $diferencia= $valor_total - ($precio_compra * $nuevo_dato->cantidad);
            $utilidad_nueva=$utilidad_anterior + $diferencia;
            $Venta->utilidad_bruta= $utilidad_nueva;
            $Venta->total_venta=$valor_nuevo;
            $Venta->save();

            $datos=DB::table('detalle_ventas')->get();

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

        }elseif ($tabla=='detalle_compras') {
            $request->validate([
                'producto_id' => ['required'],
                'oc_id' => ['required'],
            ]);
            $existe_producto=Producto::find($request->get('producto_id'));
            $existe_orden=Orden_compra::find($request->get('oc_id'));
            if($existe_producto == null && $existe_orden == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                    'existe_orden' => ['integer'],
                ]);
            }elseif($existe_producto != null && $existe_orden == null){ 
                $request->validate([
                    'existe_orden' => ['integer'],
                ]);
            }elseif($existe_producto == null && $existe_orden != null){
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            $request->validate([
                'nivel_calidad' => ['required'],
                'cantidad' => ['required','numeric', 'gt:0'],
                'precio_unitario' => ['required','numeric'],  
            ]);
            
            $existencia=DB::table('detalle_compras')->where('oc_id',$request->get('oc_id'))->where('producto_id',$request->get('producto_id'))->first();
            if($existencia != null){ 
                $request->validate([
                    'oc_id' => ['unique:detalle_compras'],
                    'producto_id' => ['unique:detalle_compras'],
                ]);
            }

            $nuevo_dato = new Detalle_compra();
            $nuevo_dato->oc_id = $request->get('oc_id');
            $nuevo_dato->producto_id = $request->get('producto_id');
            $nuevo_dato->nivel_calidad = $request->get('nivel_calidad');
            $nuevo_dato->cantidad = $request->get('cantidad');
            $nuevo_dato->precio_unitario = $request->get('precio_unitario');
            $nuevo_dato->total = $nuevo_dato->precio_unitario * $nuevo_dato->cantidad;
            

            //Actualizando tabla de ventas
            $Compra=Orden_compra::find($request->get('oc_id'));
            $sucursal=$Compra->sucursal_id;
            $valor_anterior=$Compra->total_oocc;
            $valor_nuevo=$valor_anterior + $nuevo_dato->total;
            $Compra->total_oocc=$valor_nuevo;
            
            //Actualizando tabla localizacions (stock)
            $inventario=DB::table('localizacions')->where('sucursal_id',$sucursal)->where('producto_id',$nuevo_dato->producto_id);
            
            if($inventario->first() != null){
                $stock_anterior=$inventario->value('stock');
                $stock_nuevo=$stock_anterior + $nuevo_dato->cantidad;
                $inventario->update(['stock' => $stock_nuevo]);
            }else{
                $precio_venta_bruto=$request->get('precio_unitario')/0.85;
                $resto=$precio_venta_bruto%100;
                $precio_venta= $precio_venta_bruto - $resto;
                //dd(round($precio_venta));
                DB::insert('insert into localizacions (sucursal_id, producto_id, stock, precio_compra, precio_venta, created_at, updated_at) values (?, ?, ?, ?, ?, ?,?)', [$sucursal,$request->get('producto_id'),$request->get('cantidad'),$request->get('precio_unitario'),round($precio_venta),date("Y-m-d H:i:s"),date("Y-m-d H:i:s")]);
            }
            
            $Compra->save();
            $nuevo_dato->save();
            $datos=DB::table('detalle_compras')->get();



        }elseif ($tabla=='ventas') { 
            $request->validate([
                'medio_de_pago' => ['required'],
                'sucursal_id' => ['required'],
                'con_factura' => ['required'],
                'cliente_rut' => ['required','cl_rut'],
                'vendedor_rut' => ['required'],
            ]);
            $rut_normalizado = Rut::parse($request->cliente_rut)->normalize();
            $nuevo_dato = new Venta();
            $nuevo_dato->sucursal_id = $request->get('sucursal_id');
            $nuevo_dato->cliente_rut = $rut_normalizado;
            $nuevo_dato->medio_de_pago = $request->get('medio_de_pago');
            $nuevo_dato->total_venta = 0;
            $nuevo_dato->utilidad_bruta = 0;
            $nuevo_dato->con_factura = $request->get('con_factura');
            $nuevo_dato->vendedor_rut = $request->get('vendedor_rut');
            $nuevo_dato->save();
            $datos=DB::table('ventas')->get();

        }
        
        return redirect()->route('admin_visualizar_especifico', ['datos' => $datos, 'tabla' => $tabla])->with('fila_nueva','Se ha agregado la fila correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tabla,$key,$key2=null)
    {
        if ($tabla=='usuarios') {
            $dato=User::find($key);
        }elseif ($tabla=='clientes') {
            $dato=Cliente::find($key);
        }elseif ($tabla=='trabajadores') {
            $dato=Trabajador::find($key);
        }elseif ($tabla=='orden_compras') {
            $dato=Orden_Compra::find($key);
        }elseif ($tabla=='transportes') {
            $dato=Transporte::find($key);
        }elseif ($tabla=='tornillos') {  
            $dato=Tornillo::find($key);
        }elseif ($tabla=='telefono_proveedores') { 
            $dato=DB::table('telefono_proveedors')->where('proveedor_rut',$key)->where('telefono',$key2)->first();
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
        }elseif ($tabla=='sucursal_producto') { 
            $dato=DB::table('localizacions')->where('sucursal_id',$key)->where('producto_id',$key2)->first();
        }elseif ($tabla=='inventarios') {
            $dato=Inventario::find($key);
        }elseif ($tabla=='fotos') {
            $dato=Imagen::find($key);
        }elseif ($tabla=='ejecutivos') {
            $dato=Ejecutivo::find($key);
        }elseif ($tabla=='detalle_ventas') {
            $dato=DB::table('detalle_ventas')->where('venta_id',$key)->where('producto_id',$key2)->first();
        }elseif ($tabla=='clavos') {
            $dato=Clavo::find($key);
        }elseif ($tabla=='detalle_compras') { 
            $dato=DB::table('detalle_compras')->where('oc_id',$key)->where('producto_id',$key2)->first();
        }elseif ($tabla=='ventas') {
            $dato=Venta::find($key);
        }

        return view('admin.editar_fila',compact('dato','tabla','key','key2'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$tabla,$key,$key2=null)
    {
        
        if ($tabla=='usuarios') {
            $request->validate([
                'rut' => ['required','cl_rut'],
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'tipo_usuario' => ['required','integer'],
                'estado' => ['required'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            if ($key != $rut_normalizado){
                $comprobacion = User::find($rut_normalizado);
                if ($comprobacion != null){ 
                    $request->validate([
                        'duplicado' => ['integer'],
                    ]);
                }

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
                    $actualizar_cliente->telefono = $request->get('telefono');
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
                    $nuevo_cliente->telefono = $request->get('telefono');
                }
                $nuevo_cliente->save();        
            }

            $datos=DB::table('users')->get();
        }elseif ($tabla=='clientes') {
            $request->validate([
                'telefono' => ['nullable'],
            ]);
            $actualizar=Cliente::find($key);
            $actualizar->telefono = $request->get('telefono');
            $actualizar->save();
            $datos=DB::table('clientes')->get();
        }elseif ($tabla=='trabajadores') {
            $request->validate([
                'tipo_trabajador' => ['required'],
                'sucursal_id' => ['required'],
                'password' => ['required'],
            ]);
            $actualizar=Trabajador::find($key);
            $actualizar_contraseña=User::find($key);

            if($actualizar_contraseña->password != $request->get('password')){
                $request->validate([
                    'password' => ['required', 'min:8', 'max:16',Rules\Password::defaults()],
                ]);
                $actualizar_contraseña->password = bcrypt($request->get('password'));
                $actualizar_contraseña->save();
            }

            $actualizar->tipo_trabajador = $request->get('tipo_trabajador');
            $actualizar->sucursal_id = $request->get('sucursal_id');
            $actualizar->save();
            
           
            $datos=DB::table('trabajadors')->get();
        }elseif ($tabla=='orden_compras') {
            $request->validate([
                'proveedor_rut' => ['required'],
                'sucursal_id' => ['required'],
            ]);
            $actualizar=Orden_Compra::find($key);
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->sucursal_id = $request->get('sucursal_id');
            $actualizar->save();
            $datos=DB::table('orden_compras')->get();
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
            $request->validate([
                'proveedor_rut' => ['required'],   
                'telefono' => ['required'],
            ]);
            if($key2 != $request->get('telefono')){
                 $request->validate([
                'telefono' => ['unique:telefono_proveedors'],
                ]);
            }
            DB::table('telefono_proveedors')->where('proveedor_rut',$key)->where('telefono',$key2)->update(['proveedor_rut' => $request->get('proveedor_rut'),'telefono' => $request->get('telefono')]);
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
                'rut' => ['required','cl_rut'],
                'razon_social' => ['required','string','max:255'],
                'ubicacion' => ['required','string','max:255'],
            ]);
            $rut_normalizado = Rut::parse($request->rut)->normalize();
            if ($key != $rut_normalizado){
                $comprobacion = Proveedor::find($rut_normalizado);
                if ($comprobacion != null){ 
                    $request->validate([
                        'duplicado' => ['integer'],
                    ]);
                }

            };
            $actualizar=Proveedor::find($key);
            if ($actualizar->correo != $request->get('correo')){
                $request->validate([
                    'correo' => ['required', 'string', 'email', 'max:255', 'unique:proveedors'],
                ]);
            }
            $actualizar->rut = $rut_normalizado;
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
                'estado' => ['required'],
            ]);
            
            $actualizar=Producto::find($key);
            $familia_anterior=$actualizar->familia;
            $actualizar->nombre = $request->get('nombre');
            $actualizar->descripcion = $request->get('descripcion');
            $actualizar->nivel_demanda = $request->get('nivel_demanda');
            $actualizar->familia = $request->get('familia');
            $actualizar->estado = $request->get('estado');
           

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
                'alto' => ['required', 'integer', 'gt:0'],
                'ancho' => ['required','integer', 'gt:0'],
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
            $request->validate([
                'sucursal_id' => ['required'],
                'producto_id' => ['required'],
                'stock' => ['required', 'integer', 'gte:1'],
                'precio_compra' => ['required','integer', 'gte:0'],
            ]);

            $precio_venta_bruto=$request->get('precio_compra')/0.85;
            $resto=$precio_venta_bruto%100;
            $precio_venta= $precio_venta_bruto - $resto;
            if ($key == $request->get('sucursal_id') && $key2 == $request->get('producto_id')){ // si se refiere al mismo registro
                DB::table('localizacions')->where('sucursal_id',$key)->where('producto_id',$key2)->update(['stock' => $request->get('stock'),'precio_compra' => $request->get('precio_compra'), 'precio_venta' => round($precio_venta)]);
                
            }else{
                $existencia=DB::table('localizacions')->where('sucursal_id',$request->get('sucursal_id'))->where('producto_id',$request->get('producto_id'))->first();
                if($existencia != null){ 
                    $request->validate([
                        'sucursal_id' => ['unique:localizacions'],
                        'producto_id' => ['unique:localizacions'],
                    ]);    
                }
                DB::table('localizacions')->where('sucursal_id',$key)->where('producto_id',$key2)->update(['sucursal_id' => $request->get('sucursal_id'),'producto_id' => $request->get('producto_id'),'stock' => $request->get('stock'),'precio_compra' => $request->get('precio_compra'), 'precio_venta' => round($precio_venta)]);    
            }

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
                'imagenable_id' => ['required', 'integer'],
            ]);
            $actualizar=Imagen::find($key);
            $actualizar->imagenable_id = $request->get('imagenable_id');
            $actualizar->save();
            $datos=DB::table('imagens')->get();
        }elseif ($tabla=='ejecutivos') {
            $request->validate([
                'nombre' => ['required', 'string', 'max:255'],
                'apellido' => ['required','string','max:255'],
                'correo' => ['required', 'string', 'email', 'max:255'],
                'telefono' => ['required'],
                'proveedor_rut' => ['required'],
            ]);
            $actualizar=Ejecutivo::find($key);
            
            if ($actualizar->correo != $request->get('correo') && $actualizar->telefono != $request->get('telefono')){
                $request->validate([
                    'correo' => ['unique:ejecutivos'],
                    'telefono' => ['unique:ejecutivos'],
                ]);
            }
            elseif ($actualizar->correo != $request->get('correo')){
                $request->validate([
                    'correo' => ['unique:ejecutivos'],
                ]);
            }
            elseif ($actualizar->telefono != $request->get('telefono')){
                $request->validate([
                    'telefono' => ['unique:ejecutivos'],
                ]);
            }
           
            $actualizar->nombre = $request->get('nombre');
            $actualizar->apellido = $request->get('apellido');
            $actualizar->correo = $request->get('correo');
            $actualizar->telefono= $request->get('telefono');
            $actualizar->proveedor_rut = $request->get('proveedor_rut');
            $actualizar->save();
            $datos=DB::table('ejecutivos')->get();
        }elseif ($tabla=='detalle_ventas') {
            $request->validate([
                'producto_id' => ['required'],
                'venta_id' => ['required'],
            ]);
            $existe_producto=Producto::find($request->get('producto_id'));
            $existe_venta=Venta::find($request->get('venta_id'));
            if($existe_producto == null && $existe_venta == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                    'existe_venta' => ['integer'],
                ]);
            }
            elseif($existe_producto == null){ 
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            elseif($existe_venta== null){ 
                $request->validate([
                    'existe_venta' => ['integer'],
                ]);
            }

            $request->validate([
                'cantidad' => ['required', 'integer', 'gte:1'],
            ]);
            if ($key == $request->get('venta_id') && $key2 == $request->get('producto_id')){ // misma venta, mismo producto
                
                $Venta=Venta::find($key);
                $sucursal=$Venta->sucursal_id;
                $registro_actual=DB::table('detalle_ventas')->where('venta_id',$key)->where('producto_id',$key2);
                $inventario=DB::table('localizacions')->where('producto_id',$key2)->where('sucursal_id',$sucursal);
                $stock_anterior=$inventario->value('stock');
                $cantidad_anterior=$registro_actual->value('cantidad');
                $aux=$stock_anterior + $cantidad_anterior;

               
                

                if($aux < $request->get('cantidad')){ 
                    $request->validate([
                        'supera_stock' => ['integer'],
                    ]);
                }
            
                //Valores pre-update
                $total_producto_anterior=$registro_actual->value('total_producto');
                $stock_anterior=$inventario->value('stock');
                $total_venta_anterior=$Venta->total_venta;

                $utilidad_bruta_total_anterior=$Venta->utilidad_bruta;
                $utilidad_bruta_anterior= $total_producto_anterior - ($cantidad_anterior * $inventario->value('precio_compra'));

                //Valores post-update
                $stock_nuevo=$stock_anterior + $cantidad_anterior - $request->get('cantidad');
                $precio=$inventario->value('precio_venta');
                $total_producto_actual=$request->get('cantidad') * $precio;

                $utilidad_bruta_actual=$total_producto_actual - ($request->get('cantidad') * $inventario->value('precio_compra')) ;
                
                $total_venta_nuevo=$total_venta_anterior + $total_producto_actual - $total_producto_anterior;
                $Venta->total_venta=$total_venta_nuevo;
                $Venta->utilidad_bruta= $utilidad_bruta_total_anterior - $utilidad_bruta_anterior +  $utilidad_bruta_actual;
                
                //Guardar cambios
                $inventario->update(['stock' => $stock_nuevo]);  
                $Venta->save();
                $registro_actual->update(['cantidad' => $request->get('cantidad'),'total_producto' => $total_producto_actual]);

            }else{
                $existencia=DB::table('detalle_ventas')->where('venta_id',$request->get('venta_id'))->where('producto_id',$request->get('producto_id'))->first();
                if($existencia != null){ 
                    $request->validate([
                        'venta_id' => ['unique:detalle_ventas'],
                        'producto_id' => ['unique:detalle_ventas'],
                    ]);
                }

                //*** TODO LO REFERENTE A DEJAR LAS COSAS COMO SI NO HUBIERA EXISTIDO ESTA VENTA
                $Venta=Venta::find($key);
                $sucursal=$Venta->sucursal_id;
                $registro_actual=DB::table('detalle_ventas')->where('venta_id',$key)->where('producto_id',$key2);
                $inventario=DB::table('localizacions')->where('producto_id',$key2)->where('sucursal_id',$sucursal);
                $stock_anterior=$inventario->value('stock');
                $cantidad_anterior=$registro_actual->value('cantidad');
                $aux=$stock_anterior + $cantidad_anterior;

                if($key == $request->get('venta_id')){ //misma venta, distinto producto
                   
                    $inventario_nuevo_producto=DB::table('localizacions')->where('producto_id',$request->get('producto_id'))->where('sucursal_id',$sucursal);
                    $aux=$inventario_nuevo_producto->value('stock'); 
                    if($aux < $request->get('cantidad')){ 
                        $request->validate([
                            'supera_stock' => ['integer'],
                        ]);
                    }
                    
                }elseif($key2 == $request->get('producto_id')){//distinta venta, mismo producto
                    $nueva_venta=Venta::find($request->get('venta_id'));
                    $nueva_sucursal=$nueva_venta->sucursal_id;
                    $aux=DB::table('localizacions')->where('producto_id',$key2)->where('sucursal_id',$nueva_sucursal)->value('stock');
                    if($nueva_sucursal == $sucursal){ 
                        $aux=$aux + $registro_actual->value('cantidad');
                    }
                    //dd($aux,$request->get('cantidad'));
                    if($aux < $request->get('cantidad')){ 
                        $request->validate([
                            'supera_stock' => ['integer'],
                        ]);
                    }
                }else{ //distinta venta, distinto producto

                    $nueva_venta=Venta::find($request->get('venta_id'));
                    $nueva_sucursal=$nueva_venta->sucursal_id;
                    $inventario_nuevo_producto=DB::table('localizacions')->where('producto_id',$request->get('producto_id'))->where('sucursal_id',$nueva_sucursal);
                    $aux=$inventario_nuevo_producto->value('stock');
                    if($aux < $request->get('cantidad')){ 
                        $request->validate([
                            'supera_stock' => ['integer'],
                        ]);
                    }
                }

                //Valores pre-update
                $total_producto_anterior=$registro_actual->value('total_producto'); //114390
                $total_venta_anterior=$Venta->total_venta; //total venta general

                $utilidad_bruta_total_anterior=$Venta->utilidad_bruta;
                $utilidad_bruta_anterior= $total_producto_anterior - ($cantidad_anterior * $inventario->value('precio_compra'));
        
                //Valores post-update
                $stock_nuevo=$stock_anterior + $cantidad_anterior;
                $total_venta_nuevo=$total_venta_anterior  - $total_producto_anterior;

                $total_utilidad_bruta_nuevo= $utilidad_bruta_total_anterior -  $utilidad_bruta_anterior;

                $Venta->total_venta=$total_venta_nuevo;
                $Venta->utilidad_bruta= $total_utilidad_bruta_nuevo;
                $inventario->update(['stock' => $stock_nuevo]);  
                $Venta->save();

                if($key == $request->get('venta_id')){ //misma venta, distinto producto
                    
                    //Referente al "nuevo producto"
                    $precio_nuevo_producto=$inventario_nuevo_producto->value('precio_venta');
                    $stock_before=$inventario_nuevo_producto->value('stock');
                    $stock_after=$stock_before - $request->get('cantidad');
                    $total_venta_before=$Venta->total_venta;
                    $total_producto_agora=$request->get('cantidad') * $precio_nuevo_producto;

                    $total_utilidad_bruta_before=$Venta->utilidad_bruta;
                    $utilidad_bruta_agora=$total_producto_agora - ($request->get('cantidad') * $inventario_nuevo_producto->value('precio_compra'));
                    $total_utilidad_bruta_after= $total_utilidad_bruta_before + $utilidad_bruta_agora;
                    $Venta->utilidad_bruta=$total_utilidad_bruta_after;
                    
                    $total_venta_after= $total_venta_before + $total_producto_agora; 
                    $Venta->total_venta=$total_venta_after;
                    $inventario_nuevo_producto->update(['stock' => $stock_after]);  
                    $Venta->save();
                    $registro_actual->update(['producto_id' => $request->get('producto_id'),'cantidad' => $request->get('cantidad'),'total_producto' => $total_producto_agora]);

                }elseif($key2 == $request->get('producto_id')){ //distinta venta, mismo producto
                    
                    //Referente al "nuevo producto"
                    $nueva_venta=Venta::find($request->get('venta_id'));
                    $nueva_sucursal=$nueva_venta->sucursal_id;
                    if($nueva_sucursal != $sucursal){
                        $inventario=DB::table('localizacions')->where('producto_id',$key2)->where('sucursal_id',$nueva_sucursal);
                    }
                    $precio=$inventario->value('precio_venta');
                    $stock_before=$inventario->value('stock');
                    $stock_after=$stock_before - $request->get('cantidad');
                    $total_venta_before=$nueva_venta->total_venta;
                    $total_producto_agora=$request->get('cantidad') * $precio;
                    $total_venta_after= $total_venta_before + $total_producto_agora; 
                    $nueva_venta->total_venta=$total_venta_after;

                    $total_utilidad_bruta_before=$nueva_venta->utilidad_bruta;
                    $utilidad_bruta_agora=$total_producto_agora - ($request->get('cantidad') * $inventario->value('precio_compra'));
                    $total_utilidad_bruta_after= $total_utilidad_bruta_before + $utilidad_bruta_agora;
                    $nueva_venta->utilidad_bruta=$total_utilidad_bruta_after;

                    $inventario->update(['stock' => $stock_after]);  
                    $nueva_venta->save();
                    $registro_actual->update(['venta_id' => $request->get('venta_id'),'cantidad' => $request->get('cantidad'),'total_producto' => $total_producto_agora]);
                
                }else{ //distinta venta, distinto producto
                   
                     //Referente al "nuevo producto"
                     
                     $precio_nuevo_producto=$inventario_nuevo_producto->value('precio_venta');
                     $stock_before=$inventario_nuevo_producto->value('stock');
                     $stock_after=$stock_before - $request->get('cantidad');
                     $total_venta_before=$nueva_venta->total_venta;
                     $total_producto_agora=$request->get('cantidad') * $precio_nuevo_producto;
                     $total_venta_after= $total_venta_before + $total_producto_agora; 
                     $nueva_venta->total_venta=$total_venta_after;

                     $total_utilidad_bruta_before=$nueva_venta->utilidad_bruta;
                     $utilidad_bruta_agora=$total_producto_agora - ($request->get('cantidad') * $inventario_nuevo_producto->value('precio_compra'));
                     $total_utilidad_bruta_after= $total_utilidad_bruta_before + $utilidad_bruta_agora;
                     $nueva_venta->utilidad_bruta=$total_utilidad_bruta_after;

                     $inventario_nuevo_producto->update(['stock' => $stock_after]);  
                     $nueva_venta->save();
                     $registro_actual->update(['venta_id' => $request->get('venta_id'),'producto_id' => $request->get('producto_id'),'cantidad' => $request->get('cantidad'),'total_producto' => $total_producto_agora]);

                }

              
               
            }
            $datos=DB::table('detalle_ventas')->get();

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
        }elseif ($tabla=='detalle_compras') { 
            $request->validate([
                'nivel_calidad' => ['required'],
                'cantidad' => ['required','numeric', 'gt:0'],
                'precio_unitario' => ['required','numeric'],
                'oc_id' => ['required'],
                'producto_id' => ['required'],
            ]);
            $id_correcta_oc=DB::table('orden_compras')->where('id',$request->get('oc_id'))->first();
            $id_correcta_producto=DB::table('productos')->where('id',$request->get('producto_id'))->first();

            if($id_correcta_oc==null && $id_correcta_producto==null){
                $request->validate([
                    'existe_oc' => ['integer'],
                    'existe_producto' => ['integer'],
                ]);
            }elseif($id_correcta_oc==null){
                $request->validate([
                    'existe_oc' => ['integer'],
                ]);
            }elseif($id_correcta_producto==null){
                $request->validate([
                    'existe_producto' => ['integer'],
                ]);
            }
            $registro_actual=DB::table('detalle_compras')->where('oc_id',$key)->where('producto_id',$key2);
            $total_anterior=$registro_actual->value('total');
            $total_nuevo=$request->get('cantidad') * $request->get('precio_unitario');
            if ($key == $request->get('oc_id') && $key2 == $request->get('producto_id')){ // misma orden de compra y mismo producto
                $Compra=Orden_compra::find($key);
                $sucursal=$Compra->sucursal_id;

                //Actualizando inventario
                $inventario=DB::table('localizacions')->where('sucursal_id',$sucursal)->where('producto_id',$key2);
                $stock_anterior=$inventario->value('stock');
                $stock_nuevo=$stock_anterior - $registro_actual->value('cantidad') + $request->get('cantidad');
                $inventario->update(['stock' => $stock_nuevo]);

                //Actualizando orden de compra
                $valor_anterior=$Compra->total_oocc;
                $valor_nuevo=$valor_anterior - $total_anterior + $total_nuevo;
                $Compra->total_oocc=$valor_nuevo;
                $Compra->save();

                $registro_actual->update(['nivel_calidad' => $request->get('nivel_calidad'),'cantidad' => $request->get('cantidad'),'precio_unitario' => $request->get('precio_unitario'),'total' => $total_nuevo]);

            }else{
                $existencia=DB::table('detalle_compras')->where('oc_id',$request->get('oc_id'))->where('producto_id',$request->get('producto_id'))->first();
                if($existencia != null){ 
                    $request->validate([
                        'oc_id' => ['unique:detalle_compras'],
                        'producto_id' => ['unique:detalle_compras'],
                    ]);
                }
                // Anulando la compra de ese producto en la orden de compra anterior
                $Compra_anterior=Orden_compra::find($key);
                $sucursal_anterior=$Compra_anterior->sucursal_id;
                $valor_anterior=$Compra_anterior->total_oocc;
                $valor_nuevo=$valor_anterior - $total_anterior;
                $Compra_anterior->total_oocc=$valor_nuevo;
                $Compra_anterior->save();

                // Disminuye el stock del producto que se canceló
                $inventario_anterior=DB::table('localizacions')->where('sucursal_id',$sucursal_anterior)->where('producto_id',$key2);
                $stock_anterior=$inventario_anterior->value('stock');
                $stock_nuevo=$stock_anterior - $registro_actual->value('cantidad');
                $inventario_anterior->update(['stock' => $stock_nuevo]);

                if($key == $request->get('oc_id')){ //misma orden de compra y diferente producto
                    
                    //Actualizando orden de compra
                    $old_valor_total=$Compra_anterior->total_oocc;
                    $new_valor_total=$old_valor_total + $total_nuevo;
                    $Compra_anterior->total_oocc=$new_valor_total;
                    $Compra_anterior->save();

                    //Actualizando inventario
                    $inventario=DB::table('localizacions')->where('sucursal_id',$sucursal_anterior)->where('producto_id',$request->get('producto_id'));
                    $stock_anterior=$inventario->value('stock');
                    $stock_nuevo=$stock_anterior + $request->get('cantidad');
                    $inventario->update(['stock' => $stock_nuevo]);

                    $registro_actual->update(['producto_id' => $request->get('producto_id'),'nivel_calidad' => $request->get('nivel_calidad'),'cantidad' => $request->get('cantidad'),'precio_unitario' => $request->get('precio_unitario'),'total' => $total_nuevo ]);

                }elseif($key == $request->get('producto_id')){ // distinta orden de compra y mismo producto

                    //Actualizando la "nueva" orden de compra
                    $nova_compra=Orden_compra::find($request->get('oc_id'));
                    $nova_sucursal=$nova_compra->sucursal_id;
                    $antigo_valor=$nova_compra->total_oocc;
                    $novo_valor=$antigo_valor + $total_nuevo;
                    $nova_compra->total_oocc=$novo_valor;
                    $nova_compra->save();

                    //Actualizando inventario
                    $inventario=DB::table('localizacions')->where('sucursal_id',$nova_sucursal)->where('producto_id',$key2);
                    $stock_anterior=$inventario->value('stock');
                    $stock_nuevo=$stock_anterior + $request->get('cantidad');
                    $inventario->update(['stock' => $stock_nuevo]);
                    
                    $registro_actual->update(['oc_id' => $request->get('oc_id'),'nivel_calidad' => $request->get('nivel_calidad'),'cantidad' => $request->get('cantidad'),'precio_unitario' => $request->get('precio_unitario'),'total' => $total_nuevo ]);
    

                }else{  //distinta orden de compra y diferent producto
                    
                    //Actualizando la "nueva" orden de compra
                    $nova_compra=Orden_compra::find($request->get('oc_id'));
                    $nova_sucursal=$nova_compra->sucursal_id;
                    $antigo_valor=$nova_compra->total_oocc;
                    $novo_valor=$antigo_valor + $total_nuevo;
                    $nova_compra->total_oocc=$novo_valor;
                    $nova_compra->save();

                    //Actualizando inventario
                    $inventario=DB::table('localizacions')->where('sucursal_id',$nova_sucursal)->where('producto_id',$request->get('producto_id'));
                    $stock_anterior=$inventario->value('stock');
                    $stock_nuevo=$stock_anterior + $request->get('cantidad');
                    $inventario->update(['stock' => $stock_nuevo]);

                    $registro_actual->update(['oc_id' => $request->get('oc_id'), 'producto_id' => $request->get('producto_id'),'nivel_calidad' => $request->get('nivel_calidad'),'cantidad' => $request->get('cantidad'),'precio_unitario' => $request->get('precio_unitario'),'total' => $total_nuevo ]);

                    
                }




    
            }

            $datos=DB::table('detalle_compras')->get();
           
        }elseif ($tabla=='ventas') {
            $request->validate([
                'sucursal_id' => ['required'],
                'vendedor_rut' => ['required'],
                'medio_de_pago' => ['required'], 
                'con_factura' => ['required'],
            ]);
            $actualizar=Venta::find($key);
            
            if ($request->cliente_rut != null){
                $request->validate([
                    'cliente_rut' => ['required','cl_rut'],
                ]);
                $rut_cliente_normalizado = Rut::parse($request->cliente_rut)->normalize();
                $actualizar->cliente_rut = $rut_cliente_normalizado;
            }else{
                $actualizar->cliente_rut = "";
            }
            
            $actualizar->sucursal_id = $request->get('sucursal_id');
            $actualizar->vendedor_rut = $request->get('vendedor_rut');
            $actualizar->medio_de_pago = $request->get('medio_de_pago');
            $actualizar->con_factura = $request->get('con_factura');
            $actualizar->save();
            $datos=DB::table('ventas')->get();
        }
        
        return redirect()->route('admin_visualizar_especifico', ['datos' => $datos, 'tabla' => $tabla])->with('fila_actualizada','Se ha actualizado la fila correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function borrar($tabla,$key,$key2=null)
    {
        if ($tabla=='usuarios') {
            $dato=User::find($key);
            $dato->delete();
            $datos=DB::table('users')->get();
        }elseif ($tabla=='clientes') {
            $dato=User::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('clientes')->get();
        }elseif ($tabla=='trabajadores') {
            $dato=User::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('trabajadors')->get();
        }elseif ($tabla=='orden_compras') {
            $dato=Orden_Compra::find($key);

            //Actualizando el stock
            $detalle_compras=DB::table('detalle_compras')->where('oc_id',$key)->get();
            foreach($detalle_compras as $individual){
                $inventario=DB::table('localizacions')->where('producto_id',$individual->producto_id)->where('sucursal_id',$dato->sucursal_id);
                $stock_anterior=$inventario->value('stock');
                $restar=$individual->cantidad;
                $stock_nuevo=$stock_anterior - $restar;
                $inventario->update(['stock' => $stock_nuevo]); 
            }

            $dato->delete();
            $datos=DB::table('orden_compras')->get();
            
        }elseif ($tabla=='transportes') {
            $dato=Transporte::find($key);
            $dato->delete();
            $datos=DB::table('transportes')->get();
        }elseif ($tabla=='tornillos') {  
            $dato=Producto::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('tornillos')->get();
        }elseif ($tabla=='telefono_proveedores') { 
            DB::table('telefono_proveedors')->where('proveedor_rut',$key)->where('telefono',$key2)->delete();
            $datos=DB::table('telefono_proveedors')->get();
        }elseif ($tabla=='techumbres') {
            $dato=Producto::find($key);
            $dato->estado="0";
            $dato->save();
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
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('plancha_construccions')->get();
        }elseif ($tabla=='muebles') {
            $dato=Producto::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('muebles')->get();
        }elseif ($tabla=='maderas') {
            $dato=Producto::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('maderas')->get();
        }elseif ($tabla=='sucursal_producto') { 
            DB::table('localizacions')->where('sucursal_id',$key)->where('producto_id',$key2)->delete();
            $datos=DB::table('localizacions')->get();
        }elseif ($tabla=='inventarios') {
            $dato=Inventario::find($key);
            $dato->delete();
            $datos=DB::table('inventarios')->get();
        }elseif ($tabla=='fotos') {
            $dato=Imagen::find($key);
            
            //Borrar la imagen del servidor
            unlink(public_path($dato->url));

            //Borrar la tupla de la tabla
            $dato->delete();
            $datos=DB::table('imagens')->get();
        }elseif ($tabla=='ejecutivos') {
            $dato=Ejecutivo::find($key);
            $dato->delete();
            $datos=DB::table('ejecutivos')->get();
        }elseif ($tabla=='detalle_ventas') {
            $registro_actual=DB::table('detalle_ventas')->where('venta_id',$key)->where('producto_id',$key2);
            //Actualizando tabla de ventas
            $Venta=Venta::find($key);
            $sucursal=$Venta->sucursal_id;
            $valor_anterior=$Venta->total_venta;
            $valor_nuevo=$valor_anterior - $registro_actual->value('total_producto');

            $inventario=DB::table('localizacions')->where('sucursal_id',$sucursal)->where('producto_id',$key2);
            $utilidad_anterior=$Venta->utilidad_bruta;
            $utilidad_nueva= $utilidad_anterior - ($inventario->value('precio_compra') * $registro_actual->value('cantidad'));
            $Venta->utilidad_bruta=$utilidad_nueva;

            $Venta->total_venta=$valor_nuevo;
            $Venta->save();

            //Actualizando stock tabla localizacions
            $inventario=DB::table('localizacions')->where('producto_id',$key2)->where('sucursal_id',$sucursal);
            $stock_nuevo= $inventario->value('stock') + $registro_actual->value('cantidad');
            $inventario->update(['stock' => $stock_nuevo]); 

            $registro_actual->delete();
            $datos=DB::table('detalle_ventas')->get();

        }elseif ($tabla=='clavos') {
            $dato=Producto::find($key);
            $dato->estado="0";
            $dato->save();
            $datos=DB::table('clavos')->get();
        }elseif ($tabla=='detalle_compras') { 
            $borrar=DB::table('detalle_compras')->where('oc_id',$key)->where('producto_id',$key2);

            //Actualizando tabla de orden_compras
            $Compra=Orden_compra::find($key);
            $sucursal=$Compra->sucursal_id;
            $valor_anterior=$Compra->total_oocc;
            $valor_nuevo=$valor_anterior - $borrar->value('total');
            $Compra->total_oocc=$valor_nuevo;
            $Compra->save();

            //Actualizando tabla de localizacions (stock inventario)
            $inventario=DB::table('localizacions')->where('sucursal_id',$sucursal)->where('producto_id',$key2);
            $stock_anterior=$inventario->value('stock');
            $stock_nuevo=$stock_anterior - $borrar->value('cantidad');
            $inventario->update(['stock' => $stock_nuevo]);

            $borrar->delete();

            $datos=DB::table('detalle_compras')->get();
        }elseif ($tabla=='ventas') {
            $dato=Venta::find($key);
            $detalle_ventas=DB::table('detalle_ventas')->where('venta_id',$key)->get();
            
            foreach($detalle_ventas as $individual){
                $inventario=DB::table('localizacions')->where('producto_id',$individual->producto_id)->where('sucursal_id',$dato->sucursal_id);
                $stock_anterior=$inventario->value('stock');
                $sumar=$individual->cantidad;
                $stock_nuevo=$stock_anterior + $sumar;
                $inventario->update(['stock' => $stock_nuevo]); 
            }

            $dato->delete();
            $datos=DB::table('ventas')->get();
        }
        
        return redirect()->route('admin_visualizar_especifico', ['datos' => $datos, 'tabla' => $tabla])->with('fila_eliminada','Se ha eliminado la fila correctamente.');
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

        }elseif ($tabla=='orden_compras') {
            $datos=DB::table('orden_compras')->get();

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

        }elseif ($tabla=='detalle_ventas') {
            $datos=DB::table('detalle_ventas')->get();

        }elseif ($tabla=='clavos') {
            $datos=DB::table('clavos')->get();

        }elseif ($tabla=='detalle_compras') {
            $datos=DB::table('detalle_compras')->get();
        }elseif ($tabla=='ventas') {
            $datos=DB::table('ventas')->get();
        }
        return view('admin.visualizar_especifico',compact('datos','tabla'));

    }
    
}
