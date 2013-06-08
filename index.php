<html>
<head>
	<title>Get Google Image Related Search</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.1.0/pure-min.css">
	<style type="text/css">
		.content {
			width: 900px;
			margin: 0 auto;
			padding: 30px;
			box-shadow: 0px 0px 5px #ccc;
		}	

		.pure-button-success {
            background: rgb(76, 201, 71); /* this is a green */
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }
	</style>
</head>
<body>
<div class="content">
	<div class="pure-g">
		<div class="pure-u-1-2">
			<form class="pure-form">
				<h3>Search Query</h3>
				<input type="text" placeholder="Search term eg. beach" id="query">
				<button class="pure-button pure-button-success" id="button">Get Related</button>
			</form>
		</div>
	
		<div class="pure-u-1-2">
			<h3 id="first_keyword"></h3>
			<table class="pure-table pure-table-bordered" id="related_keyword">
				
			</table>
		</div>
	</div>
</div>

	<script type="text/javascript">
		$(function(){
			$('#button').click(function(e){
				e.preventDefault();

				var keyword = $('#query').val();

				// please input query
				if(!keyword) return alert('Upps... please insert keyword');

				$.getJSON('GRelated.php', {query : keyword})
				.done(function(result){
					console.log(result);
					$('#first_keyword').html('Search result for : ' + keyword);

					// fix, clearing last result
					$('#related_keyword').html('');

					$.each(result, function(key, value){
						$('#related_keyword').append('<tr><td>'+value+'</td></tr>');	
					});					
				})
				.fail(function(error){
					console.log(error);
					alert('Search Fail');
				})
				.always(function(){
					// nothing todo -_-
				});
			});
		})
	</script>
</body>
</html>