<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add Visitor</title>

</head>
<body>
    
    <div class="container my-5">
    <header class="d-flex justify-content-between my-4">
            <h1>Add Visitor</h1>
            <div>
            <a href="visitor.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        
        <form action="visitorprocess.php" method="post">
            <div class="form-elemnt my-4">
                <input type="text" class="form-control" name="name" placeholder="Enter Name:"  autocomplete="off" required>
            </div>
            <div class="form-group my-4">
                <input type="text" class="form-control" name="id_number" placeholder="Enter Id Number:" pattern="[0-9]{8}" autocomplete="off" >
            </div>  
            <div class="form-elemnt my-4">
            <input type="tel" id="phone" name="phone" class="form-control" autocomplete="off" pattern="^\d{10}$" required placeholder="Enter Phone Number:" />        
            </div>
            <div class="form-element my-4">
                <input type="email" id="" class="form-control"  autocomplete="off" name="email"placeholder="Enter Email:">
            </div>
            <div class="form-elemnt my-4">
                <select name="gender" id="" class="form-control">
                    <option value="" selected disabled hidden>Select Gender:</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>   
            <div class="form-element my-4">
                <div class="input-group">
                    <input type="text" class="form-control" readonly>
                    <label class="input-group-btn">
                        <span class="btn btn-primary">
                            Upload ID <input type="file" id="scanned_id" name="scanned_id" style="display: none;">
                        </span>
                    </label>
                </div>
            </div>    
            <div class="form-element my-4">
                <select name="redflag" id="redflag-select" class="form-control" onchange="toggleRedInput(this)">
                    <option value="" selected disabled hidden>Red Flag History:</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <div class="form-element my-4">
                <input type="submit" name="create" value="Add " class="btn btn-primary">
            </div>
        </form>
    </div>

        
<script>
function toggleRedInput(selectElement) {
    var redFlagSelect = document.getElementById("redflag-select");
    if (redFlagSelect.value === "yes") {
        redFlagSelect.style.color = "red";
    } else {
        redFlagSelect.style.color = "black";
    }
}
</script>
</body>
</html>