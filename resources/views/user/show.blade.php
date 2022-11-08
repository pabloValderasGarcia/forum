@extends('comun')

@section('content')

    @php
        use Carbon\Carbon;
    @endphp

    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    @error('birthDate')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    <!-------------------------------- DELETE POST MODAL -------------------------------------->
        
    <div class="modal fade" id="deletePost" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action method="post" id="deleteFormPost">
                    @csrf
                    @method('delete')
                    <div class="modal-header d-flex align-items-center text-white bg-danger" style="background-color: green">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Delete post</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="name">Are you sure to delete this post?</label>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary bg-success" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary bg-danger" value="Delete post" style="border: 0"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-------------------------------- DELETE COMMENT MODAL -------------------------------------->
        
    <div class="modal fade" id="deleteComment" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action method="post" id="deleteFormComment">
                    @csrf
                    @method('delete')
                    <div class="modal-header d-flex align-items-center text-white bg-danger" style="background-color: green">
                        <h6 class="modal-title mb-0" id="threadModalLabel">Delete comment</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-light" aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="name">Are you sure to delete this comment?</label>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary bg-success" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary bg-danger" value="Delete comment" style="border: 0"></input>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section style="background-color: #eee;">
        <div class="container py-5">
    
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        
                        @if(session()->has('name') && session('name') == $user->name)
                            <div class="card-body text-center" style="position: relative; height: 17em">
                        @else
                            <div class="card-body text-center" style="position: relative; height: 15em">
                        @endif
                            
                            @if(session()->has('name') && session('name') == $user->name)
                                <label class="labelPicture" for="file" style="width: 9.5em; height: 9.5em; color: transparent; position: absolute; top: 8%; left: 27.7%; cursor: pointer; height: $circleSize; width: $circleSize; z-index: 9999">
                                    <span class="glyphicon glyphicon-camera" style="display: inline-flex; padding: .2em; height: 2em;"></span>
                                    <span style="display: inline-flex; padding: .2em; height: 2em;">Change Image</span>
                                </label>
                            @endif
                            
                            <form action="{{ url('picture/' . $user->id) }}" enctype="multipart/form-data" method="post">
                                
                                @csrf
                                @method('put')
                                
                                @if(session()->has('name') && session('name') == $user->name)
                                    <input id="file" type="file" name="picture" onchange="loadFile(event)" style="display: none"/>
                                @endif
                                
                                @if($user->picture != 'https://i.stack.imgur.com/l60Hf.png')
                                    <img id="output" class="rounded-circle img-fluid" alt="picture" src="{{ asset('storage/assets/img/picturesProfile/' . $user->picture) }}" style="width: 9.5em; height: 9.5em; position: absolute; top:8%; left:27.7%; object-fit: cover; box-shadow: var(--shadow); z-index: 0"/>
                                @else
                                    <img id="output" class="rounded-circle img-fluid" alt="picture" src="{{ $user->picture }}" style="width: 9.5em; height: 9.5em; position: absolute; top:8%; left:27.7%; object-fit: cover; box-shadow: var(--shadow); z-index: 0"/>
                                @endif
                                
                                @if(session()->has('name') && session('name') == $user->name)
                                    <button type="submit" id="changeImage" class="changeImage"/>Change</button>
                                @endif
                                
                            </form>
                            
                            @if(session()->has('name') && session('name') == $user->name)
                                <h5 class="my-3" style="padding-top: 9.5em">{{ $user->name }}</h5>
                            @else
                                <h5 class="my-3" style="padding-top: 8em">{{ $user->name }}</h5>
                            @endif
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        
                        <form action="{{ url('user/' . $user->id) }}" method="post">
                            
                            @csrf
                            @method('put')
                        
                            <div class="card-body">
                                
                                <div class="row" style="display: flex;">
                                    <div class="col-sm-3" style="flex: 2">
                                        <p class="mb-0">Username</p>
                                    </div>
                                    @if(session()->has('name') && session('name') == $user->name)
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="mb-0" name="name" style="width: 11em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="15" value="{{ old('name', $user->name) }}" required/>
                                        </div>
                                    @else
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="mb-0" name="name" style="width: 11em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="15" value="{{ $user->name }}" readonly/>
                                        </div>
                                    @endif
                                </div>
                                
                                <hr>
                                
                                <div class="row" style="display: flex">
                                    <div class="col-sm-3" style="flex: 2">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    @if(session()->has('name') && session('name') == $user->name)
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="mb-0" name="email" style="width: 17em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="100" value="{{ old('email', $user->email) }}" required/>
                                        </div>
                                    @else
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="mb-0" name="email" style="width: 17em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="100" value="{{ $user->email }}" readonly/>
                                        </div>
                                    @endif
                                </div>
                                
                                <hr>
                                
                                <div class="row" style="display: flex">
                                    <div class="col-sm-3" style="flex: 2">
                                        <p class="mb-0">Birth date</p>
                                    </div>
                                    @if(session()->has('name') && session('name') == $user->name)
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="birthDate" type="date" name="birthDate" min="1940-01-01" style="width: 7.5em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="15" value="{{ old('birthDate', $user->birthDate) }}" required/>
                                        </div>
                                    @else
                                        <div class="col-sm-9" style="flex: 5">
                                            <input class="birthDate" type="date" name="birthDate" min="1940-01-01" style="width: 6.9em; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="15" value="{{ old('birthDate', $user->birthDate) }}" readonly/>
                                        </div>
                                    @endif
                                </div>
                                
                            </div>
                            
                            @if(session()->has('name') && session('name') == $user->name)
                                <input class="editUser" style="margin: 0 0 1.4em 36em; padding: 0.4em 0.8em" type="submit" value="Update user"/>
                            @endif
                            
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><b>Published posts</b></p>
                            <div class="card mb-4 mb-md-0 data-mdb-infinite-direction" style="height: 20.7em; overflow-y: scroll">
                                <div class="card-body">
                                    @foreach($user->posts as $post)
                                    
                                        <div class="mb-3">
                                            <p class="mb-1" style="font-size: .77rem;"><b>{{ $post->title }}</b></p>
                                            <p class="mb-1" style="font-size: .77rem;">{{ $post->message }}</p>
                                            <div style="width: 7em; display: flex; justify-content: space-between">
                                                <a class="modifyLink" href="{{ url('post/' . $post->id) }}" style="font-size: .9rem; padding: 0; margin: 0">View</a>
                                                @php
                                                    $actualTime = Carbon::now('+1:00');
                                                    $limitTime = Carbon::createFromDate($post->created_at)->addMinutes(5);
                                                @endphp
                                                @if($limitTime > $actualTime)
                                                    @if(session()->has('name') && session('name') == $user->name)
                                                        <a href="" class="deleteLinkPost" data-toggle="modal" data-target="#deletePost" data-url="{{ url('post/' . $post->id) }}" style="font-size: .9rem; padding: 0;">Delete</a>
                                                        <a href="{{ url('post/' . $post->id . '/edit') }}" class="modifyLink" style="font-size: .9rem;">Edit</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="mb-2"><b>Published comments</b></p>
                            <div class="card mb-4 mb-md-0 data-mdb-infinite-direction" style="width: 22em; height: 20.7em; overflow-y: scroll">
                                <div class="card-body">
                                    @foreach($user->comments as $comment)
                                    
                                        <div class="mb-3">
                                            <p class="mb-1" style="font-size: .77rem"><b>{{ $comment->post->title }}</b></p>
                                            <p class="mb-1" style="font-size: .77rem;">{{ $comment->message }}</p>
                                            <div style="width: 7em; display: flex; justify-content: space-between">
                                                <a class="modifyLink" href="{{ url('post/' . $comment->post->id) }}" style="font-size: .9rem; padding: 0; margin: 0">View</a>
                                                @php
                                                    $actualTime = Carbon::now('+1:00');
                                                    $limitTime = Carbon::createFromDate($comment->created_at)->addMinutes(1);
                                                @endphp
                                                @if($limitTime > $actualTime)
                                                    @if(session()->has('name') && session('name') == $user->name)
                                                        <a href="" class="deleteLinkComment" data-toggle="modal" data-target="#deleteComment" data-url="{{ url('comment/' . $comment->id) }}" style="font-size: .9rem; padding: 0;">Delete</a>
                                                        <a href="{{ url('comment/' . $comment->id . '/edit') }}" class="modifyLink" style="font-size: .9rem;">Edit</a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection