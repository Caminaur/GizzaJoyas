// Animated icons
var t = 0;

$(function () {
	$('.animated-icon').click(function (e) {
		$(this).toggleClass('anim');
	})

	play();
});

function play () {
	$('.animated-icon').click();
	t = setInterval(function () {
		$('.animated-icon').click();
	},2500);

	$('.left-side').on('mousemove',function () {
		clearInterval(t);

		$('.animated-icon').removeClass('anim');

		$(this).off('mousemove');
	});
}