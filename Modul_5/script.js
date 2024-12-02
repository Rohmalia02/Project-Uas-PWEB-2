$(document).ready(function(){
//.Dasar Selektor
$('#header').css('text-align','center');//Mengubah align text pada header
$('li').css('margin','5px');
//Sektor
$('img[alt="Alumni Photo "]').css('border','2px solid red');//

//selektor
$('#alumniList li').css('font-size','18px');

//selektor
$('li:even').css('color','blue');//
$('.featured').addClass('highlight');//

//event
$('.gallery img').on('click',function(){
    var src=$(this).attr('src');
    $('#modalimage').attr('src',src);
    $('#myModal').fadeIn();
});
$('.modal.close').on('click',function(){
    $('#myModal'),fadeOut();
});
$(window).on('click',function(event){
    if($(event.target).is('#myModal')){
        $('#myModal').fadeOut();
    }
});
});