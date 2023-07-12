class EventHandling{

    constructor(){
        document.getElementById("home-page").addEventListener("click", this.homeBtnClicked);
        document.getElementById("db-insert").addEventListener("click", this.dbInsertBtnClicked);
        document.getElementById("db-filter").addEventListener("click", this.dbfilterBtnClicked);
        document.getElementById("db-delete").addEventListener("click", this.dbDeleteBtnClicked);

        document.getElementById("submit-insert-btn").addEventListener("click", this.submitBtnClicked);
    }

    homeBtnClicked(event) {
        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('username');
        document.location.href = "../pages/homePage.html?username="+paramValue;
    }

    dbInsertBtnClicked(event) {
        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('username');
        document.location.href = "../pages/insertPage.html?username="+paramValue;
    }

    dbfilterBtnClicked(event) {
        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('username');
        document.location.href = "../pages/filterPage.html?username="+paramValue;
    }

    dbDeleteBtnClicked(event) {
        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('username');
        document.location.href = "../pages/deletePage.html?username="+paramValue;
    }

    submitBtnClicked(event){
        var urlParams = new URLSearchParams(window.location.search);
        let logUsername = urlParams.get('username');
        const logmessage=document.getElementById("log-message").value;
        let logType="";
        let logSeverity="";

        // Select the radio buttons based on the name attribute
        const typeRadioButtons = document.getElementsByName("type");
        const severityRadioButtons =  document.getElementsByName("severity");

        // Loop through the radio buttons to find the selected one
        typeRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                logType=radioButton.value;
            }
        });
        severityRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                logSeverity=radioButton.value;
            }
        });
        
        if(logType=="" || logSeverity==""){
            alert("Please select a type and a severity.");
        }else if(logmessage==""){
            alert("Please add a message.");
        }else{
            const postRequest = new XMLHttpRequest();
            const postRequestBody = "func=insert&user=" + logUsername + "&type=" + logType + "&severity=" + logSeverity + "&message=" + logmessage;

            postRequest.open("POST", "../../server/controller.php");
            postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            postRequest.send(postRequestBody);
            document.location.href = "../pages/insertPage.html?username="+logUsername;
        }
    }
}