class EventHandling{

    constructor(){
        const thisObject = this;

        document.getElementById("loadAllProjects").addEventListener("click", this.loadAllBtnClicked);
        document.getElementById("loadProjectsMemberOf").addEventListener("click", this.loadMemberBtnClicked);
        document.getElementById("addProjectsToDeveloper").addEventListener("click", this.addProToDevBtnClicked);
        document.getElementById("loadSkilledDevs").addEventListener("click", this.loadSkilledDevs);
    }

    loadSkilledDevs(){
        if(document.getElementById("devSkill").value==""){
            alert("No skill");
        }else{

            let skill = document.getElementById("devSkill").value;
            let jsonAttributeNames = ["id", "name", "age", "skills"];

            const getRequest = new XMLHttpRequest();
            getRequest.open("GET", "../../server/controller.php?func=selectskilleddevs&skill=" + skill, true);
            getRequest.send();




            let div = document.getElementById('skilledDev');

            getRequest.onload = function () {
                const resultArray = JSON.parse(this.responseText);
                resultArray.forEach(function (current, index, array) {
                    array[index] = JSON.parse(current);
                });

                let str="";

                for(let row=0;row<resultArray.length;row++){
                    let notFound = resultArray[row] === undefined;
                    if(!notFound){
                        if(resultArray[row][jsonAttributeNames[3]]==skill){
                            str=str+resultArray[row][jsonAttributeNames[1]]+"<br>";
                        }
                        
                    }
                }

            div.innerHTML=str;
            }
        }
    }

    addProToDevBtnClicked(){
        if(document.getElementById("developerName").value==""){
            alert("No dev");
        }else if(document.getElementById("projectsToBeAdded").value==""){
            alert("No projects");
        }else{

            let devName=document.getElementById("developerName").value;
            let projectsToAdd=document.getElementById("projectsToBeAdded").value;

            const postRequest = new XMLHttpRequest();
            //Specify the body of the post request
            const postRequestBody = "func=assigndeveloper&developername=" + devName + "&projectstoadd=" + projectsToAdd;
            //Open the post request
            postRequest.open("POST", "../../server/controller.php");
            //Set the header of the request
            postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            postRequest.send(postRequestBody);

            document.location.href = "../pages/homePage.html";

        }
    }

    loadMemberBtnClicked(){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=selectmember", true);
        getRequest.send();

        let div = document.getElementById('projectsMemberOf');
        let jsonAttributeNames = ["id", "projectManagerID", "name", "description","members"];


        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            resultArray.forEach(function (current, index, array) {
                array[index] = JSON.parse(current);
            });

            let str="";

            for(let row=0;row<resultArray.length;row++){
                let notFound = resultArray[row] === undefined;
                if(!notFound){
                    str=str+resultArray[row][jsonAttributeNames[2]]+"<br>";
                }
            }

            div.innerHTML=str;
        }
    }

    loadAllBtnClicked(){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=selectall", true);
        getRequest.send();

        let table = document.getElementById('projectsTable');
        let jsonAttributeNames = ["id", "projectManagerID", "name", "description","members"];


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