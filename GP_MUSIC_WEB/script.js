const form = document.querySelector("form"),
fileInput = form.querySelector(".file-input"),
progressArea = document.querySelector(".progress-area"),
uploadedArea = document.querySelector(".uploaded-area");

form.addEventListener("click", () => {
  fileInput.click();
});

fileInput.onchange = ({target}) => {
    let file = target.files[0]; //getting file and [0] means if user select multiple files then we'll select only the first one
    if(file){ //if user selects a file
        let fileName = file.name; //getting file name
        if(fileName.length >= 12){ //if file name length is greater than 12
            let splitName = fileName.split('.'); //splitting the name where we get the name and extension
            fileName = splitName[0].substring(0, 12) + "... ." + splitName[1]; //getting the first part of the name and adding ... then extension
        }
        uploadFile(fileName); //calling function
    }
}

function uploadFile(name){
    let xhr = new XMLHttpRequest(); //creating new xml http request
    xhr.open("POST", "php/upload.php"); //sending post request to upload.php file
    xhr.upload.addEventListener("progress", ({loaded, total}) => { //adding event listener to track progress
        let fileLoaded = Math.floor((loaded / total) * 100); //getting percentage of loaded file
        let fileTotal = Math.floor(total / 1000); //getting total size of file in KB from Bytes
        let fileSize; //creating a variable to store file size
        (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB"; //if file size is less than 1MB then size in KB else convert size in MB
        let progressHTML = `<li class = "row">
                                <i class = "fas fa-file"></i>
                                <div class="content">
                                <div class="details">
                                    <span class="name">${name} - Uploading</span>
                                    <span class="percent">${fileLoaded}%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress" style="width:${fileLoaded}%></div>
                                </div>
                                </div>
                            </li>`; // creating new li tag inside ul tag
        uploadedArea.innerHTML = "";
        uploadedArea.classList.add("onprogress");
        progressArea.innerHTML = progressHTML; //adding above li tag inside ul tag
        if(loaded == total){ //if file loaded is equal to file total size
            progressArea.innerHTML = ""; //removing the li tag
            let uploadedHTML = `<li class = "row">
                                    <div class = "content">
                                        <i class = "fas fa-file"></i>
                                        <div class="details">
                                            <span class="name">${name} - Uploaded</span>
                                            <span class="size">${fileSize}</span>
                                        </div>
                                    </div>
                                    <i class = "fas fa-check"></i>
                                </li>`; // creating new li tag inside ul tag
            uploadedArea.classList.remove("onprogress");
            uploadedArea.innerHTML = uploadedHTML; //no history of uploaded files
        // uploadedArea.insertAdjacentElement("afterbegin", uploadedHTML); //show history of uploaded files
        };
    let formData = new FormData(form); //creating new formData
    xhr.send(formData); //sending file name to php file
    });
}