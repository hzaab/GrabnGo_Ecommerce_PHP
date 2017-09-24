jQuery(document).ready(function ($) {
    
	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };
 
    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });
    
    setInterval(function () {
        moveRight();
    }, 10000);
    
    
    
    //Quantity Counter 
    
    $('.qtyplus').click(function(e){
        
        e.preventDefault();
        
        fieldName = $(this).attr('field');
        
        var currentVal = parseInt($('input[name='+fieldName+']').val());

        if (!isNaN(currentVal)) {
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            $('input[name='+fieldName+']').val(0);
        }
    });
    

    $(".qtyminus").click(function(e) {
    
        e.preventDefault();
        
        fieldName = $(this).attr('field');
       
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        
        if (!isNaN(currentVal) && currentVal > 0) {
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            $('input[name='+fieldName+']').val(0);
        }
    });
    
    
    
//Search Form
    
    $("#search").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            $("form").submit();
        }
    });

//    SELECT `name`
//            FROM `teachers`
//            WHERE `name` LIKE '%{$name}%'
});    
