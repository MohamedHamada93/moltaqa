@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="m-0" style="display: inline;">قائمة السائقين </h5>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary" style="float: left;">
                    إضافة سائق 
                     <i class="fas fa-plus"></i>
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                  <th>الإسم</th>
                  <th>البريد الإلكتروني</th>
                  <th>الجوال</th>
                  <th>التاريخ</th>
                  <th>التحكم</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $d)
                    <tr>
                      <td>{{$d->name}}</td>
                      <td>{{$d->email}}</td>
                      <td>{{$d->phone}}</td>
                      <td> <span class="badge badge-success">{{Date::parse($d->created_at)->diffForHumans()}}</span></td>
                      <td style="line-height: 65px">
                        <a href       = "" 
                        class         = "btn btn-info btn-sm edit"
                        data-toggle   = "modal"
                        data-target   = "#modal-update"
                        data-id       = "{{$d->id}}"
                        data-name     = "{{$d->name}}"
                        data-phone    = "{{$d->phone}}"
                        data-email    = "{{$d->email}}"
                        data-lat      = "{{$d->lat}}"
                        data-lng      = "{{$d->lng}}"
                        data-address  = "{{$d->address}}"
                        > <i class="fas fa-edit"></i></a>
                        <a href="{{ route('deletedriver',$d->id) }}"  class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>

      {{-- add area modal --}}
      <div class="modal fade" id="modal-primary">
        <div class="modal-dialog">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h4 class="modal-title">إضافة سائق </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('storedriver') }}" enctype='multipart/form-data' method="post">
                {{csrf_field()}}
                <div class="row">

                  <div class="col-sm-12">
                    <label>الإسم </label> <span class="text-danger">*</span>
                    <input type="text" name="name" class="form-control" placeholder=" الإسم  " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                  <div class="col-sm-12">
                    <label>الجوال </label> <span class="text-danger">*</span>
                    <input type="text" name="phone" class="form-control" placeholder=" الجوال  " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                  <div class="col-sm-12">
                    <label>البريد الإلكتروني </label> <span class="text-danger">*</span>
                    <input type="text" name="email" class="form-control" placeholder=" البريد الإلكتروني  " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                  <div class="col-sm-6">
                    <label>lat </label> <span class="text-danger">*</span>
                    <input type="text" name="lat" class="form-control" placeholder="lat " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                  <div class="col-sm-6">
                    <label>lng </label> <span class="text-danger">*</span>
                    <input type="text" name="lng" class="form-control" placeholder="lng " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                  <div class="col-sm-12">
                    <label>العنوان</label> <span class="text-danger">*</span>
                    <input type="text" name="address" class="form-control" placeholder="العنوان " required="" maxlength="190" style="margin-bottom: 10px">
                  </div>

                </div>
                <button type="submit" id="submit" style="display: none;"></button>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light save">حفظ</button>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
            </div>
          </div>
        </div>
      </div>

      {{-- update area modal --}}
      <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">تعديل سائق : <span class="item_name"></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('updatedriver') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="edit_id" value="">
                    <div class="row">

                      <div class="col-sm-12">
                        <label>الإسم </label> <span class="text-danger">*</span>
                        <input type="text" name="edit_name" class="form-control" placeholder=" الإسم  " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                      <div class="col-sm-12">
                        <label>الجوال </label> <span class="text-danger">*</span>
                        <input type="text" name="edit_phone" class="form-control" placeholder=" الجوال  " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                      <div class="col-sm-12">
                        <label>البريد الإلكتروني </label> <span class="text-danger">*</span>
                        <input type="text" name="edit_email" class="form-control" placeholder=" البريد الإلكتروني  " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                      <div class="col-sm-6">
                        <label>lat </label> <span class="text-danger">*</span>
                        <input type="text" name="edit_lat" class="form-control" placeholder="lat " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                      <div class="col-sm-6">
                        <label>lng </label> <span class="text-danger">*</span>
                        <input type="text" name="edit_lng" class="form-control" placeholder="lng " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                      <div class="col-sm-12">
                        <label>العنوان</label> <span class="text-danger">*</span>
                        <input type="text" name="edit_address" class="form-control" placeholder="العنوان " required="" maxlength="190" style="margin-bottom: 10px">
                      </div>
    
                    </div>

                    <button type="submit" id="update" style="display: none;"></button>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light update">تحديث</button>
              <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection

@section('script')
<script type="text/javascript">

  $('.save').on('click',function(){
    $('#submit').click();
  })

  $('.edit').on('click',function(){
      var id        = $(this).data('id')
      var name      = $(this).data('name')
      var phone     = $(this).data('phone')
      var email     = $(this).data('email')
      var lat       = $(this).data('lat')
      var lng       = $(this).data('lng')
      var address   = $(this).data('address')
    
      $('.item_name')                   .text(name)
      $("input[name='edit_id']")        .val(id)
      $("input[name='edit_name']")      .val(name)
      $("input[name='edit_phone']")     .val(phone)
      $("input[name='edit_email']")     .val(email)
      $("input[name='edit_lat']")       .val(lat)
      $("input[name='edit_lng']")       .val(lng)
      $("input[name='edit_address']")   .val(address)
  })

  $('.update').on('click',function(){
    $('#update').click();
  })
</script>
@endsection

