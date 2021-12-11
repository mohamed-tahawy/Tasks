@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('dashboard/edit/product', $product->id)}}">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Product Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{$product->product_name}}" name="product_name" required autocomplete="email" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Prdouct description</label>

                            <div class="col-md-6">
                                <textarea id="email" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required  autofocus>
                                    {{$product->description}}
                                </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="row mb-3">

                            <table class="table table-bordered yajra-datatable">
                                <thead class="thead-s">
                                <tr>
                                    <th class="text-center" scope="col">Product Properties</th>
                                                
                                </tr>
                                 
    
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                            
                            <div class="col-md-6">

                               <p>  @foreach($variant as $variant)
                                <td><?php echo $variant->variant_name . "<br>". "<hr>" ?></td>
                                @endforeach</p>
                            </div>
                            
                        </div>
                       
                        
                      

                    

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>

                             
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
