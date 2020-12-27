<?php $__env->startSection('content'); ?>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar cotizacion</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form method="POST" id="formenviar" action="<?php echo e(url('/cotizacion/update/'.$cotizacion->id)); ?>" class="form-horizontal form-label-left input_mask">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  placeholder="0.00" step="0.01" name="valor"  id="valor"  class="form-control col-md-7 col-xs-12" value="<?php echo e($cotizacion->valor); ?>">
                                    <?php if ($errors->has('valor')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('valor'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha venta <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="fecha" id="fecha" class="form-control col-md-7 col-xs-12 date-picker" value="<?php echo e($fecha); ?>">
                                    <?php if ($errors->has('fecha')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('fecha'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hora <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="hora" placeholder="hh:mm" id="hora" class="form-control col-md-7 col-xs-12" value="<?php echo e($hora); ?>">
                                    <?php if ($errors->has('hora')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('hora'); ?>
                                    <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <a href="<?php echo e(url('/cotizacion')); ?>" class="btn btn-primary"><i class="fa  fa-times"></i> Cancelar</a>
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


            $('#fecha').datetimepicker({
                format: 'DD-MM-YYYY'
            });

            $('#formenviar').submit(function(){

                $('#formenviar').submit(function(){

                if(document.getElementById("valor").value<="0"){
                document.getElementById("valor").value = "0.00";
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alejandro/Documentos/sellphone/resources/views/cotizacion/edit.blade.php ENDPATH**/ ?>