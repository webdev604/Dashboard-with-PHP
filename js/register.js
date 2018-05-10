


$( document ).ready(function() {
    console.log( "ready!" );
});
function changeFullName(){
    $('#referral').val("http://example.com/"+$('#username').val().replace(/\s/g, ''));
}

