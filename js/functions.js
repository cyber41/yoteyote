function is_int(value){ 
    if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
        return true;
    }else { 
        return false;
    } 
}

function preload_start(){
    $("#status").show();  // will first fade out the loading animation
    $("#loader").show();
}

function preload_stop(){
    $("#status").fadeOut(); // will first fade out the loading animation
    $("#loader").delay().fadeOut("slow"); //  will fade out the white DIV that covers the website.
}

function load_page(type, param, page){
    preload_start();
    $(type+param).load(page).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions) {
        preload_stop();
        $('#sort_tabs').fadeIn();
    });; 	
}

function clear_page(type, param){
    preload_start();
    $(type + param).empty();
    preload_stop();	
}

function sessionCheck(){
    $.ajax({
        url:'includes/session_check.php',
        success:function(response){
            if(response == 'success'){
                $('#posts_create').slideDown();
                $('#sign_in_dropdown').hide();
                notify_small('Your still Signed In', 2000, '3', '');
            }else{
                $('#posts_create').hide();
                $('#sign_in_dropdown').slideDown();
                notify('Sign In','Sign Up if You Dont have an account', 5000, '3', '');
            }
        }
    });
}

function notify_small(content, timeout, icon, error){
    $.notification ( {
        content: content,
        timeout: timeout,
        icon:icon,
        error:error
    });
}

function notify(title, content, timeout, icon, error){
    $.notification ( {
        title:title,
        content: content,
        timeout: timeout,
        icon:icon,
        error:error
    });
}