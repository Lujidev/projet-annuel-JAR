function newXMLHttpRequest(){
    if(window.XMLHttpRequest){
        return new XMLHttpRequest();
    }else{
        return new ActiveXobject("Microsoft.XMLHTTP");
    }
}

function getPcData(column, selectId){

    var request = newXMLHttpRequest();

    var pcId = document.getElementById("mySelect_"+selectId);

    var selected = pcId.options[pcId.selectedIndex].id;


    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(request.responseText);
            console.log(data);
            //console.log(request.responseText);
            console.log(container);
            var container = document.getElementById("container_"+data.column);
            container.innerHTML ="";

            var li1 = document.createElement("li");
            var li2 = document.createElement("li");
            var li3 = document.createElement("li");
            var li4 = document.createElement("li");
            li1.setAttribute("class", "list-group-item");
            li2.setAttribute("class", "list-group-item");
            li3.setAttribute("class", "list-group-item");
            li4.setAttribute("class", "list-group-item");
            li1.innerHTML = data[0].brand;
            li2.innerHTML = data[0].cpu;
            li3.innerHTML = data[0].gpu;
            li4.innerHTML = data[0].ram;
            container.appendChild(li1);
            container.appendChild(li2);
            container.appendChild(li3);
            container.appendChild(li4);
        }
    };

    request.open("GET", "comparaison/getData.php?id="+selected+"&column="+column, true);
    request.send();



}