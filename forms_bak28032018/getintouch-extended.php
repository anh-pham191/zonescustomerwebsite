<!DOCTYPE html>
<html dir="ltr" lang="en-nz">
<head>
<meta charset="utf-8">
<script type="text/javascript" language="javascript">
$("input.uniform-stylespop").uniform();

(function($) {
    function toggleLabel() {
        var input = $(this);
        setTimeout(function() {
            var def = input.attr('title');
            if (!input.val() || (input.val() == def)) {
                input.prev('span').css('visibility', '');
                if (def) {
                    var dummy = $('<label></label>').text(def).css('visibility','hidden').appendTo('body');
                    input.prev('span').css('margin-left', dummy.width() + 3 + 'px');
                    dummy.remove();
                }
            } else {
                input.prev('span').css('visibility', 'hidden');
            }
        }, 0);
    };

    function resetField() {
        var def = $(this).attr('title');
        if (!$(this).val() || ($(this).val() == def)) {
            $(this).val(def);
            $(this).prev('span').css('visibility', '');
        }
    };

    $('.form input').live('cut', toggleLabel);
	$('.form textarea').live('cut', toggleLabel);
	$('#topnav input').live('cut', toggleLabel);

    $('.form input').live('keydown', toggleLabel);
    $('.form input').live('paste', toggleLabel);
	$('.form textarea').live('keydown', toggleLabel);
    $('.form textarea').live('paste', toggleLabel);
	$('#topnav input').live('keydown', toggleLabel);
    $('#topnav input').live('paste', toggleLabel);
    //$('select').live('change', toggleLabel);

    $('.form input').live('focusin', function() {
        $(this).prev('span').css('color', '#f0f0f0');
    });
	 $('.form textarea').live('focusin', function() {
        $(this).prev('span').css('color', '#f0f0f0');
    });
	$('#topnav input').live('focusin', function() {
        $(this).prev('span').css('color', 'transparent');
    });
    $('.form input').live('focusout', function() {
        $(this).prev('span').css('color', '#191919');
    });
	 $('.form textarea').live('focusout', function() {
        $(this).prev('span').css('color', '#191919');
    });
	$('#topnav input').live('focusout', function() {
        $(this).prev('span').css('color', '#ffffff');
    });

    // set things up as soon as the DOM is ready
    $(function() {
        $('.form input').each(function() { toggleLabel.call(this); });
		$('.form textarea').each(function() { toggleLabel.call(this); });
    });

    // do it again to detect Chrome autofill
    $(window).load(function() {
        setTimeout(function() {
            $('.form input').each(function() { toggleLabel.call(this); });
			$('.form textarea').each(function() { toggleLabel.call(this); });
			$('#topnav input').each(function() { toggleLabel.call(this); });
        }, 0);
    });

})(jQuery);

$(function() {
// Rightbar Get in touch form part 2
$("#right-getintouch-2").validate({	
    submitHandler: function(form) {
      $('#right-getintouch-2').append('<input type="text" name="frompage" style="display:none;" value="' + window.location.hostname + window.location.pathname+'" />');
	  $('#prog2').fadeIn(100);
      $.ajax({
        url: $(form).attr("action"),
        type: "POST",
        data: $(form).serialize(),
        success: function(response) {
          if (response.match(/Invalid/i)) {
              //Display try again message above form
            $('#prog2').fadeOut(200);
			$('.instructions').html('There was an error, please try again.').css({'color':'red'});
          } else if (response.match(/Unuccessful/i)) {
			//Display failure message in place of form
            $('#prog2').fadeOut(200);
			$('#theformarea-rh-extended').html('<h2>Your form could not be submitted. Please try again later.</h2><p><a href="#" onclick="$(\'#form2\').fadeOut(1500);return false;">Close</a></p>');
          } else {
            $('#form2').css('display','none');
			$('#form1').css('display','block');
			$('.theformarea-rh').css({'border-width':'5px','border-color':'#ccc','border-style':'solid'});
			_gaq.push(['_trackEvent', 'Enquiry submitted', 'Submit enquiry', '0001 Refresh Contact - Right hand side get in touch stage 2']);
            ga('send', 'event', 'Enquiry submitted', 'Submit enquiry', '0001 Refresh Contact - Right hand side get in touch stage 2');
            fbq('track', 'ENQUIRY_SUBMITTED', { action: 'submit_enquiry', label: 'Right hand side get in touch stage 2'});
            window.uetq = window.uetq || []; window.uetq.push({ 'ec': 'Enquiry Submitted', 'ea': 'Submit Enquiry', 'el': 'Right hand side get in touch stage 2', 'ev': 1 });		
          }
        },
        error: function() {
          //Display failure message in place of form
          $('#prog2').fadeOut(200);
		  $('#theformarea-rh-extended').html('<h2>Your form could not be submitted. Please try again later.</h2><p><a href="#" onclick="$(\'#form2\').fadeOut(1500);return false;">Close</a></p>');
        }
      });
    }
  });

});

</script>
<title>Get in touch | Refresh Renovations</title>
</head>
<body>
<div id="theformarea-rh-extended">
<div class="clearfix">
<div class="fleft" style="width: 595px;">
<h2>Would you like to provide more information?</h2>
<p class="instructions">Thank-you for your enquiry, to enable us to process your enquiry more efficiently, <br />would you like to provide more details about your renovation project?</p> 
</div>
<form class="fleft" style="width: 200px; margin-top: 53px;">
<label class="radiostyle" style="margin-right: 16px;"><input type="radio" class="uniform-stylespop" id="part2-yes" name="part2-complete" value="Yes" checked="checked" /> Yes</label> 
<label class="radiostyle" onclick="$('#form2').css('display','none');$('#form1').css('display','block');$('.theformarea-rh').css({'border-width':'5px','border-color':'#ccc','border-style':'solid'});"><input type="radio" class="uniform-stylespop" id="part2-no" name="part2-complete" value="No" /> No</label> 
</form>
</div>
<form action="/forms/getintouch-part2.php" method="post" id="right-getintouch-2" class="clearfix">
<fieldset class="fleft col1">
<legend></legend>
<label id="e-enq-firstname" class="input"><span>First name</span> <input type="text" name="ep-enq-firstname" class="required" value="<?php echo $_COOKIE['gfirstnamestored'];?>" /></label>
<label id="e-enq-email" class="input"><span>Email address</span> <input type="email" name="ep-enq-email" class="email required" value="<?php echo $_COOKIE['gemailstored'];?>" /></label>
<label id="e-enq-enquiry" class="input"><span>Enquiry</span> <textarea rows="2" name="ep-enq-enquiry"></textarea></label>
<label id="e-enq-tel" class="input"><span>Phone number</span> <input type="text" name="ep-enq-tel" value="<?php echo $_COOKIE['gphonestored'];?>" /></label>
</fieldset>
<fieldset class="fleft col2">
<legend></legend>
<label id="e-enq-lastname" class="input"><span>Last name</span> <input type="text" name="ep-enq-lastname" /></label>
<label id="e-enq-address" class="input"><span>Street address</span> <input type="text" name="ep-enq-address" /></label>
<label id="e-enq-suburb" class="input"><span>Suburb</span> <input type="text" name="ep-enq-suburb" /></label>
<label id="e-enq-city" class="input"><span>City</span> <input type="text" name="ep-enq-city" /></label>
<label id="e-enq-budget" class="input"><span>Budget (optional)</span> <input type="text" name="ep-enq-budget" /></label>
</fieldset>
<fieldset class="fleft col3">
<legend></legend>
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-kitchen" name="p-enq-reno[]" value="Kitchen renovation" /> Kitchen renovation</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-house" name="p-enq-reno[]" value="House extension" /> House extension</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-basement" name="p-enq-reno[]" value="Basement conversion" /> Basement conversion</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-reclad" name="p-enq-reno[]" value="Re-clad home" /> Re-clad home</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-openplan" name="p-enq-reno[]" value="Create open-plan" /> Create open-plan</label> 
</fieldset>
<fieldset class="fleft col4">
<legend></legend>
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-bathroom" name="p-enq-reno[]" value="Bathroom renovation" /> Bathroom renovation</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-loft" name="p-enq-reno[]" value="Loft room conversion" /> Loft room conversion</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-flow" name="p-enq-reno[]" value="Indoor-outdoor flow" /> Indoor-outdoor flow</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-warmup" name="p-enq-reno[]" value="Warm up home" /> Warm up home</label> 
<label class="radiostyle"><input type="checkbox" class="uniform-stylespop" id="p-enq-reno-outdoor" name="p-enq-reno[]" value="Outdoor renovation" /> Outdoor renovation</label> 
</fieldset>
<fieldset class="fright doublecol2">
<legend></legend>
<input type="submit" value="Update" name="send" id="c-enq-submit" class="submitbutton" />
</fieldset>
<p class="fleft doublecol1">Alternatively you can contact us on 0800 33 60 33</p>
</form>
<a id="closelinkleft" href="#" onclick="$('#form2').css('display','none');$('#form1').css('display','block');$('.theformarea-rh').css({'border-width':'5px','border-color':'#ccc','border-style':'solid'});return false;"><img src="/design/getintouch2-close.png" alt="Close" /></a>
<a id="closelinkright" href="#" onclick="$('#form2').css('display','none');$('#form1').css('display','block');$('.theformarea-rh').css({'border-width':'5px','border-color':'#ccc','border-style':'solid'});return false;">close</a>
<div id="prog2" class="progress" style="display: none;"></div>
<!-- end #theformarea-rh-extended --></div>
</body>
</html>