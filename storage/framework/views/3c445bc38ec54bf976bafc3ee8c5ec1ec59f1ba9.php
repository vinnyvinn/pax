<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'Laravel')); ?>

            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <?php if(Auth::check()): ?>
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

                <?php if(hasInbound()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Inbound <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo e(route('clearance-dashboard')); ?>">Clearance Dashboard</a></li>
                            <li><a href="<?php echo e(route('operations-dashboard')); ?>">Operations Dashboard</a></li>
                            <li><a href="<?php echo e(route('finance-dashboard')); ?>">Finance Dashboard</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(hasOutbound()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Outbound <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <?php if(hasShipments('Outbound')): ?>
                            <li class="dropdown-header">WAYBILLS</li>
                            <li><a href="<?php echo e(route('outbound.index')); ?>">Shipments</a></li>
                            <?php endif; ?>
                            <?php if(hasFreight('Outbound')): ?>
                                <li class="dropdown-header">FREIGHT</li>
                            <?php endif; ?>
                                
                            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('outbound.freight.index')); ?>">Billing</a></li>
                            <?php endif; ?>
                                
                            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('outbound.freight.invoice')); ?>">Invoices</a></li>
                            <?php endif; ?>
                            <?php if(hasFreight('Outbound')): ?>
                                <li class="dropdown-header">Additional Charges</li>
                            <?php endif; ?>
                            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('additional-charges-outbound.index')); ?>">Additional Charges</a></li>
                            <?php endif; ?>
                            <?php if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('additional-charges-outbound.invoices')); ?>">Invoices</a></li>
                            <?php endif; ?>

                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(hasDomestic()): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Domestic<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <?php if(hasShipments('Domestic')): ?>
                            <li class="dropdown-header">WAYBILLS</li>
                            <li><a href="<?php echo e(route('domestic.index')); ?>">Shipments</a></li>
                            <?php endif; ?>


                            <?php if(hasFreight('Domestic')): ?>
                                <li class="dropdown-header">FREIGHT</li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Domestic Freight Invoice', 'View Domestic Freight Invoice', 'Edit Domestic Freight Invoice', 'Delete Domestic Freight Invoice', 'Finalize Domestic Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('domestic-freight.index')); ?>">Billing</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Domestic Freight Invoice', 'View Domestic Freight Invoice', 'Edit Domestic Freight Invoice', 'Delete Domestic Freight Invoice', 'Finalize Domestic Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('domestic-freight.show', 'invoice')); ?>">Invoices</a></li>
                            <?php endif; ?>
                            
                        </ul>
                    </li>
                <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-non-fedex-portal')): ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Non-FedEx<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Quotes</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-inbound-non-fedex')): ?>
                            <li><a href="<?php echo e(route('quote.index', ['type' => 1])); ?>">View Inbound</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-outbound-non-fedex')): ?>
                            <li><a href="<?php echo e(route('quote.index', ['type' => 2])); ?>">View Outbound</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-inbound-qoute-non-fedex')): ?>
                            <li><a href="<?php echo e(route('quote.create', ['type' => 1])); ?>">New Inbound Quote</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-outbound-qoute-non-fedex')): ?>
                            <li><a href="<?php echo e(route('quote.create', ['type' => 2])); ?>">New Outbound Quote</a></li>
                            <?php endif; ?>
                            
                            <li class="dropdown-header">Clearance Invoicing</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-invoice-clearance-non-fedex')): ?>
                            <li><a href="<?php echo e(route('non-clearance')); ?>">Generate Invoice</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-proforma-clearance-non-fedex')): ?>
                            <li><a href="<?php echo e(route('non-invoices')); ?>">View Proforma</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-invoices-clearance-non-fedex')): ?>
                            <li><a href="<?php echo e(route('non-invoices-actual')); ?>">View Invoices</a></li>
                            <?php endif; ?>

                            <li class="dropdown-header">Inbound Freight Invoices</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-proforma-inbound-freight-non-fedex')): ?>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 1])); ?>">Proforma</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-invoice-inbound-freight-non-fedex')): ?>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 1, 'final' => 1])); ?>">Invoice</a></li>
                            <?php endif; ?>
                            <li class="dropdown-header">Outbound Freight Invoices</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-proforma-outbound-freight')): ?>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 2])); ?>">Proforma</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-invoice-outbound-freight')): ?>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 2, 'final' => 1])); ?>">Invoice</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Dispatch<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Imports</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-pickup')): ?>
                            <li><a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_tnt])); ?>">Import TNT</a></li>
                            <li><a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_fedex])); ?>">Import FEDEX</a></li>
                            <li><a href="<?php echo e(route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_recurrent])); ?>">Import Recurrent</a></li>
                            <?php endif; ?>
                            <li class="dropdown-header">Pickup Management</li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-pickups')): ?>
                            <li><a href="<?php echo e(route('pickups.index')); ?>">Pickups dashboard</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-pickup')): ?>
                            <li><a href="<?php echo e(route('pickups.create')); ?>">Add pickup</a></li>  
                            <?php endif; ?>
                        </ul>
                       </li>  
                    <?php endif; ?>
                    
            </ul>
            <?php endif; ?>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Masters <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <?php if(canAny(['Create Area Codes', 'View Area Codes', 'Edit Area Codes', 'Delete Area Codes'])): ?>
                                <li><a href="<?php echo e(route('area-code.index')); ?>">Area-Codes</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create CBV', 'View CBV', 'Edit CBV', 'Delete CBV'])): ?>
                                <li><a href="<?php echo e(route('cbv.index')); ?>">CBVs</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Cities', 'View Cities', 'Edit Cities', 'Delete Cities'])): ?>
                                <li><a href="<?php echo e(route('city.index')); ?>">Cities</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Couriers', 'View Couriers', 'Edit Couriers', 'Delete Couriers'])): ?>
                                <li><a href="<?php echo e(route('courier.index')); ?>">Couriers</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Domestic Locations', 'View Domestic Locations', 'Edit Domestic Locations', 'Delete Domestic Locations'])): ?>
                                <li><a href="<?php echo e(route('domestic-locations.index')); ?>">Domestic Locations</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Edit Domestic Rates'])): ?>
                                <li><a href="<?php echo e(route('domestic-rates.index')); ?>">Domestic Rates</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Routes', 'View Routes', 'Edit Routes', 'Delete Routes'])): ?>
                                <li><a href="<?php echo e(route('route.index')); ?>">Route</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card'])): ?>
                                <li><a href="<?php echo e(route('sales-rate-card.index')); ?>">Outbound Rate Card</a></li>
                                <li><a href="<?php echo e(route('discount-rate-card.index')); ?>">Discount Rate Card</a></li>
                            <?php endif; ?>
                            <?php if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card'])): ?>
                                <li><a href="<?php echo e(route('gdr.index')); ?>">GDR rates</a></li>
                            <?php endif; ?>
                            <?php if(canAny(['Edit Outbound Zones', 'View Outbound Zones'])): ?>
                                <li><a href="<?php echo e(route('outbound-zones.index')); ?>">Outbound Zones</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Users', 'View Users', 'Edit Users', 'Delete Users'])): ?>
                                    <li><a href="<?php echo e(route('user.index')); ?>">Users</a></li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-settings')): ?>
                            <li><a href="<?php echo e(route('other-charges.index')); ?>">Other charges</a></li>
                                <li><a href="<?php echo e(route('settings.index')); ?>">Settings</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo e(route('clients.index')); ?>">Clients</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo e(url('change-password')); ?>">Change Password</a></li>
                            <li>
                                <a href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                
            </ul>
        </div>
    </div>
</nav>
