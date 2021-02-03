window.onscroll = function() {HeaderShadow()};

  function HeaderShadow() {
      if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        document.getElementById("header").style.boxShadow = "0px 10px 40px hsl(0, 0%, 90%)";
      } else {
        document.getElementById("header").style.boxShadow = "none";
      }
    }
