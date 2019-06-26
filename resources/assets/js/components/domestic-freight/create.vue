<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Freight Invoice</div>

                    <div class="panel-body">
                        <form :action="'/domestic-freight' + (isEdit ? '/' + id : '')" method="post" role="form">
                            <input type="hidden" name="_token" :value="$root.csrf">
                            <input v-if="isEdit" type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <label for="client_id">Client</label>
                                        <h4 v-if="isEdit">{{ response.client.Account }} - {{ response.client.Name }}</h4>
                                        <select v-else required v-model="freight.client_id" class="form-control manual" name="client_id" id="client_id">
                                            <option v-for="client in clients" :value="client.DCLink">{{ client.Name }}({{ client.Account }})</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="waybill_id">Waybill</label>
                                        <h4 v-if="isEdit">{{ response.waybill.waybill_number }}</h4>

                                        <select v-else required v-model="freight.waybill_id" class="form-control manual" name="waybill_id" id="waybill_id">
                                            <option v-for="waybill in waybills" :value="waybill.id">
                                                {{ waybill.waybill_number }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="freight">Transport Charge</label>
                                        <input v-model="freight.freight" type="text" required class="form-control" name="freight" id="freight">
                                    </div>

                                    <!--<div class="form-group">-->
                                        <!--<label for="fuel_levy">Fuel Levy Rate</label>-->
                                        <!--<input v-model="freight.fuel_levy" type="text" required class="form-control" name="fuel_levy" id="fuel_levy">-->
                                    <!--</div>-->

                                    <!--<div class="form-group">-->
                                        <!--<label for="cck_levy">CCK Levy</label>-->
                                        <!--<input v-model="freight.cck_levy" type="text" required class="form-control" name="cck_levy" id="cck_levy">-->
                                    <!--</div>-->

                                    <!--<div class="form-group">-->
                                        <!--<label for="insurance_rate">Insurance Rate</label>-->
                                        <!--<input v-model="freight.insurance_rate" type="text" required class="form-control" name="insurance_rate" id="insurance_rate">-->
                                    <!--</div>-->

                                    <div class="form-group">
                                        <label for="vat_rate">VAT Rate</label>
                                        <input v-model="freight.vat_rate" type="number" step="0.01" required class="form-control" name="vat_rate" id="vat_rate">
                                    </div>

                                </div>

                                <div class="col-sm-6">

                                    <div class="form-group">
                                        <h5 class="pull-left">Subtotal before VAT</h5>
                                        <h4 class="pull-right text-right"><strong>{{ parseFloat(freight.freight).toLocaleString('en-GB') }}</strong></h4>
                                    </div>

                                    <div class="clearfix"></div>


                                    <!--<div class="form-group">-->
                                        <!--<h5 class="pull-left">Fuel Levy</h5>-->
                                        <!--<h5 class="pull-right text-right"><strong>{{ fuelLevy.toLocaleString('en-GB') }}</strong></h5>-->
                                    <!--</div>-->

                                    <!--<div class="clearfix"></div>-->

                                    <!--<div class="form-group">-->
                                        <!--<h5 class="pull-left">Subtotal after Fuel Levy</h5>-->
                                        <!--<h5 class="pull-right text-right"><strong>{{ (parseFloat(freight.freight) + fuelLevy).toLocaleString('en-GB') }}</strong></h5>-->
                                    <!--</div>-->

                                    <!--<div class="clearfix"></div>-->

                                    <!--<div class="form-group">-->
                                        <!--<h5 class="pull-left">Insurance</h5>-->
                                        <!--<h5 class="pull-right text-right"><strong>{{ insurance.toLocaleString('en-GB') }}</strong></h5>-->
                                    <!--</div>-->

                                    <!--<div class="clearfix"></div>-->

                                    <!--<div class="form-group">-->
                                        <!--<h5 class="pull-left">CCK Levy</h5>-->
                                        <!--<h5 class="pull-right text-right"><strong>{{ freight.cck_levy.toLocaleString('en-GB') }}</strong></h5>-->
                                    <!--</div>-->

                                    <!--<div class="clearfix"></div>-->

                                    <div class="form-group">
                                        <h5 class="pull-left">VAT</h5>
                                        <h5 class="pull-right text-right"><strong>{{ vat.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <hr>
                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h4 class="pull-left">Invoice Total</h4>
                                        <h4 class="pull-right text-right"><strong>{{ invoiceTotal.toLocaleString('en-GB') }}</strong></h4>
                                    </div>

                                    <input type="hidden" name="finalize" v-model="finalize">
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                <button v-if="isEdit && canf" class="btn btn-success" type="submit" @click="finalize = true">Finalize Invoice</button>
                                <a href="/domestic-freight" class="btn btn-danger">Back</a>
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
            }
        },
        data() {
            return {
                finalize: false,
                isEdit: false,
                response: {
                    client: {Account: '', Name: ''},
                    waybill: {waybill_number: '', bill_duty: '', bill_to: ''}
                },
                waybills: [],
                clients: [],
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
                    waybill_id: null,
                    client_id: null,
                    freight: 0,
                    fuel_levy: 0,
                    cck_levy: 0,
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
            fuelLevy() {
                let rate = parseFloat(this.freight.fuel_levy);
                let freight = parseFloat(this.freight.freight);

                if (isNaN(freight) || isNaN(rate)) {
                    return 0;
                }

                return (rate * freight)/100;
            },

            insurance() {
                let conversion = parseFloat(this.freight.insurance_rate);
                let freight = parseFloat(this.freight.freight);

                if (isNaN(conversion) || isNaN(freight)) {
                    return 0;
                }

                return freight * (conversion / 100);
            },

            vat() {
                let vatRate = isNaN(parseFloat(this.freight.vat_rate)) ? 0 : parseFloat(this.freight.vat_rate);
                let freight = isNaN(parseFloat(this.freight.freight)) ? 0 : parseFloat(this.freight.freight);


                return (vatRate/100) * (freight + this.fuelLevy);
            },

            invoiceTotal() {
                let freight = (isNaN(parseFloat(this.freight.freight)) ? 0 : parseFloat(this.freight.freight));
                let cck = (isNaN(parseFloat(this.freight.cck_levy)) ? 0 : parseFloat(this.freight.cck_levy));

                return this.insurance + this.vat + freight + this.fuelLevy + cck;
            }
        },

        methods: {
            getDetails() {
                this.$root.isLoading = true;
                axios.get('/domestic-freight/create?fill=t').then((response) => {
                    this.waybills = response.data.waybills;
                    this.clients = response.data.clients;
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

                        $('input').on('focus', function () {
                            this.select();
                        });
                    }, 200);
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            },

            getEditDetails() {
                this.$root.isLoading = true;
                axios.get('/domestic-freight/' + this.id +'/edit?fill=t').then((response) => {
                    this.response = response.data.invoice;
                    this.freight = response.data.invoice.proforma_data;
                    this.settings = response.data.settings;

                    setTimeout(() => {
                        $('select.manual').selectpicker({
                            size: 'auto',
                            liveSearch: true,
                            liveSearchPlaceholder: 'Search...',
                        });

                        $('input').on('focus', function () {
                            this.select();
                        });
                    }, 200);
                    this.$root.isLoading = false;
                }).catch(() => this.$root.isLoading = false);
            }
        }
    }
</script>
