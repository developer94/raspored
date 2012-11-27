$(document).ready(function ()
{	
	//==============================================================================
	//=== CLASS TIME FUNCTIONS
	//==============================================================================
	//Fix time values, slice 
	for(index in vremena)
	{
		var value = vremena[index];
		minuti[index] = value.slice(-2);
		if(minuti[index][0] == "0")
		{
			minuti[index] = minuti[index].slice(1);
		}
			
		sati[index] = value.substr(0,2);					
		if(sati[index][0] == "0")
			sati[index] = sati[index].slice(1);
	}

	var now = new Date();
	var start_time = new Date();
	start_time.setMinutes(minuti[current_index]);
	start_time.setHours(sati[current_index]);
	if(now.getTime() >= start_time.getTime())
		classes_started = true;
	
	function calculate_time()
	{
		current_index = 0;										//Check the whole list (if it's a new day)
		while(current_index < vremena.length)
		{
			if(hasAlreadyPassed(sati[current_index], minuti[current_index]) == false)
				break;
			current_index++;
		}
		if(current_index > 0)
			current_index--;
	}

	function unmark_class(class_index)
	{
		var this_class = $('#cas-'+class_index+' .bar');		//Find current class row
		var class_text = $('#cas-'+class_index+' .predmet');
		class_text.css('font-weight', 'normal').css('color', 'white');
		this_class.removeClass('time-marker');					//Remove existant class markings
	}

	function mark_class(class_index)
	{
		unmark_class(currently_marked);
		var this_class = $('#cas-'+class_index+' .bar');		//Find current class row
		var class_text = $('#cas-'+class_index+' .predmet');
		class_text.css('font-weight', 'bold').css('color', 'black');
		this_class.addClass('time-marker');						//Remove existant class markings
		currently_marked = class_index;
	}

	function correct_marker_time(minutes)
	{
		var this_class = $('#cas-'+currently_marked+' .bar');
		var value = 100 / 45 * minutes;
		this_class.css('width', value+'%');
	}
	
	g_calculate_time = calculate_time;
	calculate_time();

	function hasAlreadyPassed(hours, minutes)					//checks if the time has passed compared to the current moment
	{
		var time = new Date();
		//time.setHours(10);									//DEBUG: Test time
		//time.setMinutes(52);									//DEBUG: Test time
		
		var last_time = new Date();
		last_time.setHours(hours);
		last_time.setMinutes(minutes);
		
		if(last_time.getTime() < time.getTime())
			return true;
		else
			return false;
	}
	
	g_hasAlreadyPassed = hasAlreadyPassed;						//DEBUG: global func
	
	var timeTillEnd = function ()
	{
		var now = new Date();
		//now.setHours(10);										//DEBUG: Test time
		//now.setMinutes(52);									//DEBUG: Test time
		
		var current_class = new Date();
		var end_of_class = new Date();
		var next = new Date();
		var message;
		current_class.setHours(sati[current_index]);
		current_class.setMinutes(minuti[current_index]);
		end_of_class = new Date(current_class);
		end_of_class.setTime(current_class.getTime() + 45*60*1000);

		if(current_index < vremena.length - 1)													//if there is a next class
		{
			next.setHours(sati[current_index + 1]);
			next.setMinutes(minuti[current_index + 1]);
		}
		
		if(current_class.getTime() >= now.getTime() && current_index == 0)						//if it's time before school
		{
			var formatted_time = new Date(current_class - now);
			
			if(formatted_time.getHours() > 0)
			{
				var diff = Math.floor((formatted_time.getTime() - formatted_time.getMinutes() * 60 * 1000) / 60 / 60 / 1000) + "h " + formatted_time.getMinutes() + "m "; //Convert into Hh Mm format for display
			}
			else
				var diff = formatted_time.getMinutes();
			
			if(diff == 0)
			{
				diff = "";
				message = "Skola upravo pocinje!";
			}
			else
				message = "min. do pocetka casova";

			unmark_class(currently_marked);
		}
		else if(end_of_class.getTime() > now.getTime()) 										//if there's a class going on
		{
			var diff = Math.floor((end_of_class.getTime() - now.getTime()) / 1000 / 60);
			
			if(current_index < vremena.length - 1)
				message = "min. do kraja casa";
			else
				message = "min. do kraja <b>poslednjeg</b> casa!";

			mark_class(current_index);

			var marker_time = (now.getTime() - current_class.getTime()) / 1000 / 60;
			correct_marker_time(marker_time);
		}
		else if(now.getTime() >= end_of_class.getTime() && next.getTime() >= now.getTime()  && current_index < vremena.length - 1)	//if it's reccess - and it's not the last class
		{
			classes_started = true;
			message = "min. do kraja odmora";
			var diff = Math.floor((next.getTime() - now.getTime()) / 1000 / 60);
			if(diff == 0)
			{
				diff = "";
				message = "Cas upravo pocinje!";
				unmark_class(current_index);
				mark_class(current_index+1);
			}
		}
		else if(now.getTime() > end_of_class.getTime() && current_index == vremena.length - 1)
		{
			diff = "";
			message = "Nastava se zavrsila.";
			unmark_class(currently_marked);
		}

		calculate_time();
		
		$("#time-till-end").html(diff);								//Fill #time-till-end with the time left
		$("#time-till-end-message").html(message);					//Fill the message with appropriate time left text
		
		setTimeout(timeTillEnd, 1000);
	};
	
	timeTillEnd();
	g_timeTillEnd = timeTillEnd;								//DEBUG: global func
	//==============================================================================
	//=== END OF CLASS TIMER
	//==============================================================================
});