console.log("töötab");

//muutujad peab deklareerima sönaga "let"

let fileSize = 1024 * 1024;

//Javascript hakkab reageerima sündmustele ning neid ootama

window.onload = function(){
    document.querySelector("#photo_submit").disabled = true;
    document.querySelector("#photo").addEventListener("change", checkSize);
}

function checkSize(){
    if(document.querySelector("#photo").files[0].size <= fileSize){
        document.querySelector("#photo_submit").disabled = false;
        console.log("test 1");
    }
    else{
        document.querySelector("#photo_submit").disabled = true;
        document.querySelector("#notice") = '<span>Valitud pilt on <strong>liiga suur!</strong></span>';
    }
}
