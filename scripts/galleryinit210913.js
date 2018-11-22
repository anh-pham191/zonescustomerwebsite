$(function() {

// Item 1
$("#slides1").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination1",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides1 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides1").trigger("pause");
    },
    callback: function() {
        $("#slides1").trigger("play");
    }
});	
$('#item-1 a').on('click', function() {
      $("#slides1").trigger("play",true);
    });	
// Item 2
$("#slides2").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination2",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides2 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides2").trigger("pause");
    },
    callback: function() {
        $("#slides2").trigger("play");
    }
});	
$('#item-2 a').on('click', function() {
      $("#slides2").trigger("play",true);
    });		
// Item 3
$("#slides3").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination3",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides3 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides3").trigger("pause");
    },
    callback: function() {
        $("#slides3").trigger("play");
    }
});	
$('#item-3 a').on('click', function() {
      $("#slides3").trigger("play",true);
    });		
// Item 4
$("#slides4").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination4",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides4 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides4").trigger("pause");
    },
    callback: function() {
        $("#slides4").trigger("play");
    }
});	
$('#item-4 a').on('click', function() {
      $("#slides4").trigger("play",true);
    });		
// Item 5
$("#slides5").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination5",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides5 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides5").trigger("pause");
    },
    callback: function() {
        $("#slides5").trigger("play");
    }
});	
$('#item-5 a').on('click', function() {
      $("#slides5").trigger("play",true);
    });		
// Item 6
$("#slides6").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination6",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides6 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides6").trigger("pause");
    },
    callback: function() {
        $("#slides6").trigger("play");
    }
});	
$('#item-6 a').on('click', function() {
      $("#slides6").trigger("play",true);
    });	
// Item 7
$("#slides7").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination7",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides7 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides7").trigger("pause");
    },
    callback: function() {
        $("#slides7").trigger("play");
    }
});	
$('#item-7 a').on('click', function() {
      $("#slides7").trigger("play",true);
    });	
// Item 8
$("#slides8").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination8",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides8 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides8").trigger("pause");
    },
    callback: function() {
        $("#slides8").trigger("play");
    }
});	
$('#item-8 a').on('click', function() {
      $("#slides8").trigger("play",true);
    });	
// Item 9
$("#slides9").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination9",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides9 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides9").trigger("pause");
    },
    callback: function() {
        $("#slides9").trigger("play");
    }
});	
$('#item-9 a').on('click', function() {
      $("#slides9").trigger("play",true);
    });	
// Item 10
$("#slides10").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination10",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides10 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides10").trigger("pause");
    },
    callback: function() {
        $("#slides10").trigger("play");
    }
});	
$('#item-10 a').on('click', function() {
      $("#slides10").trigger("play",true);
    });	
// Item 11
$("#slides11").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination11",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides11 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides11").trigger("pause");
    },
    callback: function() {
        $("#slides11").trigger("play");
    }
});	
$('#item-11 a').on('click', function() {
      $("#slides11").trigger("play",true);
    });	
// Item 12
$("#slides12").carouFredSel({
    width: 476,
    align: "left",
    height: 268,
    direction: "left",
	auto: false,
    items: {
        visible: 1,
        width: 476,
        height: 268
    },
    scroll: {
        fx: "crossfade",
        easing: "linear",
        duration: 800,
        pauseOnHover: true
    },
	pagination: {
	container: "#pagination12",
	items: 1,
	fx: "fade",
	easing: "linear",
	duration: 800
	}
});
$("#slides12 a").prettyPhoto({
    theme: 'light_square',
	changepicturecallback: function() {
        $("#slides12").trigger("pause");
    },
    callback: function() {
        $("#slides12").trigger("play");
    }
});	
$('#item-12 a').on('click', function() {
      $("#slides12").trigger("play",true);
    });		
});