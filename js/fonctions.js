//lavalamp
$(document).ready(function(){
    $("body").css('overflow-y','scroll');
    $("#menu").lavaLamp({ fx: "backout", speed: 700 });
    $("body").css("overflow","-moz-scrollbars-vertical");
    $("#img_cvPDF").css("opacity",0.5); // This sets the opacity of the thumbs to 60% when the page loads
    $("#img_cvPDF").hover(function(){
        $(this).fadeTo(300, 1.0); // This should set the opacity to 100% on hover
    },function(){$(this).fadeTo(300, 0.5); // This should set the opacity back to 60% on mouseout
                });

    // Ajout de style au formulaire de contact après jqtransform.js ("à la volée")
    $("div.jqTransformInputWrapper").css("width","246px"); //largeur textbox
    $("div.jqTransformInputInner > div > input").css("width","230px"); //largeur textbox
    $("div.jqTransformSelectWrapper").css("width","249px");//largeur container select
    $("div.jqTransformSelectWrapper > div > span").css("width","219px");//largeur contenu select
    $("div.jqTransformSelectWrapper > ul").css("width","216px").css("height","120px");//largeur et hauteur liste déroulante
    $("td#jqTransformTextarea-mm ").css("width","246px").css("height","97px");//largeur et hauteur liste déroulante
    $("td#jqTransformTextarea-mm > div ").css("width","246px").css("height","97px");//largeur et hauteur liste déroulante
    $("td#jqTransformTextarea-mm > div > textarea ").css("width","240px").css("height","97px");//largeur et hauteur liste déroulante
    $("#form-container").css("-moz-border-radius","12px");
    $("#form-container").css("-khtml-border-radius","12px");
    $("#form-container").css("-webkit-border-radius","12px");
    $("#form-container").css("border-radius","12px");

    // Append shadow image to each LI
    $("#nav-logos li").append('<img class="shadow" src="images/shadow.jpg" alt="" width="81" height="27" />');

    // Animate buttons, shrink and fade shadow (animations logos)
    $("#nav-logos li").hover(function() {
        var e = this;
        $(e).find("a").stop().animate({ marginTop: "-14px" }, 250, function() {
            $(e).find("a").animate({ marginTop: "-10px" }, 250);
        });
        $(e).find("img.shadow").stop().animate({ width: "80%", height: "20px", marginLeft: "8px", opacity: 0.25 }, 250);
    },function(){
        var e = this;
        $(e).find("a").stop().animate({ marginTop: "4px" }, 250, function() {
            $(e).find("a").animate({ marginTop: "0px" }, 250);
        });
        $(e).find("img.shadow").stop().animate({ width: "100%", height: "27px", marginLeft: "0px", opacity: 1 }, 250);
    });
});

//On cache le bloc actuellement affiché avec un fadeout et on affiche ensuite le nouveau avec un fadein
function AfficherBloc(id){
    $(".blocTexte:visible").fadeOut(0,400,function() {
        $("#bloc_"+id).fadeIn(600);
    });
}





