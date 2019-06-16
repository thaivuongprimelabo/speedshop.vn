var callAjax = function(url, data, button) {
	var output = {};
	$.ajax({
	    url: url,
	    type: data.type,
	    data: data,
	    async: data.async,
	    beforeSend: function() {
	    	if(button !== undefined) {
	    		button.button('loading');
	    	}
	    	for(var id in data.container) {
	    		var con = $(data.container[id]);
	    		if(data.container[id] == data.spinner) {
	    			con.html(spinner());
	    		}
	    	}
	    	
	    },
	    headers: {
	    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    },
	    success: function (res, textStatus, xhr) {
	    	if(xhr.status === 200) {
	    		for(var id in data.container) {
	    			var div = data.container[id];
	    			if(res.hasOwnProperty(div)) {
	    				if(data.hasOwnProperty('dialog')) {
	    					$(data.dialog).modal();
	    				}
	    				
	    				if(res.hasOwnProperty('.cartCount2') && res['.cartCount2'] === 0) {
	    					$(data.checkout_btn).hide();
	    				}
	    				
	    				$(div).html(res[data.container[id]]).show();
	    				if(div === '#ajax_list' || div === '#contact_success' || div === '#contact_error') {
	    					$('html, body').animate({scrollTop: ($(div).offset().top - 200)}, '2000');
	    				}
	    				
	    			}
	    			
	    			if(res.hasOwnProperty('checkout_result') && res.checkout_result === true) {
    					window.location = data.checkout_success_url;
    				}
	    		}
	    		
	    		if(button !== undefined) {
		    		button.button('reset');
		    	}
	    		
	    	} else {
	    		
	    	}
	    }
	});

	return output;
}

var refreshCaptcha = function(url) {
	var data = {
		type : 'post',
		async : true,
		container: ['#captcha_img']
	}
	callAjax(url, data);
}

var spinner = function() {
	return "<div class='a-center'><i class='fa fa-circle-o-notch fa-spin'></i></a>";
}

var addItem = function(url, item, qty) {
	var item = JSON.parse(item);
	item['qty'] = qty !== undefined ? qty : 1;
	var data = {
		type : 'post',
		async : false,
		item: item		
	}
	var output = callAjax(url, data, 'add-item');
	$('#top-cart').html(output.top_cart);
	
}

var removeItem = function(url, id) {
	var data = {
		type : 'post',
		async : false,
		id: id		
	}
	var output = callAjax(url, data, 'remove-item');
	console.log(output);
	if(output.code === 404) {
		window.location = '/';
	}
	$('#top-cart').html(output.top_cart);
	$('#main-cart').html(output.main_cart);
}

var updateItem = function(url) {
	var qty = $('.input');
	var items = [];
	for(var i = 0; i < qty.length; i++) {
		if(qty[i].value !== '') {
			var item = {id: $(qty[i]).attr('data-id'), qty: $(qty[i]).val()};
			items.push(item)
		}
	}
	
	var data = {
		type : 'post',
		async : false,
		items: items		
	}
	var output = callAjax(url, data, 'update-item');
	$('#top-cart').html(output.top_cart);
	$('#main-cart').html(output.main_cart);
}

var checkout = function(url) {
	var data = {
		type : 'post',
		async : false,
		checkout: {
			customer_name: $('input[name="name"]').val(),
			customer_email: $('input[name="email"]').val(),
			customer_address: $('input[name="address"]').val(),
			customer_phone: $('input[name="tel"]').val(),
			payment_method: $('input[name="payments"]:checked').val()
		}		
	}
	
	var output = callAjax(url, data, 'checkout');
	if(output.order_id) {
		$('#checkout-success').show();
		$('#cart').hide();
	}
}


var loadProducts = function(url, data) {
	var output = callAjax(url, data, data.page);
	if(output.code === 200) {
		$(data.container).html(output.data);
		$(data.paging).html(output.paging);
		if(data.hasOwnProperty('widget')) {
			$(data.widget).html(output.widget);
		}
	}
}

var checkCaptcha = function(url, data) {
	var output = callAjax(url, data, data.page);
	if(output.code === 200) {
		if(output.data !== '') {
			$(data.container).show();
			$(data.container).html(output.data);
			$(data.new_captcha).html(output.new_captcha);
			return false;
		}
	}
	
	return true;
}

var formatCurrency = function (nStr, decSeperate, groupSeperate) {
  	if(nStr == null) {
  		return '0 ' + Constants.CURRENCY;
  	}
  	nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2 + 'đ';
}

