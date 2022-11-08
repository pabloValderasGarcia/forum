@extends('comun')

@section('content')

    <div class="row" style="height: 100vh">
        <div class="col-12">
            <h3 class="h4 mt-4 mb-4 p-0 rounded">| Create new post</h3>
            <form class="mb-3" action="{{ url('post') }}" method="post">
                
                @csrf
                
                <!------------------------------ DROPBOX -------------------------------->
                
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
    
                <div class="btn-group dropright mb-4">
                    <button type="button" class="btn btn-secondary dropdown-toggle bg-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category post
                    </button>
                    <div class="dropdown-menu">
                        @foreach($categories as $category)
                            <a class="categoryPostButton dropdown-item" style="cursor: pointer; user-select: none">{{ $category->name }}</a>
                        @endforeach
                    </div>
                    <input id="categoryPost" class="form-control ml-2" style="width: 50%" name="category" value="{{ old('category') }}" placeholder="Category" readonly/>
                </div>
                
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input id="title" class="form-control title" type="text" name="title" value="{{ old('title') }}" minlength="3" maxlength="20" placeholder="Enter the title" required/>
                </div>
                
                @error('message')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" style="resize: none" name="message" rows="10" minlength="10" maxlength="1460" placeholder="Enter the message"
                        required>{{ old('message') }}</textarea>
                </div>
                
                <br/>
                
                <a href=".." class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Create post</button>
                
            </form>
        </div>
    </div>
    
@endsection