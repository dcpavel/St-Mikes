$(document).ready(function () {
    var banner = $("header nav");
   
    banner.attr('class', "");
    banner.find("li").each(function () {
       if ($(this).find("ul").length > 0) {
           $(this).mouseenter(function() {
               $(this).find("ul").stop(true, true).slideDown("fast");
           });

           $(this).mouseleave(function() {
               $(this).find("ul").stop(true, true).slideUp("slow");
           });
       }
    });
   
    var address = '3233 Pacific View Drive, Corona del Mar, CA 92625';
    var myLatLng = new google.maps.LatLng(33.609, -117.859);
    
    var myOptions = {
        center: myLatLng,
        zoom: 15,
        maxZoom: 15,
        minZoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        draggable: false
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'St. Michael and All Angels',
        animation: google.maps.Animation.DROP
    });
    google.maps.event.addListener(marker, 'click', function() {
        var url = 'http://maps.google.com/maps?daddr=3233+Pacific+View+Drive+Corona+del+Mar,+CA+92625';
        window.open(url, 'Directions to Saint Michael and All Angels');
    });
});