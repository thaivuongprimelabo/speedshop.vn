@extends('layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    {{ trans('auth.' . $name . '.list_title') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">{{ trans('auth.' . $name . '.list_title') }}</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-md-12">
        	<div class="box box-primary">
        		<div class="box-header with-border">
                  	<h3 class="box-title">Tỉnh thành phố</h3>
                </div>
                <div class="box-body">
                	<div style="height:400px; overflow-x:hidden; overflow-y:auto;">
            			<table class="table table-hover table-bordered" style=" table-layout: fixed; word-wrap:break-word;">
            				<thead>
            					<tr>
            						<col width="5%">
            						<col width="45%">
            						<col width="45%">
            						<col width="5%">
            						<th>#</th>
            						<th>Tên tỉnh thành/quận huyện</th>
            						<th>Tiền ship</th>
            						<th></th>
            					</tr>
            				</thead>
            				<tbody>
            					@foreach($cities as $key=>$city)
            					<tr>
            						<td>{{ ++$key }}</td>
            						<td>{{ $city->name }}</td>
            						<td>
            							<div class="input-group">
            								<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            								<input type="number" class="form-control" value="{{ $city->ship_fee }}" />
            								<div class="input-group-btn">
            									<button type="button" class="btn btn-primary btn-save" data-id="{{ $city->matp }}" data-tp="true"><i class="fa fa-save fa-fw"></i> Lưu</button>
            									<button type="button" class="btn btn-danger btn-cancel" data-value="{{ $city->ship_fee }}"><i class="fa fa-refresh fa-fw"></i> Hủy</button>
            								</div>
            							</div>
            						</td>
            						<td><button type="button" class="btn btn-primary btn-city" data-id="{{ $city->matp }}"><i class="fa fa-plus"></i></button></td>
            					</tr>
            					@endforeach
            				</tbody>
            			</table>
        			</div>
        		</div>
        	</div>
        </div>
  	</div>
</section>
@endsection

