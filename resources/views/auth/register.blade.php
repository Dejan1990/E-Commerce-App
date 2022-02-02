@extends('site.app')
@section('title', 'Register')
@section('content')
    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">Register</h2>
        </div> <!-- container //  -->
    </section>
    <!-- ========================= SECTION INTRO END// ========================= -->
    <!-- ========================= SECTION CONTENT END// ========================= -->
    <section class="section-content bg padding-y">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title mt-2">Sign up</h4>
                    </header>
                    <article class="card-body">
                        <form action="/register" method="POST" role="form">
                            @csrf
                            <div class="form-row">
                                <div class="col form-group">
                                    <label>First name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="">
                                    @error('first_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- form-group end.// -->
                                <div class="col form-group">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" placeholder="">
                                    @error('last_name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- form-group end.// -->
                            </div>
                            <!-- form-row end.// -->
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="">
                                <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- form-group end.// -->
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>City</label>
                                    <input type="text" name="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
                                    @error('city')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- form-group end.// -->
                                <div class="form-group col-md-6">
                                    <label for="country">Country</label>
                                    <select id="country" name="country" class="form-control">
                                        <option> Choose...</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="France">France</option>
                                        <option value="United States">United States</option>
                                    </select>
                                </div>
                                <!-- form-group end.// -->
                            </div>
                            <!-- form-row.// -->
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror">
                                @error('address')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- form-group end.// -->

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                                    @error('phone')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Zip</label>
                                    <input type="number" name="zip" value="{{ old('zip') }}" class="form-control @error('zip') is-invalid @enderror">
                                    @error('zip')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Create password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- form-group end.// -->
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Register </button>
                            </div>
                            <!-- form-group// -->
                            <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
                        </form>
                    </article>
                    <!-- card-body end .// -->
                    <div class="border-top card-body text-center">Have an account? <a href="/login">Log In</a></div>
                </div>
                <!-- card.// -->
            </div>
        </div>
    </section>
@endsection