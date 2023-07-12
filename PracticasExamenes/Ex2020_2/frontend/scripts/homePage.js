class EventHandling{


    constructor(){
        const thisObject = this;

        document.getElementById("search-owner-name").addEventListener("click", function () {

            var ownerChannelName=document.getElementById("owner-name").value;
            if(ownerChannelName==""){
                alert("specify an jorunal name");
            }else{
                thisObject.loadChannelsByName(ownerChannelName);
            }
            
        });

        document.getElementById("search-own-subscriptions").addEventListener("click", thisObject.loadChannelsSubcribed);

        document.getElementById("subscribe").addEventListener("click", thisObject.subscribe);

    }

    loadChannelsSubcribed(){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=selectownsub", true);
        getRequest.send();

        let table = document.getElementById('channels-table');
        let jsonAttributeNames = ["id", "ownerid", "name", "description","subscribers"];


        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            resultArray.forEach(function (current, index, array) {
                array[index] = JSON.parse(current);
            });

            for (let row = 1, n = table.rows.length; row < n; row++) {
                let notFound = resultArray[row - 1] === undefined;
                let numColumns = table.rows[0].cells.length;
                for (let column = 0; column < numColumns; column++) {
                    notFound = notFound || resultArray[row - 1][jsonAttributeNames[column]] === undefined;
                    if (notFound){
                        table.rows[row].cells[column].innerHTML = "";
                    }else{
                        table.rows[row].cells[column].innerHTML = resultArray[row - 1][jsonAttributeNames[column]];
                    } 
                }
            }
        }
    }

    subscribe(){
        if(document.getElementById("channel-name").value==""){
            alert("You need to specify the name of the channel");
        }else{

            //Get the value of the fields
            var channelName =document.getElementById("channel-name").value;
            
            const postRequest = new XMLHttpRequest();

            //Specify the body of the post request
            const postRequestBody = "func=subscribe&channelname=" + channelName;
            //Open the post request
            postRequest.open("POST", "../../server/controller.php");

            //Set the header of the request
            postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            postRequest.send(postRequestBody);

            //Serve the specified htmls
            document.location.href = "../pages/homePage.html";
        }
    }

    


    loadChannelsByName(ownerChannelName){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=select&ownerchannelname=" + ownerChannelName, true);
        getRequest.send();

        let table = document.getElementById('channels-table');
        let jsonAttributeNames = ["id", "ownerid", "name", "description","subscribers"];


        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            resultArray.forEach(function (current, index, array) {
                array[index] = JSON.parse(current);
            });

            for (let row = 1, n = table.rows.length; row < n; row++) {
                let notFound = resultArray[row - 1] === undefined;
                let numColumns = table.rows[0].cells.length;
                for (let column = 0; column < numColumns; column++) {
                    notFound = notFound || resultArray[row - 1][jsonAttributeNames[column]] === undefined;
                    if (notFound){
                        table.rows[row].cells[column].innerHTML = "";
                    }else{
                        table.rows[row].cells[column].innerHTML = resultArray[row - 1][jsonAttributeNames[column]];
                    } 
                }
            }
        }
    }


}