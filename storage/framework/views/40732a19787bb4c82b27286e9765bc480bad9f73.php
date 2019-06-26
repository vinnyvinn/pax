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
                            <?php if(hasShipments('Inbound')): ?>
                                <li class="dropdown-header">WAYBILLS</li>
                                <li><a href="<?php echo e(route('manifest.index')); ?>">Shipments</a></li>
                                
                            <?php endif; ?>

                            <?php if(hasScans()): ?>
                                <li class="dropdown-header">SCANS</li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-71')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'dutiable')); ?>">Import 71</a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-72')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'non-dutiable')); ?>">Import 72</a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-scan-65')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'released')); ?>">Import 65</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo e(route('manifest.scan', 'oda')); ?>">ODA scan</a></li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-van-scan')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'van')); ?>">Van Scan</a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-pod-scan')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'pod')); ?>">POD Scan</a></li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('import-dex-scan')): ?>
                                <li><a href="<?php echo e(route('manifest.scan', 'dex')); ?>">DEX Scan</a></li>
                            <?php endif; ?>

                            <?php if(hasClearance()): ?>
                                <li class="dropdown-header">CLEARANCE</li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('generate-release-orders')): ?>
                                <li><a href="<?php echo e(route('clearance.index')); ?>">Generate Release Orders</a></li>
                            <?php endif; ?>
                                <li><a href="<?php echo e(route('clearing-agents')); ?>">Update Clearing Agent</a></li>
                            <?php if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice'])): ?>
                                <li><a href="<?php echo e(route('invoice.index')); ?>">Billing</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Clearance Invoice', 'View Clearance Invoice', 'Edit Clearance Invoice', 'Delete Clearance Invoice', 'Finalize Clearance Invoice'])): ?>
                                <li><a href="<?php echo e(route('invoice.invoice')); ?>">Invoices</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Agent Clearance Invoice', 'View Agent Clearance Invoice', 'Edit Agent Clearance Invoice', 'Delete Agent Clearance Invoice', 'Finalize Agent Clearance Invoice',])): ?>
                                <li><a href="<?php echo e(route('agent-clearance.index')); ?>">Agent Clearance</a></li>
                            <?php endif; ?>


                            <?php if(hasFreight('Inbound')): ?>
                                <li class="dropdown-header">FREIGHT</li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Inbound Freight Invoice', 'View Inbound Freight Invoice', 'Edit Inbound Freight Invoice', 'Delete Inbound Freight Invoice', 'Finalize Inbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('freight.index')); ?>">Billing</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Inbound Freight Invoice', 'View Inbound Freight Invoice', 'Edit Inbound Freight Invoice', 'Delete Inbound Freight Invoice', 'Finalize Inbound Freight Invoice'])): ?>
                                <li><a href="<?php echo e(route('freight.invoice')); ?>">Invoices</a></li>
                            <?php endif; ?>

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

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Non-FedEx<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Quotes</li>
                            <li><a href="<?php echo e(route('quote.index', ['type' => 1])); ?>">View Inbound</a></li>
                            <li><a href="<?php echo e(route('quote.index', ['type' => 2])); ?>">View Outbound</a></li>
                            <li><a href="<?php echo e(route('quote.create', ['type' => 1])); ?>">New Inbound Quote</a></li>
                            <li><a href="<?php echo e(route('quote.create', ['type' => 2])); ?>">New Outbound Quote</a></li>

                            <li class="dropdown-header">Clearance Invoicing</li>
                            <li><a href="<?php echo e(route('non-clearance')); ?>">Generate Invoice</a></li>
                            <li><a href="<?php echo e(route('non-invoices')); ?>">View Proforma</a></li>
                            <li><a href="<?php echo e(route('non-invoices-actual')); ?>">View Invoices</a></li>

                            <li class="dropdown-header">Inbound Freight Invoices</li>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 1])); ?>">Proforma</a></li>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 1, 'final' => 1])); ?>">Invoice</a></li>

                            <li class="dropdown-header">Outbound Freight Invoices</li>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 2])); ?>">Proforma</a></li>
                            <li><a href="<?php echo e(route('non-invoice.index', ['type' => 2, 'final' => 1])); ?>">Invoice</a></li>
                        </ul>
                    </li>
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
                                <li><a href="<?php echo e(route('rate-card.index')); ?>">Outbound Rate Card</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Edit Outbound Zones', 'View Outbound Zones'])): ?>
                                <li><a href="<?php echo e(route('outbound-zones.index')); ?>">Outbound Zones</a></li>
                            <?php endif; ?>

                            <?php if(canAny(['Create Users', 'View Users', 'Edit Users', 'Delete Users'])): ?>
                                    <li><a href="<?php echo e(route('user.index')); ?>">Users</a></li>
                            <?php endif; ?>
                            
                            <li><a href="<?php echo e(route('settings.index')); ?>">Settings</a></li>

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
