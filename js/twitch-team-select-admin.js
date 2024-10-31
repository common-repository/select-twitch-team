(function ($) {

  $(document).ready(function() {

       
    var twitchClientId = "6lv1oy7w5tn3jvqnvn8af55yqc56zs"; 
    var teamMembers = [];
    var teamLogos = [];
    var teamUrls = [];
    var teamBanners = [];
     
    $(".preview-team").click(function() {
     var teamName = twitchBall.toLowerCase();
     $(".selectTeam").hide();
      $.ajax({
        type:'GET',
        url:'https://api.twitch.tv/kraken/teams/' + teamName + '/?client_id=' + twitchClientId + '&api_version=5' ,
        dataType: 'json',
        success: function(data) {
        for(var i=0;i<data.users.length;i++){
         teamMembers.push(data.users[i].name);
         teamLogos.push(data.users[i].logo);
         teamUrls.push(data.users[i].url);
         teamBanners.push(data.users[i].profile_banner);
         
        $("#teamMembers").append('<div id="TeamMember"><div id="twitchInfo"><div id="logoContainer"><img id="yourLogo" src="'+teamLogos[i]+'" style=""></div><div id="yourName">'+teamMembers[i]+'</div><div id="yourUrlHolder">Watch Me <a href="'+teamUrls[i]+'" id="yourUrl">Here</a></div><div id="yourStats"></div></div><div id="twitchBanner"><img id="yourBanner" class="yourBanner" src="'+teamBanners[i]+'"></div></div>');
          
        }
          $(".yourBanner").each(function() {
            var atr = $(this).attr("src"); 
            if(atr == "null") {
                $(this).addClass("null");
            } else {
                $(this).removeClass("hidden");
            }
        });
                  
              
        },
        error: function () {
          $(".selectTeam").show();
          alert("Oops, Invalid Team Entered.");
        }
       
      });
    });
});
    
})(jQuery);