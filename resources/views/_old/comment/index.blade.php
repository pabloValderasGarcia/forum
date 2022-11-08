@extends('comun')

@section('content')

    <!------------------------------ POST -------------------------------->
    
    <table class="postsTable comment table table-striped table-bordered table-responsive mt-5">
        
        <tbody>
            <tr>
                <td class="post" colspan="3">
                    <h3 class="h6 mb-0"><a href="#0" class="font-weight-bold" style="color: black">AAAA</a></h3>
                </td>
            </tr>
            <tr>
                <td class="message">
                    <p class="mb-0">a</p>
                </td>
                <td class="datePost">
                    <div>a</div>
                </td>
                <td class="userPost">
                    <div><a href="">a</a></div>
                </td>
            </tr>
        </tbody>
        
    </table>

    <!----------------------------- COMMENT ------------------------------->

    <div class="row" style="height: 100vh">
        <div class="col-12">
            <h2 class="h4 text-white bg-info mt-4 mb-3 p-4 rounded">Send comment</h2>
            <form class="mb-3" action="{{ url('comment') }}" method="post">
                
                @csrf
                
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="10" min-length="10" max-length="500" placeholder="Enter the message"
                        required></textarea>
                </div>
                
                <br/>
                
                <a href=".." class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Send comment</button>
                
            </form>
        </div>
    </div>
    
@endsection