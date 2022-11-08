@extends('comun')

@section('content')

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
    @error('message')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <!------------------------------ POST -------------------------------->
    
    <p style="padding-top: 1em; font-size: 1.3em"><b>> Category </b><a href="{{ url('category/' . $post->category->id) }}" class="postLink">{{ $post->category->name }}</a></p>
    
    <h3 class="h4 mt-5 mb-2 p-0 rounded">| Edit post</h3>
    
    <form class="mb-3" action="{{ url('post/' . $post->id) }}" method="post">
                
        @csrf
        @method('put')
    
        <table class="postsTable comment table table-striped table-bordered table-responsive mt-4">
            
            <tbody>
                
                <tr>
                    <td class="post">
                        <input name="title" class="h6 mb-0 font-weight-bold" style="background-color: transparent; color: black; border: 0; border-bottom: 1px solid black" minlength="3" maxlength="20" value="{{ old('title', $post->title) }}" required/>
                    </td>
                </tr>
                
                <tr>
                    <td class="message">
                        <textarea name="message" class="form-control" style="width: 67.6em; height: 19em; background-color: transparent; color: black" minlength="10" maxlength="1460" value="{{ old('message', $post->message) }}" required>{{ $post->message }}</textarea>
                    </td>
                </tr>
                
            </tbody>
            
        </table>
        
        <a href="{{ url('user/' . DB::table('user')->where('id', $post->idUser)->first()->id) }}" class="btn btn-info">Back</a>
        <button id="sendComment" class="btn btn-success" type="submit" idPost="{{ $post->id }}">Edit</button>
        <input id="secretIdPost" name="idPost" hidden/>
        
    </form>
    
@endsection