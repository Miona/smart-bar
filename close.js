jQuery(".sb_close_icon").click(function(e){
            e.preventDefault();
            var div = jQuery(".sb_close");
            console.log(div.css("top"));
            if (div.css("top") === "-122px") {
                jQuery(".sb_close").animate({
                    top: "0px"
                });
            } else {
                jQuery(".sb_close").animate({
                    top: "-122px"
                });
            }
        });