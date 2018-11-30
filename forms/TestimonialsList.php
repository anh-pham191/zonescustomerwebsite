{exp:channel:entries disable="member_data|pagination|categories" limit="1" channel="testimonials_list"}
{snippet-doctype}
<title>{seo_page_header_title_tlist} | Zones</title>
<script type="text/javascript" language="javascript">
    var navlevels = "singleicons";
</script>
{snippet-callfiles-new}
{FirstTimeVisitorEnable}
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebPage",
  "name": "{seo_page_header_title_tlist}",
  "publisher": {
    "@type": "Organization",
    "name": "Zones Landscaping Specialists",
	"url": "http://www.zones.co.nz",
	"telephone": "+64 0800301020",
  	"address": {
    "@type": "PostalAddress",
    "streetAddress": "Level 1, 287-289 Parnell Road",
    "addressLocality": "Parnell",
    "addressRegion": "Auckland",
    "postalCode": "1052",
    "addressCountry": "NZ"
    },
    "logo": {
      "@type": "ImageObject",
      "url": "http://www.zones.co.nz/design/logo-zones.png",
      "width": 155,
      "height": 60
    }
  },
  "description": "{seo_meta_description_tlist}"
}

</script>
{/exp:channel:entries}
<meta name="description" content="{seo_meta_description_tlist}">
<meta name="keywords" content="{seo_meta_keywords_tlist}">
<style>
    .trigger {
        background: #f1f1f1 !important;
    }

    #submit {
        background-color: #077b3a;
        color: #fff;
        cursor: pointer;
        transition: 0.3s;
        font-size: 1.4em;
        padding: 15px 35px !important;
        border-radius: 25px !important
    }
</style>
</head>
<body id="top">
<nav role="navigation" id="topnav">
    <div id="sitebanner" class="clearfix">
        <p class="fleft"><a href="{site_url}"><img src="{site_url}design/logo-zones.png"
                                                   alt="Zones Landscape Design and Maintenance"/></a></p>
        <ul id="site-main" class="fleft">
            {exp:navee:custom nav_title="TopLevel" wrap_type="none"}
            {if text == 'Our work'}
            <li class="current"><a href="{link}" class="button">{text}</a></li>
            {if:else}
            <li><a href="{link}" class="button">{text}</a></li>
            {/if}
            {/exp:navee:custom}
        </ul>

        {snippet-bannersearch}
    </div>
</nav>
<div id="wrapper" class="clearfix">
    <div class="breadcrumbspacer">
        <div class="inner">
            <div class="contextnav-breadcrumb withtoggle notmobile">
                <nav>

                    <ul class="clearfix">
                        <li><a href="/photo-gallery">Our work</a></li>
                        <li><a href="/customer-testimonials">Testimonials</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <ul id="section-sub" class="textnav clearfix">
        {exp:navee:custom nav_title="WorkWeveDoneL2" wrap_type="none"}
        {if text == 'Testimonials'}
        <li class="current"><a href="{link}">{text}</a></li>
        {if:else}
        <li><a href="{link}">{text}</a></li>
        {/if}
        {/exp:navee:custom}
    </ul>

    <!-- mobile nav start -->
    <div class="contextnav-wrapper top justmobile">
        <nav class="contextnav justmobile">
            <ul class="clearfix">
                {exp:navee:custom nav_title="WhatisRefreshL2" wrap_type="none"}
                {if link == '/{segment_1}/{segment_2}/'}
                <li class="current"><a href="{link}">{text}</a></li>
                {if:else}
                <li><a href="{link}">{text}</a></li>
                {/if}
                {/exp:navee:custom}

            </ul>
        </nav>
    </div>
    <div class="contextnav-wrapper icons areas justmobile">
        <nav class="contextnav icons justmobile">
            <ul class="clearfix" id="area-icons">

                {exp:channel:categories category_group="1" style="linear"}
                <li><a href="{site_url}{category_url_title}/"><img src="{site_url}design/image.png" alt=""
                                                                   class="sprite-icon-{category_url_title}" width="48"
                                                                   height="48"/>{category_description}</a></li>
                {/exp:channel:categories}
            </ul>
        </nav>
    </div>
    <div class="contextnav-toggle justmobile open"><a href="#"><span class="hidelink">Hide navigation</span><span
                    class="showlink">Show navigation</span></a></div>
    <div class="contextnav-breadcrumb withtoggle justmobile">
        <nav>
            <ul class="clearfix">
                <li><a href="{site_url}what-is-zones/landscape-design-and-garden-maintenance/">Our services</a></li>
                {exp:navee:custom nav_title="WhatisRefreshL2" wrap_type="none"}
                {if is_selected}
                <li><a href="{link}">{text}</a></li>
                {/if}
                {/exp:navee:custom}

            </ul>
        </nav>
    </div>
    <!-- end mobile nav -->

    <div id="breadcrumb-wrapper" style="display: none;">
        <nav id="breadcrumbline" role="navigation">
            <ul>
                <li class="home"><a href="{site_url}"><img src="{site_url}design/image.png" alt="Home"
                                                           class="sprite-bread-home" width="47" height="38"/></a></li>
                <li class="parent"><a href="{site_url}what-is-zones/landscape-design-and-garden-maintenance/">Our
                        services</a></li>
                {exp:navee:custom nav_title="WhatisRefreshL2" wrap_type="none"}
                {if is_selected}
                <li><a href="{link}">{text}</a></li>
                {/if}
                {/exp:navee:custom}
            </ul>
            <div class="sep"></div>
        </nav>
    </div>

    <!--    end heading wrapper  -->
    <!--    start body-->

    <div id="wideslideshow" class="overlay sm">
        <img src="/design/renovation-customer-giving-a-testimonial.jpg" alt="Customer Testimonials"/>
        <div class="overlay-container">
            <div class="text-content">
                <div class="heading-content">Customer Testimonials</div>
                <div class="intro-bottom">Our customers have good things to say about our home renovations.</div>
            </div>
        </div>
    </div>
    <div class="inner">

        <div class="testimonial-list">
            {exp:channel:entries channel="testimonial|video_testimonial" dynamic="no" orderby="date" sort="desc"
            disable="member_data|pagination" cache="yes" refresh="1500" limit="9999"}
            {if no_results}
            <div class="notfoundmsg">Sorry, no result found.</div>
            {/if}
            <div class="testimonial-box">
                <div class="box-icon" id="testimonial"></div>
                {if "{channel_short_name}" == "testimonial"}
                <div class="box-title">{title}</div>
                <div class="more">
                    {testimonial_copy}
                </div>
                {if:else}
                <div class="box-title">{title}
                    <div class="video-hide-right">HIDE VIDEO</div>
                </div>
                <div class="video" id="video-{count}"></div>
                {video_clips_tt limit="1"}
                <input type="hidden" name="video-url" value="{slideshow-video-url-tt}"/>
                {/video_clips_tt}
                <div class="more">
                    {summary_text_tt}
                </div>
                <div class="video-play">WATCH VIDEO</div>
                <div class="video-hide">HIDE VIDEO</div>
                {/if}

            </div>
            {/exp:channel:entries}


        </div>


    </div>



</div>
<div class="services-image-block clearfix">
    <img data-src="/design/Matt-besides-form.jpg" alt="Let's discuss your project"
         class="lazy-load fright notmobile"/>
    <div class="fleft">
        <div class="content-box" id="enquiry-form">
            <div class="title">Let's discuss your project</div>
            <div class="description">Arrange a free one hour consultation to discuss options and ideas or your home
                renovation project
            </div>
            <div class="theformarea-c formholder">
                <p class="instructions"></p>
                <form action="{site_url}forms/enquiry-stage1.php" method="post" id="enquiry-s1">
                    <!--first+last name-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 input-label-wrapper">
                            <input type="text" class="form-control" placeholder="Enter first name" name="firstName" id="firstName-s1" data-prefix="s1">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 input-label-wrapper">
                            <input type="text" class="form-control" placeholder="Enter last name"  name="lastName" id="lastName-s1" data-prefix="s1" >
                        </div>
                    </div>
                    <!--/first+last name-->

                    <!--email #-->
                    <div class="row">
                        <div class="col-md-12 input-label-wrapper">
                            <input type="text" class="form-control" placeholder="Enter email address" name="email" id="email-s1"  data-prefix="s1">
                        </div>
                    </div>
                    <!--/email #-->

                    <!--phone # + Preferred time #-->
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6 input-label-wrapper phone-number-stage1">

                            <input type="text" class="form-control" placeholder="Enter phone number" name="mobile" id="mobile-s1"  data-prefix="s1">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 input-label-wrapper">
                            <select id="select-preftime" name="preftime" class="apply-fancy form-control">
                                <option value="" selected="selected">Preferred time to be contacted</option>
                                <option value="Any Time">Don't mind</option>
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
                            </select>
                        </div>
                    </div>
                    <!--/phone # + Preferred time # #-->

                    <!--enquiry-->
                    <div class="row">
                        <div class="col-sm-12 col-xs-12 input-label-wrapper">
                            <textarea rows=5 class="form-control col-xs-12" name="enquiry" id="enquiry-s1" placeholder="Enter message / enquiry"></textarea>
                        </div>
                    </div>
                    <!--/enquiry-->

                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 desktop-right">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 input-label-wrapper">
                                    <label><input type="checkbox" class="uniform-styles" name="privacy" id="privacy-s1" checked="checked" data-prefix="s1" /> I have read, understood and accepted the <a href="/privacy-statement/" target="_blank">Privacy Policy.</a></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 input-label-wrapper">
                                    <label><input type="checkbox" class="uniform-styles" name="subscribe" id="subscribe-s1" checked="checked" /> I consent to receiving advice and information relating to home improvements.</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="col-sm-12 col-xs-12 input-label-wrapper">
                                <div class="g-recaptcha"></div>
                            </div>
                        </div>
                        <fieldset class="clearfix form-website">
                            <legend></legend>
                            <label id="c-enq-website" class="input fullwidth"><span>Prove you are human by leaving this field blank</span> <input type="text" name="website" autocomplete="off" /></label>
                        </fieldset>
                        <input type="hidden" name="formpage" id="formpage-s1"/>
                    </div>
                    <!--submit buttons-->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-blue" id="submit" onclick="submitEnquirePart1('Landscape Enquiry');">Submit Enquiry</button>
                        </div>
                    </div>
                    <!--submit buttons-->
                </form>
                <div id="prog1" class="progress" style="display: none;"></div>
            </div>
            <div class="adwordstracking"></div>
        </div>
    </div>
</div>


<div class="inner"> {snippet-partners}</div>


</div><!-- end #wrapper -->
{snippet-sidey}
{embed="includes/footer-new"}
{snippet-footer-scripts}
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
{snippet-init-visitor}
<script>
    var jWindow = $(window).width();

    var showChar = 500;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";

    $('.more').each(function () {
        var content = $(this).html();

        if (content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $('.testimonial-list').masonry();

    $(".video-play").click(function () {
        if (jWindow <= 768) {
            $(this).parent().css("width", "90%");
        } else {
            $(this).parent().css("width", "100%");
        }
        $(this).css("display", "none");
        $(this).next().css("display", "block");
        if (jWindow > 768) {
            $(this).parent().children('.box-title').children(".video-hide-right").css("display", "block");
        }
        $(this).parent().children('.video').css("display", "block");
        $(this).parent().children('.video').append('<iframe width="560" height="315" src="https://www.youtube.com/embed/' + $(this).parent().children('input[name="video-url"]').val() + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        $('.testimonial-list').masonry();
        $('html, body').animate({scrollTop: $("#" + $(this).parent().children('.video').attr('id')).offset().top}, 1000);
    });
    $(".video-play-mobile").click(function () {
        $('#video-box-mobile').html("");
        $(this).css("display", "none");
        $(this).next().css("display", "block");
        $('#video-box-mobile').show(1000);
        $('#video-box-mobile').append('<iframe width="560" height="315" src="https://www.youtube.com/embed/' + $(this).parent().children('input[name="video-url-mobile"]').val() + '?autoplay=1" frameborder="0" allowfullscreen></iframe>');
        $('html, body').animate({scrollTop: $("#video-box-mobile").offset().top - 130}, 1000);
    });

    $(".video-hide").click(function () {
        if (jWindow <= 768) {
            $(this).parent().css("width", "90%");
        } else {
            $(this).parent().css("width", "29%");
        }
        $(this).parent().children('.video').html("");
        $(this).parent().children('.video').css("display", "none");
        $(this).css("display", "none");
        $(this).prev().css("display", "block");
        $(".video-hide-right").css("display", "none");
        $('.testimonial-list').masonry();
    });
    $(".video-hide-right").click(function () {
        if (jWindow <= 768) {
            $(this).parent().parent().css("width", "90%");
        } else {
            $(this).parent().parent().css("width", "29%");
        }
        $(this).parent().parent().children('.video').html("");
        $(this).parent().parent().children('.video').css("display", "none");
        $(this).css("display", "none");
        $(this).parent().parent().children('.video-play').css("display", "block");
        $(".video-hide").css("display", "none");
        $('.testimonial-list').masonry();
    });
    $(".video-hide-mobile").click(function () {
        $('#video-box-mobile').html("");
        $('#video-box-mobile').hide(1000);
        $(this).css("display", "none");
        $(this).prev().css("display", "block");
    });
    $(".arrow-down").click(function () {
        $('html, body').animate({scrollTop: $("#services-box").offset().top - 130}, 1000);
    });
    $(".enquiry-link").click(function () {
        if (jWindow <= 768) {
            $('html, body').animate({scrollTop: $("#enquiry-form").offset().top}, 1000);
        } else {
            $('html, body').animate({scrollTop: $("#enquiry-form").offset().top - 200}, 1000);
        }

    });
    $('#region-select').on('change', function () {
        var url = $(this).val();
        if (url) { // require a URL
            window.location = url; // redirect
        }
        return false;
    });
    $(".link-builders").click(function () {
        $('html, body').animate({scrollTop: $(".near-you").offset().top - 100}, 500);
    });


    var pathArray = window.location.pathname.split('/');
    if (pathArray[3] == "sort") {
        $('html, body').animate({scrollTop: $("#builders").offset().top - 130}, 500);
    }


    $(".morelink").click(function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        // $(this).parent().prev().toggle();
        $(this).prev().children('.moreellipses').toggle(500);
        $(this).prev().children('.morecontent').children('span').toggle(500);
        if ($(this).hasClass("less")) {
            $('.testimonial-list').masonry();
        } else {
            setTimeout(function () {
                $('.testimonial-list').masonry()
            }, 1000);
        }
        return false;
    });

    function s_click(obj) {
        var num = 0;
        for (var i = 0; i < obj.options.length; i++) {
            if (obj.options[i].selected == true) {
                num++;
            }
        }
        if (num == 1) {
            var url = obj.options[obj.selectedIndex].value;
            window.location.href = url;
        }
    }
</script>
</body>
</html>