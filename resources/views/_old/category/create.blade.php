@extends('comun')

@section('content')

            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-50 ">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-white" style="border-radius: 1rem; background-color: green">
                            <div class="card-body p-5 text-center" style="height: 24em">
    
                                <form class="mb-md-5 mt-md-4 pb-5" action="{{ url('category') }}" method="post">
                                    
                                    @csrf
                                    
                                    <h2 class="fw-bold mb-2 text-uppercase">New Category</h2>
                                    <p class="text-white-50 mb-5">Enter category name</p>
    
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="name" name="name" class="form-control createCategory form-control-lg"
                                            placeholder="Category name" />
                                    </div>
    
                                    <a href="." class="btn btn-outline-light btn-lg px-5 mr-3">Back</a>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Create</button>
    
                                </form>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection