@extends('layout.master')


@section('title')
    <title>Login and Register</title>
@endsection

@section('content')


    <section id="form">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <h2>Login to your account</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf <!-- Thêm token csrf để bảo vệ form -->
                            <input type="email" name="email" placeholder="Email Address" />
                            <input type="password" name="password" placeholder="Password" />
                            <span>
                            <input type="checkbox" name="remember" class="checkbox">
                            Keep me signed in
                        </span>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>New User Signup!</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf <!-- Thêm token csrf để bảo vệ form -->
                            <input type="text" name="name" placeholder="Name"/>
                            <input type="email" name="email" placeholder="Email Address"/>
                            <input type="password" name="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection

