@extends('comun')

@section('content')

    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!------------------------------ POST -------------------------------->
    
    <p style="padding-top: 1em; font-size: 1.3em"><b>> Category </b><a href="{{ url('category/' . $post->category->id) }}" class="postLink">{{ $post->category->name }}</a></p>
    
    <h3 class="h4 mt-5 mb-2 p-0 rounded">| Post</h3>
    
    <table class="postsTable comment table table-striped table-bordered table-responsive mt-0">
        
        <tbody>
            <tr>
                <td class="post" colspan="3">
                    <h3 class="h6 mb-0 font-weight-bold" style="color: black">{{ $post->title }}</h3>
                </td>
            </tr>
            <tr>
                <td class="message">
                    <p class="mb-0">{{ $post->message }}</p>
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
        </tbody>
        
    </table>
    
    <!----------------------------- COMMENTS ------------------------------->
    
    @if($post->comments->isNotEmpty())
    
        <h3 class="h4 mt-4 mb-2 p-0 rounded">| Comments</h3>
        
        <table class="postsTable comments table table-striped table-bordered table-responsive mt-0">
            
            <tbody>
                
                @foreach($post->comments as $comment)
                
                    <tr>
                        <td class="message">
                            <p class="mb-0 pr-1" style="word-break: break-all; white-space: normal">{{ $comment->message }}</p>
                        </td>
                        <td class="datePost">
                            <div>{{ $comment->updated_at }}</div>
                        </td>
                        <td class="userPost">
                            <a href="{{ url('user/' . DB::table('user')->where('id', $comment->idUser)->first()->id) }}">
                                @if(DB::table('user')->where('id', $comment->idUser)->value('picture') != 'https://i.stack.imgur.com/l60Hf.png')
                                    <img id="output" class="picture" src="{{ asset('storage/assets/img/picturesProfile/' . DB::table('user')->where('id', $comment->idUser)->value('picture')) }}" style="width: 40px; height: 40px; object-fit: cover; box-shadow: var(--shadow); border-radius: 60%;" />
                                @else
                                    <img id="output" class="picture" src="{{ DB::table('user')->where('id', $comment->idUser)->value('picture') }}" style="width: 40px; height: 40px; object-fit: cover; box-shadow: var(--shadow); border-radius: 60%;" />
                                @endif
                            </a> 
                        </td>
                    </tr>
                    
                @endforeach
                    
            </tbody>
            
        </table>
        
    @endif

    <!--------------------------- SEND COMMENT ----------------------------->

    <div class="row" style="height: 65vh">
        
        <div class="col-12">
            <h3 class="h4 mt-4 mb-2 p-2 rounded" style="width: 20%; border-left: 5px solid rgb(23,162,184); border-bottom: 5px solid rgb(23,162,184)">Send comment</h3>
            <form class="mb-3" action="{{ url('comment') }}" method="post">
                
                @csrf
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" style="resize: none" name="message" rows="10" minlength="1" maxlength="1460" placeholder="Enter the message"
                        required>{{ old('message') }}</textarea>
                </div>
                
                <a href=".." class="btn btn-info">Back</a>
                <button id="sendComment" class="btn btn-success" type="submit" idPost="{{ $post->id }}">Send comment</button>
                <input id="secretIdPost" name="idPost" hidden/>
                
            </form>
        </div>
    </div>
    
@endsection