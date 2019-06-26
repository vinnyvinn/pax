<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New Import Quote</div>

                    <div class="panel-body">
                        <form :action="'/quote' + (isEdit ? '/' + id : '')" method="post" role="form">
                            <input type="hidden" name="_token" :value="$root.csrf">
                            <input v-if="isEdit" type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="weight">Weight e.g. 10K or 10L</label>
                                        <input type="text" class="form-control" id="weight" name="weight" v-model="freight.weight" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="origin">Origin</label>
                                        <input type="text" class="form-control" id="origin" name="origin" v-model="freight.origin" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="destination">Destination</label>
                                        <input type="text" class="form-control" id="destination" name="destination" v-model="freight.destination" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="export_city">Export Country</label>
                                        <select name="export_city" id="export_city" class="form-control" v-model="freight.export_city">
                                            <option v-for="(code, country) in countries" :key="code" :value="code">{{ country }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="package_type">Packaging</label>
                                        <select class="form-control" id="package_type" name="package_type" v-model="freight.package_type" required>
                                            <option value="1">Other</option>
                                            <option value="2">FedEx PAK</option>
                                            <option value="6">FedEx Envelope</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="currency">Billing Currency</label>
                                        <select class="form-control" id="currency" name="currency" v-model="freight.currency" required>
                                            <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="total">Total Items</label>
                                        <input type="number" class="form-control" id="total" name="total" v-model="freight.total" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" v-model="freight.description" required></textarea>
                                    </div>

                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="con_name">Consignee Name</label>
                                        <input type="text" class="form-control" id="con_name" name="con_name" v-model="freight.con_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="con_company">Consignee Company</label>
                                        <input type="text" class="form-control" id="con_company" name="con_company" v-model="freight.con_company">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_phone">Consignee Phone</label>
                                        <input type="text" class="form-control" id="con_phone" name="con_phone" v-model="freight.con_phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_address">Consignee Address</label>
                                        <input type="text" class="form-control" id="con_address" name="con_address" v-model="freight.con_address">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_address_alternate">Consignee Alternate Address</label>
                                        <input type="text" class="form-control" id="con_address_alternate" name="con_address_alternate" v-model="freight.con_address_alternate">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_city">Consignee City</label>
                                        <input type="text" class="form-control" id="con_city" name="con_city" v-model="freight.con_city">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_state">Consignee State</label>
                                        <input type="text" class="form-control" id="con_state" name="con_state" v-model="freight.con_state">
                                    </div>

                                    <div class="form-group">
                                        <label for="con_city">Consignee Country</label>
                                        <select @change="setTransport" name="con_country" id="con_country" class="form-control" v-model="freight.con_country">
                                            <option v-for="(code, country) in countries" :key="code" :value="code">{{ country }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="con_postal">Consignee Postal</label>
                                        <input type="text" class="form-control" id="con_postal" name="con_postal" v-model="freight.con_postal">
                                    </div>

                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="shipper_name">Shipper Name</label>
                                        <input type="text" class="form-control" id="shipper_name" name="shipper_name" v-model="freight.shipper_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_company">Shipper Company</label>
                                        <input type="text" class="form-control" id="shipper_company" name="shipper_company" v-model="freight.shipper_company">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_phone">Shipper Phone</label>
                                        <input type="text" class="form-control" id="shipper_phone" name="shipper_phone" v-model="freight.shipper_phone">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_address">Shipper Address</label>
                                        <input type="text" class="form-control" id="shipper_address" name="shipper_address" v-model="freight.shipper_address">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_address_alternate">Shipper Alternate Address</label>
                                        <input type="text" class="form-control" id="shipper_address_alternate" name="shipper_address_alternate" v-model="freight.shipper_address_alternate">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_city">Shipper City</label>
                                        <input type="text" class="form-control" id="shipper_city" name="shipper_city" v-model="freight.shipper_city">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_state">Shipper State</label>
                                        <input type="text" class="form-control" id="shipper_state" name="shipper_state" v-model="freight.shipper_state">
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_city">Shipper Country</label>
                                        <select name="shipper_country" id="shipper_country" class="form-control" v-model="freight.shipper_country">
                                            <option v-for="(code, country) in countries" :key="code" :value="code">{{ country }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="shipper_postal">Shipper Postal</label>
                                        <input type="text" class="form-control" id="shipper_postal" name="shipper_postal" v-model="freight.shipper_postal">
                                    </div>

                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="client_id">Client</label>
                                        <h4 v-if="isEdit">{{ response.client.Account }} - {{ response.client.Name }}</h4>
                                        <select v-else required v-model="freight.client_id" class="form-control manual" name="client_id" id="client_id">
                                            <option :value="null" disabled>Select Client</option>
                                            <option v-if="client.DCLink" v-for="client in clients" :value="client.DCLink">{{ client.Name }}({{ client.Account }})</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="declared_value">Declared Value</label>
                                        <input v-model="freight.declared_value" type="text" required class="form-control" name="declared_value" id="declared_value">
                                    </div>

                                    <div class="form-group">
                                        <label for="transport">Transport</label>
                                        <input v-model="freight.transport" type="text" required class="form-control" name="transport" id="transport">
                                    </div>

                                    <div class="form-group">
                                        <label for="discount">Discount</label>
                                        <input v-model="freight.discount" type="text" required class="form-control" name="discount" id="discount">
                                    </div>

                                    <div class="form-group">
                                        <label for="insurance_rate">Insurance Rate</label>
                                        <input v-model="freight.insurance_rate" type="text" required class="form-control" name="insurance_rate" id="insurance_rate">
                                    </div>

                                    <div class="form-group">
                                        <label for="fuel_levy">Fuel Levy Rate</label>
                                        <input v-model="freight.fuel_levy" type="text" required class="form-control" name="fuel_levy" id="fuel_levy">
                                    </div>

                                    <div class="form-group">
                                        <label for="vat_rate">VAT Rate</label>
                                        <input v-model="freight.vat_rate" type="text" required class="form-control" name="vat_rate" id="vat_rate">
                                    </div>

                                    <div class="form-group">
                                        <h5 class="pull-left">Discount</h5>
                                        <h5 class="pull-right text-right">
                                            <strong>{{ totalDiscount.toLocaleString('en-GB') }}</strong>
                                        </h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">Fuel Levy</h5>
                                        <h5 class="pull-right text-right">
                                            <strong>{{ fuelLevy.toLocaleString('en-GB') }}</strong>
                                        </h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">Insurance</h5>
                                        <h5 class="pull-right text-right">
                                            <strong>{{ insurance.toLocaleString('en-GB') }}</strong>
                                        </h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">VAT</h5>
                                        <h5 class="pull-right text-right">
                                            <strong>{{ vat.toLocaleString('en-GB') }}</strong>
                                        </h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <hr>
                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h4 class="pull-left">Invoice Total</h4>
                                        <h4 class="pull-right text-right">
                                            <strong>{{ invoiceTotal.toLocaleString('en-GB') }}</strong>
                                        </h4>
                                    </div>

                                    <input type="hidden" name="finalize" v-model="finalize">

                                    <input type="hidden" name="category" value="Outbound">

                                </div>
                            </div>

                            <hr>
                            <br>

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-6">
                                    <div class="form-group pull-right">
                                        <button class="btn btn-primary" type="submit">{{ isEdit ? 'Save changes' : 'Generate Quote' }}</button>
                                        <a v-if="isEdit && canf" class="btn btn-success" :href="'/non-invoice/create?from=' + id">Generate Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: Number,
                default: null
            },
            canf: {
                type: Boolean,
                default: false
            },
        },
        data() {
            return {
                finalize: false,
                isEdit: false,
                zones: [],
                rates: [],
                response: {
                    client: { Account: '', Name: '' },
                    waybill: { waybill_number: '', bill_duty: '', bill_to: '' }
                },
                clients: [],
                countries: [],
                currencies: [],
                settings: {
                    'Current VAT Rate': {
                        current_value: 16
                    },
                    'Current Insurance Rate': {
                        current_value: 1.5
                    },
                    'Current Currency': {
                        current_value: ''
                    },
                    'Current Levy Rate': {
                        current_value: 7.5
                    }
                },
                freight: {
                    weight: null,
                    origin: null,
                    destination: null,
                    export_city: null,
                    description: '',
                    total: null,
                    con_name: null,
                    con_company: null,
                    con_phone: null,
                    con_address: null,
                    con_address_alternate: null,
                    con_city: null,
                    con_state: null,
                    con_country: null,
                    con_postal: null,

                    shipper_name: null,
                    shipper_company: null,
                    shipper_phone: null,
                    shipper_address: null,
                    shipper_address_alternate: null,
                    shipper_city: null,
                    shipper_state: null,
                    shipper_country: null,
                    shipper_postal: null,
                    package_type: null,
                    currency: null,

                    client_id: null,
                    declared_value: 0,
                    transaport: 0,
                    discount: 0,
                    fuel_levy: 0,
                    vat_rate: 16,
                    insurance_rate: 0,
                }
            };
        },

        created() {
            if (this.id) {
                this.isEdit = true;
                this.getEditDetails();
                return;
            }
            this.getDetails();
        },

        computed: {
            totalDiscount() {
                let discount = isNaN(parseFloat(this.freight.discount)) ? 0 : parseFloat(this.freight.discount);
                let freight = isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport);

                discount = discount == 0 ? 0 : freight * (discount / 100);

                return discount;
            },

            fuelLevy() {
                let rate = parseFloat(this.freight.fuel_levy);
                let freight = parseFloat(this.freight.transport);


                if (isNaN(freight) || isNaN(rate)) {
                    return 0;
                }

                return (rate * (freight - this.totalDiscount)) / 100;
            },

            insurance() {
                let conversion = parseFloat(this.freight.insurance_rate);
                let freight = parseFloat(this.freight.declared_value);

                if (isNaN(conversion) || isNaN(freight)) {
                    return 0;
                }

                return freight * (conversion / 100);
            },

            vat() {
                let vatRate = isNaN(parseFloat(this.freight.vat_rate)) ? 0 : parseFloat(this.freight.vat_rate);
                let freight = isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport);

                return (vatRate / 100) * ((freight - this.totalDiscount) + this.fuelLevy + this.insurance);
            },

            invoiceTotal() {
                let freight = (isNaN(parseFloat(this.freight.transport)) ? 0 : parseFloat(this.freight.transport));

                return this.insurance + this.vat + (freight - this.totalDiscount) + this.fuelLevy;
            },
        },

        methods: {
            formatDate(date) {
                if (!date) return '';

                return (new Date(date)).toDateString();
            },

            getPackage(type) {
                switch (type) {
                    default:
                    case 1:
                    case 3:
                    case 4:
                    case 5:
                        return 'FEDEX OTHER';
                    case 2:
                        return 'FEDEX PAK';
                    case 6:
                        return 'FEDEX ENVELOPE';
                }
            },

            getRawPackage(type) {
                switch (type) {
                    default:
                    case 1:
                    case 3:
                    case 4:
                    case 5:
                        return 'oth';
                    case 2:
                        return 'pak';
                    case 6:
                        return 'env';
                }
            },

            setTransport() {
                let country = this.freight.con_country;
                if (!country) {
                    this.freight.transport = 0;
                    return;
                }

                let zone = this.zones.filter(item => item.code == country);

                if (!zone.length) {
                    this.freight.transport = 0;
                    return;
                }
                let key = 'zone_' + zone[0].zone.toLowerCase();
                let packaging = this.getRawPackage(this.freight.package_type);
                let weight = parseFloat(this.freight.weight);
                if (this.freight.weight.toLowerCase().indexOf('l') !== -1) {
                    weight = weight / 2.2046226218;
                }

                if (weight < 0.25) {
                    if (packaging == 'env') {
                        weight = 0.25;
                    } else {
                        weight = 0.5;
                    }
                }
                if (weight > 0.25) weight = weight - parseInt(weight) < 0.5 ? parseInt(weight) + 0.5 : parseInt(weight) + 1;
                if (weight > 71) weight = 71;

                let rate = this.rates.filter(item => item.packaging_type == packaging && item.weight == weight);

                if (!rate.length) {
                    this.freight.transport = 0;
                    return;
                }

                rate = rate[0];

                this.freight.transport = parseFloat(rate[key]).toFixed(2);
            },


            getDetails() {
                this.$root.isLoading = true;
                axios.get('/quote/create?fill-out=t').then((response) => {
                    this.clients = response.data.clients;
                    this.settings = response.data.settings;
                    this.rates = response.data.rates;
                    this.zones = response.data.zones;
                    this.countries = response.data.countries;
                    this.currencies = response.data.currencies;
                    this.freight.insurance_rate = this.settings['Current Insurance Rate']['current_value'];
                    this.freight.vat_rate = this.settings['Current VAT Rate']['current_value'];
                    this.freight.fuel_levy = this.settings['Current Levy Rate']['current_value'];
                    setTimeout(() => {
                        $('select.manual').selectpicker({
                            size: 'auto',
                            liveSearch: true,
                            liveSearchPlaceholder: 'Search...',
                        }).selectpicker('deselectAll');

                        $('input').on('focus', function() {
                            this.select();
                        });
                    }, 200);

                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },

            getEditDetails() {
                this.$root.isLoading = true;
                axios.get('/quote/' + this.id + '/edit?fill-out=t').then((response) => {
                    this.countries = response.data.countries;
                    this.currencies = response.data.currencies;
                    this.response = response.data.quote;
                    this.freight = response.data.quote.proforma_data;
                    this.settings = response.data.settings;
                    this.freight.insurance_rate = this.settings['Current Insurance Rate']['current_value'];
                    this.freight.vat_rate = this.settings['Current VAT Rate']['current_value'];
                    this.freight.fuel_levy = this.settings['Current Levy Rate']['current_value'];

                    setTimeout(() => {
                        $('select.manual').selectpicker({
                            size: 'auto',
                            liveSearch: true,
                            liveSearchPlaceholder: 'Search...',
                        });

                        $('input').on('focus', function() {
                            this.select();
                        });
                    }, 200);
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            }
        }
    }
</script>
