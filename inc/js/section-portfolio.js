
/*
 * PORTFOLIO
 */
var inPortfolio = inPortfolio || {};
inPortfolio = {
  portfolio_xml: "",
  search: "",
  category: "all",
  time: "all",
  start_client: "",
  cur_pid: "",
  image_types: Array("png", "jpg", "jpeg", "gif", "tif", "bmp"),
  portfolioLoaded:false,
  useHashtags:true,
  init: function(){

    var a = document.location.toString();
    if (a.match("#")){
      inPortfolio.start_client = a.split("#")[1];
    }

      $.ajax({
          dataType: "xml",
          type: "POST",
          url: "/wp-admin/admin-ajax.php",
          success: inPortfolio.displayPortfolio,
          data: "action=getportfolio"
      });

      $("#go-prev").click(function() {
      if ($("#portfolio-list li:first-child a").is(".project_selected")) {
              $("#portfolio-list a:last").click();
          } else {
              $(".project_selected").parent().prev().find("a").click();
          }
      });
      $("#go-next").click(function() {
      if ($("#portfolio-list li:last-child a").is(".project_selected")) {
              $("#portfolio-list a:first").click();
          } else {
              $(".project_selected").parent().next().find("a").click();
          }
      });
      $("#filter a").click(function(){
          if (typeof(clicky) != "undefined") {
        clicky.log("portfolio/design-work/#" + $(this).html(), "Filter: " + $(this).html());
          }
      if ($("#portfolio-list").is(":visible")) {
              $(this).html("see full list");
          } else {
              $(this).html("hide list");
          }
          $("#portfolio-list").slideToggle("slow");
      });

      // Logo Reveal More
      var logoSection = $('.portfolio-logo-section');
      if(logoSection.length > 0){
        var logoWrapper = logoSection.children('.wpb_wrapper');
        var logoRow = logoSection.children().children('.row');
        logoWrapper.append("<div class='portfolio-read-more'><div class='portfolio-logo-button'><a href='' class='btn smaller'>See More Clients</a></div></div>");

        var showMoreBtn = $('.portfolio-logo-button');
        showMoreBtn.click(function(event){
          $('html,body').animate({
            scrollTop: $('.portfolio-read-more').offset().top + $('.portfolio-read-more').outerHeight(true)},
          'slow');

          event.preventDefault();
          var totalHeight = 0;
          logoRow.each(function() {
            totalHeight += $(this).outerHeight();
          });

          logoSection.css('height', '700px');
          logoSection.addClass('show-more');
          logoSection.css('height', totalHeight);

          $('.portfolio-read-more').fadeOut();

          return false;
/*
        $up
          .css({
            // Set height to prevent instant jumpdown when max height is removed
            "height": $up.height(),
            "max-height": 9999
          })
          .animate({
            "height": totalHeight
          });

        // fade out read-more
        $p.fadeOut();

        // prevent jump-down
        return false;




          console.log(height);
          logoSection.css('height', height);
          logoSection.css('max-height, 9999');
          logoSection.animate('height', height);

          $('.portfolio-read-more').fadeOut();

          return false;*/
      });
    }

  },
  displayPortfolio: function(b, a){

      inPortfolio.portfolio_xml = b;

    $(".sort-sentence").html('').append('<li><a class="selected" id="all" href="javascript:void(0);">All</a></li>');
      $(inPortfolio.portfolio_xml).find("category").each(function() {
          $(".sort-sentence").append('<li><a class="selected" id="' + $(this).attr("id") + '" href="javascript:void(0);">' + $(this).text() + "</a></li>");
      });

      $(".sort-sentence a").click(function() {

          if ($(this).attr("id") != "all"){
              $(".sort-sentence a").removeClass("selected");
              $("#" + $(this).attr("id")).addClass("selected");
          } else {
              $(".sort-sentence a").addClass("selected");
          }
          inPortfolio.loadProjects();

          insGlobal.trackGA(null, "Portfolio", "View Category", $(this).attr("id"));
          if (typeof(clicky) != "undefined"){
              clicky.log(window.location.pathname + "#" + $(this).attr("id"), "Portfolio filter: " + $(this).attr("id"));
          }

      });

      inPortfolio.loadProjects();

  },
  loadProjects: function(){

      inPortfolio.search = "project";
    if( $("#all.selected").length == 0 ){
      $(".sort-sentence a.selected").each(function(){
            inPortfolio.search = inPortfolio.search + "[category=" + $(this).attr("id") + "]";
        });
    }

      $("#portfolio-list").html("<ul></ul>");
      $(inPortfolio.portfolio_xml).find(inPortfolio.search).each(function() {
          $("#portfolio-list ul").append('<li title="' + $(this).find("title").text() + '"><a pid="' + $(this).attr("id") + '" href="#' + $(this).attr("slug") + '">' + $(this).find("title").text() + "</a></li>");
      });
      $("#portfolio-list a").click(function() {
          inPortfolio.loadProject($(this).attr("pid"));
      });
      $("#catcount").html('Browse <span>(<span id="catindex">1</span> of ' + $(inPortfolio.portfolio_xml).find(inPortfolio.search).length + ")</span>");
      if (inPortfolio.start_client == "") {
          $("#portfolio-list li:first-child a").click();
      } else {
          $('#portfolio-list a[href="#' + inPortfolio.start_client + '"]').click();
          inPortfolio.start_client = "";
      }

  },
  loadProject: function(a){

      $("#client-visual img, #client-visual iframe").hide();
      $(".tour-item").remove();
      $("#client-visual").addClass("iLoader");
      project_info = $(inPortfolio.portfolio_xml).find('project[id="' + a + '"]');
      $(inPortfolio.portfolio_xml).find('project[status="current"]').attr("status", "");
      $(inPortfolio.portfolio_xml).find('project[id="' + a + '"]').attr("status", "current");
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );
      $("#portfolio-item .portfolio-item-header h2").html( project_info.find("title").text() );


    // If we are on the portfolio page, use hashtags
    if ( $('.page-template-page-templatespage-portfolio-php').length > 0 ) {
      window.location.hash = project_info.attr("slug");
      document.title = "Insivia Portfolio | " + project_info.find("title").text() + " | Marketing + Web Design";
    }

      switch (project_info.attr("category"))
      {
          case "web":
              $("<img />").attr("src", project_info.find("current").text()).load(function()
              {
                  $("#client-visual").removeClass("iLoader");
                  $("#client-visual").html($(this)).fadeIn("slow", function(){
                      inPortfolio.getNext();
                  });
                  if (project_info.find("tour").length)
                  {
                      project_info.find("spotlight").each(function()
                      {
                          $("#portfolio-item").append('<div class="tour-item"><a class="touricon" href="javascript:void(0);" style="top:' + $(this).attr("posy") + "px;left:" + $(this).attr("posx") + 'px;">&nbsp;</a><article class="tourbox-top" style="top:' + ($(this).attr("posy") - 9) + "px;left:" + ($(this).attr("posx") - 184) + 'px;"><p>' + $(this).text() + "</p></article></div>");
                      });
                      $(".touricon").delay(600).fadeIn("slow", function()
                      {
                          $(this).delay(400).fadeOut("slow", function()
                          {
                              $(this).delay(200).fadeIn("slow");
                          });
                      });
                      $(".touricon").bind("mouseenter", function(c)
                      {
                          var b = $(this);
                          $(this).parent().find("article").css(
                          {
                              display: "block"
                          }).animate(
                          {
                              opacity: 1
                          }, 300);
                      });
                      $(".tourbox-top").bind("mouseleave", function(b)
                      {
                          $(this).parent().find("article").animate(
                          {
                              opacity: 0
                          }, 300, function()
                          {
                              $(this).css(
                              {
                                  display: "none"
                              });
                          });
                      });
                  }
              });
              $("#altopts").html("&nbsp;");
              if (project_info.find("before").length)
              {
                  $("#altopts").append('<span class="text-shift before versionshift" showing="current" project="' + a + '"></span>');
                  $(".versionshift").attr("altbefore", project_info.find("before").text());
                  $(".versionshift").attr("altcurrent", project_info.find("current").text());
                  $(".versionshift").click(function()
                  {
                      $("#client-visual img").remove();
                      $("#client-visual").addClass("iLoader");
                      if ($(this).attr("showing") == "before")
                      {
                          $(".touricon").animate({opacity: 1});
                          $(".versionshift").addClass("before").removeClass("current");
                          $("#client-visual").html('<img src="'+$(this).attr("altcurrent")+'" />');
                          $("#client-visual img").load(function()
                          {
                              $("#client-visual").html($(this)).fadeIn("fast", function()
                              {
                                  inPortfolio.getNext();
                              });
                              $("#client-visual").removeClass("iLoader");
                          });
                          $(this).attr("showing", "current");
                          if (typeof(clicky) != "undefined"){clicky.log(window.location.pathname + "#" + project_info.attr("slug") + "-current", "View Current");}
                      }
                      else
                      {
                          $(".touricon").clearQueue().stop();
                          $(".touricon").css('opacity', '0');
                          $(".versionshift").addClass("current").removeClass("before");
                          $("#client-visual").html('<img src="'+$(this).attr("altbefore")+'" />');
                          $("#client-visual img").load(function()
                          {
                              $("#client-visual").html($(this)).fadeIn("fast", function()
                              {
                                  inPortfolio.getNext();
                              });
                              $("#client-visual").removeClass("iLoader");
                          });
                          $(this).attr("showing", "before");
                          if (typeof(clicky) != "undefined")
                          {
                clicky.log(window.location.pathname + "#" + project_info.attr("slug") + "-before", "View Before");
                          }
                      }
                  });
              }
              if (project_info.find("url").length)
              {
                  $("#altopts").append('<a class="text-shift explore" href="" target="_blank"></a>');
                  $(".explore").attr("href", "http://" + project_info.find("url").text());
                  $(".explore").html("http://" + project_info.find("url").text());
                  $("#portfolio #portfolio-item #altopts span, #portfolio #portfolio-item #altopts a").bind("click", function()
                  {
                      var b = $("#portfolio #portfolio-item h2").text();
                      var c = $("#portfolio #portfolio-sort ul li").find("a.selected");
                      if (c.length > 1)
                      {
                          c = "All";
                      }
                      else
                      {
                          c = $(c).text();
                      }
                      _gaq.push(["_setCustomVar", 1, "Portfolio Filter", c, 3]);
                      if ($(this).is("span"))
                      {
                          if ($(this).hasClass("current"))
                          {
                              insGlobal.trackGA(null, "Portfolio", "Before Screen", b);
                          }
                          else
                          {
                              insGlobal.trackGA(null, "Portfolio", "Current Screen", b);
                          }
                      }
                      else
                      {
                          insGlobal.trackGA(null, "Portfolio", "View Site", b);
                          if (typeof(clicky) != "undefined")
                          {
                              clicky.log("http://" + project_info.find("url").text(), "View Site " + b);
                          }
                      }
                  });
              }
              break;
          case "print":
          case "marketing":
          case "identity":
          case "mobile":
              $("<img />").attr("src", project_info.find("image:first").text()).load(function()
              {
                  $("#client-visual").html($(this)).fadeIn("slow", function()
                  {
                      inPortfolio.getNext();
                  });
                  $("#client-visual").removeClass("iLoader");
              });
              $("#altopts").html("");
              if (project_info.find("image").length > 1)
              {
                  project_info.find("image").each(function()
                  {
                      if ($(this).attr("title") != undefined)
                      {
                          title = 'title="' + $(this).attr("title") + '"';
                      }
                      else
                      {
                          title = "";
                      }
                      $("#altopts").append('<span class="text-shift altopts" altopt="' + $(this).text() + '" ' + title + "></span>");
                  });
                  $("#altopts span:first").addClass("altopts_selected");
                  $(".altopts").click(function()
                  {
                      $("#client-visual img").hide();
                      $("#client-visual").addClass("iLoader");
                      $(".altopts_selected").removeClass("altopts_selected");
                      $("<img />").attr("src", $(this).attr("altopt")).load(function()
                      {
                          $("#client-visual").html($(this)).fadeIn("slow", function()
                          {
                              inPortfolio.getNext();
                          });
                          $("#client-visual").removeClass("iLoader");
                      });
                      $(this).addClass("altopts_selected");
                  })
              }
              break;
          case "media":
              $("#client-visual").html('<iframe width="853" height="480" src="' + project_info.find("video:first").text() + '" frameborder="0" allowfullscreen></iframe>').fadeIn("slow", function(){
                  inPortfolio.getNext();
              });
              $("#altopts").html("");
              if (project_info.find("video").length > 1)
              {
                  project_info.find("video").each(function()
                  {
                      if ($(this).attr("title") != undefined)
                      {
                          title = 'title="' + $(this).attr("title") + '"';
                      }
                      else
                      {
                          title = "";
                      }
                      $("#altopts").append('<span class="text-shift altopts" altopt="' + $(this).text() + '" ' + title + "></span>");
                  });
                  $("#altopts span:first").addClass("altopts_selected");
                  $(".altopts").click(function()
                  {
                      $("#client-visual iframe").hide();
                      $("#client-visual").addClass("iLoader");
                      $(".altopts_selected").removeClass("altopts_selected");
                      $("#client-visual").html('<iframe width="853" height="480" src="' + $(this).attr("altopt") + '" frameborder="0" allowfullscreen></iframe>').fadeIn("slow", function(){
                          inPortfolio.getNext();
                      });
                      $(this).addClass("altopts_selected");
                  });
              }
              break;
      }
      $(".project_selected").removeClass("project_selected");
      $('a[pid="' + a + '"]').addClass("project_selected");
      inPortfolio.cur_pid = a;
      $("#catindex").html(($(".project_selected").parent().index() + 1));

      insGlobal.trackGA(null, "Portfolio", project_info.attr("category"), $("h2").html());
      if (typeof(clicky) != "undefined"){
          clicky.log(window.location.pathname + "#" + project_info.attr("slug"), "View project " + project_info.find("title").text());
      }

  },
  getNext:function()
  {

      var c = [];
      var d = $('a[pid="' + inPortfolio.cur_pid + '"]');
      var a = $(d).parent().next().find("a").attr("pid");
      var b = $(inPortfolio.portfolio_xml).find('project[id="' + a + '"]');

      $(b).find("images").children().each(function(){
          c.push($(this).text());
      });
      inPortfolio.preloadAssets(c);

  },
  preloadAssets: function(d){

      for (var b = d.length; b--;) {
          var c = d[b];
          c = c.split(".");
          c = c[c.length - 1];

          if(c=='png' || c=='jpg' || c=='jpeg' || c=='gif' || c=='tif' || c=='bmp'){
              var a = new Image();
              a.src = d[b];
          }

      }

  }

}
/*
 * END PORTFOLIO
 */


$(document).ready(function(){

  inPortfolio.init();

});



