@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card-body">
                    
        <table class="table table-bordered yajra-datatable">
        <thead class="thead-s">
        <tr>
            <th class="text-center" scope="col">Number</th>
            <th>Product Name</th>
            <th class="text-center" scope="col">description</th>
            <th class="text-center" scope="col">Action</th>

        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
                        
 

                    

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script type="text/javascript">
    $(function () {
    
    var table = $('.yajra-datatable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ url('dashboard/product/all') }}",
      columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'product_name', name: 'product_name'},
          {data: 'description', name: 'description'},
          {
              
     
              data: 'action', 
              name: 'action',
    
              orderable: true, 
              searchable: true
          },
      ]
    });
    
    });
    
    </script>
@endsection