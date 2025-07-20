@extends('layout.instructorapp')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
        <div class="row">
            <div class="col-md-12">
                @include('message')

                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('instructor.profile.index') }}"><i class="bx bx-user me-1"></i> Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('instructor.profile.update.password') }}"><i
                                class="bx bx-cog me-1"></i>
                            Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i>
                            Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages-account-settings-connections.html"><i
                                class="bx bx-link-alt me-1"></i> Connections</a>
                    </li>
                </ul>

                <div class="card mb-4">
                    <h5 class="card-header">Update Password</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST"
                            action="{{ route('instructor.profile.update.password') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input class="form-control" type="password" id="current_password"
                                            name="current_password" />
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input class="form-control" type="password" id="new_password" name="new_password"
                                            />
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password_confirmation" class="form-label">Confirm New
                                            Password</label>
                                        <input class="form-control" type="password" id="new_password_confirmation"
                                            name="new_password_confirmation"
                                           />
                                    </div>

                                    <div class="mt-3">
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
