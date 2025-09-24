@extends('layout.instructorapp')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
        <div class="row">
            <div class="col-md-12">
                @include('message')
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    @include('backend.instructor.nav')
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('instructor.profile.update') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                                <img src="{{ asset($instructor->image) }}" alt="user-avatar"
                                    class="d-block rounded" height="100" width="100" id="image-preview" />

                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" name="image" class="account-file-input"
                                            hidden accept="image/png, image/jpeg" />
                                    </label>

                                    <button type="button" id="resetImageBtn"
                                        class="btn btn-outline-secondary account-image-reset mb-4">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="first_name" name="first_name"
                                        value="{{ old('first_name', $instructor->first_name) }}" autofocus />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name"
                                        value="{{ old('last_name', $instructor->last_name) }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="email" id="email" name="email"
                                        value="{{ old('email', $instructor->email) }}" placeholder="john.doe@example.com" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="select2 form-select" name="gender">
                                        <option value="">Select gender</option>
                                        <option value="male"
                                            {{ old('gender', $instructor->gender) == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $instructor->gender) == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <input type="text" id="phone" name="phone" class="form-control"
                                        placeholder="202 555 0111" value="{{ old('phone', $instructor->phone) }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Address" value="{{ old('address', $instructor->address) }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input class="form-control" type="text" id="city" name="city"
                                        placeholder="California" value="{{ old('city', $instructor->city) }}" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="country">Country</label>
                                    <select id="country" class="select2 form-select" name="country">
                                        <option value="">Select</option>
                                        @foreach (['Australia', 'Bangladesh', 'Belarus', 'Brazil', 'Canada', 'China', 'France', 'Germany', 'India', 'Indonesia', 'Israel', 'Italy', 'Japan', 'Korea', 'Mexico', 'Pakistan', 'Russia', 'South Africa', 'Thailand', 'Turkey', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States'] as $country)
                                            <option value="{{ $country }}"
                                                {{ old('country', $instructor->country) == $country ? 'selected' : '' }}>
                                                {{ $country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="bio" class="form-label">Bio</label>
                                    <textarea class="form-control" id="bio" name="bio" placeholder="Bio">{{ old('bio', $instructor->bio) }}</textarea>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="experience" class="form-label">Experience</label>
                                    <textarea class="form-control" id="experience" name="experience" placeholder="Experience">{{ old('experience', $instructor->experience) }}</textarea>
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" id="resetBtn" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#upload').on('change', function(event) {
                const [file] = event.target.files;
                if (file) {
                    if (file.size > 800 * 1024) {
                        alert('File size exceeds 800KB limit.');
                        $(this).val('');
                        return;
                    }
                    $('#image-preview').attr('src', URL.createObjectURL(file)).css('display', 'block');
                }
            });
        });
    </script>
@endsection
