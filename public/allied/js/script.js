window.onscroll = function(){
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        
        document.getElementById("topNav").classList.remove("initial-menu-padding");
        document.getElementById("topNav").classList.add("scroll-menu-effect");
    } else {
        document.getElementById("topNav").classList.remove("scroll-menu-effect");
        document.getElementById("topNav").classList.add("initial-menu-padding");
    }
};