@extends('site.layout.default')
@section('title',$title)
@section('content')

    <div class="page-content-wrapper">
        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">
                <!-- User Information-->
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-info">
                            <h5 class="mb-0">{{auth()->user()->name}}</h5>
                        </div>
                    </div>
                </div>
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        @if($errors->any())
                            <h4 class="alert alert-danger">{{$errors->first()}}</h4>
                        @endif
                        <form action="{{route('update_password')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>Old Password</span></div>
                                <input class="form-control" name="old_password" type="password">
                            </div>
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>New Password</span></div>
                                <input class="form-control" name="password" type="password">
                            </div>
                            <div class="form-group">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>Repeat New Password</span></div>
                                <input class="form-control" name="password_confirmation" type="password">
                            </div>
                            <button class="btn btn-success w-100" type="submit">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
