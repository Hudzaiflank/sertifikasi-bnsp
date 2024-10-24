@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
    <div class="container-full">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    <div class="box bb-3 border-warning">
                        <div class="box-header">
                            <h4 class="box-title">Student <strong>Search</strong></h4>
                        </div>

                        <div class="box-body">

                            <form method="GET" action="{{ route('student.year.class.wise') }}">

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Year <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <select name="year_id" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Year</option>
                                                    @foreach($years as $year)
                                                    <option value="{{ $year->id }}" {{ (@$year_id == $year->id) ? "selected" : "" }}>
                                                        {{ $year->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class <span class="text-danger"> </span></h5>
                                            <div class="controls">
                                                <select name="class_id" required="" class="form-control">
                                                    <option value="" selected="" disabled="">Select Class</option>
                                                    @foreach($classes as $class)
                                                    <option value="{{ $class->id }}" {{ (@$class_id == $class->id) ? "selected" : "" }}>
                                                        {{ $class->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4" style="padding-top: 25px;">
                                        <input type="submit" class="btn btn-rounded btn-dark mb-5" name="search"
                                            value="Search">
                                    </div>

                                </div><!-- end row -->

                            </form>

                        </div>
                    </div>
                </div> <!-- end first col 12 -->

                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student List</h3>
                            <a href="{{ route('student.registration.add') }}" style="float: right;"
                                class="btn btn-rounded btn-success mb-5"> Add Student </a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">SL</th>
                                            <th>Name</th>
                                            <th>NIM</th>
                                            <th>Year</th>
                                            <th>Class</th>
                                            <th>Image</th>
                                            @if(Auth::user()->role == "Admin")
                                            <th width="25%">Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allData as $key => $value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            
                                            <!-- Menggunakan optional() untuk mencegah akses null -->
                                            <td>{{ optional($value->student)->name }}</td>
                                            <td>{{ optional($value->student)->id_no }}</td>
                                            <td>{{ optional($value->studentYear)->name }}</td>
                                            <td>{{ optional($value->studentClass)->name }}</td>
                                    
                                            <td>
                                                <img id="showImage" src="{{ (!empty($value->image)) ? url('upload/student_images/'.$value->image) : url('upload/no_image.jpg') }}" style="width: 100px; height: 100px;">

                                            </td>
                                    
                                            <td>
                                                <!-- Memastikan bahwa $value->student->id diakses dengan benar -->
                                                <a title="Edit" href="{{ route('student.registration.edit', optional($value->student)->id) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                
                                                <a title="Delete" href="{{ route('student.registration.delete', optional($value->student)->id) }}" class="btn btn-danger" id="delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
</div>

@endsection

@section('scripts')
<!-- SweetAlert for delete confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var link = $(this).attr("href");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            });
        });
    });
</script>
@endsection
