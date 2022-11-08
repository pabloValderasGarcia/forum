<!doctype html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>p0st3d forum | 2022 Copyrights - 2022</title>
        <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/font-awesome/css/font-awesome.min.css') }}">
    </head>

    <body>
        
        <!-------------------------------------------------------------------->
        <!-------------------------------------------------------------------->
        <!------------------------------ MODALS ------------------------------>
        <!-------------------------------------------------------------------->
        <!-------------------------------------------------------------------->
        
        
        <!------------------------------ USER FORM ------------------------------>
        
        <!--REGISTER-->
        
        <section id="registerForm" class="vh-100 gradient-custom register">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem; height: 37.4em">
                            <div class="card-body p-5">
    
                                <form class="mb-md-5 mt-md-4 pb-5" data-toggle="modal" action="{{ url('register') }}" method="post">
                                    
                                    @csrf
                                    
                                    <a href="." data-toggle="modal" data-target="#loginForm" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    
                                    <h2 class="fw-bold mb-2 text-uppercase text-center">Register</h2>
                                    <p class="text-white-50 mb-5 text-center">Please enter new login and data!</p>
    
                                    <div class="form-outline form-white mb-4">
                                        <label for="name">Username</label>
                                        <input id="name" class="form-control form-control-lg" type="user" name="name" minlength="3" maxlength="15"
                                            placeholder="Username" required/>
                                    </div>
    
                                    <div class="form-outline form-white mb-4">
                                        <label for="email">Email</label>
                                        <input id="email" class="form-control form-control-lg" type="email"  name="email" maxlength="100" 
                                            placeholder="Email" required/>
                                    </div>
                                    
                                    <div class="form-outline form-white mb-4">
                                        <label for="birthDate">Birth date</label>
                                        <input id="birthDate" class="birthDate form-control form-control-lg" type="date" name="birthDate" min="1940-01-01" 
                                            placeholder="Birth date" required/>
                                    </div>
    
                                    <div class="text-center">
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                                    </div>
    
                                </form>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!--LOGIN-->
        
        <section id="loginForm" class="vh-100 gradient-custom login">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
    
                                <form class="mb-md-5 mt-md-4 pb-5" action="{{ url('login') }}" method="post">
                                    
                                    @csrf
                                    
                                    <a href="."><i class="fa fa-times" aria-hidden="true"></i></a>
                                    
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
    
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" id="name" name="name" minlength="3" maxlength="15" class="form-control form-control-lg mx-auto" style="width: 80%"
                                            placeholder="Username" required/>
                                    </div>
    
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
    
                                </form>
    
                                <div>
                                    <p class="mb-0">
                                        Don't have an account? <a href="" data-toggle="modal" data-target="#registerForm" data-dismiss="modal" class="text-white-50 fw-bold">Sign Up</a>
                                    </p>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!----------------------------- CREATE CATEGORY ----------------------------->
        
        <div class="modal fade" id="createCategory" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('category') }}" method="POST">
                        @csrf
                        <div class="modal-header d-flex align-items-center">
                            <h6 class="modal-title mb-0" id="threadModalLabel">| New Category</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input required value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Enter name" minlength="3" maxlength="20"/>
                            </div>
                            <div class="modal-footer">
                                <a type="button" class="btn btn-primary bg-info text-white" data-dismiss="modal">Cancel</a>
                                <button type="submit" class="btn btn-primary bg-success" style="border: 0">Create category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-------------------------------------------------------------------->
        <!-------------------------------------------------------------------->
        
        <!------------------------------- NAV ---------------------------------->
        
        <nav class="navbar navbar-dark bg-dark">
            <div class="container" style="display: flex; flex-wrap: wrap">
                <h1 class="title"><a href="{{ url('/') }}" class="navbar-brand">p0st3d forum by PNVG</a></h1>
                <div style="flex: 10; margin-top: 0.06em">
                    @if(session()->has('name'))
                        <a href="" data-toggle="modal" data-target="#createCategory" class="btn btn-primary category">New Category</a>
                        <a href="{{ url('post/create') }}" class="btn btn-primary post">New Post</a>
                        <a href="{{ url('user/' . session('id')) }}">{{ session('name') }}</a>
                        <a class="closeSession" href="{{ url('logout') }}" style="all: unset; cursor: pointer"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                    @else
                        <a href="" data-toggle="modal" data-target="#loginForm" class="btn btn-primary login">Login</a>
                    @endif
                </div>
            </div>
        </nav>
        
        <!------------------------------- BODY --------------------------------->
        
        <div class="container my-3">
            
            @error('default')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            @error('userError')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            @error('name') <!--category-->
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            @if(session()->has('works'))
                <div class="alert alert-success">
                    {{ session()->get('works') }}
                </div>
            @endif
        
            @yield('content')
        
        </div>
        
        <!------------------------------ FOOTER -------------------------------->
        
        <footer class="small bg-dark text-white">
            <div class="container py-4">
                <ul class="list-inline mb-0 text-center">
                    <li class="list-inline-item">&copy; 2022 p0st3d, Inc.</li>
                    <li class="list-inline-item"><a href="#0">Terms and privacy policy</a>.</li>
                </ul>
            </div>
        </footer>

        <script src="{{ url('assets/js/scripts.js') }}"></script>
        <script src="{{ url('assets/js/jquery.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        
    </body>

</html>