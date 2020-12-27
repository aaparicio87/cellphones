<?php $__env->startSection('content'); ?>
<?php if($ultima_cotizacion==null): ?>
<div class="alert alert-warning" role="alert">
   <h4>No existe cotizacion del dolar debe crearla antes de realizar una venta</h4>
  </div>
 <?php endif; ?>
 <?php if ($errors->has('observacion')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('observacion'); ?>
 <div class="alert alert-danger"><h4><?php echo e($message); ?></h4></div>
 <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
    <div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ventas</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="table_ventas" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <?php if($ultima_cotizacion != null): ?>
                                <th width="50px">
                                    <a class="btn btn-primary btn-xs" href="<?php echo e(url('ventas/create')); ?>">Adicionar venta</a>
                                </th>
                                <?php endif; ?>
                                <th>Fecha venta</th>
                                <th>Imei</th>
                                <th>Precio en dolares</th>
                                <th>Precio en pesos</th>
                                <th>Precio venta</th>
                                <th>Vendedor</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Metodo de pago</th>
                                <th>Observacion</th>
                                <th>Usuario</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $ventas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <a href="<?php echo e(url('/ventas/edit/'.$venta->id)); ?>" class="btn btn-default btn-xs btn-detail">Editar</a>
                                    <a href="<?php echo e(url('/ventas/show/'.$venta->id)); ?>" class="btn btn-danger btn-xs btn-detail">Eliminar</a>
                                </td>
                                <td><?php
                                    if($venta->fecha=='0000-00-00 00:00:00'){
                                        echo '';
                                    }else{
                                        echo date('d-m-Y h:i:s',strtotime($venta->fecha));
                                    }
                                    ?>
                                </td>
                                <td><?php echo e($venta->imei); ?></td>
                                <td><?php echo e($venta->precio_dollar); ?></td>
                                <td><?php echo e($venta->precio); ?></td>
                                <td><?php echo e($venta->precio_venta); ?></td>
                                <td><?php echo e($venta->vendedor); ?></td>
                                <td><?php echo e($venta->nombre); ?></td>
                                <td><?php echo e($venta->telefono); ?></td>
                                <td><?php echo e($venta->email); ?></td>
                                <td><?php echo e($venta->metodo_pago); ?></td>
                                <td><?php echo e($venta->observacion); ?></td>
                                <td><?php echo e($venta->usuario); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

        jQuery(document).ready(function($){

            $('#table_ventas').dataTable({
                "language" : {
                    "url":'lan/spanish.json'
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/alejandro/Documentos/sellphone/resources/views/ventas/index.blade.php ENDPATH**/ ?>