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

                    <form method="POST" action="{{ url('dashboard/create-product')}}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md">Product Name</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" required autocomplete="email" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md">Prdouct description</label>

                            <div class="col-md-6">
                                <textarea id="email" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required  autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md">Selecte Options</label>

                            <div class="col-md-6" style="margin-top:20px;">
                                @foreach($options as $option)
                                                                <div class="row mb-3">

                                <h1 class="col-md-2 col-form-label text-md">{{$option->option_name}}</h1>
                                <input type="hidden" name="option_id[]" value="{{$option->id}}" />
                                <select class="selectpicker" multiple data-live-search="true" name="option_values[{{$option->id}}][]" >
                                    @foreach($option->values as $value)
                                    <option vlaue="{{$value->id}}">{{$value->value_name}}</option>
                                    @endforeach

                                </select>
                                        </div>
                                @endforeach     
                                  
                                @error('option_values')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                                @error('option_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
