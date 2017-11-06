<div class="panel panel-default">

	<div class="panel-body">
		<form id="editForm" method="POST">
			<div>
				<label for="category">Category : </label>
				<input type="text" id="category" name="category" value="<?= $data["imgCategory"] ?>">
			</div>
			<img src="<?= $data["imgUrl"] ?>" width="<?= $data["imgSize"] ?>">
			<div>
				<label for="comment">Comment : </label>
				<input type="text" id="comment" name="comment" value="<?= $data["imgComment"] ?>">
			</div>
		</form>
	</div>

</div>

<script type="text/javascript">
	$(function (){
		$("a[href*='saveAction']").click(function (event){
			event.preventDefault();
			
			$("#editForm").attr("action", $(this).attr("href")).submit();
		});
	});
</script>