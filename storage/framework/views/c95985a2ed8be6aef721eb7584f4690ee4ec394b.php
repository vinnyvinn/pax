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
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Inbound <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">WAYBILLS</li>
                        <li><a href="<?php echo e(route('manifest.index')); ?>">Shipments</a></li>
                        <li class="dropdown-header">SCANS</li>
                        <li><a href="<?php echo e(route('manifest.scan', 'released')); ?>">Import 65</a></li>
                        <li><a href="<?php echo e(route('manifest.scan', 'dutiable')); ?>">Import 71</a></li>
                        <li><a href="<?php echo e(route('manifest.scan', 'non-dutiable')); ?>">Import 72</a></li>
                        <li><a href="<?php echo e(route('manifest.scan', 'van')); ?>">Van Scan</a></li>
                        <li><a href="<?php echo e(route('manifest.scan', 'pod')); ?>">POD Scan</a></li>
                        <li><a href="<?php echo e(route('manifest.scan', 'dex')); ?>">DEX Scan</a></li>
                        <li class="dropdown-header">CLEARANCE</li>
                        <li><a href="<?php echo e(route('clearance.index')); ?>">Generate Release Orders</a></li>
                        <li><a href="<?php echo e(route('invoice.index')); ?>">Billing</a></li>
                        <li><a href="<?php echo e(route('invoice.invoice')); ?>">Invoices</a></li>
                        <li><a href="<?php echo e(route('agent-clearance.index')); ?>">Agent Clearance</a></li>
                        <li class="dropdown-header">FREIGHT</li>
                        <li><a href="<?php echo e(route('freight.index')); ?>">Billing</a></li>
                        <li><a href="<?php echo e(route('freight.invoice')); ?>">Invoices</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Outbound <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">WAYBILLS</li>
                        <li><a href="<?php echo e(route('outbound.index')); ?>">Shipments</a></li>
                        <li class="dropdown-header">FREIGHT</li>
                        <li><a href="<?php echo e(route('outbound.freight.index')); ?>">Billing</a></li>
                        <li><a href="<?php echo e(route('outbound.freight.invoice')); ?>">Invoices</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >Domestic<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="dropdown-header">WAYBILLS</li>
                        <li><a href="<?php echo e(route('domestic.index')); ?>">Shipments</a></li>
                        <li class="dropdown-header">FREIGHT</li>
                        
                        <li><a href="<?php echo e(route('domestic-freight.index')); ?>">Billing</a></li>
                        <li><a href="<?php echo e(route('domestic-freight.show', 'invoice')); ?>">Invoices</a></li>
                    </ul>
                </li>

            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        Masters <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo e(route('area-code.index')); ?>">Area-Codes</a></li>
                        <li><a href="<?php echo e(route('route.index')); ?>">Route</a></li>
                        <li><a href="<?php echo e(route('courier.index')); ?>">Couriers</a></li>
                        <li><a href="<?php echo e(route('hscode.index')); ?>">HSCodes</a></li>
                        <li><a href="<?php echo e(route('cbv.index')); ?>">CBVs</a></li>
                        <li><a href="<?php echo e(route('domestic-locations.index')); ?>">Domestic Locations</a></li>
                        <li><a href="<?php echo e(route('domestic-rates.index')); ?>">Domestic Rates</a></li>
                    </ul>
                </li>
                <!-- Authentication Links -->
                <?php if(Auth::guest()): ?>
                    
                    
                <?php else: ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
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
