//===============================================
function sGManager() {}
function sGApp() {}
//===============================================
var GManager = (function() {
    //===============================================
    var m_instance;
    //===============================================
    var mgr;
    //===============================================
    var Container = function() {
        return {
            //===============================================
            init: function() {
                this.construct();
            },
            //===============================================
            construct: function() {
                // manager
                this.mgr = new sGManager();
                // app
                this.mgr.app = new sGApp();
                this.mgr.app.app_name = "ReadyApp";
                this.mgr.app.displayfiles_check_count = 0;
                this.mgr.app.displayfiles_check_flag = 0;
            },
            //===============================================
            getData: function() {
                return this.mgr;
            }
            //===============================================
        };
    }
    //===============================================
    return {
        Instance: function() {
            if(!m_instance) {
                m_instance = Container();
            }
            return m_instance;
        }
    };
    //===============================================
})();
//===============================================
GManager.Instance().init();
//===============================================
