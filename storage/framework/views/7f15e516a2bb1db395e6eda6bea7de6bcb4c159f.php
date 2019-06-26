<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                       Pickup details - <?php echo e($pickup->pickup_no); ?> (<?php echo e($pickup->status_name); ?>)
                    </div>

                    <div class="panel-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="details">
                                <br>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h5>Pickup date</h5>
                                        <h5><?php echo e($pickup->pickup_date); ?></h5>
                                        <hr>

                                        <h5>Ready time</h5>
                                        <h5><?php echo e($pickup->ready_time); ?></h5>
                                        <hr>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Close time</h5>
                                        <h5><?php echo e($pickup->close_time); ?></h5>
                                        <hr>
                                        <h5>No of packages</h5>
                                        <h5><?php echo e($pickup->no_packages); ?></h5>
                                        <hr>
                                    </div>
                                    <div class="col-sm-4">
                                        <h5>Expected weight</h5>
                                        <h5><?php echo e($pickup->expected_weight.' Kg'); ?></h5>
                                        <hr>

                                        <h5>Cash collect</h5>
                                        <h5><?php echo e($pickup->cash_collect); ?></h5>
                                        <hr>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Contact name</h5>
                                        <h5><?php echo e($pickup->contact_name); ?></h5>
                                        <hr>

                                        <h5>Contact phone</h5>
                                        <h5><?php echo e($pickup->contact_phone); ?></h5>
                                        <hr>

                                        <h5>Company name</h5>
                                        <h5><?php echo e($pickup->company_name); ?></h5>
                                        <hr>

                                    </div>
                                    <div class="col-sm-6">
                                        <h5>Bill account</h5>
                                        <h5><?php echo e(!$pickup->client ? '-' : $pickup->client->Name); ?></h5>
                                        <hr>

                                        <h5>Bill Company</h5>
                                        <h5><?php echo e($pickup->bill_company_name); ?></h5>
                                        <hr>

                                        <h5>Courier</h5>
                                        <h5><?php echo e($pickup->courier ? $pickup->courier->name : '-'); ?></h5>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    
                                        <h5>Address</h5>
                                        <p>
                                            <?php echo e($pickup->address); ?>

                                        </p>
                                        <hr>
                                    </div>
                                    <div class="col-sm-6">

                                        <h5>Brief description</h5>
                                        <p>
                                            <?php echo e($pickup->description); ?>

                                        </p>
                                        <hr>
                                    </div>
                                    <?php if($pickup->done_comment): ?>
                                    <div class="col-sm-6">

                                        <h5>Done comment</h5>
                                        <p><?php echo e($pickup->done_comment); ?></p>
                                        <hr>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($pickup->cancel_comment): ?>
                                    <div class="col-sm-6">

                                        <h5>Cancel Comment</h5>
                                        <p><?php echo e($pickup->cancel_comment); ?></p>
                                        <hr>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo e(route('pickups.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>