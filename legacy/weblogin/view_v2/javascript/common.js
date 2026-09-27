/**
 * Global Ajax Options
 */
 
$.urlParam = function(url,name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
	
	if(!results)return false;
	return results[1] || 0;
} 

$(document).ajaxSend(function(event, jqXHR, ajaxOptions) {
	autoLogOutCount=0;
	$sessioncheck=$.urlParam(ajaxOptions.url,'sessioncheck'); 
	if(!$sessioncheck){
		loadTime=0;
		$('#loading').show();
	}
}).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
  
  console.log(event);
  console.log(jqXHR);
  console.log(ajaxSettings);
  console.log(thrownError);

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
	loadTime=0;
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

function humanize(str) {
  	var frags = str.split('_');
  	
  	for (i=0; i<frags.length; i++) {
    	frags[i] = frags[i].charAt(0).toUpperCase() + frags[i].slice(1);
  	}

  	return frags.join(' ');
}

$(document).ready(function() {
	$('.profileBox').click(function(){
		$('.profile_right ul').slideToggle();
	});
	$(document).click(function (e) {   
		if ($(e.target).closest('.profileBox').length != 0) return true;
		$('.profile_right ul').hide();
	});
	//Form Submit for IE Browser
	$('button[type=\'submit\']').on('click', function() {
		$("form[id*='form-']").submit();
	});

	// Refresh window after close modal
	$(".refresh-modal").on('hidden.bs.modal', function () {
		window.location.reload(true);
	});

	$('.modal').on('hidden.bs.modal', function (e) {
	    $(e.target).removeData('bs.modal');
	});

	$(document).on('keyup', function(e) {
		if (e.key === 'Escape') {
			if ($('.modal').hasClass('in')) {
				$('.modal').modal('hide');
			}
		}
	});

	$(".bs-select2-multiple").select2({
		theme: "bootstrap",
	});

	$('.colorpicker-element').colorpicker({
		format: 'hex',
		customClass: 'colorpicker-2x',
		sliders: {
            saturation: {
                maxLeft: 150,
                maxTop: 150
            },
            hue: {
                maxTop: 150
            },
            alpha: {
                maxTop: 150
            }
        }
	});

	// Highlight any found errors
	$('.text-danger').each(function() {
		var element = $(this).parent();	// for normal form
		var el = $(this).parent().parent();	// for form-horizontal

		if (element.hasClass('form-group')) {
			element.addClass('has-error');
		} else if (el.hasClass('form-group')) {
			el.addClass('has-error');
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
	} else {
		// $('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

		// $('#menu li li.active').has('ul').children('ul').addClass('collapse in');
		// $('#menu li li').not('.active').has('ul').children('ul').addClass('collapse');
	}

	/*/ Menu Hover
	$('#column-left').mouseover(function() {
		if (!($('#column-left').hasClass('HoverActive')) && $('#column-left').hasClass('active')){
			LeftMenuHoverAction();
		}
	});
	$('#column-left').mouseout(function() {
		if (($('#column-left').hasClass('HoverActive'))){
			LeftMenuHoverAction();
		}
	});
	
	function LeftMenuHoverAction() {
		// resize datatable
		//$($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();

		// Checks if the left column is active or not.
		if ($('#column-left').hasClass('HoverActive')) {
			localStorage.setItem('column-left', '');

			$('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');

			$('#column-left').removeClass('HoverActive');

			$('#menu > li > ul').removeClass('in collapse');
			$('#menu > li > ul').removeAttr('style');
		} else {
			localStorage.setItem('column-left', 'HoverActive');

			$('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');

			$('#column-left').addClass('HoverActive');

			// Add the slide down to open menu items
			$('#menu li.open').has('ul').children('ul').addClass('collapse in');
			$('#menu li').not('.open').has('ul').children('ul').addClass('collapse');
		}
	}*/
	// Menu button
	$('#button-menu').on('click', function() {
		// resize datatable
		//$($.fn.dataTable.tables(true)).DataTable().columns.adjust().responsive.recalc();

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

	// Tooltip remove fixed
	$(document).on('click', '[data-toggle=\'tooltip\'], [data-tooltip=\'tooltip\']', function(e) {
		$('body > .tooltip').remove();
	});

	$(document).on('click', '[data-tooltip=\'tooltip\']', function(e) {
		$('body > .tooltip').remove();
	});

	$('.password-control').on("cut copy paste drop",function(e) {
		e.preventDefault();
	});
	
	$('.btn-show-password').on('click', function() {
		$(this).find('i').toggleClass('fa-eye fa-eye-slash');
		var el = $(this).parents('.input-group').find('input').attr('id');
		
		if ($('#' + el).attr('type') === 'password') {
			$('#' + el).attr('type', 'text');
		} else {
			$('#' + el).attr('type', 'password');
		}
	});

	// Image Manager
	$(document).on('click', 'a[data-toggle=\'image\']', function(e) {
		var $element = $(this);
		var $popover = $element.data('bs.popover'); // element has bs popover?
		
		e.preventDefault();

		// destroy all image popovers
		$('a[data-toggle="image"]').popover('destroy');

		// remove flickering (do not re-add popover when clicking for removal)
		if ($popover) {
			return;
		}

		$element.popover({
			html: true,
			placement: 'right',
			trigger: 'manual',
			content: function() {
				return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
			}
		});

		$element.popover('show');

		$('#button-image').on('click', function() {
			var $button = $(this);
			var $icon   = $button.find('> i');
			
			$('#modal-image').remove();

			$.ajax({
				url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id'),
				dataType: 'html',
				beforeSend: function() {
					$button.prop('disabled', true);
					if ($icon.length) {
						$icon.attr('class', 'fa fa-circle-o-notch fa-spin');
					}
				},
				complete: function() {
					$button.prop('disabled', false);
					if ($icon.length) {
						$icon.attr('class', 'fa fa-pencil');
					}
				},
				success: function(html) {
					$('body').append('<div id="modal-image" class="modal">' + html + '</div>');

					$('#modal-image').modal('show');
				}
			});

			$element.popover('destroy');
		});

		$('#button-clear').on('click', function() {
			$element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

			$element.parent().find('input').val('');

			$element.popover('destroy');
		});
	});

	// tooltips on hover
	$('[data-toggle=\'tooltip\'], [data-tooltip=\'tooltip\']').tooltip({container: 'body', html: true});

	// Makes tooltips work on ajax generated content
	$(document).ajaxStop(function() {
		$('[data-toggle=\'tooltip\'], [data-tooltip=\'tooltip\']').tooltip({container: 'body', html: true});
	});

	// https://github.com/opencart/opencart/issues/2595
	$.event.special.remove = {
		remove: function(o) {
			if (o.handler) {
				o.handler.apply(this, arguments);
			}
		}
	}

	$('[data-toggle=\'tooltip\'], [data-tooltip=\'tooltip\']').on('remove', function() {
		$(this).tooltip('destroy');
	});
	
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		$($.fn.dataTable.tables(true)).DataTable().columns.adjust().fixedColumns().relayout();
	});
});

// Tagname
(function($) {
	$.fn.tagName = function() {
		return this.prop('tagName').toLowerCase();
	}
})(window.jQuery);

// Sum
(function($) {
	$.fn.sum = function() {
		var sum = 0;
		$(this).each(function(index, element) {
			if ($.trim($(element).val()) != '')
			sum += parseFloat($(element).val());
		});

		return !isNaN(sum) ? sum : 0;
	}
})(window.jQuery);

// Input Filter
/**
 * 	Integer values (both positive and negative):
 *		/^-?\d*$/.test(value)
 *	Integer values (positive only):
 *		/^\d*$/.test(value)
 *	Integer values (positive and up to a particular limit):
 *		/^\d*$/.test(value) && (value === "" || parseInt(value) <= 500)
 *	Floating point values (allowing both . and , as decimal separator):
 *		/^-?\d*[.,]?\d*$/.test(value)
 *	Currency values (i.e. at most two decimal places):
 *		/^-?\d*[.,]?\d{0,2}$/.test(value)
 *	Hexadecimal values:
 *		/^[0-9a-f]*$/i.test(value)
 */
(function($) {
  	$.fn.inputFilter = function(inputFilter) {
	    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
	      	if (inputFilter(this.value)) {
	        	this.oldValue = this.value;
	        	this.oldSelectionStart = this.selectionStart;
	        	this.oldSelectionEnd = this.selectionEnd;
	      	} else if (this.hasOwnProperty("oldValue")) {
	        	this.value = this.oldValue;
	        	this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
	      	}
	    });
  	};
}(window.jQuery));

// Autocomplete */
(function($) {
	$.fn.autocomplete = function(option) {
		return this.each(function() {
			var $this = $(this);
			var $dropdown = $('<ul class="dropdown-menu" />');
			
			this.timer = null;
			this.items = [];

			$.extend(this, option);

			$this.attr('autocomplete', 'off');

			// Focus
			$this.on('focus', function() {
				if (option.minLength !== undefined) {
					if (this.value.length >= option.minLength) {
						this.request();
					} else {
						this.hide();
					}
				} else {
					this.request();
				}
			});

			// Blur
			$this.on('blur', function() {
				setTimeout(function(object) {
					object.hide();
				}, 200, this);
			});

			// Keydown
			$this.on('keydown', function(event) {
				switch(event.keyCode) {
					case 27: // escape
						this.hide();
						break;
					case 9: // tab
						this.hide();
						break;
					default:
						if (option.minLength !== undefined) {
							if (this.value.length >= option.minLength) {
								this.request();
							} else {
								this.hide();
							}
						} else {
							this.request();
						}
						break;
				}
			});

			// Click
			this.click = function(event) {
				event.preventDefault();

				var value = $(event.target).parent().attr('data-value');

				if (value && this.items[value]) {
					this.select(this.items[value]);
				}
			}

			// Show
			this.show = function() {
				var pos = $this.position();

				$dropdown.css({
					top: pos.top + $this.outerHeight(),
					left: pos.left
				});

				$dropdown.show();
			}

			// Hide
			this.hide = function() {
				$dropdown.hide();
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
				var html = '';
				var category = {};
				var name;
				var i = 0, j = 0;

				if (json.length) {
					for (i = 0; i < json.length; i++) {
						// update element items
						this.items[json[i]['value']] = json[i];

						if (!json[i]['category']) {
							// ungrouped items
							html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
						} else {
							// grouped items
							name = json[i]['category'];
							if (!category[name]) {
								category[name] = [];
							}

							category[name].push(json[i]);
						}
					}

					for (name in category) {
						html += '<li class="dropdown-header">' + name + '</li>';

						for (j = 0; j < category[name].length; j++) {
							html += '<li data-value="' + category[name][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[name][j]['label'] + '</a></li>';
						}
					}
				}

				if (html) {
					this.show();
				} else {
					this.hide();
				}

				$dropdown.html(html);
			}

			$dropdown.on('click', '> li > a', $.proxy(this.click, this));
			$this.after($dropdown);
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

function newstatus(data) {
	if (data == '1') {
		return '<span class="label label-success">Pending</span>';
	} else if (data == '2') {
		return '<span class="label label-danger">Complete</span>';
	} else {
		return '<span class="label label-danger">Trash</span>';
	}
}

function invstatus(data) {
	if (data == '1') {
		return '<span class="label label-danger">Pending</span>';
	} else if (data == '2') {
		return '<span class="label label-success">Complete</span>';
	} else {
		return '<span class="label label-danger">Unknown</span>';
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

function formToJson(form_name, local_storage = false) {
	if (local_storage) {
		var serializeArray = $('form[name=\'' + form_name + '\'] :input').filter(function(index, element) {
			return $.trim($(element).val()) != '';
		}).serializeArray();

		var object = [];
		for (var j = 0; j < serializeArray.length; j++) {
			var flag = false;
			for (var i = 0; i < object.length; i++) {
				if (serializeArray[j].name == object[i].name || serializeArray[j].name == object[i].name + '[]') {
					object[i].value += ',' + serializeArray[j].value;
					flag = true;
					break;
				}
			}
			if (!flag) {
				var objectLength = object.length;
				object[objectLength] = serializeArray[j];
				object[objectLength].name = object[objectLength].name.replace('[]', '');
			}
		}

		localStorage.setItem(local_storage, JSON.stringify(object));
	} else {
		return JSON.stringify($('form[name=\'' + form_name + '\']').serializeArray());
	}
}

function JsonToForm(form_name, local_storage,type='datatable') {
	var json = JSON.parse(localStorage.getItem(local_storage));
	var arr = {};

	if(json!=null){
		$.each(json, function(key, value) {
			
			if(type!='datatable'){
				var ctrl = $('form[name=\'' + form_name + '\']').find('[name=\'' + value.name + '\'], [name=\'' + value.name + '[]\']').eq(0);

				switch(ctrl.attr('type')) {
					case 'radio': case 'checkbox':   
						ctrl.each(function() {
							if ($(this).attr('value') == value.value) $(this).attr("checked", value.value);
						});   
						break;
					default:
						if (ctrl.hasClass('select2-hidden-accessible')) {
							var vArr = value.value.split(',');
							ctrl.val(vArr).trigger('change');
						} else {
							ctrl.val(value.value);
						} 
				}
			}

			arr[value.name] = value.value;
		});
	}
	
    return arr;
}