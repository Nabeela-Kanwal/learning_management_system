@extends('layout.adminapp')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Categories/</span> Add Category</h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Add Category</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Name</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="icon-fullname" class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" id="basic-icon-default-fullname"
                                                placeholder="John Doe" aria-label="John Doe"
                                                aria-describedby="icon-fullname" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-company">Slug</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="icon-company" class="input-group-text"><i class="bx bx-buildings"></i></span>
                                            <input type="text" id="basic-icon-default-company" class="form-control"
                                                placeholder="slug" aria-label="slug"
                                                aria-describedby="icon-company" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Image</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="icon-email" class="input-group-text"><i class="bx bx-image"></i></span>
                                            <input type="file" id="basic-icon-default-email" class="form-control"
                                                placeholder="image" aria-label="image"
                                                aria-describedby="icon-email" />

                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 form-label" for="basic-icon-default-phone">Status</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <span id="icon-phone" class="input-group-text"><i class="bx bx-check"></i></span>
                                            <input type="text" id="basic-icon-default-phone"
                                                class="form-control phone-mask" placeholder="status"
                                                aria-label="status" aria-describedby="icon-phone" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

@endsection
