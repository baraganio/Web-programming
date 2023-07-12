
class EventHandling{


    constructor(){
        const thisObject = this;

        document.getElementById("allProductPageBtn").addEventListener("click",this.changeToAllProductsPage);

        document.getElementById("submitPro").addEventListener("click",this.submitProds);


        /*document.getElementById("search-journal-name").addEventListener("click", function () {

            var journalName=document.getElementById("journal-name").value;
            if(journalName==""){
                alert("specify an jorunal name");
            }else{
                thisObject.loadJournalsByName(journalName);
            }
            
        });

        document.getElementById("insert-article").addEventListener("click", this.addBtnClicked);

        //Call the checkUpdates methos each 2 seconds
        setInterval(this.checkUpdates, 2000);*/

    }

    changeToAllProductsPage(){
        document.location.href = "../pages/allProductPage.html";
    }

    submitProds(){
        document.location.href = "../pages/upload.html";
    }

    /*checkUpdates(){
        //Create a request
        const getRequest = new XMLHttpRequest();

        //Specify what type of request will be and the url with the parameters
        getRequest.open("GET", "../../server/controller.php?func=checkupdates", true);

        //Send the request
        getRequest.send();

        //Specifie the attributes the json  will have
        let jsonAttributeNames = ["id", "user", "journalid", "summary","date"];

        //Specify what to do when the request is done and it has a result
        getRequest.onload = function () {

            //Decode the json response
            const resultArray = JSON.parse(this.responseText);

            
            if(resultArray!=false){
                
                //Decode each json object of the response
                resultArray.forEach(function (current, index, resultArray) {
                    resultArray[index] = JSON.parse(current);
                });

                var user;
                var summary;
                var date;

                for(let row = 0; row<resultArray.length; row++){
                    //Get the attributes of the object
                    user=resultArray[row][jsonAttributeNames[1]];
                    summary=resultArray[row][jsonAttributeNames[3]];
                    date=resultArray[row][jsonAttributeNames[4]];

                }

                //Make a visual alert
                alert("New Article by: " + user + ". With the summary: " + summary + ". And date: " + date);
            }
        }
        
    }*/

    /*addBtnClicked(){
        document.location.href = "../pages/insertPage.html";
    }*/

    /*loadJournalsByName(journalName){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=select&journalname=" + journalName, true);
        getRequest.send();

        let table = document.getElementById('articles-table');
        let jsonAttributeNames = ["id", "user", "journalid", "summary","date"];


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
    }*/

}