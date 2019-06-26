<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
                  <li class="active">Clients</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        
                        <div class="row">
                        <div class="col-lg-8">Clients</div>
                         <div class="col-lg-4 pull-right">
                            <form action="<?php echo e(route('clients.store')); ?>" method="post" enctype="multipart/form-data">
                                   <?php echo e(csrf_field()); ?>

                                   <div class="input-group">
                                       <input type="file" name="file" id="file" accept=".xls, .xlsx" placeholder="GDR rate" class="form-control input-sm pull-right" required>
                                       <span class="input-group-btn">
                                           <button type="submit" class="btn btn-sm btn-primary">Import</button>
                                       </span>
                                   </div>
                               </form>
                          </div>   
                        </div>
                        
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table dataTable">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Account</th>
                                    <th>FEDEXID</th>
                                    <th>Discount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($client->Name); ?></td>
                                        <td><?php echo e($client->Account); ?></td>
                                        <td><?php echo e($client->FedexId); ?></td>
                                        <td><?php echo e($client->Discount); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Account</th>
                                        <th>FEDEXID</th>
                                        <th>Discount</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>