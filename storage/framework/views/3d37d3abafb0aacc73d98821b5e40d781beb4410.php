<ul id="sidebarnav">
        <li class="nav-devider"></li>
       <li> <a href="<?php echo e(route('dispatch.home')); ?>"><i class="fa fa-home"></i><span class="hide-menu">Home</span></a></li>
        <li class="nav-label">Masters</li>
        <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">Customers</span></a>
            <ul aria-expanded="false" class="collapse">
               <li><a href="<?php echo e(route('customers.index')); ?>">Customer list</a></li>
                <li><a href="<?php echo e(route('customers.create')); ?>">Add Customer</a></li>
            </ul>
        </li>
    </ul>