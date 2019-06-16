<div class="modal fade" id="uploadModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tải tập tin</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post">
        	<input type="hidden" class="form-control" id="id" name="id" value=""/>
              <div class="form-group">
                <label>Tải từ máy tính</label>
                <div class="form-group">
            		<button type="button" id="upload_by_computer" class="btn btn-primary">Chọn file</button>
            	</div>
              </div>
              <div class="form-group">
                <label>Địa chỉ hình ảnh</label>
            	<input type="text" id="upload_by_url" class="form-control" placeholder="URL" />
              </div>
              <div class="form-group">
              	<label>Preview</label>
              	 <a href="javascript:void(0)" class="upload_image">
                  	<img src="" id="preview" />
                  </a>
              </div>
              <div id="error_list">
  
  			  </div>
        </form>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary pull-right" id="select_image">{{ trans('auth.button.select') }}</button>
        <button type="button" class="btn btn-default mr10" data-dismiss="modal">{{ trans('auth.button.close') }}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>