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
            },
            //===============================================
            removeImage: function(path) {
                var lXmlhttp = new XMLHttpRequest();
                lXmlhttp.onreadystatechange = function() {
                    if(this.readyState == 4 && this.status == 200) {
                    }
                }
                lXmlhttp.open("POST", "/php/request.php", true);
                lXmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                lXmlhttp.send(
                "req=" + "image_remove" +
                "&path=" + path
                );
            },
            //===============================================
            getFilename: function(path) {
                var lFilename = path.replace(/^.*[\\\/]/, '');
                return lFilename;
            },
            //===============================================
            downloadImage: function(path) {
                var lLink = document.createElement('a');
                var lFilename = this.getFilename(path);
                lLink.setAttribute('download', lFilename);
                lLink.style.display = 'none';
                document.body.appendChild(lLink);
                lLink.setAttribute('href', path);
                lLink.click();
                document.body.removeChild(lLink);
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
