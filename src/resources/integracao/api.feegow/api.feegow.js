class ApiFeegow {

    apiUrl = location.origin + '/resources/integracao/api.feegow.php';
    header = {};
    apiGatewayService = null;

    constructor() {
        var url = decodeURIComponent(this.getCokie('url'));
        if(url != ''){
            this.apiUrl = url + '/resources/integracao/api.feegow.php';
        } 
        this.apiGatewayService = new ApiGatewayService();
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    get(metodo = "", data = {}) {
        if(data){
            data = new URLSearchParams(data).toString();
        }
        this.header.Requesttype = 'GET';
        this.header.Metodo = metodo;
        return this.apiGatewayService.apiRequest(this.apiUrl, data, 'GET', this.header);
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    put(metodo = "", data = {}) {
        this.header.Requesttype = 'PUT';
        this.header.Metodo = metodo;
        return this.apiGatewayService.apiRequest(this.apiUrl, data, 'PUT', this.header);
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    post(metodo = '', data = {}) {
        this.header.Requesttype = 'POST';
        this.header.Metodo = metodo;
        return this.apiGatewayService.apiRequest(this.apiUrl, data, 'POST', this.header);
    }

    getCokie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
}
