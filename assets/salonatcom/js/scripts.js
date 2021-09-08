/*
◄------------------------------------------------------------► 
This file includes all cusomized javascript and all plugins libraries options 
◄------------------------------------------------------------►
*/

(function ($){
  //-- Enable Use Strict Mode --
  "use strict";

  // dropdown
  $(document).on('click' , '[data-toggle="dropdown"]' , function(e){
    e.preventDefault();
    $('[data-toggle="dropdown"]').not(this).removeClass('active').next('.dropdown-menu').removeClass('active').slideUp(300);
    $(this).toggleClass('active').next('.dropdown-menu').addClass('active').slideToggle(300);
  });

  $(document).on('click' , '.dropdown' , function(event){
    event.stopPropagation();
  });

  $(document).on('click' , 'html' , function(){
    $('[data-toggle="dropdown"]').removeClass('active').next('.dropdown-menu').removeClass('active').slideUp(300);
  });
  //------------------------------------
  //-- MAIN SLIDER --     
  $(window).load(function(){   
    var time = 10; // time in seconds
    var owl = $('.main-slider');
    var duration = 10000;

    var jQueryprogressBar,
        jQuerybar, 
        jQueryelem, 
        isPause, 
        tick,
        percentTime;    

    owl.on('initialize.owl.carousel initialized.owl.carousel ' , function(e){
      $('.owl-slider-item').each( function() {
        var $owlslideritem = $(this),
            animation = $owlslideritem.attr("data-owl-animation"),
            animationDelay = $owlslideritem.attr("data-owl-animation-delay");


        $('.' + e.type)
        $owlslideritem.addClass(animation +' owled');
        $owlslideritem.css({ 'animation-delay' : animationDelay });

        window.setTimeout(function() {
          $('.' + e.type)
          // $owlslideritem.removeClass(animation +' owled');
        } , duration);
      
      });
    });

    owl.owlCarousel({
      animateIn: 'fadeIn',
      animateOut: 'fadeOut',
      margin:0,
      loop:true,
      autoplay:true,
      autoplayTimeout:duration,
      autoplayHoverPause:false,
      nav: true,
      dots: false,
      stagePadding:0,
      smartSpeed:0,
      onInitialized: progressBar,
      onTranslated: moved,
      onDrag: pauseOnDragging,
      mouseDrag: false,
      touchDrag: false,
      responsive:{
        0:{
          items:1,
          slideBy: 1
        }
      }
    });


    // Init progressBar where elem is jQuery(".carousel-tweets")
    function progressBar(){    
      // build progress bar elements
      buildProgressBar();

      // start counting
      start();
    }

    // create div#progressBar and div#bar then prepend to jQuery(".carousel-tweets")
    function buildProgressBar(){
      jQueryprogressBar = jQuery("<div>",{
        id:"progress-bar"
      });

      jQuerybar = jQuery("<div>",{
        id:"bar"
      });

      jQueryprogressBar.append(jQuerybar).prependTo(owl);
    }

    function start() {
      // reset timer
      percentTime = 0;
      isPause = false;

      // run interval every 0.01 second
      tick = setInterval(interval, 10);
    };

    function interval() {
      if(isPause === false){
        percentTime += 1 / time;

        jQuerybar.css({
          width: percentTime+"%"
        });

        // if percentTime is equal or greater than 100
        if(percentTime >= 100){
          // slide to next item 
          owl.trigger("next.owl.carousel");
          percentTime = -1000; // give the carousel at least the animation time ;)
        }
      }
    }

    // pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }

    // moved callback
    function moved(){
      // clear interval
      clearTimeout(tick);

      // start again
      start();
    }
  });  

  var clientsss = $('.clients-carousel');

  clientsss.owlCarousel({
    margin: 30,
    loop:true,
    autoplay:true,
    nav: false,
    dots: false,
    stagePadding:0,
    smartSpeed:500,

    responsive:{
      0:{
        items:1,
        slideBy: 1
      },
      991:{
        items:4,
        slideBy: 4
      },
      1200:{
        items:5,
        slideBy: 5
      }
    }
  });


  var col3 = jQuery(".carousel-col-3");

  col3.owlCarousel({
    nav : true,
    dots : true,
    loop:true,
    autoplay : true,
    autoplayHoverPause: true,
    margin:30,
    responsive:{
      0:{
          items:1,
          slideBy: 1
      },
      768:{
          items:2,
          slideBy: 2
      },
      1200:{
          items:3,
          slideBy: 3
      }
    }
  });


  var col4 = jQuery(".carousel-col-4");

  col4.owlCarousel({
    nav : true,
    dots : true,
    loop:true,
    autoplay : true,
    autoplayHoverPause: true,
    margin:30,
    responsive:{
      0:{
          items:1,
          slideBy: 1
      },
      768:{
          items:2,
          slideBy: 2
      },
      991:{
          items:3,
          slideBy: 3
      },
      1200:{
          items:4,
          slideBy: 4
      }
    }
  });


  var col5 = jQuery(".carousel-col-5");

  col5.owlCarousel({
    nav : true,
    dots : true,
    loop:true,
    autoplay : true,
    autoplayHoverPause: true,
    margin:30,
    responsive:{
      0:{
          items:1,
          slideBy: 1
      },
      480:{
          items:2,
          slideBy: 2
      },
      768:{
          items:3,
          slideBy: 3
      },
      991:{
          items:5,
          slideBy: 5
      }
    }
  });


  //------------------------------------
  //tooltip
  $('[data-toggle="tooltip"]').tooltip();
  //------------------------------------
  // INPUT PLACEHOLDER
  $('input:not(input[type="checkbox"], input[type="radio"], input[type="submit"], input[type="file"], input[type="date"]),textarea').each(function(){
    // Use the "that" = $(this) Convention
    var that   = $(this),
        holder = $.trim($(this).attr('data-placeholder'));
    
    that.blur(function(){
      //Use Trim because users can type empty space
      if ($.trim(that.attr('placeholder')).length == 0 && $.trim(that.attr('placeholder')) != holder){
        that.attr('placeholder' ,holder);
      }
    })
    .focus(function(){
      if ($.trim(that.attr('placeholder')) == holder){
        that.attr('placeholder' ,'');
      }
    });
    that.trigger('blur');
  });
  //------------------------------------
  /* ◄------ WINDOW HEIGHT SECTION -------------------------------► */
  var windowH = $(window).height();
  var hederHeight = $('header').height();
  $('.main-slider-wrapper').css({ 'height' : windowH - hederHeight });
  //------------------------------------
  /* ◄------ chzn select -------------------------------► */
  var config = {
    '.chzn-select'           : {},
    '.chzn-select-deselect'  : {allow_single_deselect:true},
    '.chzn-select-no-single' : {disable_search_threshold:10},
    // '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
    // '.chzn-select-width'     : {width:"95%"}
  }

  for (var selector in config) {
    $(selector).chosen(config[selector]);
  }  
  //------------------------------------

  /* ◄------ jquery UI -------------------------------► */
  // date picker
  $( ".datepicker" ).datepicker({
    dateFormat: 'yy-mm-dd', 
    inline: true,
    showOtherMonths: true
  })
  .datepicker('widget').wrap('<div class="ll-skin-nigran">');
  //------------------------------



  /* ◄------ SET BACKGROUND IMAGE  -------------------------------► */
  $('.img-bg , .pattern-bg').each( function() {
    var section = $(this),
        bg = $(this).attr("data-bg-img");
    section.css('background-image', 'url('+ bg +')');
  });
  //------------------------------



  // multi select
  $(".mutliSelect-wrapper .dt a").on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $(this).parent().next(".mutliSelect-wrapper .dd").slideToggle('fast');
  });

  $(".mutliSelect-wrapper .dd ul li a").on('click', function() {
    $(".mutliSelect-wrapper .dd ul").hide();
  });

  function getSelectedValue(id) {
    return $("#" + id).find(".dt a span.value").html();
  }

  $(document).bind('click', function(e) {
    var $clicked = $(e.target);
    if (!$clicked.parents().hasClass("mutliSelect-wrapper")) {
      $(".mutliSelect-wrapper .dt a").removeClass('active');
      $(".mutliSelect-wrapper .dd").slideUp();
    }
  });

  $('.mutliSelect input[type="checkbox"]').on('click', function() {

    var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').data('value'),
      title = $(this).data('value');

    if ($(this).is(':checked')) {
      $(this).parent('li').addClass('active');
      var html = '<span title="' + title + '">' + title + '<i>,</i></span>';
      $(this).parents('.mutliSelect-wrapper').find('.multiSel').append(html);
      $(this).parents('.mutliSelect-wrapper').find(".hida").hide();
    } else {
      $('span[title="' + title + '"]').remove();
      $(this).parent('li').removeClass('active');
      // var ret = $(".hida");
      // $('.mutliSelect-wrapper .dt a').append(ret);
    }

    // alert($('.multiSel').children().length);

    $('.multiSel').each( function(){
      if ($(this).children().length == 0) {
        $(this).next(".hida").show();
      }else {
        $(this).next(".hida").hide();
      }  
    });

  });


  /* ◄------ MIXITUP -------------------------------► */
  // To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".

  var multiFilter = {
    
    // Declare any variables we will need as properties of the object
    
    $filterGroups: null,
    $filterUi: null,
    $reset: null,
    groups: [],
    outputArray: [],
    outputString: '',
    
    // The "init" method will run on document ready and cache any jQuery objects we will need.
    
    init: function(){
      var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
      
      self.$filterUi = $('#Filters');
      self.$filterGroups = $('.filter-group');
      self.$reset = $('#Reset');
      self.$container = $('.salons-filter');
      
      self.$filterGroups.each(function(){
        self.groups.push({
          $inputs: $(this).find('input'),
          active: [],
          tracker: false
        });
      });
      
      self.bindHandlers();
    },
    
    // The "bindHandlers" method will listen for whenever a form value changes. 
    
    bindHandlers: function(){
      var self = this,
          typingDelay = 300,
          typingTimeout = -1,
          resetTimer = function() {
            clearTimeout(typingTimeout);
            
            typingTimeout = setTimeout(function() {
              self.parseFilters();
            }, typingDelay);
          };
      
      self.$filterGroups
        .filter('.checkboxes')
        .on('click', function() {
          self.parseFilters();
        });
      
      self.$filterGroups
        .filter('.search')
        .on('keyup change', resetTimer);
      
      self.$reset.on('click', function(e){
        e.preventDefault();
        self.$filterUi[0].reset();
        self.$filterUi.find('input[type="text"]').val('');
        self.parseFilters();
      });
    },
    
    // The parseFilters method checks which filters are active in each group:
    
    parseFilters: function(){
      var self = this;
   
      // loop through each filter group and add active filters to arrays
      
      for(var i = 0, group; group = self.groups[i]; i++){
        group.active = []; // reset arrays
        group.$inputs.each(function(){
          var searchTerm = '',
              $input = $(this),
              ttt = $input.data('filter'),
              minimumLength = 3;
          
          if ($input.is(':checked')) {
            group.active.push(ttt);
          }
          
          if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
            searchTerm = this.value
              .trim()
              .toLowerCase()
              .replace(' ', '-');
            
            group.active[0] = '[class*="' + searchTerm + '"]'; 
          }
        });
        group.active.length && (group.tracker = 0);
      }
      
      self.concatenate();
    },
    
    // The "concatenate" method will crawl through each group, concatenating filters as desired:
    
    concatenate: function(){
      var self = this,
        cache = '',
        crawled = false,
        checkTrackers = function(){
          var done = 0;
          
          for(var i = 0, group; group = self.groups[i]; i++){
            (group.tracker === false) && done++;
          }

          return (done < self.groups.length);
        },
        crawl = function(){
          for(var i = 0, group; group = self.groups[i]; i++){
            group.active[group.tracker] && (cache += group.active[group.tracker]);

            if(i === self.groups.length - 1){
              self.outputArray.push(cache);
              cache = '';
              updateTrackers();
            }
          }
        },
        updateTrackers = function(){
          for(var i = self.groups.length - 1; i > -1; i--){
            var group = self.groups[i];

            if(group.active[group.tracker + 1]){
              group.tracker++; 
              break;
            } else if(i > 0){
              group.tracker && (group.tracker = 0);
            } else {
              crawled = true;
            }
          }
        };
      
      self.outputArray = []; // reset output array

      do{
        crawl();
      }
      while(!crawled && checkTrackers());

      self.outputString = self.outputArray.join();
      
      // If the output string is empty, show all rather than none:
      
      !self.outputString.length && (self.outputString = 'all'); 
      
      
      
      // ^ we can check the console here to take a look at the filter string that is produced
      
      // Send the output string to MixItUp via the 'filter' method:
      
      if(self.$container.mixItUp('isLoaded')){
        self.$container.mixItUp('filter', self.outputString);
      }
    }
  };
    
  // On document ready, initialise our code.

  $(function(){
        
    // Initialize multiFilter code
        
    multiFilter.init();
        
    // Instantiate MixItUp
        
    $('.salons-filter').mixItUp({
      controls: {
        enable: true
      },
      animation: {
        easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
        queueLimit: 3,
        duration: 600
      }
    });    
  });
  //------------------------------



  
  $('.has-offer').each(function(){
    $(this).find('.media-holder').append($('<div class="ribbon">Offer</div>'));
  });
  //------------------------------




  // CART
  // add service to cart
  $('.services').on('click', ".add-serv", function(e) {
    e.preventDefault();

    var link = $('<a href="#" class="remove-serv"><i class="fa fa-times"></i></a>'),
        dataCoverText = $('#services').attr("data-cover-text"),
        cover = $('<div class="cover"><strong>'+ dataCoverText +'</strong></div>');

    $('.no-services').hide();
    $('.contenuBook').show();

    $(this).parents('.service-in-list').prepend(cover).delay(1500).slideUp(500).addClass('removed').clone().prependTo('.cart').addClass('added').removeClass('removed').append(link).find('.cover').remove();
    setTimeout(function() {
      $('.removed').remove();

      $('.services-list').each(function(){
        if ($(this).children().length == 0) {
          $(this).next('.noserv').show();
        }
      });
    }, 2000);
  });

  // remove service from cart
  $('.cart').on('click', ".remove-serv", function(e) {
    e.preventDefault();
    var id = '#' + $(this).parents('.service-in-list').attr('data-category');
    $(this).parents('.service-in-list').slideUp(500).removeClass('added').addClass('returned').clone().prependTo(id).addClass('back').removeClass('returned').find('.remove-serv').remove();
    setTimeout(function() {
      $('.returned').remove();
      $('.back').removeClass('back');
      if ($('.cart').children().length == 0) {
        $('.no-services').show();
        $('.contenuBook').hide();
      };

    }, 500);

    $('.services-list').each(function(){
      if ($(this).children().length > 0) {
        $(this).next('.noserv').hide();
      }
    });
  });
  //------------------------------

    




















  // // RESPONSIVE
  // function checkSize(){
  //   var windowSize = $(window).width();
  //   if(windowSize < 992) {
  //     $('.main-nav').addClass('responsive-navigation dropdown').find('> ul').addClass('dropdown-menu');
  //   }
  //   else {
  //     $('.main-nav').removeClass('responsive-navigation dropdown').find('> ul').removeClass('dropdown-menu');
  //   }
  // }

  // checkSize();
  
  // $(window).resize(function(){checkSize()});
  //----------------------------------------
})($);