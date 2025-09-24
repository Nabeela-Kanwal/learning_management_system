@extends('layout.adminapp')

@section('content')
    <div class="content-wrapper">
        @include('message')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">
                    <a href="{{ route('admin.instructor.index') }}" class="text-muted">Instructors</a> /
                </span>
                Edit Instructor
            </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Edit Instructor</h5>
                        </div>
                        <div class="card-body">
                            <form id="instructorForm" action="{{ route('admin.instructor.update', $instructor->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="instructor">
                                {{-- Image --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        @if ($instructor->image)
                                            <img id="previewImage" src="{{ asset($instructor->image) }}"
                                                alt="Instructor Image"
                                                style="max-width: 150px; margin-top: 10px; display: block;">
                                        @else
                                            <img id="previewImage" src="#" alt="Image Preview"
                                                style="max-width: 150px; margin-top: 10px; display: none;">
                                        @endif
                                        <br>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-image"></i></span>
                                            <input type="file" name="image" class="form-control"
                                                onchange="checkImage(this)">
                                        </div>

                                        @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                {{-- First Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">First Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="first_name" class="form-control"
                                                value="{{ old('first_name', $instructor->first_name) }}"
                                                placeholder="First Name" required>
                                        </div>
                                        @error('first_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Last Name --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" name="last_name" class="form-control"
                                                value="{{ old('last_name', $instructor->last_name) }}"
                                                placeholder="Last Name" required>
                                        </div>
                                        @error('last_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $instructor->email) }}" placeholder="Email" required>
                                        </div>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Password --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Leave blank to keep current password">
                                        </div>
                                        @error('password')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ old('phone', $instructor->phone) }}" placeholder="Phone">
                                        </div>
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Address --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ old('address', $instructor->address) }}" placeholder="Address">
                                        </div>
                                        @error('address')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Gender --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-male-female"></i></span>
                                            <select name="gender" class="form-control" required>
                                                <option value="male"
                                                    {{ old('gender', $instructor->gender) == 'male' ? 'selected' : '' }}>
                                                    Male</option>
                                                <option value="female"
                                                    {{ old('gender', $instructor->gender) == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>



                                {{-- Bio --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Bio</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-detail"></i></span>
                                            <textarea name="bio" class="form-control" rows="4" placeholder="Instructor Bio">{{ old('bio', $instructor->bio) }}</textarea>
                                        </div>
                                        @error('bio')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                {{-- Status --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        @php
                                            // Determine checked state
                                            $statusChecked = old('status', $instructor->status) == 1 ? 'checked' : '';
                                        @endphp
                                        <div class="form-check form-switch mb-3">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="statusSwitch" value="1" {{ $statusChecked }}>
                                            <label class="form-check-label" for="statusSwitch" id="statusLabel">
                                                {{ $statusChecked ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- Submit --}}
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button class="btn btn-primary" type="submit" id="submitBtn">
                                            Update <x-loader-icon />
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Image preview + validation
        function checkImage(input) {
            var file = input.files[0];
            if (file && validateFile(file, 2, true)) {
                var preview = document.getElementById("previewImage");
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                input.value = '';
                alert('Invalid file. Only images up to 2MB are allowed.');
            }
        }

        function validateFile(file, maxSizeMB = 2, onlyImage = true) {
            var validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            var maxSizeBytes = maxSizeMB * 1024 * 1024;
            return (!onlyImage || validTypes.includes(file.type)) && file.size <= maxSizeBytes;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const statusSwitch = document.getElementById('statusSwitch');
            const statusLabel = document.getElementById('statusLabel');

            function updateLabel() {
                statusLabel.textContent = statusSwitch.checked ? 'Active' : 'Inactive';
            }

            statusSwitch.addEventListener('change', updateLabel);
            updateLabel(); 
        });
    </script>
@endsection
