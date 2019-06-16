<div class="modal fade" id="serviceModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{ trans('auth.button.add_service') }}</h4>
      </div>
      <div class="modal-body">
        <form id="add_form" role="form" method="post">
        	<input type="hidden" class="form-control" id="id" name="id" value=""/>
              <div class="form-group">
              	<div class="input-group">
              		<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
            		<input type="text" class="form-control" id="service_name" name="service_name" value="" placeholder="Vui lòng nhập tên dịch vụ" />
            	</div>
              </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="service_submit">{{ trans('auth.button.create') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div id="clone" style="display: none;">
@include('auth.products.details')
</div>