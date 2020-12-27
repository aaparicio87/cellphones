@extends('layout')
@section('content')
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Eliminar venta</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="{{url('/ventas/destroy/'.$venta->id)}}" class="form-horizontal form-label-left input_mask">
                            @csrf
                            {{method_field('DELETE')}}
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha_venta" id="fecha_venta" class="form-control col-md-7 col-xs-12 date-picker" value="{{$fecha_venta}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hora venta
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="hora_venta" id="hora_venta" class="form-control col-md-7 col-xs-12" value="{{$hora_venta}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Imei
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @foreach($celulares as $celular)
                                    @if($celular->venta_id == $venta->id)
                                    <input type="text"  value="{{$celular->imei}}" name="imei" id="imei" class="form-control col-md-7 col-xs-12 imei bold" readonly>
                                    @break
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dolar <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="precio_dollar" id="precio_dollar" class="form-control col-md-7 col-xs-12 precio_dollar" value="{{$venta->precio_dollar}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pesos <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="precio" id="precio" class="form-control col-md-7 col-xs-12 precio" value="{{$venta->precio}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vendedor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="vendedor" id="vendedor" class="form-control col-md-7 col-xs-12 vendedor" value="{{$venta->vendedor}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Precio venta
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                @foreach($celulares as $celular)
                                                @if($celular->venta_id == $venta->id)
                                    <input type="text" placeholder="0.00" step="0.01" value="{{$celular->precio_venta}}" name="precio_venta" id="precio_venta" class="form-control col-md-7 col-xs-12 precio_venta bold" readonly>
                                @break
                                @endif
                                @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nombre" id="nombre" class="form-control col-md-7 col-xs-12 nombre"value="{{$venta->nombre}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefono
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="telefono" id="telefono" class="form-control col-md-7 col-xs-12 telefono"value="{{$venta->telefono}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="email" id="email" class="form-control col-md-7 col-xs-12 email"value="{{$venta->email}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Metodo de Pago
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="metodo" id="metodo" class="form-control col-md-7 col-xs-12 email"value="{{$venta->metodo_pago}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tipo de Cliente
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="tipo_cliente" id="tipo_cliente" class="form-control col-md-7 col-xs-12 email"value="{{$venta->tipo_cliente}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Observacion<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" name="observacion" id="observacion" rows="2"></textarea>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="{{url('/ventas')}}" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Eliminar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>

    jQuery(document).ready(function($){

        $('#fecha_venta').datetimepicker({
            format: 'DD-MM-YYYY'

        });

    });
</script>
@endsection
