function showLoading() {
	jq('.blockscreen').fadeIn();
}

function hideLoading() {
	jq('.blockscreen').fadeOut();
}

function appLoaded() {
	jq(document).ready(function(){
		hideLoading();

		jq('.showloading').click(function(){
			showLoading();
		})

		jq('form').submit(function(){ showLoading(); });

		jq('.indisponivel').click(function(){
			alert("Indispónível.");
			return false;
		});

		jq('.certeza').click(function(){
			var pergunta = jq(this).attr('title');
			return confirm(pergunta);
		});

	})
}