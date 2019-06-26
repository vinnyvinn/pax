<template>
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <label class="checkbox-inline">
                 <input type="checkbox" :value="1" v-model="recurrent.days['sun']">Sun
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="2" v-model="recurrent.days['mon']">Mon
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="3" v-model="recurrent.days['tue']">Tue
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="4" v-model="recurrent.days['wed']">Wed
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="5" v-model="recurrent.days['thur']">Thur
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="6" v-model="recurrent.days['fri']">Fri
              </label>
              <label class="checkbox-inline">
                  <input type="checkbox" :value="7" v-model="recurrent.days['sat']">Sat
              </label>
            </div>
            <div class="col-md-12"><br>
              <div class="form-group">
                <label for="ready_time">Ready time</label>
                <input type="time" id="ready_time" class="form-control" v-model="recurrent.ready_time">
              </div>
            </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <div class="col-md-12">
            <button type="button" class="btn btn-sm btn-primary pull-right" @click.prevent="setRecurrentDays">
              <i :class="!loading ? 'fa fa-save' : 'fa fa-cog fa-spin'"></i> Set Days
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data () {
      return {
          recurrent: {
            days: {
              'sun': false,
              'mon': false,
              'tue': false,
              'wed': false,
              'thur': false,
              'fri': false,
              'sat': false
            },
            ready_time: null
          },
          loading: false
      }
    },
    props: ['pickup'],
    created() {
      if(this.pickup.days) {
        this.recurrent.days.sun = Number(this.pickup.days.sun);
        this.recurrent.days.mon = Number(this.pickup.days.mon);
        this.recurrent.days.tue = Number(this.pickup.days.tue);
        this.recurrent.days.wed = Number(this.pickup.days.wed);
        this.recurrent.days.thur = Number(this.pickup.days.thur);
        this.recurrent.days.fri = Number(this.pickup.days.fri);
        this.recurrent.days.sat = Number(this.pickup.days.sat);
      }
      this.recurrent.ready_time = this.pickup.ready_time
    },
    methods: {
      setRecurrentDays() {
        if(!this.pickup.ready_time) return
        this.loading = true;
        axios.put(`/dispatch/pickups-set-recurrent-dates/${this.pickup.id}`, this.recurrent)
        .then(response => {
          toastr.success(response.data.message);
          this.loading = false;
        }).catch(error => {
          toastr.error(error.response.data.message);
          this.loading = false;
        });
      }
    }
  }
</script>
