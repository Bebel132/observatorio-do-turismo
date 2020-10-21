function showLoading() {
	jq('.blockscreen').fadeIn();
}

function hideLoading() {
	jq('.blockscreen').fadeOut();
}


boxsStart = Cookie.get('boxs');
function togglePathsView() {
	jq('.boxs').toggleClass('boxs2');
	if(boxsStart==""){
		boxsStart='boxs2';
	}else{
		boxsStart="";
	}
	Cookie.set('boxs',boxsStart,3)
}

function appLoaded() {
	jq(document).ready(function(){
		hideLoading();

		jq('.showloading').click(function(){
			showLoading();
		})

		jq('.naoindexados input,.naoindexados select,.naoindexados textarea').change(function(){

			line = jq(this).parent().parent();
			if(line.attr('class')!='edited'){
				line.addClass('edited');
				val = jq('.contador .alterados span').html();
				val = parseInt(val);
				val++;
				jq('.contador .alterados span').html(val);
				line.find('input[type=checkbox]').prop('checked',true);
			}

			if(jq(this).attr('data-default')!=jq(this).val()){
				jq(this).addClass('edited');
			}else{
				jq(this).removeClass('edited');
			}

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

		jq('.boxs').addClass(boxsStart);

		// window.onbeforeunload = function(){
		// 	val = jq('.naoindexados .contador .alterados span').html();
		// 	if(val==0)
		// 		return null;
		// 	return 'Os dados alterados ainda não foram salvos, deseja permanecer nesta página?';
		// };

	})
}


