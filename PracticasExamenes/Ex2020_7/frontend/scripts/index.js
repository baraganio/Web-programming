
class EventHandling{


    constructor(){
        const thisObject = this;

        document.getElementById("updateKeyWords").addEventListener("click", this.updateKeywordsBtnClicked);
        document.getElementById("diplayWebsites").addEventListener("click", this.displayWebsitesBtnClicked);
        document.getElementById("searchKeysToMatch").addEventListener("click", this.searchKeysToMatchBtnClicked);

    }

    searchKeysToMatchBtnClicked(){
        let keys=document.getElementById("keysToMatch").value;

        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=keystomatch&keys=" + keys, true);
        getRequest.send();

        let div = document.getElementById('docMatchesDiv');
        

        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            let str="";
            
            for (let row = 0; row < resultArray.length; row++) {
                str=str+resultArray[row];
            }
            div.innerHTML=str;
        }
    }

    displayWebsitesBtnClicked(){
        const getRequest = new XMLHttpRequest();
        getRequest.open("GET", "../../server/controller.php?func=displaywebsites", true);
        getRequest.send();

        let table = document.getElementById('websitesTable');
        let jsonAttributeNames = ["id", "url", "documentscount"];

        getRequest.onload = function () {
            const resultArray = JSON.parse(this.responseText);
            resultArray.forEach(function (current, index, array) {
                array[index] = JSON.parse(current);
            });
            let str="";
            for (let row = 1; row < resultArray.length+1; row++) {
                let newRow = table.insertRow(row);
                let notFound = resultArray[row-1] === undefined;
                for (let column = 0; column < 3; column++) {
                    newRow.insertCell(column);
                    notFound = notFound || resultArray[row-1][jsonAttributeNames[column]] === undefined;
                    if (!notFound){
                        table.rows[row].cells[column].innerHTML = resultArray[row-1][jsonAttributeNames[column]];
                    }
                    
                }
            }
        }
    }

    updateKeywordsBtnClicked(){
        if(document.getElementById("documentName").value==""){
            alert("No document specified");
        }else{
            let documentName=document.getElementById("documentName").value;
            let keyword1=document.getElementById("keyword1").value;
            let keyword2=document.getElementById("keyword2").value;
            let keyword3=document.getElementById("keyword3").value;
            let keyword4=document.getElementById("keyword4").value;
            let keyword5=document.getElementById("keyword5").value;

            const getRequest = new XMLHttpRequest();
            getRequest.open("GET", "../../server/controller.php?func=updatekeywords&documentname=" + documentName + "&keyword1=" + keyword1 + "&keyword2=" + keyword2 + "&keyword3=" + keyword3 + "&keyword4=" + keyword4 + "&keyword5=" + keyword5, true);
            getRequest.send();

            
        }

    }

}