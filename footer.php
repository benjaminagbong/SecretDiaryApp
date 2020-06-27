<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		
		$(".toggleform").click(function () {
			// body...
			$("#signinform").toggle();
			$("#loginform").toggle();
		});

		$("#diary").bind('input propertychange', function() {

			$.ajax({
			  type: "POST",
			  url: "updatedatabase.php",
			  data: {content: $("#diary").val() }
			   			
			});
      
		});

	</script>

</body>
</html>

