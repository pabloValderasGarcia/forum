@extends('comun')

@section('content')

            <!------------------------------ DROPBOX -------------------------------->

            <div class="">
                <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categories
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#"><b>All categories</b></a>
                    @foreach($categories as $category)
                        <a class="dropdown-item" href="#">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
            
            <div class="row">

                <!------------------------------ FORUMS -------------------------------->
                
                <div class="col-12 col-xl-9">
                    
                    @foreach($categories as $category)
                        <h2 class="h4 text-white bg-info mb-0 p-4 rounded-top">Category {{ $category->name }}</h2>
                        <table class="postsTable table table-striped table-bordered table-responsive">
                            
                            <tbody>
                                
                                @foreach($category->posts as $post)
                                        <tr>
                                            <td class="post">
                                                <h3 class="h6 mb-0"><a href="#0" class="text-uppercase">{{ $post->title }}</a></h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="message">
                                                <p class="mb-0">{{ $post->message }}</p>
                                            </td>
                                            <td class="comments">
                                                <div class="text-right"><a href="" class="mr-2">View</a>5</div>
                                            </td>
                                            <td class="datePost">
                                                <div>{{ $post->created_at }}</div>
                                            </td>
                                            <td class="userPost">
                                                <div><a href="">{{ DB::table('user')->where('id', $post->idUser)->value('name') }}</a></div>
                                            </td>
                                        </tr>
                                @endforeach
                                    
                            </tbody>
                            
                        </table>
                    @endforeach
                    
                </div>

                <!----------------------- ONLINE MEMBERS ------------------------->
                
                <div class="col-12 col-xl-3">
                    <aside>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-xl-12">
                                <div class="card mb-3 mb-sm-0 mb-xl-3">
                                    <div class="card-body">
                                        <h2 class="h4 card-title">Members:</h2>
                                        <dl class="row mb-0">
                                            <dt class="col-8">Total members:</dt>
                                            <dd class="col-4 mb-0">{{ DB::table("user")->count() }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
            
@endsection