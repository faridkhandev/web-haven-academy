/**
 * Global Ajax Options
 */
$(document).ajaxSend(function(event, jqXHR, ajaxOptions) {
	$('#loading').show();
}).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
	
	//console.log(event);
	//console.log(jqXHR);
	//console.log(ajaxSettings);
	//console.log(thrownError);

	if (jqXHR.readyState == 0) {
		//alert('Network connection failed... Please try again!');
	} 	
	else if (jqXHR.readyState != 4) {
		alert('Network connection failed... Please try again!');
	} 	
	else {
		alert("There are some error in server response, if you get similar error again please ask your administrator..!");
		
	}
}).ajaxComplete(function(event, jqXHR, ajaxOptions) {
	$('#loading').hide();
});

function formToJson(form_name, local_storage = false) {
	if (local_storage) {
		var serializeArray = $('form[name=\'' + form_name + '\'] :input').filter(function(index, element) {
			return $.trim($(element).val()) != '';
		}).serializeArray();
		localStorage.setItem(local_storage, JSON.stringify(serializeArray));
	} else {
		return JSON.stringify($('form[name=\'' + form_name + '\']').serializeArray());
	}
}

function JsonToForm(form_name, local_storage = false) {
	var json = JSON.parse(localStorage.getItem(local_storage));
	var arr = {};

	$.each(json, function(key, value) {
		var ctrl = $('form[name=\'' + form_name + '\']').find('[name=\'' + value.name + '\']');
        switch(ctrl.attr('type')) {
            case "radio": case "checkbox":   
                ctrl.each(function() {
                    if ($(this).attr('value') == value.value) $(this).attr("checked", value.value);
                });   
                break;  
            default:
                ctrl.val(value.value); 
        }
        arr[value.name] = value.value;
    });
	
    return arr;
}

function getURLVar(key) {
	var value = [];

	var query = String(document.location).split('?');

	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');

			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}

		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
}

$(document).ready(function() {
	//Form Submit for IE Browser
	$('button[type=\'submit\']').on('click', function() {
		$("form[id*='form-']").submit();
	});

	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent().parent();
		
		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		}
	});
	
	// Set last page opened on the menu
	$('#menu a[href]').on('click', function() {
		sessionStorage.setItem('menu', $(this).attr('href'));
	});

	if (!sessionStorage.getItem('menu')) {
		$('#menu #dashboard').addClass('active');
	} else {
		// Sets active and open to selected page in the left column menu.
		$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active open');
	}

	if (localStorage.getItem('column-left') == 'active') {
		$('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');
		
		$('#column-left').addClass('active');
		
		// Slide Down Menu
		$('#menu li.active').has('ul').children('ul').addClass('collapse in');
		$('#menu li').not('.active').has('ul').children('ul').addClass('collapse');
		$('#menu li').not('.active').has('ul').children('li').children('ul').addClass('collapse in');
	} else {
		$('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');
		
		$('#menu li li.active').has('ul').children('ul').addClass('collapse in');
		$('#menu li li').not('.active').has('ul').children('ul').addClass('collapse in');
		$('#menu li').not('.active').has('ul').children('li').children('ul').addClass('collapse in');
	}

	// Menu button
	$('#button-menu').on('click', function() {
		// Checks if the left column is active or not.
		if ($('#column-left').hasClass('active')) {
			localStorage.setItem('column-left', '');

			$('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

			$('#column-left').removeClass('active');

			$('#menu > li > ul').removeClass('in collapse');
			$('#menu > li > ul').removeAttr('style');
		} else {
			localStorage.setItem('column-left', 'active');

			$('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');
			
			$('#column-left').addClass('active');

			// Add the slide down to open menu items
			$('#menu li.open').has('ul').children('ul').addClass('collapse in');
			$('#menu li').not('.open').has('ul').children('ul').addClass('collapse');
		}
	});

	// Menu
	$('#menu').find('li').has('ul').children('a').on('click', function() {
		if ($('#column-left').hasClass('active')) {
			$(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			$(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		} else if (!$(this).parent().parent().is('#menu')) {
			$(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
			$(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
		}
	});
	
	// Override summernotes image manager
	$('button[data-event=\'showImageDialog\']').attr('data-toggle', 'image').removeAttr('data-event');
	
	$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
		$('#modal-image').remove();
		
		$(this).parents('.note-editor').find('.note-editable').focus();
				
		$.ajax({
			url: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
			dataType: 'html',
			beforeSend: function() {
				$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
				$('#button-image').prop('disabled', true);
			},
			complete: function() {
				$('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
				$('#button-image').prop('disabled', false);
			},
			success: function(html) {
				$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
	
				$('#modal-image').modal('show');
			}
		});	
	});
	
	// Image Manager
	$(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
		e.preventDefault();
		
		$('.popover').popover('hide', function() {
			$('.popover').remove();
		});
					
		var element = this;
		
		$(element).popover({
			html: true,
			placement: 'right',
			trigger: 'manual',
			content: function() {
				return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
			}
		});
		
		$(element).popover('show');

		$('#button-image').on('click', function() {
			$('#modal-image').remove();
		
			$.ajax({
				url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
				dataType: 'html',
				beforeSend: function() {
					$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$('#button-image').prop('disabled', true);
				},
				complete: function() {
					$('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
					$('#button-image').prop('disabled', false);
				},
				success: function(html) {
					$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
		
					$('#modal-image').modal('show');
				}
			});
			
			$(element).popover('hide', function() {
				$('.popover').remove();
			});
		});		
		
		$('#button-clear').on('click', function() {
			$(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
			
			$(element).parent().find('input').attr('value', '');
			
			$(element).popover('hide', function() {
				$('.popover').remove();
			});
		});
	});
	
	// tooltips on hover
	$('[data-toggle=\'tooltip\']').tooltip({container: 'body', html: true});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\']').tooltip({container: 'body'});
	});
	
	// https://github.com/opencart/opencart/issues/2595
	$.event.special.remove = {
		remove: function(o) {
			if (o.handler) { 
				o.handler.apply(this, arguments);
			}
		}
	}
	
	$('[data-toggle=\'tooltip\']').on('remove', function() {
		$(this).tooltip('destroy');
	});	
});

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			this.timer = null;
			this.items = new Array();
	
			$.extend(this, option);
	
			$(this).attr('autocomplete', 'off');
			
			// Focus
			$(this).on('focus', function() {
				this.request();
			});
			
			// Blur
			$(this).on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);				
			});
			
			// Keydown
			$(this).on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					default:
						this.request();
						break;
				}				
			});
			
			// Click
			this.click = function(event) {
				event.preventDefault();
	
				value = $(event.target).parent().attr('data-value');
	
				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}
			
			// Show
			this.show = function() {
				var pos = $(this).position();
	
				$(this).siblings('ul.dropdown-menu').css({
					top: pos.top + $(this).outerHeight(),
					left: pos.left
				});
	
				$(this).siblings('ul.dropdown-menu').show();
			}
			
			// Hide
			this.hide = function() {
				$(this).siblings('ul.dropdown-menu').hide();
			}		
			
			// Request
			this.request = function() {
				clearTimeout(this.timer);
		
				this.timer = setTimeout(function(object) {
					object.source($(object).val(), $.proxy(object.response, object));
				}, 200, this);
			}
			
			// Response
			this.response = function(json) {
				html = '';
	
				if (json.length) {
					for (i = 0; i < json.length; i++) {
						this.items[json[i]['value']] = json[i];
					}
	
					for (i = 0; i < json.length; i++) {
						if (!json[i]['category']) {
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						}
					}
	
					// Get all the ones with a categories
					var category = new Array();
	
					for (i = 0; i < json.length; i++) {
						if (json[i]['category']) {
							if (!category[json[i]['category']]) {
								category[json[i]['category']] = new Array();
								category[json[i]['category']]['name'] = json[i]['category'];
								category[json[i]['category']]['item'] = new Array();
							}
	
							category[json[i]['category']]['item'].push(json[i]);
						}
					}
	
					for (i in category) {
						html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';
	
						for (j = 0; j < category[i]['item'].length; j++) {
							html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
						}
					}
				}
	
				if (html) {
					this.show();
				} else {
					this.hide();
				}
	
				$(this).siblings('ul.dropdown-menu').html(html);
			}
			
			$(this).after('<ul class="dropdown-menu"></ul>');
			$(this).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));	
			
		});
	}
})(window.jQuery);

// Datatable
$.extend( true, $.fn.dataTable.defaults, {
	"lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
	"processing": false,
	oLanguage: {sProcessing: ''},
    "drawCallback": function () {
        $('.dataTables_paginate > .pagination').addClass('pagination-sm');
    },
	"fnInitComplete": function(){
		this.fnAdjustColumnSizing(true);   
	},
});

$.fn.datetimepicker.defaults.icons = {
    time: 'fa fa-clock-o',
    date: 'fa fa-calendar',
    up: 'fa fa-chevron-up',
    down: 'fa fa-chevron-down',
    previous: 'fa fa-chevron-left',
    next: 'fa fa-chevron-right',
    today: 'fa fa-dot-circle-o',
    clear: 'fa fa-trash',
    close: 'fa fa-times'
};
function checkbox(data) {
	return '<input type="checkbox" name="selected[]" value="' + data + '">';
}

function freightType(data) {
	if (data == '1') {
		return 'Air';
	} else if (data == '2') {
		return 'Sea';
	} else if (data == '3') {
		return 'Courier';
	} else {
		return '-';
	}
}

function chargeType(data) {
	if (data == '1') {
		return 'Fixed';
	} else if (data == '2') {
		return 'Percentage';
	} else {
		return '-';
	}
}

function status(data) {
	if (data == '1') {
		return '<span class="label label-success">Enabled</span>';
	} else if (data == '0') {
		return '<span class="label label-danger">Disabled</span>';
	} else {
		return '<span class="label label-danger">Trash</span>';
	}
}

function publishingStatus(data,sWidth='100') {
	
	sWidth=(sWidth=='enq')?80:100;
	var style=' style="width: '+sWidth+'%;display: block;float:left;"';
	var styleSubMit=' style="width: '+sWidth+'%;display: block;float:left;background-color:#9040f7"';
	switch (data) {
		
		case 'DRAFT':	return '<span class="label label-default"'+style+'>DRAFT</span>'; break;
		case 'REQUEST':	return '<span class="label label-warning"'+style+'>REQUEST</span>'; break;
		case 'APPROVE':	return '<span class="label label-info"'+style+'>APPROVE</span>'; break;
		case 'PUBLISH':	return '<span class="label label-primary"'+style+'>PUBLISH</span>'; break;
		case 'SUBMITTED':return '<span class="label" '+styleSubMit+'>SUBMITTED</span>'; break;
		case 'HOLD':	return '<span class="label label-danger"'+style+'>HOLD</span>'; break;
		case 'CANCEL':	return '<span class="label label-danger"'+style+'>CANCEL</span>'; break;
		case 'AWARDED':	return '<span class="label label-success"'+style+'>AWARDED</span>'; break;
		default: '<span class="label"'+style+'>'+data+'</span>';
	}
}

function pingServer() {
	$.ajax({
		url: 'index.php?route=common/login/pingServer&token=' + getURLVar('token'),
		dataType: 'json',
		success: function(response) {
			if (response.status) {
				window.location.replace(response.url);
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

function invertColor(hex, bw) {
    if (hex.indexOf('#') === 0) {
        hex = hex.slice(1);
    }
    // convert 3-digit hex to 6-digits.
    if (hex.length === 3) {
        hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
    }
    if (hex.length !== 6) {
        throw new Error('Invalid HEX color.');
    }
    var r = parseInt(hex.slice(0, 2), 16),
        g = parseInt(hex.slice(2, 4), 16),
        b = parseInt(hex.slice(4, 6), 16);
    if (bw) {
        // http://stackoverflow.com/a/3943023/112731
        return (r * 0.299 + g * 0.587 + b * 0.114) > 186
            ? '#000000'
            : '#FFFFFF';
    }
    // invert color components
    r = (255 - r).toString(16);
    g = (255 - g).toString(16);
    b = (255 - b).toString(16);
    // pad each with zeros and return
    return "#" + padZero(r) + padZero(g) + padZero(b);
}

function padZero(str, len) {
    len = len || 2;
    var zeros = new Array(len).join('0');
    return (zeros + str).slice(-len);
}

function thousands_separators(number,dec=0) //sd 16-mar-2020
{
	//console.log('## '+number+' dd ' +dec);
	if (dec!=0 && number !=null && number !='') 
		num= parseFloat(number).toFixed(dec); 
	else 
		num=number;
	if(!isNaN(num)){
		var num_parts = num.toString().split(".");
		num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		//console.log('rtn='+num_parts.join("."));
		return num_parts.join(".");
	}
	//console.log('rtn='+number);
	return number;
}

function timeoutredirect(url,time=2000){
	setTimeout(function () {window.location.href = url; }, time);
}