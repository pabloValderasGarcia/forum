@extends('comun')

@section('content')

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!------------------------------ POST -------------------------------->
    
    <p style="padding-top: 1em; font-size: 1.3em"><b>> Category </b><a href="{{ url('category/' . $comment->post->category->id) }}" class="postLink">{{ $comment->post->category->name }}</a></p>
    
    <h3 class="h4 mt-5 mb-2 p-0 rounded">| Post</h3>

    <table class="postsTable comment table table-striped table-bordered table-responsive mt-4">
        
        <tbody>
            
            <tr>
                <td class="post" colspan="4">
                    <h3 class="h6 mb-0 font-weight-bold">{{ $comment->post->title }}</h3>
                </td>
            </tr>
            <tr>
                <td class="message">
                    <p class="mb-0" style="word-break: break-all; white-space: normal">{{ $comment->post->message }}</p>
                </td>
                <td class="comments">
                    <div class="text-right">
                        <a href="{{ url('post/' . $comment->post->id) }}" class="mr-2">Cmmts.</a>{{ DB::table('comment')->where('idPost', $comment->post->id)->count('id') }}
                    </div>
                </td>
                <td class="datePost">
                    <div>{{ $comment->post->created_at }}</div>
                </td>
            </tr>
            
        </tbody>
        
    </table>
    
    <h3 class="h4 mt-5 mb-2 p-0 rounded">| Edit comment</h3>
    
    <form class="mb-3" action="{{ url('comment/' . $comment->id) }}" method="post">
                
        @csrf
        @method('put')
    
        <table class="postsTable comment table table-bordered table-responsive mt-4">
            
            <tbody>
                
                <tr>
                    <td class="message">
                        <textarea name="message" class="form-control" style="width: 67.6em; height: 19em; background-color: transparent; color: black" minlength="1" maxlength="1460" required>{{ old('message', $comment->message) }}</textarea>
                    </td>
                </tr>
                
            </tbody>
            
        </table>
        
        <div style="padding-bottom: 15em">
            <a href="{{ url('user/' . DB::table('user')->where('id', $comment->idUser)->first()->id) }}" class="btn btn-info">Back</a>
            <button id="sendComment" class="btn btn-success" type="submit">Edit</button>
        </div>
        
    </form>
    
@endsection