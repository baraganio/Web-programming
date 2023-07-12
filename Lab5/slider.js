// Function in charge of make the pictures moving from left to right
function slide(){

    // Hide the main picture
     $("#toShow").hide();

    // Animates all "li" elements by adding the left propertie on 10px
    // with a duration of 100 miliseconds. The propertie reappear call, 
    // after ending the animation, the function named as the propertie
    $("li").animate({"left":"+=10px"}, 100, reappear);

    // Calll the method that check which component has been clicked
    checkClick();
}

// Check which component has been clicked
function checkClick(){

    // Actions when a "li" component has been clicked
    $("li").click(function(){

        // Get the src of the picture contained on the "li" clicked
        var imgSrc = $(this).find("img").attr("src");

        // Change the toShow picture
        $("#toShow").attr("src",imgSrc);

        // Show the toShow picture
        $("#toShow").show();
        
        // Stop the animation that all the "li" are having
        $("li").stop();
    });

    // If the toShow image is clicked
    $("#toShow").click(function(){
        slide();
    });

    /*
    //Modification required on the revision
    $("#toShow").dblclick(function(){
        $("img").hide();
    });*/
}

// Function in charge of make the pictures that disappear on the rigth,
// appear again on the left
function reappear(){
    // Store the left position of the current element
    var left = $(this).parent().offset().left + $(this).offset().left;
    // Evaluate if the current element is outside the page
    if(left>=1400)
        {
            // Change the left propertie of the current element
            $(this).css("left", left-1400);
        }
        // Call the function slide
    slide();
}


// Method that wait until the document is fully loaded
// The $ is the sign that tell the programm to acces JQuery
// Document is what we need to find (Html elements)
// .ready is the event to wait on the element specified
// function(){} is the function to be performed after the event happens
$(document).ready(function(){

    // Width of the picture
    var picWidth = 200;

    var pos = 0;

    // .each works as a loop running over all the "li" elements
    $("li").each(function(){

        // Increment the position as much as the with of the pictures
        pos += picWidth;

        // Set the position of each element (run by the loop). At the end
        // it will be calculated as (pos*width)
        $(this).css("left", pos);
    });

    // Call the function to slide the pictures
    slide();
});