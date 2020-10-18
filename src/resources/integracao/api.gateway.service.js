class ApiGatewayService {
    /**
     * Função responsavel pro processar as requisições ajax ou para api feitas pelo javascritp
     * @param {*} url 
     * @param {*} data 
     * @param {*} type 
     */
    apiRequest(url, data, type = 'POST', headers = "") {
        if (type != 'GET') {
            data = JSON.stringify(data);
        }
       
        return new Promise((resolve, reject) => {
            $.ajax({
                type: type,
                crossDomain: true,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                url: url,
                data: data,
                headers: headers,
                success: function (data) {
                    resolve(data);   
                },
                error: function (data) {
                    reject(data);
                }
            });
        });
    };

}

