<template>
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-body">
            <v-select :options="couriers" v-model="courier"></v-select>
        </div>
        <div class="panel-footer clearfix">
          <div class="col-md-12">
            <button type="button" class="btn btn-sm btn-primary pull-right" @click.prevent="assignCourier">
              <i :class="!loading ? 'fa fa-save' : 'fa fa-cog fa-spin'"></i> Assign
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import vSelect from 'vue-select'
export default {
    data () {
      return {
          couriers: [],
          courier: {},
          loading: false
      }
    },
    created () {
      this.getCouriers()
    },
    props: ['id'],
    computed: {
      assignment () {
        return {
          id: this.id,
          courier_id: this.courier.id,
          loading: false
        }
      }
    },
    methods: {
        getCouriers () {
            this.$root.loading = true
            axios.get('/courier?view=ajax').then(response => {
                this.$root.loading = false
                this.couriers = response.data.data.forEach(c => {
                    c.label = `${c.name} - route: ${c.route.name}-${c.route.area_code.code}`
                })
                this.couriers = response.data.data
            }).catch(response => {
                this.$root.loading = false
            })
        },
        assignCourier () {
            if(this.validator()) return;
            this.loading = true;
            axios.put('/dispatch/pickups-assign-courier', this.assignment)
            .then(response => {
                toastr.success(response.data.message);
                this.loading = false;
                setTimeout(() => {
                    window.location.reload(true);
                }, 250);
            }).catch(response => {
                this.loading = false;
                toastr.error(response.data.message);
            });
        },
        validator () {
            let error = false;
            if(!this.assignment.id) {
                error = true;
                toastr.error('Invalid pickup, refresh the page and try again');
            }
            if(!this.courier || !this.assignment.courier_id) {
                error = true;
                toastr.error('courier is required.');
            }

            return error;
        }
    },
    components: { 'v-select': vSelect}
}
</script>