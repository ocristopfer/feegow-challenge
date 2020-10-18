class ApiFeegowProfessional {

    apiFeegow = null;
    
    constructor(){
         this.apiFeegow = new ApiFeegow();    
    }

    /**
     * Lista os nomes do proffisionias. Voce pode filtrar por profisionais ativos ou inativos.
     *  GET https://api.feegow.com/v1/api/professional/list
     * @param {*} ativo 
     * @param {*} unidade_id
     * @param {*} especialidade_id
     * 
     */
    list(ativo = true, unidade_id = null, especialidade_id = null){
        var data = {};
        if(ativo){
            data.ativo = "1";
        }else{
            data.ativo = "0";
        }
        if(unidade_id != null){
            data.unidade_id = unidade_id;
        }
        if(especialidade_id != null){
            data.especialidade_id = especialidade_id;
        }

        return this.apiFeegow.get('professional/list', data);
    }

    search(profissional_id = null){
        return this.apiFeegow.get('/professional/search', profissional_id);
    }
}