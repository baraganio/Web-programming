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
        
        document.getElementById("prev-logs-btn").addEventListener("click", function () {
            if (thisObject.currentPage == 0) {
                return;
            }
            thisObject.currentPage--;
            thisObject.loadLogs(thisObject);
        });

        document.getElementById("next-logs-btn").addEventListener("click", function () {
            console.log(thisObject.currentPageSize);
            if (thisObject.currentPageSize < 4) {
                return;
            }
            thisObject.currentPage++;
            thisObject.currentPageSize=0;
            thisObject.loadLogs(thisObject);
        });
        
        
        this.loadLogs(this);
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

    loadLogs(thisObject){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=select&username=all&type=all&severity=all" + "&pageSize=" + thisObject.pageSize + "&currentPage=" + thisObject.currentPage, true);
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
}