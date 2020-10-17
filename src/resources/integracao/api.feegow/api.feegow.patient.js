class ApiFeegowPatient {

    apiFeegow = null;
    
    constructor(token){
         this.apiFeegow = new ApiFeegow(token);    
    }

    /**
     * Lista todas origens.
     */
    listSources(){
        return this.apiFeegow.get('patient/list-sources');
    }


}