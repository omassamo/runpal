window.onload = function(){
document.getElementById("btn_indi").onclick = function(){indiLoad()};

function indiLoad() {
    $.ajax({
    url: 'individual.html',
    type: 'post',
    success: function(response) {
        $('#indi').append(response);
        $( "#btn-wrapper" ).hide();
    }
});
}

document.getElementById("btn_group").onclick = function(){groupLoad()};

function groupLoad() {
    $.ajax({
    url: 'group.html',
    type: 'post',
    success: function(response) {
        $('#group').append(response);
        $( "#btn-wrapper" ).hide();
    }
});
}

};

