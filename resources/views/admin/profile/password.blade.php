@extends('layout.adminapp')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
        <div class="row">
            <div class="col-md-12">
                @include('message')

                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    @include('components.tabs.nav-items', [
                        'routePrefix' => 'admin',
                    ])
                </ul>

                <div class="card mb-4">
                    <h5 class="card-header">Update Password</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.update.password') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input class="form-control @error('current_password') is-invalid @enderror"
                                            type="password" id="current_password" name="current_password" />
                                        @error('current_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                            type="password" id="new_password" name="new_password" />
                                        @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirm New
                                            Password</label>
                                        <input class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                            type="password" id="new_password_confirmation"
                                            name="new_password_confirmation" />
                                        @error('new_password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="mt-5 mb-3">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        <button type="reset" id="resetBtn"
                                            class="btn btn-outline-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
