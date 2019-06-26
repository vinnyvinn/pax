<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pickups report</title>
</head>
<body>
  <table class="table dataTable">
    <thead>
        <tr>
           <th>#</th>
           <th>Pickup no</th>
           <th>Pickup Date</th>
           <th>Ready time</th>
           <th>Close time</th>
           <th>Company Name</th>
           <th>Assigned to</th>
           <th>Status</th>
           <th>Type</th>
           <th>Address</th>
           <th>Contact name</th>
           <th>Contact phone</th>
           <th>Description</th>
           <th>Instructions</th>
           <th>Cash Collect</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pickup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($key+1); ?></td>
            <td><?php echo e($pickup->pickup_no); ?></td>
            <td><?php echo e($pickup->pickup_date); ?></td>
            <td><?php echo e($pickup->ready_time); ?></td>
            <td><?php echo e($pickup->close_time); ?></td>
            <td><?php echo e($pickup->company_name); ?></td>
            <td><?php echo e($pickup->courier ? $pickup->courier->name : '-'); ?></td>
            <td><?php echo e($pickup->status_name); ?></td>
            <td><?php echo e($pickup->type_name); ?></td>
            <td><?php echo e($pickup->address); ?></td>
            <td><?php echo e($pickup->contact_name); ?></td>
            <td><?php echo e($pickup->contact_phone); ?></td>
            <td><?php echo e($pickup->description); ?></td>
            <td><?php echo e($pickup->instructions); ?></td>
            <td><?php echo e($pickup->cash_collect); ?></td>
          </tr> 
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</body>
</html>