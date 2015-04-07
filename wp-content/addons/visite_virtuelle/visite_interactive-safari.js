var stop_point;
var canplaythrough = false;
var canplaythroughboth = false;
var hasStarted = false;
var point;
var default_volume = 0.5;
var old_mousex = 0;
var old_mousey = 0;


function vidplay() {
	var player = $('video#visite').get(0);
	if (stop_point[point] == undefined || !stop_point[point]['played']) {
		$('.showit').fadeOut(300);
		player.play();
	} else {
		$('#bottom').hide();
		setPoint(point);
		point++;
	}
}

function restart() {
	var player = $('video#visite').get(0);
    player.currentTime = 0;
}

function reverse(){
	var player = $('video#visite').get(0);

	do_reverse();

	return false;
}

/*
function do_reverse2(){
	var player = $('video#visite').get(0);
	TweenMax.fromTo(player, 3, {currentTime:player.currentTime}, {currentTime: stop_point[point-2]['time'], delay:0, repeat:0, yoyo:false, ease:Linear.easeNone})
} */

function do_reverse(){
	var player = $('video#visite').get(0);

	$('#bottom').hide().removeClass('showit');

	try{
		if(player.currentTime > stop_point[point-2]['time'] && false){
			player.currentTime += -0.05;
			setTimeout(function(){ do_reverse(); },50);
		}
		else{
			point--;
			
			setPoint(point-1);
		}
	}
	catch(e){}
}

function setPoint(point){
	player = $('video#visite').get(0);
	player.currentTime = stop_point[point]['time'];
	$('#bottom>a').attr('href', stop_point[point]['link']);
	$('#bottom>a').html(stop_point[point]['desc']);

	if(point > 0)
		$('#bottom').fadeIn().addClass('showit');

	if(point > 1){
		$('#left:not(visible)').fadeIn(300);
	}
	else{
		$('#left:visible').fadeOut(100);
	}
}

function loadImages(){
	for (i = 0; i < images.length; i++) {
		img = new Image();
		img.src = images[i];
	}
}

$(document).ready(function(){
	initStopPoint();

	loadImages();

	var player = $('video#visite').get(0);
	var audio = $('audio#backtrack').get(0);
	player.volume = 0;
	audio.volume = default_volume;

	player.addEventListener("canplaythrough",function(){
		if(canplaythrough){
			$('#loader').fadeOut(800);

			canplaythroughboth = true;

			if(hasStarted){
				player.play();
				audio.play();
			}
		}

		canplaythrough = true;
	}, false)

	player.addEventListener("onwaiting",function(){
		$('#loader').fadeIn(300);
	}, false)

	audio.addEventListener("canplaythrough",function(){
		if(canplaythrough){
			$('#loader').fadeOut(800);
			
			canplaythroughboth = true;

			if(hasStarted){
				player.play();
				audio.play();
			}
		}

		canplaythrough = true;
	}, false)

	$('video#visite').on('timeupdate', function(){
		if(point < stop_point.length && stop_point[point]['time'] < player.currentTime){
			player.pause();
			$('#bottom>a').attr('href', stop_point[point]['link']);
			$('#bottom>a').html(stop_point[point]['desc']);

			stop_point[point]['played'] = true;

			point++;
		}
	}).on('ended', function(){
		point++;
		$('#replay').fadeIn(300);
	}).on('pause', function(){
		if(!player.ended){
			$('#bottom').fadeIn(300).addClass('showit');
		}

	}).on('play', function(){
		$('#bottom').fadeOut(300).removeClass('showit');
	})

	$('#player_visite').on('mousemove', function(event){
		if(player.paused && hasStarted){
			if(point > 2){
				if(point <= stop_point.length)
					$('.showit').fadeIn(300);
			}
			else
				$('.showit:not(#left)').fadeIn(300);
		}

		if(hasStarted && Math.abs(event.pageX - old_mousex) > 20 && Math.abs(event.pageY - old_mousey) > 20){
			$('#sound').fadeIn(300);
			old_mousex = 0;
			old_mousey = 0;
		}
	}).on('mouseleave', function(){
		$('.showit').fadeOut(300);
		old_mousex = 0;
		old_mousey = 0;
	})

	$('#left>a').on('click',function(){
		reverse();
		return false;
	})

	$('#right>a').on('click',function(){
		vidplay();
		return false;
	})

	$('.move_controls>a').on('click',function(event){
		old_mousex = event.pageX;
		old_mousey = event.pageY;
	})

	$('#sound>a').on('click',function(){
		if(audio.volume > 0){
			audio.volume = 0;

			$(this).css({
				'background-position':"-32px 0"
			});
		}
		else{
			audio.volume = default_volume;

			$(this).css({
				'background-position':"0 0"
			});
		}

		return false;
	})

	$('#play a').on('click',function(){
		// player.play();
		// audio.play();

		hasStarted = true;

		$('#play').fadeOut(300);

		if(canplaythroughboth){
			player.play();
			audio.play();
		}

		return false;
	})

	$('#replay a').on('click',function(){
		initStopPoint();
		vidplay();

		//$("#replay").fadeOut(300);
		$("#replay").css({
			'border-bottom':"#555 3px solid"
		}).animate({
			'top':"-600px"
		},800);

		setTimeout(function(){
			$("#replay").hide().css({
				'top':"0"
			});},
			2000
		);
	})

	$('#bottom>a').on('click',function(){
		return false;
	})

	$('.skip').on('click',function(){
		point = $(this).attr('data-point');
		setPoint(point);
	})
})