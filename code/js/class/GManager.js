//===============================================
class sGManager {}
class sGApp {}
//===============================================
class GManager {
    //===============================================
    static instance = null;
    //===============================================
    constructor() {
        // manager
        this.mgr = new sGManager();
        // app
        this.mgr.app = new sGApp();
        this.mgr.app.app_name = "ReadyApp";
        this.mgr.app.displayfiles_check_count = 0;
        this.mgr.app.displayfiles_check_flag = 0;
    }
    //===============================================
    static Instance() {
        if(this.instance == null) {
            this.instance = new GManager();
        }
        return this.instance;
    }
    //===============================================
    getData() {
        return this.mgr;
    }
    //===============================================
}
//===============================================
