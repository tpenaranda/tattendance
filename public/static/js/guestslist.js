$( document ).ready(function() {

	var spinSettings = {
		lines: 17, length: 60, width: 28, radius: 100, scale: .3, corners: 1,
		color: '#000', opacity: 0.5, rotate: 0, direction: 1, speed: 0.5, trail: 0,
		fps: 2, zIndex: 2e9, className: 'spinner', top: '50%', left: '50%',
		shadow: false, hwaccel: false, position: 'relative'
	}

	$('input[name="needaride-switch"]').bootstrapSwitch();
	$('input[name="going-switch"]').bootstrapSwitch();

	$('#going-tr').click( function () {
		$('input[name="going-switch"]').bootstrapSwitch('toggleState');
	});

	$('#needaride-tr').click( function () {
		$('input[name="needaride-switch"]').bootstrapSwitch('toggleState');
	});

	$('input[name="going-switch"]').on('switchChange.bootstrapSwitch', function(event, state) {
		$('#center-sw').spin(spinSettings);
		$.ajax({
			url: '/save/going/' + $('#comment-textarea').data('guestid') + '/',
			type: 'POST',
			traditional: true,
			timeout: 3000,
			data: {
					_token              : $('#comment-textarea').data('csrftoken'),
					guesttoken          : $('#comment-textarea').data('guesttoken'),
					going               : state
				},
			success: function(data) {
				$('#center-sw').spin(false);
				if (data.going) {
					$('#msg-not-going').hide();
					$('#msg-going').show();
				} else {
					$('#msg-going').hide();
					$('#msg-not-going').show();
				}
			},
			error: function(e) {
				location.reload();
			}
		});
	});

	$('input[name="needaride-switch"]').on('switchChange.bootstrapSwitch', function(event, state) {
		$('#center-sw').spin(spinSettings);
		$.ajax({
			url: '/save/need_a_ride/' + $('#comment-textarea').data('guestid') + '/',
			type: 'POST',
			traditional: true,
			timeout: 5000,
			data: {
					_token              : $('#comment-textarea').data('csrftoken'),
					guesttoken          : $('#comment-textarea').data('guesttoken'),
					need_a_ride         : state
				},
			success: function(data) {
				$('#center-sw').spin(false);
			},
			error: function(e) {
				location.reload();
			}
		});
	});

	$('#comment-button').click( function () {
		$('#center-sw').spin(spinSettings);
		$.post("/save/comment/" + $('#comment-textarea').data('guestid') + '/',{
				_token              : $('#comment-textarea').data('csrftoken'),
				guesttoken          : $('#comment-textarea').data('guesttoken'),
				comment             : $('#comment-textarea').val()
			}, function(data) {
				$('#center-sw').spin(false);
			}
		);
	});

	$('#comment-textarea').keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			$('#comment-button').click();
		}
	});

});
