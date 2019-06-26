<div class="row">
    <div class="col-12">
        <div class="table-responsive m-t-40">
            <table class="table dataTable">
              <thead>
                  <tr>
                     <th class="printable">#</th>
                     <th class="printable">Pickup no</th>
                     <th class="printable">Bill Account</th>
                     <th class="printable">Bill Company</th>
                     <th class="printable">Pickup Date</th>
                     <th class="printable">Company Name</th>
                     <th class="printable">Assigned to</th>
                     <th class="printable">Status</th>
                     <th class="printable">Type</th>
                     <th class="printable">Close time</th>
                     <th>Action</th>
                  </tr>
              </thead>
              <tfoot>
                  <tr>
                    <th class="printable">#</th>
                    <th class="printable">Pickup no</th>
                    <th class="printable">Bill Account</th>
                    <th class="printable">Bill Company</th>
                    <th class="printable">Pickup Date</th>
                    <th class="printable">Company Name</th>
                    <th class="printable">Assigned to</th>
                    <th class="printable">Status</th>
                    <th class="printable">Type</th>
                    <th class="printable">Close time</th>
                    <th>Action</th>
                  </tr>
              </tfoot>
              <tbody>
                  @foreach ($data as $key => $pickup)
                    <tr>
                      <td class="printable">{{ $key+1 }}</td>
                      <td class="printable">{{ $pickup->pickup_no }}</td>
                      <td class="printable">{{ $pickup->client ? $pickup->client->Name :'-' }}</td>
                      <td class="printable">{{ $pickup->bill_company_name }}</td>
                      <td class="printable">{{ $pickup->pickup_date }}</td>
                      <td class="printable">{{ $pickup->company_name }}</td>
                      <td class="printable">{{ $pickup->courier ? $pickup->courier->name : '-' }}</td>
                      <td class="printable">{{ $pickup->status_name }}</td>
                      <td class="printable">{{ $pickup->type_name }}</td>
                      <td class="printable">{{ $pickup->close_time }}</td>
                      <td>
                        @if($table == 'posted')
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='{{"#assignment_modal_id_".$pickup->id }}'>
                            <i class="fa fa-exchange"></i>
                          </button>
                          @include('dispatch.pickups.partials.assign-modal')
                        @endif
                        @if($table == 'recurrent')
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='{{"#set_recurrent_modal_id_".$pickup->id }}'>
                          <i class="fa fa-bell"></i>
                        </button>
                        @include('dispatch.pickups.partials.set-recurrent-modal')
                        @endif
                        @can('update-status-pickups')
                          @if($table == 'assigned')
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='{{"#update_status_modal_id_".$pickup->id }}'>
                            <i class="fa fa-exchange"></i>
                          </button>
                          @include('dispatch.pickups.partials.update-status')
                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target='{{"#reschedule_modal_id_".$pickup->id }}'>
                              <i class="fa fa-bell"></i>
                            </button>
                            @include('dispatch.pickups.partials.reschedule')
                          @endif
                        @endcan
                        @can('update-pickup')
                          <a href="{{ route('pickups.edit', $pickup->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                        @endcan
                        <a href="{{ route('pickups.show', $pickup->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                        @can('update-pickup')
                          <button type="button" class="btn btn-danger btn-sm btn-destroy" data-token="{{ csrf_token() }}" data-url="{{ route('pickups.destroy', $pickup->id) }}"><i class="fa fa-trash"></i></button>
                        @endcan
                      </td>
                    </tr> 
                  @endforeach
              </tbody>
            </table>
        </div>
    </div>
</div>
