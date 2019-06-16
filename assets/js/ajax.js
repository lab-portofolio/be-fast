const ajax = (data, url, action, callBack) => {
    let xmlHttp = null
    if (window.XMLHttpRequest) xmlHttp = new XMLHttpRequest()
    else xmlHttp = new ActiveXObject("Microsoft.XMLHTTP")
    
    xmlHttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) 
            callBack(this.responseText)
    }

    if (action == "GET" || action == "get") {
        xmlHttp.open("GET", url + "?" + data, true)
        xmlHttp.send()
    }
    else {
        xmlHttp.open("POST", url, true)
        xmlHttp.send(data)
    }
}