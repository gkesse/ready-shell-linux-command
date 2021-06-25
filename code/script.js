//===============================================
function onEvent(obj, sender, action) {
    if(sender == "displayfiles") {
        if(action == "select") {
            var lForm = obj.parentNode.parentNode.parentNode;
            lForm.submit();
        }
    }
}
//===============================================
