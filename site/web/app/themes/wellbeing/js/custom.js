jQuery(window).load(function() {

  if (jQuery('body').hasClass('single-places') || jQuery('body').hasClass('single-company') || jQuery('body').hasClass('single-trails')) {
    document.getElementById('shareBtn').onclick = function() {
      FB.ui({
        display: 'popup',
        method: 'share',
        href: window.location.href
      }, function(response){});
    }
  }
})
function arrows() {
  jQuery('.sf-field-taxonomy-sacred_places h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-sleep_stay h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-eat_drink h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-personal_service h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-visit_our_nature h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-cultural_historic_sites h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-made_in_localy_shop h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');
  jQuery('.sf-field-taxonomy-routes h4').append('<span class="arrow-in-search lnr lnr-chevron-down"></span>');

  jQuery('.sf-field-taxonomy-sacred_places').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-sleep_stay').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-eat_drink').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-personal_service').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-visit_our_nature').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-cultural_historic_sites').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-made_in_localy_shop').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
  jQuery('.sf-field-taxonomy-routes').prepend('<li class="main-li-checkbox"><input type="checkbox" name="main-check-tax" class="main-check-tax"><label for="main-check-tax" class="main-check-label"></label></li>');
}


// jQuery(document).on("sf:ajaxstart", ".searchandfilter", function() {
//   console.log('start');
//   arrows();
// });

jQuery(document).on("sf:init", ".searchandfilter", function() {
  // console.log('init');
  arrows();

  jQuery('.sf-level-0').each(function() {
    if (jQuery(this).hasClass('sf-option-active')) {
      jQuery(this).parent().parent().find('h4').addClass('opened-ul');

    }
  })
 
 // ON ANY CHANGE IF ALL CHECBOXES ARE SELECTED THEN THE MAIN CATEGORY CHECBOX WILL STAY SELECTED AS WELL

  jQuery('.main-li-checkbox').each(function() {
    var checkBoxes_length = jQuery(this).parent().find('.sf-input-checkbox').length;
    var checked_check_box_length = jQuery(this).parent().find('.sf-input-checkbox:checked').length;
    if (checkBoxes_length == checked_check_box_length) {
      jQuery(this).find('.main-check-tax').prop('checked', true);
    }
  });

 // FUNCTION TO CHECK ALL CHECKBOXES AT ONCE ON THE MAIN CHECKBOX

  jQuery(".main-check-label").on('click', function() {
      var maincheckbox = jQuery(this).parent().find('.main-check-tax');
      var checkBoxes_not_checked = jQuery(this).parent().parent().find('.sf-input-checkbox').not(':checked');
      var checkBoxes_checked = jQuery(this).parent().parent().find('.sf-input-checkbox:checked');
      var checkBoxes_length = jQuery(this).parent().parent().find('.sf-input-checkbox').length;
      var checked_check_box_length = jQuery(this).parent().parent().find('.sf-input-checkbox:checked').length;

      if (checkBoxes_length == checked_check_box_length) {
         checkBoxes_checked.trigger('click');
      }
      maincheckbox.prop("checked", !maincheckbox.prop("checked"));
      checkBoxes_not_checked.trigger('click');
      
  });  
});


jQuery(document).on("sf:ajaxfinish", ".searchandfilter", function() {
  // console.log('rezultati');
  arrows();
  
  jQuery('.sf-level-0').each(function() {
      if (jQuery(this).hasClass('sf-option-active')) {
        jQuery(this).parent().parent().find('h4').addClass('opened-ul');
      }
  })

   // ON ANY CHANGE IF ALL CHECBOXES ARE SELECTED THEN THE MAIN CATEGORY CHECBOX WILL STAY SELECTED AS WELL
  jQuery('.main-li-checkbox').each(function() {
      var checkBoxes_length = jQuery(this).parent().find('.sf-input-checkbox').length;
      var checked_check_box_length = jQuery(this).parent().find('.sf-input-checkbox:checked').length;
      if (checkBoxes_length == checked_check_box_length) {
        jQuery(this).find('.main-check-tax').prop('checked', true);
      }
    });

  // FUNCTION TO CHECK ALL CHECKBOXES AT ONCE ON THE MAIN CHECKBOX
  jQuery(".main-check-label").on('click', function() {
        var maincheckbox = jQuery(this).parent().find('.main-check-tax');
        var checkBoxes_not_checked = jQuery(this).parent().parent().find('.sf-input-checkbox').not(':checked');
        var checkBoxes_checked = jQuery(this).parent().parent().find('.sf-input-checkbox:checked');
        var checkBoxes_length = jQuery(this).parent().parent().find('.sf-input-checkbox').length;
        var checked_check_box_length = jQuery(this).parent().parent().find('.sf-input-checkbox:checked').length;

        if (checkBoxes_length == checked_check_box_length) {
           checkBoxes_checked.trigger('click');
        }
        maincheckbox.prop("checked", !maincheckbox.prop("checked"));
        checkBoxes_not_checked.trigger('click');
        
    });  

});

jQuery(document).ready(function() {

  if (jQuery('html').attr('lang') == 'de-DE' && jQuery('body').hasClass('page-template-register-template')) {
    jQuery('.confirm-pass').text('Bestätige das Passwort');
    jQuery(document).ajaxStop(function(){
      setTimeout(function(){
        jQuery('.confirm-pass').text('Bestätige das Passwort');
      }, 5);
    })
  }
  if (jQuery('html').attr('lang') == 'sv-SE' && jQuery('body').hasClass('page-template-register-template')) {
    jQuery('.confirm-pass').text('Bekräfta ditt lösenord');
    jQuery(document).ajaxStop(function(){
      setTimeout(function(){
        jQuery('.confirm-pass').text('Bekräfta ditt lösenord');
      }, 5);
    })
  }

  if (jQuery('html').attr('lang') == 'da-DK' && jQuery('body').hasClass('page-template-evaluation-form-page')) {
    jQuery('span.frm_required').text('Obligatorisk spørgsmål');
    jQuery(document).ajaxStop(function(){
      setTimeout(function(){
        jQuery('span.frm_required').text('Obligatorisk spørgsmål');
      }, 5);
    })
  }

  jQuery('.form-submit #submit').addClass('rmp-rating-widget__submit-btn');

  jQuery('.append-climate-button').appendTo('.appended-content');

  jQuery(function () {
       jQuery('.acc-title').click(function () {
           jQuery(this).next('div').slideToggle();
           jQuery(this).find('.lnr-chevron-down').toggleClass('flipit');
           jQuery(this).parent().siblings().children().next().slideUp();
           jQuery('.acc-title').not(this).find('.lnr-chevron-down').removeClass('flipit');
           
           return false;
       });

   });



  
  jQuery('.res-ratings-main .js-rmp-avg-rating').appendTo('.span-res-ratings');
  jQuery('span.js-rmp-vote-count').append(' ratings');
  jQuery('span.add-rating').click(function(){
    jQuery('.open-vote-section').addClass('open-vote-section-opened');
  })
  jQuery('.cancel-vote').click(function(){
    jQuery('.open-vote-section').removeClass('open-vote-section-opened');
  })







  jQuery(document).ajaxStop(function(){
    if (jQuery('.rmp-rating-widget__msg').text() !== '') {
      setTimeout(function(){
        jQuery('.open-vote-section').removeClass('open-vote-section-opened');
      }, 2000);
    }
  })

  if (jQuery('body').hasClass('home')) {
    var maxCookieValue = 1, initCookie = 1, expirationDays = 1;
    var cookieName = "homepagepopup";
    var getCookie = Cookies.get(cookieName);

    
      if (getCookie == null) {
        Cookies.set(cookieName, initCookie, { expires: expirationDays });
        // console.log('Cookie set to value 1');
        setTimeout(function(){
          jQuery('#myModal').modal('show');
        }, 2000);
      } 
    else {
     if (getCookie >= initCookie && getCookie < maxCookieValue) {
       getCookie++;
       Cookies.set(cookieName, getCookie, { expires: expirationDays });
       // console.log('Cookie incremented. Value is ' + getCookie);
       setTimeout(function(){
         jQuery('#myModal').modal('show');
       }, 2000);
     }
     if (getCookie >= maxCookieValue) {
       // console.log('Cookie max allowed value reached: ' + getCookie);
     }
    }
  }
  jQuery('.cost_btn_wrap a').on('click', function(){
    jQuery('#webclosebtn2').trigger('click');
    setTimeout(function(){
      jQuery('body').addClass('modal-open');
    }, 400);
  })
  jQuery('body').on('click', '.favorites-button', function(){
    jQuery('.favourite-content').css('right', '0');
    jQuery('.favourite-content-overlay').show();
  })
  jQuery('body').on('click', '.favourite-content span.lnr.lnr-cross', function(){
    jQuery('.favourite-content').css('right', '-410px');
    jQuery('.favourite-content-overlay').hide();
  })
  jQuery('body').on('click', '.searchandfilter ul li h4', function() {
    jQuery(this).toggleClass('opened-ul');
  });
  


  var $document = jQuery(document),
      $element = jQuery('#header'),
      className = 'hasScrolled';

  $document.scroll(function() {
      if ($document.scrollTop() >= 150) {
          $element.addClass(className);
      } 
      else {
          $element.removeClass(className);
      }
  });
  // jQuery(document).on('click', 'a[href^="#"]', function (event) {
  //     event.preventDefault();

  //     jQuery('html, body').animate({
  //         scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top
  //     }, 500);
  // });
  jQuery('.pages-slider').slick({
      dots: false,
      arrows: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 800,
      slidesToShow: 4,
      prevArrow: '.small-prev',
      nextArrow: '.small-next',
      responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
      ]
  });


   jQuery('#sbi_images').slick({
      dots: false,
      arrows: true,
      infinite: false,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 800,
      slidesToShow: 4,
      responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
      ]
  });

  jQuery('body').on('click', '.view-all-photos', function(){
    jQuery('.hiden-images-slide').css('display', 'flex');
    jQuery('.slide-images-singles').slick({
        dots: true,
        arrows: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 6000,
        speed: 800,
        slidesToShow: 1
    });
    // check to see if there are one or less slides
    if (!(jQuery('.slide-images-singles .slick-slide').length > 1)) {
        jQuery('.slide-images-singles .slick-dots').hide();
    }
    
  })
  jQuery('.close-popup').click(function(){
    jQuery('.hiden-images-slide').css('display', 'none');
    jQuery('.slide-images-singles').slick('destroy');
  })


  jQuery('.slide-images').slick({
      dots: true,
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 800,
      slidesToShow: 1
  });
    // check to see if there are one or less slides
    if (!(jQuery('.slide-images .slick-slide').length > 1)) {
        jQuery('.slide-images .slick-dots').hide();
    }
    var animation = 'rubberBand';
        
    jQuery('.menu-icon').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      jQuery('.mobile-menu-holder').toggleClass('active-menu');
      jQuery('.desktop-menu').toggleClass('show-menu');
      jQuery(this).toggleClass('menu-icon--active');
    });
      
    jQuery('.menu-icon').on('click', function () {
      jQuery(this).addClass('animated ' + animation).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
      jQuery(this).removeClass('animated ' + animation);
      });
    });
       
    // if (jQuery('#menu-main-menu li').hasClass('wpml-ls-current-language')) {    
    //   jQuery('.menu-item-has-children > a'):not('.wpml-ls-current-language > a').append('<span class="click-li-child"><span class="lnr lnr-chevron-down"></span>');
    // }

    jQuery('.wpml-ls-current-language > a').click(function(e){
      e.preventDefault();
      jQuery(this).toggleClass('flipX');
      jQuery(this).parent().find('ul').slideToggle();
    })

    jQuery('.click-li-child').click(function(e){
      e.preventDefault();
      jQuery(this).toggleClass('flipX');
      jQuery(this).parent().next().slideToggle();
    })
     
});