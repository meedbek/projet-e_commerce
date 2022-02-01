var passager = document.getElementById('passagers');

var menu = document.getElementById('menu');

passager.addEventListener("click" , function(event){     
      event.stopPropagation();
      menu.style.display = 'block';
});

document.getElementsByTagName('body').addEventListener("click",function(event){
      event.stopPropagation();
      menu.style.display = 'none';
})


