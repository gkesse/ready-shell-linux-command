//===============================================
function onEvent(obj, sender, action) {
    if(sender == "displayfiles") {
        if(action == "select") {
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
