<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(!Utils::blank($config['web_ico']))
    <link rel="shortcut icon" href="{{ $config['web_ico'] . '?t=' . time() }}">
    @endif

    <title>{{ trans('auth.title') }}</title>

    <!-- Styles -->
    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{ url('admin/plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('admin/plugins/iCheck/square/blue.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('admin/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  
  <link rel="stylesheet" href="{{ url('admin/dist/css/skins/_all-skins.min.css') }}">
  
  <link rel="stylesheet" href="{{ url('admin/css/custom-styles.css') }}">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .nopadding {
       padding: 0 !important;
       margin: 0 !important;
    }
    .thumb{
      margin-bottom: 4px;
      margin-right:4px;
    }
    .selected {
        background: #f0f0f0;
        display: inline-block;
    }
    .add_image, .upload_image {
        display:table-cell;
        background: #f0f0f0;
        text-align: center;
        vertical-align: middle;
    }
    
    .add_image i, .upload_image i {
        font-size: 36px;
    }
    
    .image_product {
        position: relative;
        margin: 5px;
    }
    
    .image_product:hover .remove {
        display: block;
    }
    
    .image_product .remove {
        position: absolute;
        top: 4px;
        right: 4px;
        font-size: 18px;
        display: none;
    }
  </style>
</head>
@if(Auth::guest())
<body class="hold-transition login-page">
@yield('content')
@else
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">
          	<b>C</b>P
          </span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{{ trans('auth.title') }}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
    
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ Auth::user()->getAvatar() }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ Auth::user()->getAvatar() }}" class="img-circle" alt="User Image">
    
                    <p>
                      {{ Auth::user()->name }}
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ route('auth_profile') }}" class="btn btn-default btn-flat">{{ trans('auth.button.profile') }}</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat">{{ trans('auth.button.logout') }}</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
  	</header>
  	@include('auth.common.sidebar')

   	<div class="content-wrapper">
	@yield('content')
	</div>
	
	<footer class="main-footer">
        Copyright &copy; {{ date('Y') }}. All rights
        reserved.
    </footer>
    @include('auth.common.alert')
    @include('auth.products.add_service_modal')
    @include('auth.common.select_post')
</div>
@endif
<!-- jQuery 3 -->
<script src="{{ url('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('admin/plugins/iCheck/icheck.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ url('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ url('admin/bower_components/moment/min/moment.min.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ url('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ url('admin/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ url('admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('admin/dist/js/demo.js') }}"></script>
<!-- CK Editor -->
<script src="{{ url('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('admin/js/jquery.validate.js') }}" type="text/javascript"></script>
<script src="{{ url('js/custom.js?t=' . time()) }}"></script>
<script>
  $(function () {
	if($('.alert').length > 0) {
    	setTimeout(function(){ 
    		$('.alert').fadeOut();
    	}, 3000);
	}

	@if(isset($editor))
		$('.fckeditor').each(function(e){
			var editor = $(this).attr('data-editor');
			var height = $(this).attr('data-height');
			if(editor === 'small') {
	        	CKEDITOR.replace( this.id, {height: height, customConfig: '{{ url('admin/js/editor.small.js') }}' });
			} else {
				CKEDITOR.replace( this.id, {
			        filebrowserBrowseUrl : '{{ asset('/kcfinder/browse.php?opener:ckeditor&type:files') }}',
			        filebrowserImageBrowseUrl : '{{ asset('/kcfinder/browse.php?opener:ckeditor&type:images') }}',
			        filebrowserFlashBrowseUrl : '{{ asset('/kcfinder/browse.php?opener:ckeditor&type:flash') }}',
			        filebrowserUploadUrl : '{{ asset('/kcfinder/upload.php?opener:ckeditor&type:files') }}',
			        filebrowserImageUploadUrl : '{{ asset('/kcfinder/upload.php?opener:ckeditor&type:images') }}',
			        filebrowserFlashUploadUrl : '{{ asset('/kcfinder/upload.php?opener:ckeditor&type:flash') }}',
					height: height, 
					customConfig: '{{ url('admin/js/editor.full.js') }}' });
			}
	    });
	@endif

	//Date picker
    $('#datepicker').datepicker({
      	autoclose: true,
      	format: 'dd/mm/yyyy'
    })
    
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    $('.sidebar-menu').tree();

	$(document).on('click', '.page_number', function(e) {
		var page = $(this).attr('data-page');
		search(page);
	});

	$(document).on('click', '#search', function(e) {
		search(1);
	});

	$(document).on('click', '.edit', function(e) {
			var url = $(this).attr('data-url');
			window.location = url;
	});

	$(document).on('click', '.remove-row', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			var url = $(this).attr('data-url');
			var id = $(this).attr('data-id');
			var ids = [id];
			deleteManyRow(url, ids);
			return true;
		}
		return false;
	});

	$(document).on('click', '.update-status', function(e) {
		var table = $(this).attr('data-key');
		var data = {
			type : 'post',
			async : false,
			id : $(this).attr('data-id'),
			current_status: $(this).attr('data-status'),
			table: table
		}

		var res = callAjax('{{ route('update_status') }}', data, 'update_status');
		$(this).attr('data-status', res.status);
		if(res.status === '1') {
			$(this).find('span').attr('class', 'label label-success');
		} else {
			$(this).find('span').attr('class', 'label label-danger');
		}
		$(this).find('span').html(res.text);
	});


	$('input#check_all').on('ifChecked', function(event){
		$('input[name="check_remove"]').prop('checked', true);
		$('input[name="check_remove"]').parent().addClass('checked');
	});

	$('input#check_all').on('ifUnchecked', function(event){
		$('input[name="check_remove"]').prop('checked', false);
		$('input[name="check_remove"]').parent().removeClass('checked');
	});

    $('button[type="submit"]').click(function(e) {
		$('form').submit();
    });

    $('#save, #save_user').click(function(e) {
        $(this).button('loading');
    	if($("#submit_form").valid()) {

        	var col = 'name';
        	if($(this).attr('id') === 'save_user') {
				col = 'email';
        	}

        	if($('#' + col).length > 0) {
            	var input = {
            	   	value: $('#' + col).val().trim(),
        			col : col,
        			itemName : $('#' + col).attr('placeholder'),
        			url: '{{ route('check_exists') }}',
        			id_check: $(this).attr('data-id'),
        			table: '{{ isset($name) ? $name : '' }}',
        		};
            	checkExist(input);
        	} else {
        		$("#submit_form").submit();
        	}
    	} else {
    		$('html, body').animate({scrollTop: ($('#submit_form').offset().top - 200)}, '2000');
    		$(this).button('reset');
    	}
    });

    $('#selectPostModal').on('show.bs.modal', function (event) {
		$.get('{{ route('getSelectPost') }}', function(res) {
			var tbody = '';
			for(var i in res) {
				tbody += '<tr>';
				tbody += '<td><input type="radio" name="select_post" value="' + res[i].link + '" /></td>';
				tbody += '<td>' + res[i].id + '</td>';
				tbody += '<td>' + res[i].name + '</td>';
				tbody += '<td>' + res[i].link + '</td>';
				tbody += '</tr>';
			}

			$('#table_select_post').find('tbody').html(tbody);
			$('#data_select_post').val(JSON.stringify(res));
		});
    });

    $('#selectPostModal #search_name').keyup(function(e) {
		var res = JSON.parse($('#data_select_post').val());
		res = res.filter((record) => {
			var value = $(this).val().toLowerCase();
            return record.name.indexOf(value) !== -1 || record.name_url.indexOf(value) !== -1;
        });

		var tbody = '';
		for(var i in res) {
			tbody += '<tr>';
			tbody += '<td><input type="radio" name="select_post" value="' + res[i].link + '" /></td>';
			tbody += '<td>' + res[i].id + '</td>';
			tbody += '<td>' + res[i].name + '</td>';
			tbody += '<td>' + res[i].link + '</td>';
			tbody += '</tr>';
		}

		$('#table_select_post').find('tbody').html(tbody);
    });

    $('#select_post').click(function(e) {
		$('input[name="select_post"]').each(function(index, item) {
			if(item.checked) {
				$('#link').val(item.value);
			}
		});
		$('#selectPostModal').modal('hide');
    });

    $('input.select_type').on('ifChecked', function(event){
    	var className = $(this).val();
    	$('.select_type').addClass('hide_element');
    	$('.' + className).removeClass('hide_element');
	});

    $(document).on('blur', '#youtube_id', function(e) {
        var id = getLinkYoutubeId($(this).val());
        var iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + id + '" frameborder="0" allowfullscreen></iframe>';
        $('#youtube_embed_url').val(id);
        $('#youtube_preview').html(iframe);
	});

	$(document).on('keyup', '#price', function(e) {
		$('#format_currency strong small i').html(formatCurrency($(this).val(), '.', '.'));

		var price = Number($(this).val());
		var discount = Number($('#discount').val());
		if(discount && price) {
			var discount_money = price - (price * (discount / 100));
			$('#format_discount strong small i').html(formatCurrency(discount_money, '.', '.'));
		}
	});

	$(document).on('mouseup keyup', '#discount', function(e) {
		var price = Number($('#price').val());
		var discount = Number($(this).val());
		if(discount && price) {
			var discount_money = price - (price * (discount / 100));
			$('#format_discount strong small i').html(formatCurrency(discount_money, '.', '.'));
		}
	});

	$(document).on('click', '.img-wrapper', function(e) {
		var filename = $(this).attr('data-filename');
		$('.img-wrapper').find('.fa-check').remove();
		var html = '<i class="fa fa-check" aria-hidden="true" style="position:absolute; top:15px; left:15px; font-size:30px; color:#31a231"></i>';
		$(this).prepend(html);
		$('#is_main').val(filename);
	});

	$(document).on('click', '.remove-img', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			var filename = $(this).attr('data-filename');
			$(this).parent().remove();
			var id = $(this).attr('data-id');
			var hidden = '';
			if(id) {
				hidden = '<input type="hidden" name="images_del[]" value="' +  id + '" />';
			}
			$('#preview_list').append(hidden);

			var file_selected = $('#file_selected').val();
			file_selected = file_selected.replace(filename + ',', '');
			$('#file_selected').val(file_selected);
			return true;
		}
		return false;
	});

	$(document).on('click', '.remove-img-simple', function(e) {
		if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
			$(this).parent().parent().find('input[type="file"]').val('');
			$(this).parent().find('.filename_hidden').val('');
			$(this).parent().find('img').attr('src', '{{ Utils::getImageLink(Common::NO_IMAGE_FOUND) }}');
			$(this).remove();
			return true;
		}
		return false;
	});

	$('#add_new_service').click(function(e) {
    	$('#serviceModal').modal();
    });
    $('#serviceModal').on('show.bs.modal', function (event) {
    	$('#service_name').val('');
    });
    $(document).on('click', '.toy-item thead', function(e) {
		var style = $(this).find('tbody').attr('style');
		if(style.length === 0) {
			$(this).find('tbody').fadeOut();
		} else {
			$(this).find('tbody').fadeIn();
		}
	});
    
    $('#service_submit').click(function(e) {
		var service_group_name = $('#service_name').val().trim();
		if(service_group_name.length > 0) {
			var data_index = getMax('.toy-item', 'data-index');
			$('#clone').find('.service-group-name-title').html(service_group_name);
			$('#clone').find('.service-group-name').val(service_group_name);
			$('#clone').find('table').attr('data-index', data_index);
			var clone = $('#clone').html();
			$('#services').append(clone);
		}
		$('#serviceModal').modal('hide');
    });
    
    $(document).on('click', '.add-service-item', function(e) {
    	var parentElement = $(this).parent().parent().parent().parent();
    	var group_index =  parentElement.attr('data-index');
    	var row_index = Number(parentElement.attr('data-row-index')) + 1;
    	var row = 'service[' + group_index + ']';
		var service_group_name_tag = row + '[group_name]';
    	var service_name_tag = row + '[item][' + row_index + '][name]';
        var service_price_tag = row + '[item][' + row_index + '][price]';
        
		var service_item = $('#hidden-item').clone().removeClass('hide_element');
		service_item.find('.service-name').attr('name', service_name_tag);
		service_item.find('.service-price').attr('name', service_price_tag);
		parentElement.find('.service-group-name').attr('name', service_group_name_tag);
		parentElement.attr('data-row-index', row_index);
		service_item.insertBefore(parentElement.find('tr.add-item'));
    });

    $(document).on('click', '.remove-group', function(e) {
		$(this).parent().parent().parent().parent().remove();
    });

    $(document).on('click', '.remove-detail', function(e) {
		$(this).parent().parent().remove();
    });

    $(document).on('change', '.upload-simple', function(e) {
    	checkUploadFile('{{ route('checkUploadFile') }}', $(this));
    });

    $(document).on('change', '.upload-multiple', function(e) {
    	checkUploadFile('{{ route('checkUploadFile') }}', $(this), '{{ trans('validation.image_selected') }}');
    });

    $(document).on('click', '#upload_button', function(e) {
    	var preview_id = $(this).attr('data-preview-control');
    	var limit_upload = $(this).attr('data-limit-upload');
    	var width = $(this).attr('data-width');
  	  	var height = $(this).attr('data-height');
        var control_name = $(this).attr('data-name');
		var upload = document.createElement('input');
		upload.type = "file";
		upload.name = control_name;
		upload.style = "display:none";
		upload.multiple = true;
		upload.className = "upload-multiple";
		upload = $(upload);
		upload.attr('data-preview-control', preview_id);
		upload.attr('data-width', width);
		upload.attr('data-height', height);
		upload.attr('data-limit-upload', limit_upload);
		upload.click();
		$('#preview_list').append(upload);
    });

    $(document).on('ifChecked', '#select_all', function(e) {
		$('.row-delete').iCheck('check');
		$('.row-delete').parent().parent().parent().attr('style', 'background:#f0f0f0');
    });

    $(document).on('ifChecked', '.row-delete', function(e) {
		$(this).parent().parent().parent().attr('style', 'background:#f0f0f0');
    });

    $(document).on('ifUnchecked', '#select_all', function(e) {
		$('.row-delete').iCheck('uncheck');
		$('.row-delete').parent().parent().parent().attr('style', '');
    });

    $(document).on('ifUnchecked', '.row-delete', function(e) {
		$(this).parent().parent().parent().attr('style', '');
    });

    $(document).on('click', '#remove_many', function(e) {
    	if(confirmDelete('{{ trans('messages.CONFIRM_DELETE') }}')) {
        	var url = $(this).attr('data-url');
        	var ids = [];
    		$('.row-delete').each(function(index, item) {
    			if(item.checked) {
    				ids.push(item.value);
    			}
    		});
    		if(ids.length === 0) {
    			errorUploadAlert('Vui lòng chọn ít nhất 1 dòng');
    			return false;
    		}
    		deleteManyRow(url, ids);
			return true;
		}
		return false;
		
    });
    $(document).on('click', '.add-info', function(e) {
    	var input = $(this).prev().find('input').first().clone().val('');
    	$(this).prev().append(input);
		
    });

	$(document).on('click', '.btn-city', function(e) {
		var self = $(this);
		var id = self.attr('data-id');
		if(self.find('i').hasClass('fa-minus')) {
			$('.item' + id).hide();
			self.find('i').removeClass('fa-minus').addClass('fa-plus');
			return false;
		}
		if($('.item' + id).length === 0) {
    		$.get('{{ route('loadDistrict') }}?city_id=' + id + '&json=true', function(res) {
    			if(res.data.length > 0) {
    				var html = '';
        			for(var i in res.data) {
        				html += '<tr class="item' + id + '">';
        				html += '<td>&nbsp;&nbsp;' + res.data[i].maqh + '</td>';
        				html += '<td>|--- ' + res.data[i].name + '</td>';
        				html += '<td>';	
        				html += '<div class="input-group">';
        				html += '	<span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>';
        				html += '	<input type="number" class="form-control" value="' + res.data[i].ship_fee + '" />';
        				html += '	<div class="input-group-btn">';
        				html += '		<button type="button" class="btn btn-primary btn-save"  data-id="' + res.data[i].maqh + '"><i class="fa fa-save fa-fw"></i> Lưu</button>';
        				html += '		<button type="button" class="btn btn-danger  btn-cancel" data-value="' + res.data[i].ship_fee + '"><i class="fa fa-refresh fa-fw"></i> Hủy</button>';
        				html += '	</div>';
        				html += '</div>';
						html += '</td>';
        				html += '</tr>';
        			}
        			$(html).insertAfter(self.parent().parent());
    			}
    		});
    		
		} else {
			$('.item' + id).show();
		}
		self.find('i').removeClass('fa-plus').addClass('fa-minus');
    });

	$(document).on('click', '.btn-save', function(e) {
		var tp = $(this).attr('data-tp');
		var value = $(this).parent().parent().find('input').val();
		var data = {
			type : 'post',
			async : true,
			id : $(this).attr('data-id'),
			ship_fee: value,
		}
		callAjax('{{ route('updateShipFee') }}', data, 'update-ship-fee');

		if(tp) {
			$('.item' + $(this).attr('data-id')).find('input').val(value);
		}
	});

	$(document).on('click', '.btn-cancel', function(e) {
		var value = $(this).attr('data-value');
		$(this).parent().parent().find('input').val(value);
	});
  });
</script>
@yield('script')
</body>

</html>
