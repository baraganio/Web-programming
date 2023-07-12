class EventHandling{

    constructor(){
        const thisObject = this;

        document.getElementById("insertFatherName").addEventListener("click", this.fatherNameBtnClicked);
        document.getElementById("insertMotherName").addEventListener("click", this.motherNameBtnClicked);

        document.getElementById("fatherDescendingLine").addEventListener("click", this.fatherDescendingLineBtnCllicked);
        document.getElementById("motherDescendingLine").addEventListener("click", this.motherDescendingLineBtnCllicked);

    }

    fatherDescendingLineBtnCllicked(){
        const getRequest = new XMLHttpRequest();

        getRequest.open("GET", "../../server/controller.php?func=fatherline", true);
        getRequest.send();

        let div = document.getElementById('fatherLine');

        let str="";

        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            let sep= resultArray.split(",")
            for(let i=0;i<sep.length;i++){
                str =str + sep[i];
            }
            
            div.innerHTML=str;
        }

    }

    motherDescendingLineBtnCllicked(){
        const getRequest = new XMLHttpRequest();

        getRequest.open("GET", "../../server/controller.php?func=motherline", true);
        getRequest.send();

        let div = document.getElementById('motherLine');

        let str="";

        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            let sep= resultArray.split(",")
            for(let i=0;i<sep.length;i++){
                str =str + sep[i];
            }
            
            div.innerHTML=str;
        }

    }

    fatherNameBtnClicked(){
        if(document.getElementById("fatherName").value==""){
            alert("No father name");
        }else{
            let fatherName = document.getElementById("fatherName").value;

            const updateRequest = new XMLHttpRequest();

            updateRequest.open("GET", "../../server/controller.php?func=updatefather&fathername=" + fatherName, true);
            updateRequest.send();

            //Serve the specified htmls
            document.location.href = "../pages/homePage.html";

        }
        
    }

    motherNameBtnClicked(){
        if(document.getElementById("motherName").value==""){
            alert("No mother name");
        }else{
            let motherName = document.getElementById("motherName").value;

            const updateRequest = new XMLHttpRequest();

            updateRequest.open("GET", "../../server/controller.php?func=updatemother&mothername=" + motherName, true);
            updateRequest.send();

            //Serve the specified htmls
            document.location.href = "../pages/homePage.html";

        }
    }



}