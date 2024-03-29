@extends('admin.layout.main')
@include('admin.layout.table')
@section('content')
<div class="content-wrapper" style="min-height: 1345.31px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="{{ route('admin.index') }}" class="btn btn-lm btn-success float-left">
            <i class="fas fa-list-alt mr-2"></i>
            Danh sách
          </a>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
            <li class="breadcrumb-item active">User Admin</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Thêm mới user</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div class="card-body">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name=" name" id="name"
                    value="{{ old('name') }}" placeholder="Enter full name">
                  @error('name')
                  <span id="name" class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label for="name">Gender</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                        <div class="form-check">
                          <input {{ (old('gender')==0) ? 'checked' : '' }} value="0" id="female"
                            class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender"
                            checked>
                          <label for="female" class="form-check-label">Female</label>
                          @error('gender')
                          <span id="name" class="error invalid-feedback">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-check">
                        <input {{ (old('gender')==1) ? 'checked' : '' }} value="1" id="male" class="form-check-input"
                          type="radio" name="gender">
                        <label for="male" class="form-check-label">Male</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                    value="{{ old('email') }}" placeholder="Enter email">
                  @error('email')
                  <span id="email" class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone"
                    value="{{ old('phone') }}" placeholder="Enter phone">
                  @error('phone')
                  <span id="phone" class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="password" placeholder="Enter password">
                  @error('password')
                  <span id="password" class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input {{ (old('isActive')==1) ? '' : 'checked' }} class="custom-control-input" type="checkbox"
                      id="isActive" value="1">
                    <label for="isActive" class="custom-control-label">Active</label>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
          <!-- /.card -->
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- Form Element sizes -->
            <div class="card card-success">
              <div class="card-body">
                <div class="form-group">
                  <label for="birthday">Birthday</label>
                  <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Enter phone">
                </div>
                <div class="form-group">
                  <label for="avatar">Avatar</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input name="avatar" type="file" class="custom-file-input" id="avatar">
                      <label class="custom-file-label" for="avatar">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div>
                  </div>
                </div>
                <div id="preview"></div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea class="form-control" id="address" name="address" rows="3"
                    placeholder="Enter address"></textarea>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label for="city">City</label>
                      <select id="city" name="idCity" class="form-control">
                        <option value="">---Chọn Tỉnh/Thành---</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="district">District</label>
                      <select id="district" name="idDistrict" class="form-control">
                        <option value="">---Chọn Quận/Huyện---</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ward">Ward</label>
                  <select id="ward" name="idWard" class="form-control">
                    <option value="">---Chọn Xã/Phường---</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
      </form>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@push('script')
<script>
  getAddress('avatar', '');
  preview('preview')
</script>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
<script>
  toastMessageSuccess("{{ Session::get('message') }}")
</script>
@endif
@endpush