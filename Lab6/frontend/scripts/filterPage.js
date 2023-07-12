class EventHandling{
    constructor(){
        this.pageSize = 4;
        this.currentPage = 0;
        this.currentPageSize = 0;
        const thisObject = this;

        document.getElementById("home-page").addEventListener("click", this.homeBtnClicked);
        document.getElementById("db-insert").addEventListener("click", this.dbInsertBtnClicked);
        document.getElementById("db-filter").addEventListener("click", this.dbfilterBtnClicked);
        document.getElementById("db-delete").addEventListener("click", this.dbDeleteBtnClicked);

        document.getElementById("filter-logs-btn").addEventListener("click", function () {
            thisObject.filterLogsBtnClicked(thisObject);
        });

        document.getElementById("prev-logs-btn").addEventListener("click", function () {
            if (thisObject.currentPage == 0) {
                return;
            }
            thisObject.currentPage--;
            thisObject.filterLogsBtnClicked(thisObject);
        });

        document.getElementById("next-logs-btn").addEventListener("click", function () {
            if (thisObject.currentPageSize < 4) {
                return;
            }
            thisObject.currentPage++;
            thisObject.currentPageSize=0;
            thisObject.filterLogsBtnClicked(thisObject);
        });
    }

    filterLogsBtnClicked(thisObject){
        let typeValue="all";
        let severityValue="all";
        let username="all";
        if(document.getElementById("only-user").checked){
            var urlParams = new URLSearchParams(window.location.search);
            username = urlParams.get('username');
        }
        
        // Select the radio buttons based on the name attribute
        const typeRadioButtons = document.getElementsByName("type");
        const severityRadioButtons =  document.getElementsByName("severity");
        

        // Loop through the radio buttons to find the selected one
        typeRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                typeValue=radioButton.value;
            }
        });
        severityRadioButtons.forEach(function(radioButton) {
            if (radioButton.checked) {
                severityValue=radioButton.value;
            }
        });

        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=select&username=" + username + "&type=" + typeValue + "&severity=" + severityValue + "&pageSize=" + thisObject.pageSize + "&currentPage=" + thisObject.currentPage, true);
        getRequest.send();

        let table = document.getElementById('logs-table');
        let jsonAttributeNames = ["id", "user", "date", "type","severity", "message"];


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
                if(!notFound){
                    thisObject.currentPageSize++;
                }
            }
        }
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
}