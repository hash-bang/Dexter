$(function() {
	$.extend({
		go: function(screen) {
			$(document).scrollTo('#screen_' + screen, 800, {offset: -400});
		},
		refresh_list: function() {
			$.getJSON('api/get_hosts.php?', function(data) {
				$('#host_list').empty();
				var found = 0;
				$.each(data, function(i,host) {
					if (found++ == 0) // First found phone
						$('#host_list').html('<img src="images/phone.png"/><br/><h1>Select your phone</h1><p>Which one of the following looks like your phone. If unsure just select the first one.</p>');
					if (found++ < 5) // Only care about so many
						$('#host_list').append('<a href="javascript:$.scan(\'' + host.ip + '\',\'' + host.mac + '\',\'' + host.name + '\')">' + host.mac + (host.name ? ' (' + host.name + ')' : '') + '</a>');
				});
				if (found == 0)
					$('#host_list').html('<img src="images/alert.png"><br/><h1>No phones found</h1><p>Sorry but it looks like there are no phones to scan.</p><p>Connect your phone to the WiFi point <b>\'Mobile Phone Healthcheck\'</b> to continue</p>');
				setTimeout('$.refresh_list()', 3000);
			});
		},
		scan: function(ip,mac,name) {
			$.go('scanning');
			$.getJSON('api/attack.php?ip=' + ip + '&mac=' + mac + '&name=' + name, function(data) {
				$.go('report');
				if (data.status == 'ok') {
					$('#report_cart').html('<div><h2>Phone security report</h2><p>Your phone is secure!</p><p>We couldn\'t find any issues with your phone.</p> <p style="font-size: 10pt">We try to do a scan for most known security issues but we can\'t gurentee a completely virus free phone.</p></div>');
					$('#report_grade').html('<img src="images/grade-pass.png"/>');
				} else {
					var report = '<div><h2>Phone security report</h2><p>We found a few issues with your phone.</p><p>The following ports were found to be open:</p><ul>';
					$.each(data.ports, function(port, name) {
						report += '<li>' + port + (name ? ' - ' + name : '') + '</li>';
					});
					report += '</ul><p>It might be a good idea to install a virus scanner on your phone.</p></div>';
					$('#report_card').html(report);
					$('#report_grade').html('<img src="images/grade-fail.png"/>');
				}
			});
		}
	});
	$.go('home');
	$.refresh_list();
});
