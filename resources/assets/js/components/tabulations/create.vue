<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Invoice</div>

                    <div class="panel-body">

                        <form :action="'/invoice' + (isEdit ? '/' + id : '')" method="post" role="form">
                            <input type="hidden" name="_token" :value="$root.csrf">
                            <input v-if="isEdit" type="hidden" name="_method" value="PUT">

                            <div class="row">
                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label for="client_id">Client</label>
                                        <h4 v-if="isEdit">{{ response.client.Account }} - {{ response.client.Name }}</h4>
                                        <select v-else required v-model="tabulation.client_id" class="form-control manual" name="client_id" id="client_id">
                                            <option selected disabled>Select Client</option>
                                            <option v-for="client in clients" :value="client.DCLink" :key="client.id">{{ client.Name }}({{ client.Account }})</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="client_email">Client Email</label>
                                        <input type="text" v-model="tabulation.client_email" :value="clientEmail" name="client_email" class="form-control" id="client_email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="waybill_id">Waybill</label>
                                        <h4 v-if="isEdit">{{ response.waybill.waybill_number }} (Duty {{ response.waybill.bill_duty }}, Bill To {{ response.waybill.bill_to }})</h4>

                                        <select v-else required v-model="tabulation.waybill_id" class="form-control manual" name="waybill_id" id="waybill_id">
                                            <option selected disabled>Select Waybill</option>
                                            <option v-for="waybill in waybills" :value="waybill.id" :key="waybill.id">
                                                {{ waybill.waybill_number }} (Duty {{ waybill.bill_duty }}, Bill To {{ waybill.bill_to }})
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fob">F.O.B.</label>
                                        <input v-model="tabulation.fob" type="text" required class="form-control" name="fob" id="fob">
                                    </div>

                                    <div class="form-group">
                                        <label for="conversion_rate">Conversion Rate</label>
                                        <input v-model="tabulation.conversion_rate" type="text" required class="form-control" name="conversion_rate" id="conversion_rate">
                                    </div>

                                    <div class="form-group">
                                        <label for="excise_duty">Excise Duty</label>
                                        <input v-model="tabulation.excise_duty" type="text" required class="form-control" name="excise_duty" id="excise_duty">
                                    </div>

                                    <div class="form-group">
                                        <label for="insurance_rate">Insurance Rate</label>
                                        <input v-model="tabulation.insurance_rate" type="text" required class="form-control" name="insurance_rate" id="insurance_rate">
                                    </div>

                                    <div class="form-group">
                                        <label for="freight">Freight</label>
                                        <input v-model="tabulation.freight" type="text" required class="form-control" name="freight" id="freight">
                                    </div>

                                    <div class="form-group">
                                        <label for="other_charges">Other Charges</label>
                                        <input v-model="tabulation.other_charges" type="text" required class="form-control" name="other_charges" id="other_charges">
                                    </div>
                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label for="duty_rate">Import Duty Rate</label>
                                        <input v-model="tabulation.duty_rate" type="text" required class="form-control" name="duty_rate" id="duty_rate">
                                    </div>

                                    <div class="form-group">
                                        <label for="vat_rate">VAT Rate</label>
                                        <input v-model="tabulation.vat_rate" readonly type="text" required class="form-control" name="vat_rate" id="vat_rate">
                                    </div>

                                    <div class="form-group">
                                        <label for="idf">IDF</label>
                                        <input v-model="tabulation.idf" readonly type="text" required class="form-control" name="idf" id="idf">
                                    </div>

                                    <div class="form-group">
                                        <label for="rdl">RDL</label>
                                        <input v-model="tabulation.rdl" readonly type="text" required class="form-control" name="rdl" id="rdl">
                                    </div>

                                    <div class="form-group">
                                        <label for="kaa">KAA</label>
                                        <input v-model="tabulation.kaa" readonly type="text" required class="form-control" name="kaa" id="kaa">
                                    </div>

                                    <div class="form-group">
                                        <label for="kebs">KEBS</label>
                                        <input v-model="tabulation.kebs" type="text" required class="form-control" name="kebs" id="kebs">
                                    </div>

                                    <div class="form-group">
                                        <label for="gok">GOK</label>
                                        <input v-model="tabulation.gok" type="text" required class="form-control" name="gok" id="gok">
                                    </div>

                                    <div class="form-group">
                                        <label for="email_cc">CC Email</label>
                                        <input type="text" name="email_cc" class="form-control" id="email_cc">
                                        <small class="help-text">For more than one email add comma ( , )</small>
                                    </div>
                                </div>

                                <div class="col-sm-4">

                                    <div class="form-group">
                                        <label for="agency_fees">Agency Fees</label>
                                        <input v-model="tabulation.agency_fees" type="text" required class="form-control" name="agency_fees" id="agency_fees">
                                    </div>


                                    <div class="form-group">
                                        <h5 class="pull-left">Local Amount</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ localAmount.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>
                                    
                                    <div class="form-group">
                                        <h5 class="pull-left">Excise duty</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ insuranceAmount.toLocaleString('en-GB') }}</strong></h5>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">
                                        <h5 class="pull-left">Insurance Amount</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ exciseDuty.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">Customs Value</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ cif.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">Import Duty</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ dutyAmount.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h5 class="pull-left">VAT</h5>
                                        <h5 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ vat.toLocaleString('en-GB') }}</strong></h5>
                                    </div>

                                    <div class="clearfix"></div>

                                    <hr>
                                    <div class="form-group">
                                        <h4 class="pull-left">Sub Total</h4>
                                        <h4 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ invoiceTotal.toLocaleString('en-GB') }}</strong></h4>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h4 class="pull-left">VAT</h4>
                                        <h4 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ agentVat.toLocaleString('en-GB') }}</strong></h4>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="form-group">
                                        <h4 class="pull-left">Invoice Total</h4>
                                        <h4 class="pull-right text-right"><strong>{{ settings['Current Currency']['current_value'] }} {{ (invoiceTotal + agentVat).toLocaleString('en-GB') }}</strong></h4>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="finalize" v-model="finalize">

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Process</button>
                                <button v-if="isEdit" class="btn btn-success" type="submit" @click="finalize = true">Finalize Invoice</button>
                                <a href="/invoice" class="btn btn-danger">Back</a>
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
            }
        },
        data() {
            return {
                finalize: false,
                isEdit: false,
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
                        current_value: 'KES'
                    }
                },
                response: {
                    client: {Account: '', Name: ''},
                    waybill: {waybill_number: '', bill_duty: '', bill_to: ''}
                },
                tabulation: {
                    waybill_id: null,
                    client_id: null,
                    fob: 0,
                    conversion_rate: 0,
                    freight: 0,
                    other_charges: 0,
                    excise_duty: 0,
                    insurance_rate: 0,
                    duty_rate: 0,
                    vat_rate: 0,
                    idf: 0,
                    rdl: 0,
                    kaa: 0,
                    kebs: 0,
                    gok: 0,
                    agency_fees: 0,
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
            this.getSettings();
        },

        computed: {
            localAmount() {
                let conversion = parseFloat(this.tabulation.conversion_rate);
                let fob = parseFloat(this.tabulation.fob);

                if (isNaN(conversion) || isNaN(fob)) {
                    return 0;
                }

                return conversion * fob;
            },

            insuranceAmount() {
                let conversion = parseFloat(this.tabulation.insurance_rate);
                let fob = parseFloat(this.localAmount);

                if (isNaN(conversion) || isNaN(fob)) {
                    return 0;
                }

                return fob * (conversion / 100);
            },

            cif() {
                let freight = isNaN(parseFloat(this.tabulation.freight)) ? 0 : parseFloat(this.tabulation.freight);
                let other_charges = isNaN(parseFloat(this.tabulation.other_charges)) ? 0 : parseFloat(this.tabulation.other_charges);

                return this.localAmount + this.insuranceAmount + freight + other_charges;
            },

            dutyAmount() {
                let duty = isNaN(parseFloat(this.tabulation.duty_rate)) ? 0 : parseFloat(this.tabulation.duty_rate);

                return (duty * this.cif)/100;
            },
            exciseDuty() {
                let eDuty = isNaN(parseFloat(this.tabulation.duty_rate)) ? 0 : parseFloat(this.tabulation.duty_rate);
                
                return (eDuty * this.cif)/100;
            },
            vat() {
                let vatRate = isNaN(parseFloat(this.tabulation.vat_rate)) ? 0 : parseFloat(this.tabulation.vat_rate);

                return (vatRate/100) * (this.dutyAmount + this.cif);
            },

            agentVat() {
                let vatRate = isNaN(parseFloat(this.tabulation.vat_rate)) ? 0 : parseFloat(this.tabulation.vat_rate);

                return (vatRate/100) * (isNaN(parseFloat(this.tabulation.agency_fees)) ? 0 : parseFloat(this.tabulation.agency_fees));
            },

            invoiceTotal() {
                let addons = (isNaN(parseFloat(this.tabulation.idf)) ? 0 : parseFloat(this.tabulation.idf)) +
                    (isNaN(parseFloat(this.tabulation.agency_fees)) ? 0 : parseFloat(this.tabulation.agency_fees)) +
                    (isNaN(parseFloat(this.tabulation.rdl)) ? 0 : parseFloat(this.tabulation.rdl)) +
                    (isNaN(parseFloat(this.tabulation.kaa)) ? 0 : parseFloat(this.tabulation.kaa)) +
                    (isNaN(parseFloat(this.tabulation.kebs)) ? 0 : parseFloat(this.tabulation.kebs)) +
                    (isNaN(parseFloat(this.tabulation.gok)) ? 0 : parseFloat(this.tabulation.gok)) +
                    (isNaN(parseFloat(this.tabulation.excise_duty)) ? 0 : parseFloat(this.tabulation.excise_duty));

                return this.dutyAmount + this.vat + addons;
            },
            clientEmail() {
                if(!this.tabulation.client_email) {
                    let clients = this.clients.filter(client => {
                        if(client.DCLink == this.tabulation.client_id) {
                            return client;
                        }
                    });
                    return clients.length ? clients[0].Email : '';
                }
                 return this.tabulation.client_email;
            }
        },

        methods: {
            getEditDetails() {
                this.$root.isLoading = true;
                axios.get('/invoice/' + this.id +'/edit?fill=t').then((response) => {
                    this.waybills = response.data.waybills;
                    this.response = response.data.invoice;
                    this.clients = response.data.clients;
                    this.settings = response.data.settings;
                    this.tabulation = response.data.invoice.proforma_data;
                    this.tabulation.insurance_rate = this.settings['Current Insurance Rate']['current_value'];
                    this.tabulation.vat_rate = this.settings['Current VAT Rate']['current_value'];
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


            getDetails() {
                this.$root.isLoading = true;
                axios.get('/invoice/create?fill=t').then((response) => {
                    this.waybills = response.data.waybills;
                    this.clients = response.data.clients;
                    this.settings = response.data.settings;
                    this.tabulation.insurance_rate = this.settings['Current Insurance Rate']['current_value'];
                    this.tabulation.vat_rate = this.settings['Current VAT Rate']['current_value'];
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
            getSettings() {
                this.$root.isLoading = true
                axios.get('/settings').then(response => {
                    response.data.data.forEach(element => {
                        if(element.key == 'VAT') {
                            this.tabulation.vat_rate = element.current_value
                        }
                        if(element.key == 'IDF') {
                            this.tabulation.idf = element.current_value
                        }
                        if(element.key == 'RDL') {
                            this.tabulation.rdl = element.current_value
                        }
                        if(element.key == 'KAA') {
                            this.tabulation.kaa = element.current_value
                        }
                    });
                })
            }
        }
    }
</script>
