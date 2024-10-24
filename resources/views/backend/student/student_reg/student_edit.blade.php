@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->

        <section class="content">
            <!-- Basic Forms -->
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Student</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col">

                            <form id="studentEditForm" method="post" action="{{ route('update.student.registration', $editData->user_id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $editData->id }}">

                                <!-- 1st Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Student Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required value="{{ $editData['student']['name'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Father's Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="fname" class="form-control" required value="{{ $editData['student']['fname'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mother's Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mname" class="form-control" required value="{{ $editData['student']['mname'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 1st Row -->

                                <!-- 2nd Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mobile Number <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="mobile" class="form-control" required value="{{ $editData['student']['mobile'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Address <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control" required value="{{ $editData['student']['address'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" id="gender" required class="form-control">
                                                    <option value="" selected disabled>Select Gender</option>
                                                    <option value="Male" {{ ($editData['student']['gender'] == 'Male') ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ ($editData['student']['gender'] == 'Female') ? 'selected' : '' }}>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 2nd Row -->

                                <!-- 3rd Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" id="religion" required class="form-control">
                                                    <option value="" selected disabled>Select Religion</option>
                                                    <option value="Islam" {{ ($editData['student']['religion'] == 'Islam') ? 'selected' : '' }}>Islam</option>
                                                    <option value="Hindu" {{ ($editData['student']['religion'] == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                                    <option value="Christian" {{ ($editData['student']['religion'] == 'Christian') ? 'selected' : '' }}>Christian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Birth <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="dob" id="dob" class="form-control" required value="{{ $editData['student']['dob'] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Display Umur -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Umur <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <p id="ageDisplay" style="font-size: 16px; font-weight: bold;">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 3rd Row -->

                                <!-- 4th Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year_id" required class="form-control">
                                                    <option value="" selected disabled>Select Year</option>
                                                    @foreach($years as $year)
                                                    <option value="{{ $year->id }}" {{ ($editData->year_id == $year->id) ? 'selected' : '' }}>
                                                        {{ $year->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class_id" required class="form-control">
                                                    <option value="" selected disabled>Select Class</option>
                                                    @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" {{ ($editData->class_id == $class->id) ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 4th Row -->

                                <!-- 5th Row -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Profile Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" class="form-control" id="image">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="controls">
                                                <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/student_images/'.$editData->image) : url('upload/no_image.jpg') }}" style="width: 100px; height: 100px; border: 1px solid #000;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End 5th Row -->

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info mb-5" value="Update">
                                </div>
                            </form>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Untuk menampilkan gambar yang dipilih
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // Menghitung umur dinamis setelah tanggal lahir diubah
        $('#dob').on('change', function() {
            var dob = $(this).val(); // Ambil nilai tanggal lahir
            if (dob) {
                var dobDate = new Date(dob);
                var today = new Date();
                var age = today.getFullYear() - dobDate.getFullYear();

                // Periksa jika bulan atau tanggal belum tercapai untuk tahun ini
                var monthDifference = today.getMonth() - dobDate.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
                    age--;
                }

                // Tampilkan umur
                if (age >= 0) {
                    $('#ageDisplay').text(age + ' tahun');
                } else {
                    $('#ageDisplay').text('0 tahun');
                }
            } else {
                $('#ageDisplay').text('-'); // Reset jika tidak ada tanggal yang dipilih
            }
        });

        // Validasi usia sebelum submit form
        $('#studentEditForm').on('submit', function(e) {
            var dob = $('#dob').val(); // Ambil nilai tanggal lahir
            if (dob) {
                var dobDate = new Date(dob);
                var today = new Date();
                var age = today.getFullYear() - dobDate.getFullYear();

                // Periksa jika bulan atau tanggal belum tercapai untuk tahun ini
                var monthDifference = today.getMonth() - dobDate.getMonth();
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
                    age--;
                }

                // Jika usia kurang dari 10 tahun
                if (age < 10) {
                    e.preventDefault(); // Cegah submit form
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: ` umur anda adalah ${age} tahun, Umur Minimal adalah 10 tahun`,
                    });
                }
            }
        });
    });
</script>

@endsection
