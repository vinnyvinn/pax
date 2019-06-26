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
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            @if (Auth::check())
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

                @if(hasInbound())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Inbound <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('clearance-dashboard') }}">Clearance Dashboard</a></li>
                            <li><a href="{{ route('operations-dashboard') }}">Operations Dashboard</a></li>
                            <li><a href="{{ route('finance-dashboard') }}">Finance Dashboard</a></li>
                        </ul>
                    </li>
                @endif

                @if(hasOutbound())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Outbound <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if(hasShipments('Outbound'))
                            <li class="dropdown-header">WAYBILLS</li>
                            <li><a href="{{ route('outbound.index') }}">Shipments</a></li>
                            @endif
                            @if(hasFreight('Outbound'))
                                <li class="dropdown-header">FREIGHT</li>
                            @endif
                                
                            @if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice']))
                                <li><a href="{{ route('outbound.freight.index') }}">Billing</a></li>
                            @endif
                                
                            @if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice']))
                                <li><a href="{{ route('outbound.freight.invoice') }}">Invoices</a></li>
                            @endif
                            @if(hasFreight('Outbound'))
                                <li class="dropdown-header">Additional Charges</li>
                            @endif
                            @if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice']))
                                <li><a href="{{ route('additional-charges-outbound.index') }}">Additional Charges</a></li>
                            @endif
                            @if(canAny(['Create Outbound Freight Invoice', 'View Outbound Freight Invoice', 'Edit Outbound Freight Invoice', 'Delete Outbound Freight Invoice', 'Finalize Outbound Freight Invoice']))
                                <li><a href="{{ route('additional-charges-outbound.invoices') }}">Invoices</a></li>
                            @endif

                        </ul>
                    </li>
                @endif

                @if(hasDomestic())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Domestic<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            @if(hasShipments('Domestic'))
                            <li class="dropdown-header">WAYBILLS</li>
                            <li><a href="{{ route('domestic.index') }}">Shipments</a></li>
                            @endif


                            @if(hasFreight('Domestic'))
                                <li class="dropdown-header">FREIGHT</li>
                            @endif

                            @if(canAny(['Create Domestic Freight Invoice', 'View Domestic Freight Invoice', 'Edit Domestic Freight Invoice', 'Delete Domestic Freight Invoice', 'Finalize Domestic Freight Invoice']))
                                <li><a href="{{ route('domestic-freight.index') }}">Billing</a></li>
                            @endif

                            @if(canAny(['Create Domestic Freight Invoice', 'View Domestic Freight Invoice', 'Edit Domestic Freight Invoice', 'Delete Domestic Freight Invoice', 'Finalize Domestic Freight Invoice']))
                                <li><a href="{{ route('domestic-freight.show', 'invoice') }}">Invoices</a></li>
                            @endif
                            {{--<li><a href="{{ route('domestic-freight.show', 'quote') }}">Quote</a></li>--}}
                        </ul>
                    </li>
                @endif
                    @can('view-non-fedex-portal')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Non-FedEx<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Quotes</li>
                            @can('view-inbound-non-fedex')
                            <li><a href="{{ route('quote.index', ['type' => 1]) }}">View Inbound</a></li>
                            @endcan
                            @can('view-outbound-non-fedex')
                            <li><a href="{{ route('quote.index', ['type' => 2]) }}">View Outbound</a></li>
                            @endcan
                            @can('create-inbound-qoute-non-fedex')
                            <li><a href="{{ route('quote.create', ['type' => 1]) }}">New Inbound Quote</a></li>
                            @endcan
                            @can('create-outbound-qoute-non-fedex')
                            <li><a href="{{ route('quote.create', ['type' => 2]) }}">New Outbound Quote</a></li>
                            @endcan
                            
                            <li class="dropdown-header">Clearance Invoicing</li>
                            @can('generate-invoice-clearance-non-fedex')
                            <li><a href="{{ route('non-clearance') }}">Generate Invoice</a></li>
                            @endcan
                            @can('view-proforma-clearance-non-fedex')
                            <li><a href="{{ route('non-invoices') }}">View Proforma</a></li>
                            @endcan
                            @can('view-invoices-clearance-non-fedex')
                            <li><a href="{{ route('non-invoices-actual') }}">View Invoices</a></li>
                            @endcan

                            <li class="dropdown-header">Inbound Freight Invoices</li>
                            @can('generate-proforma-inbound-freight-non-fedex')
                            <li><a href="{{ route('non-invoice.index', ['type' => 1]) }}">Proforma</a></li>
                            @endcan
                            @can('generate-invoice-inbound-freight-non-fedex')
                            <li><a href="{{ route('non-invoice.index', ['type' => 1, 'final' => 1]) }}">Invoice</a></li>
                            @endcan
                            <li class="dropdown-header">Outbound Freight Invoices</li>
                            @can('generate-proforma-outbound-freight')
                            <li><a href="{{ route('non-invoice.index', ['type' => 2]) }}">Proforma</a></li>
                            @endcan
                            @can('generate-invoice-outbound-freight')
                            <li><a href="{{ route('non-invoice.index', ['type' => 2, 'final' => 1]) }}">Invoice</a></li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    @can('view-pickups')
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
                            Dispatch<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Imports</li>
                            @can('create-pickup')
                            <li><a href="{{ route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_tnt]) }}">Import TNT</a></li>
                            <li><a href="{{ route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_fedex]) }}">Import FEDEX</a></li>
                            <li><a href="{{ route('pickups.import', ['type' => \PAX\Models\Pickup::TYPE_recurrent]) }}">Import Recurrent</a></li>
                            @endcan
                            <li class="dropdown-header">Pickup Management</li>
                            @can('view-pickups')
                            <li><a href="{{ route('pickups.index') }}">Pickups dashboard</a></li>
                            @endcan
                            @can('create-pickup')
                            <li><a href="{{ route('pickups.create') }}">Add pickup</a></li>  
                            @endcan
                        </ul>
                       </li>  
                    @endcan
                    
            </ul>
            @endif

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Masters <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @if(canAny(['Create Area Codes', 'View Area Codes', 'Edit Area Codes', 'Delete Area Codes']))
                                <li><a href="{{route('area-code.index')}}">Area-Codes</a></li>
                            @endif

                            @if(canAny(['Create CBV', 'View CBV', 'Edit CBV', 'Delete CBV']))
                                <li><a href="{{ route('cbv.index') }}">CBVs</a></li>
                            @endif

                            @if(canAny(['Create Cities', 'View Cities', 'Edit Cities', 'Delete Cities']))
                                <li><a href="{{ route('city.index') }}">Cities</a></li>
                            @endif

                            @if(canAny(['Create Couriers', 'View Couriers', 'Edit Couriers', 'Delete Couriers']))
                                <li><a href="{{ route('courier.index') }}">Couriers</a></li>
                            @endif

                            @if(canAny(['Create Domestic Locations', 'View Domestic Locations', 'Edit Domestic Locations', 'Delete Domestic Locations']))
                                <li><a href="{{ route('domestic-locations.index') }}">Domestic Locations</a></li>
                            @endif

                            @if(canAny(['Edit Domestic Rates']))
                                <li><a href="{{ route('domestic-rates.index') }}">Domestic Rates</a></li>
                            @endif

                            @if(canAny(['Create Routes', 'View Routes', 'Edit Routes', 'Delete Routes']))
                                <li><a href="{{route('route.index')}}">Route</a></li>
                            @endif

                            @if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card']))
                                <li><a href="{{route('sales-rate-card.index')}}">Outbound Rate Card</a></li>
                                <li><a href="{{route('discount-rate-card.index')}}">Discount Rate Card</a></li>
                            @endif
                            @if(canAny(['Edit Outbound Rate Card', 'View Outbound Rate Card']))
                                <li><a href="{{ route('gdr.index') }}">GDR rates</a></li>
                            @endif
                            @if(canAny(['Edit Outbound Zones', 'View Outbound Zones']))
                                <li><a href="{{route('outbound-zones.index')}}">Outbound Zones</a></li>
                            @endif

                            @if(canAny(['Create Users', 'View Users', 'Edit Users', 'Delete Users']))
                                    <li><a href="{{ route('user.index') }}">Users</a></li>
                            @endif
                            @can('view-settings')
                            <li><a href="{{ route('other-charges.index') }}">Other charges</a></li>
                                <li><a href="{{ route('settings.index') }}">Settings</a></li>
                            @endcan
                            <li><a href="{{ route('clients.index') }}">Clients</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('change-password') }}">Change Password</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
                
            </ul>
        </div>
    </div>
</nav>
