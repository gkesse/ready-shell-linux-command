//===============================================
function onEvent(obj, sender, action) {
    // displayfiles
    if(sender == "displayfiles") {
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
        }
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
        // header_select
        else if(action == "header_select") {
            var lHeaders = [
                ["cancel", "Annuler", "displayfiles", "header_js"],
            ];
            var lHtml = "";
            for(var i = 0; i < lHeaders.length; i++) {
                var lHeader = lHeaders[0];
                if(i != 0) {lHtml += " | ";}
                lHtml += format("<button onclick='onEvent(this, \"{0}\", \"{1}\")'>{2}</button>", lHeader[2], lHeader[3], lHeader[1]);
            }
            obj = obj.parentNode;
            obj.innerHTML = lHtml;
            
            var lParent = obj.parentNode.nextElementSibling.firstChild;
            var lImgMap = lParent.querySelectorAll("img");
            for(var i = 0; i < lImgMap.length; i++) {
                var lImgNode = lImgMap[i];
                var lHtml = format("<div><input type='checkbox'></div>");
                lImgNode.parentNode.innerHTML += lHtml;
            }
        }
        // image_load
        else if(action == "image_load") {
            var lHtml = "";
            lHtml += format("<img class='img' src='{0}' alt='{1}' title='{1}'/>",
            obj.dataset.src, obj.dataset.alt);
            obj.innerHTML = lHtml;
        }
        else if(action == "select") {
            var lForm = obj.parentNode.parentNode.parentNode;
            lForm.submit();
        }
        else if(action == "delete") {
            var lForm = obj.parentNode;
            var lConfirm = confirm("Voulez-vous supprimer ?");
            if(lConfirm) {
                lForm.submit();
            }
        }
    }
}
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
