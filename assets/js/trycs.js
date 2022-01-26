$(document).ready(function() {

    $('#search_text_input').focus(function() {
        if(window.matchMedia( "(min-width: 800px)" ).matches) {
            $(this).animate({width: '250px'}, 500);
        }
    });

    $('.button_holder').on('click', function() {
        document.search_form.submit();
    })


});



function updateLikes(id) {
    return $.get("like_post.php", {post_id: id}).done((num_likes) => {
        $(`#total_like_${id}`).html(`${num_likes} ${num_likes === '1' ? 'Like' : 'Likes'}`)
    })
}

 
function sendLike(id) {
    const current_label = $(`#like_button_${id}`).val()
    const sendLike = $.post("includes/handlers/send_like.php", 
        {userLoggedIn:userLoggedIn, id:id}, 
        function(response){
            updateLikes(id);
            $(`#like_button_${id}`).val(current_label == 'Like' ? 'Unlike' : 'Like');
    });
}


function sendComment(id) {
 
    const commentText = $("#comment" + id).val();
    
    if(commentText === "") {
 
        alert("Please enter some text first");
        return;
    }
 
    const sendComment = $.post("includes/handlers/send_comment.php", 
        {userLoggedIn:userLoggedIn, commentText:commentText, id:id}, 
        function(response){
 
        if(response !== "No text") {
 
            const loadComment = $.post("includes/handlers/load_comment.php", 
                {id:id, userLoggedIn:userLoggedIn}, 
                function(newComment) {
 
                $("#comment" + id).val("");
                const noComment = $("#toggleComment" + id).find("#noComment" + id);
                
                if(noComment.length !== 0) {
                    noComment.remove();
                }
 
                $("#toggleComment" + id + " .comment_section").append(newComment);
 
            });
        }
 
        else {
 
            alert("Something went wrong. Please try again");
        } 
 
    });
}





$('#searchForm').on('shown.bs.collapse', function () {
    // focus input on collapse
    $("#search").focus()
})

$('#searchForm').on('hidden.bs.collapse', function () {
    // focus input on collapse
    $("#search").blur()
})






$(document).click(function(e) {

    if(e.target.class != "search_results" && e.target.id != "search_text_input") {

        $(".search_results").html("");
        $('.search_results_footer').html("");
        $('.search_results_footer').toggleClass("search_results_footer_empty");
        $('.search_results_footer').toggleClass("search_results_footer");
    }

    if(e.target.class != "dropdown_data_window") {

        //$(".dropdown_data_window").html("");
        //$(".dropdown_data_window").css({"padding" : "0px", "height" : "0px", "border" : "none"});
    }



});



function getDropdownData(user, type) {
 
    //if($(".dropdown_data_window").css("height") == "0px") {
 
        var pageName;
 
        if(type == 'notification') {
            pageName = "ajax_load_notifications.php";
            $("span").remove("#unread_notification");
        }
        else if (type == 'message') {
            pageName = "ajax_load_messages.php";
            $("span").remove("#unread_message");
        }
 
        var ajaxreq = $.ajax({
            url: "includes/handlers/" + pageName,
            type: "POST",
            data: "page=1&userLoggedIn=" + user,
            cache: false,
 
            success: function(response) {
                $(".dropdown_data_window").html(response);
                $(".dropdown_data_window").css({"padding" : "0px", "height": "280px", "border" : "1px solid #DADADA"});
                $("#dropdown_data_type").val(type);
            }
 
        });
 
    //}else {
        //$(".dropdown_data_window").html("");
        //$(".dropdown_data_window").css({"padding" : "0px", "height": "0px", "border" : "none"});
    //}
 
}


function getLiveSearchUsers(value, user) {

    $.post("includes/handlers/ajax_search.php", {query:value, userLoggedIn: user}, function(data) {

        if($(".search_results_footer_empty")[0]) {
            $(".search_results_footer_empty").toggleClass("search_results_footer");
            $(".search_results_footer_empty").toggleClass("search_results_footer_empty");
        }

        $('.search_results').html(data);
        $('.search_results_footer').html("<a href='search.php?q=" + value + "'>See All Results</a>");

        if(data == "") {
            $('.search_results_footer').html("");
            $('.search_results_footer').toggleClass("search_results_footer_empty");
            $('.search_results_footer').toggleClass("search_results_footer");
        }
    });

}






