<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Celular;
use App\User;
use App\Cotizacion;
use App\Venta;
use App\Caja;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\Validator;

class VentasController extends Controller
{
    public function index()
    {
        $ultima_cotizacion = Cotizacion::all()->last();
        $ventas = DB::table('ventas')
            ->leftjoin('celulares', 'celulares.venta_id', '=', 'ventas.id')
            ->leftjoin('users', 'users.id', '=', 'ventas.user_id')
            ->select('ventas.*', 'celulares.imei as imei', 'celulares.precio_venta as precio_venta','users.name as usuario')
            ->get();
        return view('ventas.index',['ventas'=>$ventas,'ultima_cotizacion'=>$ultima_cotizacion]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $celulares = DB::table('celulares')
        ->whereNull('venta_id')
        ->get();

        $ultima_cotizacion = Cotizacion::all()->last();

        return view('ventas.create',['celulares'=>$celulares,'ultima_cotizacion'=>$ultima_cotizacion]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
            $validatedData = $request->validated();
            $precio_venta = $request->input('precio_venta');
            $fecha_venta =$request->input('fecha_venta');
            $hora = $request->input('hora_venta');
            $fecha_final = $fecha_venta.' '.$hora;
            $imei = $request->input('imei');
            $precio = $request->input('precio');
            $fecha = date('Y-m-d H:i',strtotime($fecha_final));
            $precio_dollar = $request->input('precio_dollar');
            $vendedor = $request->input('vendedor');
            $ultima_cotizacion = Cotizacion::all()->last();

            $precio_venta = ($precio/$ultima_cotizacion->valor)+$precio_dollar;


            $cell= Celular::find($imei);

            $venta = new Venta();
            $venta->user_id = $request->session()->get('user')->id;
            $venta->cotizacion_id = $ultima_cotizacion->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');
            $venta->save();

            $caja = new Caja();
            $caja->saldo_dollar = $precio_dollar;
            $caja->saldo_pesos = $precio;
            $caja->fecha = $fecha;
            $caja->saldo_final = $precio_venta;
            $caja->observacion = "Venta del celular con IMEI"." ".$cell->imei;
            $caja->concepto = 'Ingreso';
            $caja->user_id = $request->session()->get('user')->id;
            $caja->cotizacion_id = $ultima_cotizacion->id;
            $caja->venta_id = $venta->id;
            $caja->save();


            $cell->venta_id = $venta->id;
            $cell->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $cell->precio_venta = $precio_venta;
            $cell->comprador = $request->input('nombre');
            $ultima_cotizacion->usado = 1;

            $cell->update();
            $ultima_cotizacion->update();

        return redirect('/ventas');
    }

    public function edit($id)
    {

        $venta = Venta::find($id);

        $celulares = DB::table('celulares')
        ->get();

        $ultima_cotizacion = Cotizacion::find($venta->cotizacion_id);
        $fecha_venta = date('d-m-Y',strtotime($venta->fecha));
        $hora_venta = date('H:i',strtotime($venta->fecha));

        return view('ventas.edit',['venta'=>$venta, 'celulares'=>$celulares,'ultima_cotizacion'=>$ultima_cotizacion,'fecha_venta'=>$fecha_venta,'hora_venta'=>$hora_venta]);
    }

    public function show($id)
    {

        $venta = Venta::find($id);

        $celulares = DB::table('celulares')
        ->get();

        $fecha_venta = date('d-m-Y',strtotime($venta->fecha));
        $hora_venta = date('H:i',strtotime($venta->fecha));

        return view('ventas.show',['venta'=>$venta, 'celulares'=>$celulares,'fecha_venta'=>$fecha_venta,'hora_venta'=>$hora_venta]);
    }

    public function update(VentaFormRequest $request, $id)
    {

        $validatedData = $request->validated();

        $venta = Venta::find($id);

        $celular_act =  DB::table('celulares')
        ->where('venta_id', '=', $id)->first();

        $celular_actual = Celular::find($celular_act->id);

        $cotizacion = Cotizacion::find($venta->cotizacion_id);

        $caja_dat =  DB::table('cajas')
        ->where('venta_id', '=', $id)->first();

        $caja = Caja::find($caja_dat->id);



        $imei = $request->input('imei');
        $precio = $request->input('precio');
        $fecha_venta =$request->input('fecha_venta');
        $hora = $request->input('hora_venta');
        $fecha_final = $fecha_venta.' '.$hora;
        $fecha = date('Y-m-d H:i',strtotime($fecha_final));
        $precio_dollar = $request->input('precio_dollar');
        $vendedor = $request->input('vendedor');


        $precio_venta = ($precio/$cotizacion->valor)+$precio_dollar;

        if($imei != $celular_actual->id)
        {

            $celular_selec = Celular::find($imei);


            $venta->user_id = $request->session()->get('user')->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');

            $celular_selec->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $celular_selec->precio_venta = $precio_venta;
            $celular_selec->comprador = $request->input('nombre');
            $celular_selec->venta_id = $venta->id;

            $celular_actual->precio_venta = null;
            $celular_actual->comprador = null;
            $celular_actual->fecha_venta = null;
            $celular_actual->venta_id =null;

            $caja->saldo_dollar = $precio_dollar;
            $caja->saldo_pesos = $precio;
            $caja->fecha = $fecha;
            $caja->saldo_final = $precio_venta;
            $caja->user_id = $request->session()->get('user')->id;

            $celular_actual->update();
            $celular_selec->update();
            $venta->update();
            $caja->update();

        }

        else
        {

            $venta->user_id = $request->session()->get('user')->id;
            $venta->vendedor = $vendedor;
            $venta->precio_dollar = $precio_dollar;
            $venta->precio = $precio;
            $venta->fecha = $fecha;
            $venta->nombre = $request->input('nombre');
            $venta->email =  $request->input('email');
            $venta->telefono = $request->input('telefono');
            $venta->metodo_pago = $request->input('metodo_pago');
            $venta->observacion = $request->input('observacion');
            $venta->tipo_cliente = $request->input('tipo_cliente');

            $celular_actual->comprador = $request->input('nombre');
            $celular_actual->fecha_venta = date('Y-m-d',strtotime($request->input('fecha_venta')));
            $celular_actual->precio_venta = $precio_venta;


            $caja->saldo_dollar = $precio_dollar;
            $caja->saldo_pesos = $precio;
            $caja->fecha = $fecha;
            $caja->saldo_final = $precio_venta;
            $caja->user_id = $request->session()->get('user')->id;

            $celular_actual->update();
            $venta->update();
            $caja->update();
        }

        return redirect('/ventas');
    }

    public function destroy($id,Request $request)
    {
        $input = $request->all();
        $rules = [
            'observacion' => 'required',
        ];
        $messages = [
            'observacion.required' => 'Debe especificar el motivo por el cual va a eliminar una venta',
            ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect('/ventas')
            ->withErrors($validator)
            ->withInput();
        }
        else
        {
        $venta = Venta::find($id);
        $celular_act  =  DB::table('celulares')
        ->where('venta_id', '=', $id)->first();



        $observacion = $request->input('observacion');

        $ventas = DB::table('ventas')
                    ->where('cotizacion_id', '=', $venta->cotizacion_id)
                    ->get();

        $celular_actual = Celular::find($celular_act->id);

        $caja = new Caja();
        $caja->saldo_dollar = $venta->precio_dollar;
        $caja->saldo_pesos = $venta->precio;
        $caja->fecha = date('Y-m-d H:i');
        $caja->saldo_final = $celular_actual->precio_venta;
        $caja->observacion = $observacion;
        $caja->concepto = 'Egreso';
        $caja->user_id = $request->session()->get('user')->id;
        $caja->cotizacion_id = $venta->cotizacion_id;
        $caja->save();

        if($ventas->count() == 1)
        {
            $cotizacion = Cotizacion::find($venta->cotizacion_id);
            $cotizacion->usado = 0;
            $cotizacion->update();
        }

        $celular_actual->precio_venta = null;
        $celular_actual->comprador = null;
        $celular_actual->fecha_venta = null;
        $celular_actual->venta_id=null;
        $celular_actual->update();
        $venta->delete();

            return redirect('/ventas');
        }
    }


}
