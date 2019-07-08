$(document).ready(function() {
    console.log("Fuck it! We'll do it LIVE!");

    $(".result").on("click", function(){

        var id = $(this).attr("data-linkId");
        var url = $(this).attr("href");
        console.log(url);
        console.log(id);

        if(!id) {
            alert("data-linked attribute not found");
        }

        increaseLinkClicked(id, url);

        return false;
    });
});

function increaseLinkClicked(linkId, url) {

    $.post("ajax/updateLinkCount.php", {linkId: linkId}).done(function(result){
        if(result != "") {
            alert(result);
            return;
        }

        window.location.href = url;
    });

}