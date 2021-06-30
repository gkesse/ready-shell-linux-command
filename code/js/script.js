//===============================================
// onSubmit
//===============================================
function onSubmit(obj, sender, action) {
    onEvent(obj, sender, action);
    return false;
}
//===============================================
// onEvent
//===============================================
function onEvent(obj, sender, action) {
    var lApp = GManager.Instance().getData().app;
    //===============================================
    // displayfiles
    if(sender == "displayfiles") {
        //===============================================
        // header
        if(action == "header") {
            var lHeaders = [
                ["select", "Sélectionner", "displayfiles", "header_select"],
            ];
            var lHtml = "";
            for(var i = 0; i < lHeaders.length; i++) {
                var lHeader = lHeaders[0];
                if(i != 0) {lHtml += " | ";}
                lHtml += format("<button onclick='onEvent(this, \"{0}\", \"{1}\")'>{2}</button>", lHeader[2], lHeader[3], lHeader[1]);
            }
            obj.innerHTML = lHtml;
            var lHtml = format("<div class='border'>({0}) fichier(s) sélectionné(s)</div>", lApp.displayfiles_check_count);
            obj.nextElementSibling.innerHTML = "";
        }
        //===============================================
        // header_js
        else if(action == "header_js") {
            obj = obj.parentNode;
            onEvent(obj, "displayfiles", "header");

            var lParent = obj.parentNode.nextElementSibling.firstChild;
            var lImgMap = lParent.querySelectorAll("img");
            for(var i = 0; i < lImgMap.length; i++) {
                var lImgNode = lImgMap[i];
                var lImg = lImgNode.parentNode.firstChild;
                lImgNode.parentNode.innerHTML = lImg.outerHTML;
            }
        }
        //===============================================
        // header_cancel
        else if(action == "header_cancel") {
            lApp.displayfiles_check_flag = 0;
            lApp.displayfiles_check_count = 0;
            onEvent(obj, "displayfiles", "header_js");
        }
        //===============================================
        // header_select
        else if(action == "header_select") {
            var lHeaders = [
                ["delete", "Supprimer", "displayfiles", "image_delete"],
                ["download", "Télécharger", "displayfiles", "image_download"],
                ["cancel", "Annuler", "displayfiles", "header_cancel"],
            ];
            var lHtml = "";
            for(var i = 0, j = 0; i < lHeaders.length; i++) {
                var lHeader = lHeaders[i];
                var lKey = lHeader[0];
                if(lKey == "delete") {
                    if(lApp.displayfiles_check_count == 0) {continue;}
                }
                else if(lKey == "download") {
                    if(lApp.displayfiles_check_count == 0) {continue;}
                }
                if(j != 0) {lHtml += " | ";}
                j = 1;
                lHtml += format("<button onclick='onEvent(this, \"{0}\", \"{1}\")'>{2}</button>", lHeader[2], lHeader[3], lHeader[1]);
            }
            obj = obj.parentNode;
            obj.innerHTML = lHtml;

            var lHtml = format("<div class='border'>({0}) fichier(s) sélectionné(s)</div>", lApp.displayfiles_check_count);
            obj.nextElementSibling.innerHTML = lHtml;
            
            if(lApp.displayfiles_check_flag == 0) {
                var lParent = obj.parentNode.nextElementSibling.firstChild;
                var lImgMap = lParent.querySelectorAll("img");
                for(var i = 0; i < lImgMap.length; i++) {
                    var lImgNode = lImgMap[i];
                    var lHtml = format("<div><input type='checkbox' \
                    onclick='onEvent(this, \"displayfiles\", \"image_select\")'></div>");
                    lImgNode.parentNode.innerHTML += lHtml;
                }
            }
        }
        //===============================================
        // image_load
        else if(action == "image_load") {
            var lHtml = "";
            lHtml += format("<img class='img' src='{0}' alt='{1}' title='{1}'/>",
            obj.dataset.src, obj.dataset.alt);
            obj.innerHTML = lHtml;
        }
        //===============================================
        // image_select
        else if(action == "image_select") {
            var lParent = obj.parentNode.parentNode.parentNode;
            var lInputMap = lParent.querySelectorAll("input");
            var lCheckCount = 0;
            for(var i = 0; i < lInputMap.length; i++) {
                var lCheckBox = lInputMap[i];
                if(lCheckBox.checked) {lCheckCount++;}
            }
            lApp.displayfiles_check_count = lCheckCount;
            lApp.displayfiles_check_flag = 1;
            obj = obj.parentNode.parentNode.parentNode.parentNode.previousElementSibling.firstChild.firstChild;
            onEvent(obj, "displayfiles", "header_select");
        }
        //===============================================
        // image_delete
        else if(action == "image_delete") {
            var lConfirm = confirm("Voulez-vous supprimer ?");
            if(!lConfirm) {return;}
            var lParent = obj.parentNode.parentNode.nextElementSibling;
            var lInputMap = lParent.querySelectorAll("input");
            for(var i = 0; i < lInputMap.length; i++) {
                var lInputNode = lInputMap[i];
                var lChecked = lInputNode.checked;
                if(lChecked) {
                    var lImg = lInputNode.parentNode.previousElementSibling;
                    var lSrc = lImg.getAttribute("src");
                    var lNode = lInputNode.parentNode.parentNode;
                    lNode.parentNode.removeChild(lNode);
                    GManager.Instance().removeImage(lSrc);
                }
            }
            onEvent(obj, "displayfiles", "header_cancel");
        }
        //===============================================
        // image_download
        else if(action == "image_download") {
            var lConfirm = confirm("Voulez-vous télécharger ?");
            if(!lConfirm) {return;}
            var lParent = obj.parentNode.parentNode.nextElementSibling;
            var lInputMap = lParent.querySelectorAll("input");
            for(var i = 0; i < lInputMap.length; i++) {
                var lInputNode = lInputMap[i];
                var lChecked = lInputNode.checked;
                if(lChecked) {
                    var lImg = lInputNode.parentNode.previousElementSibling;
                    var lSrc = lImg.getAttribute("src");
                    GManager.Instance().downloadImage(lSrc);
                }
            }
            onEvent(obj, "displayfiles", "header_cancel");
        }
        //===============================================
    }
    //===============================================
    // uploadfiles
    else if(sender == "uploadfiles") {
        //===============================================
        // image_load
        if(action == "image_load") {
            var lParent = obj.parentNode.parentNode.parentNode.nextElementSibling;
            lParent.innerHTML = "";
            for(var i = 0; i < obj.files.length; i++) {
                (function() {
                    var lReader = new FileReader();
                    lReader.onload = function(event) {
                        lParent.innerHTML += format("<div class='border3'><img class='img' src='{0}'/></div>", event.target.result);
                    }
                    lReader.readAsDataURL(obj.files[i]);
                })();
            }
        }
        //===============================================
        // image_submit
        else if(action == "image_submit") {
            var lFileNode = obj.firstChild.nextElementSibling.nextElementSibling;
            var lInfoNode = obj.parentNode.parentNode.nextElementSibling.nextElementSibling;
            lInfoNode.innerHTML = "";
            for(var i = 0; i < lFileNode.files.length; i++) {
                (function() {
                    var lFile = lFileNode.files[i];
                    var chunk_uploader = new MyChunkUploader();

                    chunk_uploader.on_ready = function(response) {
                    };

                    chunk_uploader.on_done = function() {
                        lInfoNode.innerHTML += format("<div>on_done...</div>");
                        lInfoNode.innerHTML += format("<div>file_name : {0}</div>", lFile.name);
                        lInfoNode.innerHTML += format("<div>file_size : {0} KB</div>", (lFile.size/(1024)).toFixed(2));
                    };
                    
                    chunk_uploader.on_error = function(object, err_type) {
                        lInfoNode.innerHTML += format("<div>on_error...</div>");
                    };

                    chunk_uploader.on_abort = function(object) {
                        lInfoNode.innerHTML += format("<div>on_abort...</div>");
                    };

                    chunk_uploader.on_upload_progress = function(progress) {
                    };

                    chunk_uploader.upload_chunked('/uploads/upload.php',lFile);
                })();
            }
        }
        //===============================================
    }
    //===============================================
}
//===============================================
// onLazyLoad
//===============================================
function onLazyLoad() {
    var lLazyLoad = document.querySelectorAll(".lazyload");

    var lObsOptions = {
        root: null,
        rootMargin: '0px',
        threshold: [0.0, 1.0]
    };

    var lObs = new IntersectionObserver(objs => {
        objs.forEach(obj => {
            if (obj.intersectionRatio > 0) {
                var lTarget = obj.target;
                if(!lTarget.hasAttribute("data-state")) {
                    var lDataState = document.createAttribute("data-state");
                    lDataState.value = "off";
                    lTarget.setAttributeNode(lDataState);
                }
                if(lTarget.dataset.state == "on") {return;}
                // start lazy loading
                onEvent(lTarget, lTarget.dataset.sender , lTarget.dataset.action);                
                // end lazy loading
                lTarget.dataset.state = "on";
            } 
        });
    }, lObsOptions);

    lLazyLoad.forEach(obj => {
        lObs.observe(obj);
    });
}
//===============================================
onLazyLoad();
//===============================================
