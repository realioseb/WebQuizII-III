var button = document.getElementsByName("save")[0];

button.onclick = function() {
    event.preventDefault();
    
    var client = (new XMLHttpRequest) || (new ActiveXObject);
    var note = document.getElementsByName("note")[0];
    
    client.open("POST", "notes.php", false);
    client.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    client.onreadystatechange = function() {
        if(client.status === 201) {
            var postResp = JSON.parse(client.response);
            
            document.getElementById("msg").innerHTML = postResp.status.message;
            
            var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
            
            xmlhttp.open("GET", "notes.php", false);
            xmlhttp.setRequestHeader("Content-type", "application/json");
            
            xmlhttp.onreadystatechange = function() {
                var getResp = JSON.parse(xmlhttp.response);
                console.log(getResp);
            };
            
            xmlhttp.send();
        } else {
            console.log(client.status);
            document.getElementById("msg").innerHTML = "Please wait, Loading...";
        }
    };
    
    client.send("note=" + note.value);
};

//function drawTable(jsonArray) {
//    var tr = document.createElement("tr");
//    tr.appendChild();
//}