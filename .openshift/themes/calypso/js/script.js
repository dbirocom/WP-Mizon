$(document).ready(function(){ 
	// Main Nav
	 $("#main-nav li").hover(function(){
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
    }, function(){
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
    }); 
	// Home Slider
	$('#home-slider #slider').flexslider({
        animation: "slide"
    });
	// Home Carousel
	$('#home-carousel').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 204,
        itemMargin: 0
    });
	// Helper
	$(".popular-item ul li:nth-child(3n),.product-list ul li:nth-child(3n)").addClass("last");
	$(".footer-contact input[type=text],.footer-contact input[type=email]").addClass("input-text");
	$(".footer-contact textarea").addClass("textarea-text");
	$(".footer-contact input[type=submit]").addClass("contact-submit");
	// Random rating 
	$('.shuffle').randomImage();
	// Custom Select
	if (!$.browser.opera) {
		$('select.select1').each(function(){
			var title = $(this).attr('title');
			if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
			$(this)
				.css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
				.after('<span class="select1">' + title + '</span>')
				.change(function(){
					val = $('option:selected',this).text();
					$(this).next().text(val);
					})
		});
	};
	// Scroll Top 
	$('.scroll-top a').click(function(){
		$('html, body').animate({scrollTop:0}, 'slow');
	});
	// Input focus 
	$(".sidebar-search input[type=text],#searchform input[type=text]")
		.bind("focus.labelFx", function(){
			$(this).prev().hide();
		})
		.bind("blur.labelFx", function(){
			$(this).prev()[!this.value ? "show" : "hide"]();
		})
		.trigger("blur.labelFx");  
});