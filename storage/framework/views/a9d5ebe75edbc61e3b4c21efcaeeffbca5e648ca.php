<?php $__env->startSection('content'); ?>
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Rate Card</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo e(route('rate-card.update', $card->id)); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <?php echo e(method_field('PUT')); ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <h4>Packaging</h4>
                            <p><?php echo e($card->getPackaging()); ?></p>
                        </div>
                        <div class="col-sm-6">
                            <h4>Weight</h4>
                            <p><?php echo e($card->weight); ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group<?php echo e($errors->has('zone_a') ? ' has-error' : ''); ?>">
                                <label for="zone_a">Zone A</label>
                                <input type="number" step="0.01" min="0" name="zone_a" id="zone_a" class="form-control" required value="<?php echo e($card->zone_a); ?>">

                                <?php if($errors->has('zone_a')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_a')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_b') ? ' has-error' : ''); ?>">
                                <label for="zone_b">Zone B</label>
                                <input type="number" step="0.01" min="0" name="zone_b" id="zone_b" class="form-control" required value="<?php echo e($card->zone_b); ?>">

                                <?php if($errors->has('zone_b')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_b')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_c') ? ' has-error' : ''); ?>">
                                <label for="zone_c">Zone C</label>
                                <input type="number" step="0.01" min="0" name="zone_c" id="zone_c" class="form-control" required value="<?php echo e($card->zone_c); ?>">

                                <?php if($errors->has('zone_c')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_c')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_d') ? ' has-error' : ''); ?>">
                                <label for="zone_d">Zone D</label>
                                <input type="number" step="0.01" min="0" name="zone_d" id="zone_d" class="form-control" required value="<?php echo e($card->zone_d); ?>">

                                <?php if($errors->has('zone_d')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_d')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_e') ? ' has-error' : ''); ?>">
                                <label for="zone_e">Zone E</label>
                                <input type="number" step="0.01" min="0" name="zone_e" id="zone_e" class="form-control" required value="<?php echo e($card->zone_e); ?>">

                                <?php if($errors->has('zone_e')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_e')); ?></span>
                                <?php endif; ?>
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="form-group<?php echo e($errors->has('zone_f') ? ' has-error' : ''); ?>">
                                <label for="zone_f">Zone F</label>
                                <input type="number" step="0.01" min="0" name="zone_f" id="zone_f" class="form-control" required value="<?php echo e($card->zone_f); ?>">

                                <?php if($errors->has('zone_f')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_f')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_g') ? ' has-error' : ''); ?>">
                                <label for="zone_g">Zone G</label>
                                <input type="number" step="0.01" min="0" name="zone_g" id="zone_g" class="form-control" required value="<?php echo e($card->zone_g); ?>">

                                <?php if($errors->has('zone_g')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_g')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_h') ? ' has-error' : ''); ?>">
                                <label for="zone_h">Zone H</label>
                                <input type="number" step="0.01" min="0" name="zone_h" id="zone_h" class="form-control" required value="<?php echo e($card->zone_h); ?>">

                                <?php if($errors->has('zone_h')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_h')); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group<?php echo e($errors->has('zone_i') ? ' has-error' : ''); ?>">
                                <label for="zone_i">Zone I</label>
                                <input type="number" step="0.01" min="0" name="zone_i" id="zone_i" class="form-control" required value="<?php echo e($card->zone_i); ?>">

                                <?php if($errors->has('zone_i')): ?>
                                    <span class="help-block"><?php echo e($errors->first('zone_i')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="<?php echo e(route('rate-card.index')); ?>" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>