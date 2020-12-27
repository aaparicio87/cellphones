<?php $__env->startSection('content'); ?>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar caja</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="<?php echo e(url('/caja/update/'.$caja->id)); ?>" class="form-horizontal form-label-left input_mask">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha" id="fecha" class="form-control col-md-7 col-xs-12 " value="<?php echo e($caja->fecha); ?>" readonly>
                                </div>
                                <?php if ($errors->has('fecha')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fecha'); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dolar
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_dollar" id="saldo_dollar" class="form-control col-md-7 col-xs-12 saldo_dollar" value="<?php echo e($caja->saldo_dollar); ?>">
                                    <?php if ($errors->has('saldo_dollar')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('saldo_dollar'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pesos
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_pesos" id="saldo_pesos" class="form-control col-md-7 col-xs-12 precio" value="<?php echo e($caja->saldo_pesos); ?>">
                                    <?php if ($errors->has('saldo_pesos')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('saldo_pesos'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Saldo final <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                <input type="text" placeholder="0.00" min="0" step="0.01" name="saldo_final" id="saldo_final" class="form-control col-md-7 col-xs-12 saldo_final bold" value="<?php echo e($caja->saldo_final); ?>" readonly>
                                <?php if ($errors->has('saldo_final')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('saldo_final'); ?>
                                <div class="alert alert-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Observacion <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea class="form-control" name="observacion" id="observacion" rows="2"><?php echo e($caja->observacion); ?></textarea>

                                    <?php if ($errors->has('observacion')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('observacion'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <!-- Seccion de Concepto-->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Concepto <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="concepto" class="form-control col-md-7 col-xs-12 js-example-basic-single">

                                            <option value="">Seleccione Concepto</option>
                                            <option value="Ingreso" <?= $caja->concepto === 'Ingreso' ? 'selected' : '' ?>>Ingreso</option>
                                            <option value="Egreso" <?= $caja->concepto === 'Egreso' ? 'selected' : '' ?>>Egreso</option>
                                    </select>
                                    <?php if ($errors->has('concepto')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('concepto'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>
                            <!-- Fin de Concepto-->

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" name="cotizacion" id="cotizacion" class="form-control col-md-7 col-xs-12 cotizacion" value="<?php echo e($ultima_cotizacion->valor); ?>">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="<?php echo e(url('/caja')); ?>" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Aceptar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        jQuery(document).ready(function($){

            $('#saldo_pesos').change(function(){

            var saldo_pesos = document.getElementById("saldo_pesos").value;
            var saldo_dollar = document.getElementById("saldo_dollar").value;
            var cotizacion = document.getElementById("cotizacion").value;

                if(isNaN(saldo_pesos)){
                    saldo_pesos="0.00";
                }

                if(isNaN(saldo_dollar)){
                    saldo_dollar="0.00";
                }

                if((saldo_pesos.length<=0) && (saldo_dollar.length<=0)){
                        document.getElementById("saldo_final").value ="0.00";
                }

                if(saldo_pesos.length<=0){
                    saldo_pesos="0.00";
                }

                if(saldo_dollar.length<=0){
                    saldo_dollar = "0.00";
                }

                var saldo_final = (parseFloat(saldo_pesos)/parseFloat(cotizacion))+parseFloat(saldo_dollar);
                document.getElementById("saldo_final").value = String(saldo_final.toFixed(2));


            });

            $('#saldo_dollar').change(function(){
                var saldo_pesos = document.getElementById("saldo_pesos").value;
                var saldo_dollar = document.getElementById("saldo_dollar").value;
                var cotizacion = document.getElementById("cotizacion").value;

                if(isNaN(saldo_dollar)){

                    saldo_dollar = "0.00";
                }

                if(isNaN(saldo_pesos)){

                    saldo_pesos = "0.00";
                }

                if((saldo_pesos.length<=0) && (saldo_dollar.length<=0)){
                        document.getElementById("saldo_final").value ="0.00";
                }

                if(saldo_pesos.length<=0){
                    saldo_pesos="0.00";
                }

                if(saldo_dollar.length<=0){
                    saldo_dollar = "0.00";
                }

                var saldo_final = (parseFloat(saldo_pesos)/parseFloat(cotizacion))+parseFloat(saldo_dollar);
                document.getElementById("saldo_final").value = String(saldo_final.toFixed(2));

            });

                $('#formenviar').submit(function(){

                if(document.getElementById("saldo_pesos").value.length<=0){
                    document.getElementById("saldo_pesos").value = "0.0";
                }

                if(document.getElementById("saldo_dollar").value.length<=0){
                    document.getElementById("saldo_dollar").value = "0.0";
                }

                });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alejandro/Documentos/sellphone/resources/views/caja/edit.blade.php ENDPATH**/ ?>