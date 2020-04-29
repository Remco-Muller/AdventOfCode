<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Jquery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link href="css/bootstrap-reboot.css" rel="stylesheet">
    <!-- Own Files -->
</head>
<body class="bg-dark">
<?php
$newfile = fopen("day5.txt", "r");
$jsonArray = array();
while(!feof($newfile)){
    $code = fgets($newfile);
    $code = explode(")", $code);
    $codeArray = array("orbit"=>$code[0],"planet"=>substr($code[1], 0, 3));
    array_push($jsonArray, $codeArray);
}
fclose($newfile);
$newfile = fopen("input.json", "w+");
$jsonArray = json_encode($jsonArray);
fwrite($newfile, $jsonArray);




?>
<script>
    var objectArray = new Array();
    var count = 0;
    var count2 = 0;
    function run(){
        $.getJSON("input.json", function(data){
            data.forEach(function(item){
                var newObject = new Object();
                newObject.planet = item.planet;
                newObject.orbit = item.orbit;
                newObject.history = Array();
                objectArray.push(newObject);
            })
        }).success(function(){
            objectArray.forEach(function(data3){
                var target = data3.orbit;
                do{
                    var found = false;
                    count++;
                    if(target == "COM"){
                        return false;
                    }
                    objectArray.forEach(function(data2) {
                        if(data2.planet == target){
                            if(found == false){
                                target = data2.orbit;
                                found = true
                                data3.history.push(target + " | ")
                            }

                        }
                    });

                    if(found = false){
                        return false;
                    }
                }
                while(true)
            })
            objectArray.forEach(function(data4) {
                if(data4.planet == "YOU"){
                    console.log(data4.planet + " | " + data4.history + " | ")
                }
                    if(data4.planet == "SAN"){
                        console.log(data4.planet + " | " + data4.history + " | ")
                       for(var x = 0; x < data4.history.length; x++){
                           objectArray.forEach(function(data5) {
                                if(data5.planet == "YOU"){
                                    for(var y = 0; y < data5.history.length; y++) {
                                        if(data5.history[y] == data4.history[x]){
                                            console.log(data5.history[y] + " | " + x + " | " + y + " | " + data4.history[x])
                                    }
                                    }
                                }
                           })
                           }
                       }
            })
            })
        }
</script>
</body>
</html>