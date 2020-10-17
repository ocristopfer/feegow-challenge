class ApiFeegowSpecialties {

    apiFeegow = null;
    
    constructor(token){
         this.apiFeegow = new ApiFeegow(token);    
    }

    /**
     * Lista todas especialidades disponíveis para agendamento.
     */
    list(){
        return this.apiFeegow.get('specialties/list', null);
    }

}