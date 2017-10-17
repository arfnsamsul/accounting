		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function () {
			    $('.navbar-toggle').click(function () {
			        $('.navbar-nav').toggleClass('slide-in');
			        $('.side-body').toggleClass('body-slide-in');
			        $('#search').removeClass('in').addClass('collapse').slideUp(200);

			        /// uncomment code for absolute positioning tweek see top comment in css
			        //$('.absolute-wrapper').toggleClass('slide-in');
			        
			    });
			   
			   // Remove menu for searching
			   $('#search-trigger').click(function () {
			        $('.navbar-nav').removeClass('slide-in');
			        $('.side-body').removeClass('body-slide-in');

			        /// uncomment code for absolute positioning tweek see top comment in css
			        //$('.absolute-wrapper').removeClass('slide-in');

			    });
			});

			$(document).ready(function() {
			    $('#tablenormal').DataTable();
			} );
		</script>