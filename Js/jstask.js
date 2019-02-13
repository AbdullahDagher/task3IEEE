var tabbuttons=document.querySelectorAll(".tabs .butt button");
var tabcont=document.querySelectorAll(".tabs .container");

function showcont(contIndex,colorc){
    tabbuttons.forEach(function(node){
       node.style.backgroundColor="";
       node.style.color="";
    });
    tabbuttons[contIndex].style.backgroundColor=colorc;
    tabbuttons[contIndex].style.color="black";
    tabcont.forEach(function(node){
       node.style.display="none";
    });
    tabcont[contIndex].style.display="block";
    tabcont[contIndex].style.background=colorc;
}
showcont(0,'#ffffff');

