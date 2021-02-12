@extends('layouts.master')
@section('css')
        @toastr_css
@section('title')
    {{ trans('Grades_trans.title_page') }}
@stop
@endsection
@section('page-header')


<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">  {{ trans('translat.Grads') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('Grades_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('translat.Grads') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
  <div class="row">

      <div class="col-xl-12 mb-30">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




        <div class="card card-statistics h-100">
          <div class="card-body">
            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('Grades_trans.add_Grade') }}
            </button>
            <div class="table-responsive">
            <table id="datatable" class="table table-striped table-bordered p-0">
              <thead>
                  <tr>
                    <th>#</th>
                      <th>{{trans('Grades_trans.Name')}}</th>
                      <th>{{ trans('Grades_trans.Notes') }}</th>
                      <th>{{ trans('Grades_trans.Processes') }}</th>

                  </tr>
              </thead>
              <tbody>
                   <?php $i = 0; ?>
                        @foreach ($Grades as $Grade)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>
                                <td>{{ $Grade->Name }}</td>
                                <td>{{ $Grade->Notes }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Grade->id }}"
                                        title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm remove" data-toggle="modal"
                                        data-target="{{ $Grade->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>



<div class="modal fade" id="edit{{ $Grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Grades_trans.edit_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Grades.update','test') }}" method="POST">
                    {{ method_field('patch') }}
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control" value="{{ $Grade->getTranslation('Name','ar') }}">
                                                        <input id="id" type="hidden" name="id" class="form-control" value="{{ $Grade->id }}">

                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="Name_en"   value="{{ $Grade->getTranslation('Name','en') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3"> {{ $Grade->Notes }}</textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>




                                @endforeach



           </table>
          </div>
          </div>
        </div>
      </div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Grades_trans.add_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Grades.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                :</label>
                            <input id="Name" type="text" name="Name" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                :</label>
                            <input type="text" class="form-control" name="Name_en">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                            :</label>
                        <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                            rows="3"></textarea>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
            </div>
            </form>

        </div>
    </div>
</div>


  </div>
<!-- row closed -->
@endsection
@section('js')
   @toastr_js
    @toastr_render

   <script>

$('.remove').click(function(){
    var id =$(this).data('target')
    swal({
      title:" {{ trans('massege.title') }}",
      text: "{{ trans('massege.text') }}",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: "{{ trans('massege.confirmButton') }}",
      cancelButtonText: "{{ trans('massege.cancelButton') }}",

    }).then((result) => {

        if (result.value) {
           window.location='{{ route('Grades.delete')}}/'+id

      }
    })
})










   </script>
@endsection

