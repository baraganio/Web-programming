class EventHandling{

    constructor(){     

        document.getElementById("insert-article-btn").addEventListener("click", this.insertArticle);
    }

    insertArticle(){

        //Check all the fields have value
        if(document.getElementById("article-journal-name")==""){
            alert("You need to specify the name of the journal where it will be posted");
        }else if(document.getElementById("article-summary")==""){
            alert("You need to specify the name of the journal where it will be posted");
        }else{

            //Get the value of the fields
            var journalName =document.getElementById("article-journal-name").value;
            var articleSummary =document.getElementById("article-summary").value;
            
            const postRequest = new XMLHttpRequest();

            //Specify the body of the post request
            const postRequestBody = "func=insert&journalname=" + journalName + "&articlesummary=" + articleSummary;

            //Open the post request
            postRequest.open("POST", "../../server/controller.php");

            //Set the header of the request
            postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            postRequest.send(postRequestBody);

            //Serve the specified htmls
            document.location.href = "../pages/homePage.html";
        }
    }
}