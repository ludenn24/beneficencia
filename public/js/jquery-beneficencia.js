jQuery(document).ready(function(){	
    
    owl_testimonios = jQuery('.owl_testimonios');
    owl_testimonios.owlCarousel({
        nav: false,
        dots: true,
        loop:true,
        autoplay: true,
        dotsContainer: '.owl_dots_content_inicio_generales',
        margin:0,
        animateOut: 'fadeOut',
        responsive:{
            0:{
                margin: 0,
                items: 1
            },
            1024:{
                margin: 45,
                items: 2
            }
        }
    });
    owl_home_top = jQuery('.owl_home_top');
    owl_home_top.owlCarousel({
        nav: false,
        dots: true,
        loop:true,
        autoplay: true,
        dotsContainer: '.owl_dots_top',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
    });
    owl_landing_history = jQuery('.owl_landing_history');
    owl_landing_history.owlCarousel({
        nav: true,
        dots: true,
        loop:true,
        autoplay: true,
        autoplayTimeout: 5000,
        margin:0,
        items: 1,
        navText: ['Anterior', 'Siguiente']
    });
    owl_landing_top = jQuery('.owl_landing_top');
    owl_landing_top.owlCarousel({
        nav: false,
        dots: true,
        loop:true,
        autoplay: true,
        dotsContainer: '.owl_dots_landing_top',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
    });
    owl_presbitero_first = jQuery('.owl_presbitero_first');
	owl_presbitero_first.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: true,
    	dotsContainer: '.owl_dots_presbitero_first',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
	});
    owl_landing_second = jQuery('.owl_landing_second');
	owl_landing_second.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: false,
    	dotsContainer: '.owl_dots_landing_second',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
	});
     owl_inicio_generales = jQuery('.owl_inicio_generales');
	owl_inicio_generales.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: false,
    	dotsContainer: '.owl_dots_inicio_generales',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
	});
     owl_home_historia = jQuery('.owl_home_historia');
	owl_home_historia.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: true,
    	dotsContainer: '.owl_dots_historia',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
	});
    
    owl_home_noticias = jQuery('.owl_home_noticias');
	owl_home_noticias.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: true,
    	dotsContainer: '.owl_dots_noticias',
        margin:0,
        center: true,
        stagePadding: 40,
        items:1
	});
    
    owl_home_eventos = jQuery('.owl_home_eventos');
	owl_home_eventos.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: true,
    	dotsContainer: '.owl_dots_eventos',
        margin:0,
        items: 1,
        animateOut: 'fadeOut'
	});
    
     owl_noticias_relacionadas = jQuery('.owl_noticias_relacionadas');
	owl_noticias_relacionadas.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: false,
    	dotsContainer: '.owl_dots_noticias_relacionadas',
    	responsive:{
	        0:{
	            margin: 10,
    			items: 1
	        },
            
            580:{
	            margin: 10,
    			items: 2
	        },
	        767:{
	            margin: 10,
    			items: 3
	        },
	        1024:{
	            margin: 10,
    			items: 4
	        }
	    }
	});
       owl_inicio_generales_mini = jQuery('.owl_inicio_generales_mini');
	owl_inicio_generales_mini.owlCarousel({
	    nav: false,
		dots: true,
        loop:true,
	    autoplay: false,
    	dotsContainer: '.owl_dots_inicio_generales',       
        responsive:{
	        0:{
	            margin: 10,
    			items: 2
	        },
            600:{
	            margin: 10,
    			items: 3
	        }
	    }
	});
    $('.owl_dots_landing_second .owl-dot').each(function(){
        $(this).children('span').text($(this).index()+1);
    });
    $(".nav_desk_icon").click(function(){
        $(".nav_mobile").fadeToggle(300);
        $(".nav_desk_icon").hide();        
    });
    $(".nav_mobile_icon").click(function(){
        $(".nav_desk_icon").fadeToggle(300);
        $(".nav_mobile").hide();        
    
    });  
    $('.icon_plan1').svgInject();

    var filtro_inmobiliaria = $("#filtro_collapse").offset();
    
    var filtro_top = filtro_inmobiliaria.top;
	$(window).scroll(function(){        
		if($(this).scrollTop() >= filtro_top) {
			$("#filtro_collapse").addClass("sticky");
		} else {
			$("#filtro_collapse").removeClass("sticky");
		}
	});
    
    
});
function scrollDownAnimate(id){
    $('html, body').animate({
       scrollTop: ($(id).offset().top)
    },500);
}
