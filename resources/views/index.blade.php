@extends('comun')

@section('content')

    <!------------------------------ DROPBOX -------------------------------->
    
    <div>
        <button class="btn btn-secondary dropdown-toggle mb-4" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ url('.') }}"><b>All categories</b></a>
            @foreach($categories as $category)
                <a href="{{ url('category/' . $category->id) }}" class="dropdown-item">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    
    <div class="row">

        <!------------------------------ FORUMS -------------------------------->
        
        <div class="col-12 col-xl-9 data-mdb-infinite-direction" style="height: 39em; overflow-y: scroll">
            
            @foreach($categories as $category)
            
                <h3 class="h4 mt-4 mb-2 p-0 rounded">| {{ $category->name }}</h2>
            
                @if($category->posts->isNotEmpty())
                    
                    <table class="postsTable mb-5 table table-striped table-bordered table-responsive">
    
                        <tbody>
                            
                            @foreach($category->posts as $post)
                                <tr>
                                    <td class="post" colspan="4">
                                        <h3 class="h6 mb-0"><a href="{{ url('post/' . $post->id) }}" class="postLink font-weight-bold">{{ $post->title }}</a></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="message">
                                        <p class="mb-0" style="word-break: break-all; white-space: normal">{{ $post->message }}</p>
                                    </td>
                                    <td class="comments">
                                        <div class="text-right">
                                            <a href="{{ url('post/' . $post->id) }}" class="mr-2">Cmmts.</a>{{ DB::table('comment')->where('idPost', $post->id)->count('id') }}
                                        </div>
                                    </td>
                                    <td class="datePost">
                                        <div>{{ $post->updated_at }}</div>
                                    </td>
                                    <td class="userPost">
                                        <a href="{{ url('user/' . DB::table('user')->where('id', $post->idUser)->first()->id) }}">
                                            
                                            @if(DB::table('user')->where('id', $post->idUser)->value('picture') != 'https://i.stack.imgur.com/l60Hf.png')
                                                <img id="output" class="picture" src="{{ asset('storage/assets/img/picturesProfile/' . DB::table('user')->where('id', $post->idUser)->value('picture')) }}" style="width: 40px; height: 40px; object-fit: cover; box-shadow: var(--shadow); border-radius: 60%;" />
                                            @else
                                                <img id="output" class="picture" src="{{ DB::table('user')->where('id', $post->idUser)->value('picture') }}" style="width: 40px; height: 40px; object-fit: cover; box-shadow: var(--shadow); border-radius: 60%;" />
                                            @endif
                                        
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                                
                        </tbody>
                        
                    </table>
                    
                @else
                
                    <h3 class="h6 mb-5">There are no posts yet...</h3>
                    
                @endif
                
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

@endsection