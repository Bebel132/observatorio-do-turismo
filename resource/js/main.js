function scrollTo(elem,vel,doc,ajust){

	vel = (typeof vel !== 'undefined') ? vel : 500;
	ajust = (typeof ajust !== 'undefined') ? ajust : 0;
	doc = (typeof doc !== 'undefined') ? doc : 'html, body';
	var desloc = (jq( elem ).offset().top + ajust);
	var jqdoc = jq(doc);
	jqdoc.animate({
		scrollTop: desloc
	}, vel);
	return desloc;
}


jq(window).scroll( function() {
	var top = jq(this).scrollTop();

	fator = Math.ceil(top / 20);

	if(fator >= 5){
		jq('header').addClass('min');
		jq('header').removeClass('max');
	}else{
		jq('header').removeClass('min');
		jq('header').addClass('max');
	}
})

jq(document).ready(function(){

	jq('.rollto').click(function(){
		var href = jq(this).attr('href');
		var hs = href.split('#');
		var href2 = "#"+hs[hs.length-1]
		scrollTo(href2,500,'html, body',-150);
	})

	jq('.gotab').click(function(){

		var container = jq(this).attr('container');
		var tab = jq(this).attr('tab');

		jq(container).find('.gotab').removeClass('active');
		jq(this).addClass('active');
		jq(container).find('.tab').hide();
		jq(container).find(tab).show();

	})

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

})