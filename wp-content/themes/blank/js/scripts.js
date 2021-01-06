$('.cat-list_item').on('click', function(event) {
	event.preventDefault();
	$('.cat-list_item').removeClass('active');
	$(this).addClass('active');

	$.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		dataType: 'html',
		data: {
			action: 'filter_posts',
			category: $(this).data('slug'),
		},
		success: function(res) {
			var xhrData = JSON.parse(res);
			if(xhrData.success === true) {
				$('.tiles').html(xhrData.data);
			} else {
				$('.tiles').html('<li>No matching data found</li>');
			}
		}
	});
});

$('#searchform-salary').on('submit', function(event) {

	$.ajax({
		type: 'POST',
		url: '/wp-admin/admin-ajax.php',
		dataType: 'html',
		data: {
			action: 'filter_posts_acf',
			salary: $('#salary').val(),
		},
		success: function(res) {
			var xhrData = JSON.parse(res);
			if(xhrData.success === true) {
				$('#salary-list').html(xhrData.data);
			} else {
				$('#salary-list').html('<li>No matching data found</li>');
			}
		}
	});
	return false;
});