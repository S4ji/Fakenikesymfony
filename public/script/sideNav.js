

/* set sidenav at 25rem*/
function openNav() {
    document.getElementById("sidenav").style.width = "25rem";
    document.getElementById("main").style.marginLeft = "25rem";
  }
  
  /* set sidenav at 0rem to hide it*/
  function closeNav() {
    document.getElementById("sidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    console.log("closenav");
  }

  document.getElementById("closeNavBtn").addEventListener("click", closeNav);
  document.getElementById("openNavBtn").addEventListener("click", openNav);

  