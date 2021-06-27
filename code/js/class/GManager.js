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
        this.mgr.app.win_width = 640;
        this.mgr.app.win_height = 480;
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
