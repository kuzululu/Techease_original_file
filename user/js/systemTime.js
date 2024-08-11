$(document).ready(function(){
	let myTime = setInterval(myTimer, 1000);

	function myTimer(){
		let d = new Date(); //24 hr format

		// current time, e.g. "1:54 PM"
		let currentTime = d.toLocaleTimeString().replace(/:\d+ /, ' ');

		// current date in the format "MM/DD/YYYY"
		let currentDate = d.toLocaleDateString();

		// combine date and time
		let dateTime = currentDate + " | " + currentTime;

		$("#time").val(dateTime);
	}
});