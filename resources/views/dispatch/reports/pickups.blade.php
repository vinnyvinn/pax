<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pickups report</title>
</head>
<body>
  <table class="table dataTable">
    <thead>
        <tr>
           <th>#</th>
           <th>Pickup no</th>
           <th>Pickup Date</th>
           <th>Ready time</th>
           <th>Close time</th>
           <th>Company Name</th>
           <th>Assigned to</th>
           <th>Status</th>
           <th>Type</th>
           <th>Address</th>
           <th>Contact name</th>
           <th>Contact phone</th>
           <th>Description</th>
           <th>Instructions</th>
           <th>Cash Collect</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $pickup)
          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $pickup->pickup_no }}</td>
            <td>{{ $pickup->pickup_date }}</td>
            <td>{{ $pickup->ready_time }}</td>
            <td>{{ $pickup->close_time }}</td>
            <td>{{ $pickup->company_name }}</td>
            <td>{{ $pickup->courier ? $pickup->courier->name : '-' }}</td>
            <td>{{ $pickup->status_name }}</td>
            <td>{{ $pickup->type_name }}</td>
            <td>{{ $pickup->address }}</td>
            <td>{{ $pickup->contact_name }}</td>
            <td>{{ $pickup->contact_phone }}</td>
            <td>{{ $pickup->description }}</td>
            <td>{{ $pickup->instructions }}</td>
            <td>{{ $pickup->cash_collect }}</td>
          </tr> 
        @endforeach
    </tbody>
  </table>
</body>
</html>