// Message Class
var messageEffect;
var effectDuration;

function Message() {
	messageEffect	= "fade";
	effectDuration	= 1000;
}

Message.prototype.error	= function(text, duration)
{	
	$("#MessageWrapper").show();
	$("#MessageError").html(text);
	$("#MessageError").fadeIn(effectDuration).delay(duration).fadeOut(effectDuration);
	$("#MessageWrapper").hide;
}

Message.prototype.success = function(text, duration)
{	
	$("#MessageWrapper").show();
	$("#MessageSuccess").html(text);
	$("#MessageSuccess").fadeIn(effectDuration).delay(duration).fadeOut(effectDuration);
	$("#MessageWrapper").hide;
}

Message.prototype.message = function(text, duration)
{	
	$("#MessageWrapper").show();
	$("#MessageNormal").html(text);
	$("#MessageNormal").fadeIn(effectDuration).delay(duration).fadeOut(effectDuration);
	$("#MessageWrapper").hide;
}

Message.prototype.setEffect	= function(effect)
{
	messageEffect	= effect;
}

Message.prototype.setEffectDuration	= function(duration)
{
	effectDuration	= duration;
}