// =============  Data Table - (Start) ================= //

$(document).ready(function(){
    var print = $('#printable').DataTable({
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']
    });

    var dashprint = $('#dashprint').DataTable({
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']
    });
    var leadingCandidates = $('#leadingCandidates').DataTable({
        buttons:['copy', 'csv', 'excel', 'pdf', 'print']
    });

    var dtable = $('#defaultTable').DataTable({
    });

    print.buttons().container()
    .appendTo('#printable_wrapper .col-md-6:eq(0)');

    dashprint.buttons().container()
    .appendTo('#dashprint_wrapper .col-md-6:eq(0)');

    leadingCandidates.buttons().container()
    .appendTo('#leadingCandidates_wrapper .col-md-6:eq(0)');
});

    // CLOCK
		function realtimeClock() {			
	    	var rtClock = new Date();
			var hours = rtClock.getHours();
			var minutes = rtClock.getMinutes();
			var seconds = rtClock.getSeconds();

			var amPm = ( hours < 12 ) ? " <span class='badge bg-warning'>AM</span>" : " <span class='badge bg-info'>PM</span>";

			hours = (hours > 12) ? hours - 12 : hours;

			hours = ("0" + hours).slice(-2);
			minutes = ("0" + minutes).slice(-2);
			seconds = ("0" + seconds).slice(-2);

			document.getElementById('clock').innerHTML = 
			hours + "  :  " + minutes + "  :  " + seconds + " " + amPm;
			var t = setTimeout(realtimeClock, 500);

			}
			realtimeClock()

    // Function to open modal
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
        modal.style.transition  = "all 300ms ease-in-out";

    }

    // Function to close modal
    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "none";
        modal.style.transition  = "all 300ms ease-in-out";

    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        var modals = document.getElementsByClassName('modal');
        for (var i = 0; i < modals.length; i++) {
        var modal = modals[i];
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    }

  


