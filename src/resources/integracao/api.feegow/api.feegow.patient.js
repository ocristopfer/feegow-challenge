class ApiFeegowPatient {

    apiFeegow = null;
    
    constructor(){
         this.apiFeegow = new ApiFeegow();    
    }

    /**
     * Lista todas origens.
     */
    listSources(){
        return this.apiFeegow.get('patient/list-sources');
    }


}