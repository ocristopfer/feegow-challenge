class ApiFeegow {

    apiUrl = 'https://api.feegow.com/v1/api/';
    header = {};
    token = null;

    constructor(token) {
        this.header = { "x-access-token": token}
        this.apiGatewayService = new ApiGatewayService();
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    get(metodo = "", data = {}) {
        var data = new URLSearchParams(data).toString()
        return this.apiGatewayService.apiRequest(this.apiUrl + metodo, data, 'GET', this.header)
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    put(metodo = "", data = {}) {
        return this.apiGatewayService.apiRequest(this.apiUrl + metodo, data, 'PUT', this.header)
    }

    /**
     * 
     * @param {string} metodo 
     * @param {json} data 
     */
    post(metodo = '', data = {}) {
        return this.apiGatewayService.apiRequest(this.apiUrl + metodo, data, 'POST', this.header)
    }
}
