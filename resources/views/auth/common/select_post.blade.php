<div class="modal fade" id="selectPostModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">{{ trans('auth.banners.select_post_title') }}</h4>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      		<div class="col-md-12">
                <div class="form-group has-feedback">
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                  <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Lọc theo tựa đề" />
                  </div>
                </div>
             </div>
      	</div>
      	<div style="width:100%; height:300px; overflow:auto;">
            <table id="table_select_post" class="table table-bordered">
            	<thead>
            		<tr>
            			<th></th>
            			<th>ID</th>
            			<th>Tựa đề</th>
            			<th>URL</th>
            		</tr>
            	</thead>
            	<tbody>
            	</tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="select_post">{{ trans('auth.button.select') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  <input type="hidden" id="data_select_post" value="" />
</div>
