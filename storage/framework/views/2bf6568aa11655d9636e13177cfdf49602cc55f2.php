<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="<?php echo e(route('setting-dashboard')); ?>">Setting Dashboard</a></li>
                  <li><a href="<?php echo e(route('gdr.index')); ?>">GDR rates</a></li>
                  <li class="active">GDR rate details</li>
                </ol>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="card-title">Rate card details (USD)</h4>
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-title">
                                Effective from: <?php echo e(pax_date_format($data->effective_from)); ?> Effective to: <?php echo e(pax_date_format($data->effective_to)); ?>

                            </h4>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Package</th>
                                    <th>Weight</th>
                                    <th>A</th>
                                    <th>B</th>
                                    <th>C</th>
                                    <th>D</th>
                                    <th>E</th>
                                    <th>F</th>
                                    <th>G</th>
                                    <th>H</th>
                                    <th>I</th>
                                    <th>J</th>
                                    <th>K</th>
                                    <th>L</th>
                                    <th>M</th>
                                    <th>N</th>
                                    <th>O</th>
                                    <th>P</th>
                                    <th>Q</th>
                                    <th>R</th>
                                    <th>S</th>
                                    <th>T</th>
                                    <th>U</th>
                                    <th>V</th>
                                    <th>W</th>
                                    <th>X</th>
                                    <th>Y</th>
                                    <th>Z</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $data->rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <tr>
                                    <td><?php echo e($rate->package_type); ?></td>
                                    <td><?php echo e($rate->weight); ?></td>
                                    <td><?php echo e($rate->a ?  number_format($rate->a, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->b ?  number_format($rate->b, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->c ?  number_format($rate->c, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->d ?  number_format($rate->d, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->e ?  number_format($rate->e, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->f ?  number_format($rate->f, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->g ?  number_format($rate->g, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->h ?  number_format($rate->h, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->i ?  number_format($rate->i, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->j ?  number_format($rate->j, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->k ?  number_format($rate->k, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->l ?  number_format($rate->l, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->m ?  number_format($rate->m, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->n ?  number_format($rate->n, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->o ?  number_format($rate->o, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->p ?  number_format($rate->p, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->q ?  number_format($rate->q, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->r ?  number_format($rate->r, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->s ?  number_format($rate->s, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->t ?  number_format($rate->t, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->u ?  number_format($rate->u, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->v ?  number_format($rate->v, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->w ?  number_format($rate->w, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->x ?  number_format($rate->x, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->y ?  number_format($rate->y, 4) : '-'); ?></td>
                                    <td><?php echo e($rate->z ?  number_format($rate->z, 4) : '-'); ?></td>
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
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>