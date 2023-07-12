class EventHandling{

    constructor(){

        document.getElementById("insertFamilyRelation").addEventListener("click", this.insertFamilyRelation);
        document.getElementById("displaySiblings").addEventListener("click", this.displaySiblings);
        document.getElementById("displayFatherLine").addEventListener("click", this.displayFatherLine);
        document.getElementById("displayMotherLine").addEventListener("click", this.displayMotherLine);

    }

    displayFatherLine(){
        const getRequest = new XMLHttpRequest();

        getRequest.open("GET", "../../server/controller.php?func=displayfatherline", true);
        getRequest.send();

        let div = document.getElementById('fatherline');

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

    displayMotherLine(){
        const getRequest = new XMLHttpRequest();

        getRequest.open("GET", "../../server/controller.php?func=displaymotherline", true);
        getRequest.send();

        let div = document.getElementById('motherline');

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

    displaySiblings(){
        const getRequest = new XMLHttpRequest();

        getRequest.open("GET", "../../server/controller.php?func=displaysiblings", true);
        getRequest.send();

            let div = document.getElementById('siblings');

            getRequest.onload = function () {
                const resultArray = JSON.parse(this.responseText);

                if(resultArray.length>0){
                    div.innerHTML="Your siblings are: " + resultArray;
                }else{
                    div.innerHTML="You don't have any sibling."
                }
                
            }
    }

    insertFamilyRelation(){
        if(document.getElementById("userNameToAdd").value==""){
            alert("No user name");
        }else if(document.getElementById("userFatherToAdd").value==""){
            alert("No user father name");
        }else if(document.getElementById("userMotherToAdd").value==""){
            alert("No user mother name");
        }else{
            let userNameToAdd = document.getElementById("userNameToAdd").value;
            let userFatherToAdd = document.getElementById("userFatherToAdd").value;
            let userMotherToAdd = document.getElementById("userMotherToAdd").value;

            const postRequest = new XMLHttpRequest();

            const postRequestBody = "func=insertfamilyrelation&usernametoadd=" + userNameToAdd + "&userfathertoadd=" + userFatherToAdd + "&usermothertoadd="+ userMotherToAdd;

            postRequest.open("POST", "../../server/controller.php");
            postRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            postRequest.send(postRequestBody);

            postRequest.onload = function () {
                const resultArray = JSON.parse(this.responseText);
               if(resultArray==false){
                alert("It doesn't exist that user");
               }
            }

        }
    }

}