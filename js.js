var button = document.getElementsByName("save")[0];
button.onclick = function() {
    event.preventDefault();
    
    var note = document.getElementsByName("note")[0];
    var url = document.getElementsByTagName("form")[0].action;
    
    var client = (new XMLHttpRequest) || (new ActiveXObject);
    
    client.open("POST", url, true);
    client.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    client.onreadystatechange = function() {
        var postResp = JSON.parse(client.response);
        
        if(client.readyState === 4 && client.status === 201) {
            alert(postResp.status.message);
            
            var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
            
            xmlhttp.open("GET", url, true);
            xmlhttp.setRequestHeader("Content-type", "application/json");
            
            xmlhttp.onreadystatechange = function() {
                if(client.readyState === 4) {
                    var getResp = JSON.parse(xmlhttp.response);

                    var newBody = drawTableBody(getResp);

                    var table = document.getElementsByTagName("table")[0];
                    var oldBody = table.getElementsByTagName("tbody")[0];

                    table.replaceChild(newBody, oldBody);
                }
            };
            
            xmlhttp.send();
        } else if(client.readyState === 4 && client.status === 400) {
            alert(postResp.status.message);
        }
    };
    
    client.send("note=" + note.value);
    
    note.value = "";
};

function drawTableBody(jsonArray) {
    var tbody = document.createElement("tbody");
    
    jsonArray.forEach(function(elem){
        var tr = document.createElement("tr");
        
        var noteTd = document.createElement("td");
        noteTd.innerHTML = elem.note;
        tr.appendChild(noteTd);
        
        var idTd = document.createElement("td");
        idTd.innerHTML = elem.id;
        tr.appendChild(idTd);
        
        var dateTd = document.createElement("td");
        dateTd.innerHTML = elem.date;
        tr.appendChild(dateTd);
        
        var checkTd = document.createElement("td");
        checkTd.innerHTML = "<input type='checkbox' value='" + elem.id + "'>";
        tr.appendChild(checkTd);
        
        tbody.appendChild(tr);
    });
    
    return tbody;
}

var del = document.getElementsByTagName("a")[0];
del.onclick = function() {
    event.preventDefault();
    
    var list = document.getElementsByTagName("tbody")[0].children;
    
    var len = list.length;
    
    var deletable = [];
    
    for(var i = 0; i < len; i++) {
        if(list[i].lastChild.firstChild.checked) {
            deletable.push(list[i].children[1].innerHTML);
        }
    }
    
    if(confirm("Are you sure you want delete all selected notes?")) {
        var client = (new XMLHttpRequest) || (new ActiveXObject);

        var url = this.href;
        client.open("POST", url, true);

        client.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        client.onreadystatechange = function() {
            if(client.readyState === 4) {
                for(var i = 1; i <= len; i++) {
                    var j = len-i;
                    
                    if(list[j].lastChild.firstChild.checked) {
                        list[j].parentNode.removeChild(list[j]);
                    }
                }
                
                var msg = JSON.parse(client.response);
                alert(msg.status.message);
            }
        };
        
        client.send("del=" + encodeURIComponent(JSON.stringify(deletable)));
    }
};