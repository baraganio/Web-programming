class EventHandling{

    constructor(){
        document.getElementById("home-page").addEventListener("click", this.homeBtnClicked);
        document.getElementById("db-insert").addEventListener("click", this.dbInsertBtnClicked);
        document.getElementById("db-filter").addEventListener("click", this.dbfilterBtnClicked);
        document.getElementById("db-delete").addEventListener("click", this.dbDeleteBtnClicked);

        document.getElementById("delete-btn").addEventListener("click", this.deleteBtnClicked);
    }

    deleteBtnClicked(event) {
        const logId = document.getElementById("log-id").value;
        const deleteRequest = new XMLHttpRequest();

        //--
        deleteRequest.open("POST", "../../server/controller.php");
        deleteRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        const deleteRequestBody = "func=delete&logId=" + logId;

        deleteRequest.send(deleteRequestBody);

        var urlParams = new URLSearchParams(window.location.search);
        var paramValue = urlParams.get('username');
        document.location.href="../pages/deletePage.html?username="+paramValue;
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